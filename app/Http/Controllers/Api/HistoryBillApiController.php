<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Trail\IproApiController;


class HistoryBillApiController extends Controller
{
    use IproApiController;

    public function history(Request $request)
    {
        try {
            $phone = $request->user()->currentAccessToken()->tokenable->phone;
            $data = $this->historyBill("2097262177",$request->start,$request->end,$request->total);

            return  response()->json([
                'status' => true,
                'data' => $data
            ]);

        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
        }
    }
}
