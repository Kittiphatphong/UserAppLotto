<?php

namespace App\Http\Controllers\Trail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait GetDrawController
{

    public function getDraw(){
        //Api form iPro get draw
        $getDraw = Http::post('http://104.155.206.54:1030/api_partner/web/index.php?r=other/get-all-draw',[
            'jwt_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozOCwidXNlcm5hbWUiOiJVc2VyQXBwVGVzdCIsImlwYWRkciI6IiIsImp3dF9zdGFydCI6IjIwMjEtMDMtMTAgMTE6NTE6MDQiLCJqd3RfZXhwaXJlIjoiMjAyMS0wMy0xMCAxMTo1MTowNCJ9.ygSuXZDKBiL6GIKUquENUjEKHyWDu_vDeqBCp9j-FrI',
            'draw_type' => 1
        ]);

        return ['draw_no'=>json_decode($getDraw,false)->data->draw_lotto[0]->draw_no,'draw_date'=>json_decode($getDraw,false)->data->draw_lotto[0]->draw_date] ;

    }
}
