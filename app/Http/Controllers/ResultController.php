<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\BillOrder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PushNotificationController;
class ResultController extends Controller
{
    protected $PushNotificationController;
    public function __construct(PushNotificationController $pushNotificationController)
    {
        $this->PushNotificationController = $pushNotificationController;
    }

    public function resultList(){
        $result = new Result();
        $billOrder = BillOrder::where('id',DB::raw("(select max(`id`) from bill_orders)"))->pluck('draw')->first();
        $billOrders = BillOrder::where('status_win',1)->get();
        return view('result.resultList')
            ->with('result_list',$result)
            ->with('currently_draw',$billOrder)
            ->with('billOrders',$billOrders)
            ->with('results',Result::all());
    }
    public function resultStore(Request $request){
        $request->validate([
            'draw' => 'required|unique:results',
            'l2d3d4d5d6d' => 'required|min:6|max:6',
            'animal1' => 'required|different:animal2|min:2|max:2',
            'animal2' => 'required||different:animal3|min:2|max:2',
            'animal3' => 'required|different:animal1|min:2|max:2',

        ]);
        if(round($request->animal1)>40 || round($request->animal2)>40 || round($request->animal3)>40){
            return back()->with("warning","3/40 not more than 40");
        }
        if(BillOrder::where('draw',$request->get('draw'))->count() <= 0 ){
            return back()->with("warning","This draw is not exist");
        }

        $result = new Result();
        $result->draw = $request->get('draw');
        $result->l2d3d4d5d6d = $request->get('l2d3d4d5d6d');
        $result->animal1 = $request->animal1;
        $result->animal2 = $request->animal2;
        $result->animal3 = $request->animal3;
        $result->save();
        $title = "Result lottory draw ". $result->draw;
        $body = "6d=".$result->l2d3d4d5d6d."\n3/40=".$result->animal1."-".$result->animal2."-".$result->animal3;
         $this->PushNotificationController->pushNotificationAll($body,$title);
        $this->winStore($result->id);
        return back()->with('success',"Updated result draw ".$result->draw." successful");

    }

    public function winStore($id)
    {
        $result = Result::find($id);
        $billOrders = BillOrder::all()->where('draw', $result->draw);
        $bill2ds = $billOrders->where('type', "2d3d4d5d6d");
        $bill340s = $billOrders->where('type', "3/40");
        $checkResult = [$result->animal1,$result->animal2,$result->animal3];

        //store wining bill 2d3d4d5d6d
    foreach ($bill2ds as $bill2d){
        foreach ($bill2d->billorder2d3d4d5d6ds as $bill){

            switch (strlen($bill->number_code)){
                case 6:
                    if($bill->number_code == $result->l2d3d4d5d6d) $bill->storeWins(6);
                    break;

                case 5:
                    if($bill->number_code == substr($result->l2d3d4d5d6d,1,5)) $bill->storeWins(5);
                    break;

                case 4:
                    if($bill->number_code == substr($result->l2d3d4d5d6d,2,5)) $bill->storeWins(4);
                    break;

                case 3:
                    if($bill->number_code == substr($result->l2d3d4d5d6d,3,5)) $bill->storeWins(3);
                    break;

                case 2:
                    if($bill->number_code == substr($result->l2d3d4d5d6d,4,5)) $bill->storeWins(2);
                    break;

                default:
                    echo "Don't have this digit";
            }
        }
    }

        //store wining bill 3/40
        foreach ($bill340s as $bill340) {
            foreach ($bill340->bill340s as $bill) {
                if ($bill->animal1 != null && $bill->animal2 != null && $bill->animal3 != null) {
                    if (in_array($bill->animal1, $checkResult) && in_array($bill->animal2, $checkResult) && in_array($bill->animal3, $checkResult))
                        $bill->storeWins(3);

                } elseif ($bill->animal1 != null && $bill->animal2 != null && $bill->animal3 == null) {

                    if (in_array($bill->animal1, $checkResult) && in_array($bill->animal2, $checkResult))
                        $bill->storeWins(2);

                } else {

                    if (in_array($bill->animal1, $checkResult))
                        $bill->storeWins(1);

                }
            }

        }
        return back()->with('success','Updated wining draw ' . $result->draw);
    }

    public function resultDelete($id){
        $this->winReset($id);
        $result =  Result::find($id);
        $result->delete();
        return back()->with('success','Deleted result successful');

    }

    public function winReset($id){
        $result = Result::find($id);
        $billOrderDraw6d = BillOrder::where('draw',$result->draw)->where('type','2d3d4d5d6d')->pluck('id');
        $billOrderDraw340 = BillOrder::where('draw',$result->draw)->where('type','3/40')->pluck('id');
        DB::table('bill_orders')->where('draw',$result->draw)->update(['status_win' => 0]);
        DB::table('billorder2d3d4d5d6ds')->whereIn('order_id',$billOrderDraw6d)->update(['status_win' => null]);
        DB::table('billorder340s')->whereIn('order_id',$billOrderDraw340)->update(['status_win' => null]);

    }

    public function winRestore($id){
    $this->winReset($id);
    $this->winStore($id);
    return back()->with('success','Successful');
    }

}
