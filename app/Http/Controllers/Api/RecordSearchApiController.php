<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\DreamSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\json_decode;

class RecordSearchApiController extends Controller
{
    public function recordSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_value' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "msg" => $validator->errors()->first(),
            ], 422);
        }
        $value = DreamSearch::pluck('name')->toArray();
        if(in_array($request->search_value,$value)){
           $dreamSearch = DreamSearch::where('name',$request->search_value)->first();
           $dreamSearch->count = $dreamSearch->count + 1;
           $dreamSearch->save();

        }else{
            $dreamSearch = new DreamSearch();
            $dreamSearch->name = $request->search_value;
            $dreamSearch->count =1;
            $dreamSearch->save();
        }
        return response()->json([
            'status' => true,
            'msg' =>  'saved'
        ]);


    }

    public function dreamSearchList(){
        try {
            $animal = Animal::pluck('description')->toArray();
            $data = [];
            for ($i=0;$i<count($animal);$i++){
                $explode_id = explode(',', $animal[$i]);
                for ($j=0;$j<count($explode_id);$j++){
                    array_push($data,str_replace([' ','.'],'',$explode_id[$j]) );
                }
            }

            return response()->json([
               'status' => true,
               'data' =>  $data
            ]);


        }catch (\Exception $e){
            return response()->json([
                'status' => true,
                'msg' => $e->getmassage()
            ]);
        }
    }
}
