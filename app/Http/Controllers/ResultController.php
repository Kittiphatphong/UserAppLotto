<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\BillOrder;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Bill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ResultController extends Controller
{
    protected $PushNotificationController;

    public function __construct(PushNotificationController $pushNotificationController)
    {
        $this->PushNotificationController = $pushNotificationController;
    }

    public function resultList(){
        $result = new Result();
        $billOrders = Bill::where('status_win',1)->get();
        return view('result.resultList')
            ->with('result_list',$result)
            ->with('currently_draw',$this->PushNotificationController->getDraw())
//            ->with('billOrders',$billOrders)
            ->with('results',Result::orderBy('draw','desc')->get());
    }
    public function resultStore(Request $request){
        $request->validate([
            'l2d3d4d5d6d' => 'required|min:6|max:6',
            'animal1' => 'required|different:animal2|min:2|max:2',
            'animal2' => 'required||different:animal3|min:2|max:2',
            'animal3' => 'required|different:animal1|min:2|max:2',

        ]);
        if(round($request->animal1)>40 || round($request->animal2)>40 || round($request->animal3)>40){
            return back()->with("warning","3/40 not more than 40");
        }
        if(BillOrder::where('draw',$this->PushNotificationController->getDraw())->count() <= 0 ){
            return back()->with("warning","This draw is not exist");
        }
        if(in_array($this->PushNotificationController->getDraw(),Result::pluck('draw')->toArray())) {
            return back()->with("warning","This draw is have result already");
        }

        $number2d = substr($request->get('l2d3d4d5d6d'),4,5);
        $animal1 = $request->animal1;
        $animal2 = $request->animal2;
        $animal3 = $request->animal3;
        $animal6d_id = Animal::whereHas('animalNos',function ($q) use ($number2d){
            $q->where('animal_digit',$number2d);
        })->first()->id;
        $animal1_id = Animal::whereHas('animalNos',function ($q) use ($animal1){
            $q->where('animal_digit',$animal1);
        })->first()->id;
        $animal2_id = Animal::whereHas('animalNos',function ($q) use ($animal2){
            $q->where('animal_digit',$animal2);
        })->first()->id;
        $animal3_id = Animal::whereHas('animalNos',function ($q) use ($animal3){
            $q->where('animal_digit',$animal3);
        })->first()->id;
        $result6d = $request->get('l2d3d4d5d6d');


        $result = new Result();
        $result->draw = $this->PushNotificationController->getDraw();
        $result->l2d3d4d5d6d = $result6d;
        $result->d6 = substr ($result6d, 0,1);
        $result->d5 = substr ($result6d, 1,1);
        $result->d4 = substr ($result6d, 2,1);
        $result->d3 = substr ($result6d, 3,1);
        $result->d2 = substr ($result6d, 4,1);
        $result->d1 = substr ($result6d, 5,1);


        $result->animal1 = $animal1;
        $result->animal2 = $animal2;
        $result->animal3 = $animal3;
        $result->animal6d_id = $animal6d_id;
        $result->animal1_id = $animal1_id;
        $result->animal2_id = $animal2_id;
        $result->animal3_id = $animal3_id;
        $result->save();


        $title = "Result draw ". $result->draw;
        $body = "6d=".$result->l2d3d4d5d6d." && 3/40=".$result->animal1."-".$result->animal2."-".$result->animal3;
         $this->PushNotificationController->pushNotificationAll($body,$title,3,$result);
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

                switch (strlen($bill->digit)){
                    case 6:
                        if($bill->digit == $result->l2d3d4d5d6d) $bill->storeWins(6);
                        break;

                    case 5:
                        if($bill->digit == substr($result->l2d3d4d5d6d,1,5)) $bill->storeWins(5);
                        break;

                    case 4:
                        if($bill->digit == substr($result->l2d3d4d5d6d,2,5)) $bill->storeWins(4);
                        break;

                    case 3:
                        if($bill->digit == substr($result->l2d3d4d5d6d,3,5)) $bill->storeWins(3);
                        break;

                    case 2:
                        if($bill->digit == substr($result->l2d3d4d5d6d,4,5)) $bill->storeWins(2);
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
        //push notification to customer
        $this->PushNotificationController->pushNotificationWin($result->draw);
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
        DB::table('bill_orders')->where('draw',$result->draw)->update(['total_win' => 0]);
        DB::table('billorder2d3d4d5d6ds')->whereIn('order_id',$billOrderDraw6d)->update(['type_win' => null]);
        DB::table('billorder340s')->whereIn('order_id',$billOrderDraw340)->update(['type_win' => null]);

    }

    public function winRestore($id){
    $this->winReset($id);
    $this->winStore($id);
    return back()->with('success','Successful');
    }


















//    public function winReset($id){
//        $result = Result::find($id);
//        DB::table('bills')->where('draw',$result->draw)->update(['status_win' => 0]);
//        DB::table('bills')->where('draw',$result->draw)->update(['type_win' => 0]);
//        DB::table('bills')->where('draw',$result->draw)->update(['total_win' => 0]);
//    }


//    public function winStore($id)
//    {
//        $result = Result::find($id);
//        $bills = Bill::all()->where('draw', $result->draw);
//        $bill2ds = $bills->where('type', "2d3d4d5d6d");
//        $bill340s = $bills->where('type', "3/40");
//        $checkResult = [$result->animal1,$result->animal2,$result->animal3];
//
//        //store wining bill 2d3d4d5d6d
//        foreach ($bill2ds as $bill){
//
//            switch (strlen($bill->digit[0])){
//                case 6:
//                    if($bill->digit[0] == $result->l2d3d4d5d6d) $bill->storeWin6ds(6);
//                    break;
//
//                case 5:
//                    if($bill->digit[0] == substr($result->l2d3d4d5d6d,1,5)) $bill->storeWin6ds(5);
//                    break;
//
//                case 4:
//                    if($bill->digit[0] == substr($result->l2d3d4d5d6d,2,5)) $bill->storeWin6ds(4);
//                    break;
//
//                case 3:
//                    if($bill->digit[0] == substr($result->l2d3d4d5d6d,3,5)) $bill->storeWin6ds(3);
//                    break;
//
//                case 2:
//                    if($bill->digit[0] == substr($result->l2d3d4d5d6d,4,5)) $bill->storeWin6ds(2);
//                    break;
//
//                default:
//                    echo "Don't have this digit";

//            }
//
//        }
//
//        //store wining bill 3/40
//        foreach ($bill340s as $bill) {
//
//            switch (count($bill->digit)){
//                case 3:
//                    if (in_array($bill->digit[0], $checkResult) && in_array($bill->digit[1], $checkResult) && in_array($bill->digit[2], $checkResult))
//                        $bill->storeWin340s(3);
//                    break;
//
//                case 2:
//                    if (in_array($bill->digit[0], $checkResult) && in_array($bill->digit[1], $checkResult))
//                        $bill->storeWin340s(2);
//                    break;
//
//                case 1:
//                    if (in_array($bill->digit[0], $checkResult) )
//                        $bill->storeWin340s(1);
//                    break;
//
//                default:
//                    echo "Don't have this digit";
//            }
//
//        }
//        //push notification to customer
//        $this->PushNotificationController->pushNotificationWin($result->draw);
//
//        return back()->with('success','Updated wining draw ' . $result->draw);
//    }
}


