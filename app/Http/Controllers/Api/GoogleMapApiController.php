<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoogleMap;
use Illuminate\Http\Request;
use App\Http\Resources\GoogleMapResource;

class GoogleMapApiController extends Controller
{
    public function index(){

        $data = GoogleMapResource::collection(GoogleMap::all());
        return response()->json([
           'status' => true ,
            'data' => $data
        ],200);
    }
}
