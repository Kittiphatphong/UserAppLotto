<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LottoController extends Controller
{
    protected $jwt_key ;
    public function __construct()
    {
        $this->jwt_key = env('JWT_KEY');
    }
    //get draw
    public function getDraw(){
        try {
            $charge= Http::post('http://ncclaolotto.com:9008/index.php?r=other/get-all-draw',[
                'jwt_key' => $this->jwt_key,
                'draw_type' => 1,

            ]);

            if($charge['status'] == "0"){
                return $charge['description'];

            }else{
                return $charge['data']['draw_lotto'][0]['draw_no'];
            }
        }catch (\Exception $e){
            return 'jwt_key invalid';
        }
    }
    //sell lotto 2d3d4d5d6d
    public function sell6d($phone,$code,$transaction_id){
        try {
            $buyLotto = Http::post('http://ncclaolotto.com:9008/index.php?r=lotto/sell',[
                'jwt_key' => $this->jwt_key,
                'phone_number' => $phone,
                'code' => $code,
                'transaction_id' => $transaction_id
            ]);

            return $buyLotto;
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    //sell lotto 3/40
    public function sell340($phone,$code,$transaction_id){
        try {
            $buyLotto = Http::post('http://ncclaolotto.com:9008/index.php?r=lotto-340/sell',[
                'jwt_key' => $this->jwt_key,
                'phone_number' => $phone,
                'code' => $code,
                'transaction_id' => $transaction_id
            ]);

            return $buyLotto;
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function delete6d($bill_no){
        try {
            Http::post('http://ncclaolotto.com:9008/index.php?r=lotto/delete',[
                'jwt_key' => $this->jwt_key,
                'bill_no' => $bill_no
            ]);


        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function delete340($bill_no){
        try {
            Http::post('http://ncclaolotto.com:9008/index.php?r=lotto-340/delete',[
                'jwt_key' => $this->jwt_key,
                'bill_no' => $bill_no
            ]);

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

}
