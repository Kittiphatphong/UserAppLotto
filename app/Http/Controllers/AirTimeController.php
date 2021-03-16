<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\PayUService\Exception;
class AirTimeController extends Controller
{
    protected $jwt_key ;

    public function __construct()
    {
        $this->jwt_key = env('JWT_KEY');
    }
    public function viewBalance($phone){
        try {
            $balance= Http::post('http://ncclaolotto.com:9008/index.php?r=airtime/view-balance',[
                'jwt_key' => $this->jwt_key,
                'phone_number' => $phone,

            ]);

            if($balance['status'] == "0"){
                return $balance['description'];

            }else{
                return $balance['data']['balance'];
            }
        }catch (\Exception $e){
               return 'jwt_key invalid';
        }
    }

    public function charge($phone,$amount){
        try {
            $charge= Http::post('http://ncclaolotto.com:9008/index.php?r=airtime/charge',[
                'jwt_key' => $this->jwt_key,
                'phone_number' => $phone,
                'amount' => $amount

            ]);

            if($charge['status'] == "0"){
                return $charge['description'];

            }else{
                return $charge['data']['request_id'];
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

}
