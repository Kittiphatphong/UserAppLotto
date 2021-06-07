<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Resources\NewsResource;
class NewsApiController extends Controller
{
    public function newsList(Request $request){
        try {
            return response()->json([
               'status' => true,
               'data' => NewsResource::collection(News::with('newsImages')->latest()->get())
            ]);

        }catch (\Exception $e){
            return response()->json([
                'status' => true,
                'msg' => $e->getMessage()
            ],422);
        }
    }
}
