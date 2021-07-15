<?php

namespace App\Http\Controllers\Trail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



trait IproApiController
{
    protected $url = "http://ncclaolotto.com:9063/";
    protected $jwt_key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozOCwidXNlcm5hbWUiOiJVc2VyQXBwVGVzdCIsImlwYWRkciI6IiIsImp3dF9zdGFydCI6IjIwMjEtMDMtMTAgMTE6NTE6MDQiLCJqd3RfZXhwaXJlIjoiMjAyMS0wMy0xMCAxMTo1MTowNCJ9.ygSuXZDKBiL6GIKUquENUjEKHyWDu_vDeqBCp9j-FrI';

    public function historyBill($phone,$start,$end,$total){
        //Api form iPro get draw
        $history = Http::post($this->url.'index.php?r=history',[
            'jwt_key' => $this->jwt_key,
            'phone_number' => $phone,
            'start_time' => $start,
            'end_time' => $end,
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
}
