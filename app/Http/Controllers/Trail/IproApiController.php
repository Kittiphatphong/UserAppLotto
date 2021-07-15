<?php

namespace App\Http\Controllers\Trail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



trait IproApiController
{
    protected $url = "http://ncclaolotto.com:9063/";
    protected $jwt_key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozOCwidXNlcm5hbWUiOiJVc2VyQXBwVGVzdCIsImlwYWRkciI6IiIsImp3dF9zdGFydCI6IjIwMjEtMDMtMTAgMTE6NTE6MDQiLCJqd3RfZXhwaXJlIjoiMjAyMS0wMy0xMCAxMTo1MTowNCJ9.ygSuXZDKBiL6GIKUquENUjEKHyWDu_vDeqBCp9j-FrI';

    public function historyBill($phone,$draw_id,$page,$total){
        $history = Http::post($this->url.'index.php?r=history',[
            'jwt_key' => $this->jwt_key,
            'phone_number' => $phone,
            'draw_id' => $draw_id,
            'page' => $page,
            'total' =>$total
        ])->getBody()->getContents();

        $data= json_decode($history)->data;
        if($data->data ==null)
            $total_sale=0;
        else
            $total_sale=$data->total_sale;
        return [
            'total_page' => $data->total_page,
            'total_bill' => $data->total_bill,
            'total_sell' => $total_sale,
            'bill_list' => $data->data
        ];
    }

    public function getAllDraw(){
        $history = Http::post($this->url.'index.php?r=other/get-all-draw',[
            'jwt_key' => $this->jwt_key,

        ])->getBody()->getContents();
        $data = json_decode($history)->data->draw_lotto;
        return $data;
    }
}
