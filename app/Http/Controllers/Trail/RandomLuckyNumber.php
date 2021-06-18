<?php

namespace App\Http\Controllers\Trail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

trait RandomLuckyNumber
{
    public function luckyRandom($set,$type,$name){
        session_start();
         if($set>100){
             return null;
         }
        try {
            $_SESSION[$name];
        }catch (\Exception $e){
            $_SESSION[$name] = null;
        }

            if($_SESSION[$name] != null){
                if(count($_SESSION[$name])+$set >99){
                    $lucky_number = [];
                }else{
                    $lucky_number = $_SESSION[$name];
                }
            } else{
            $lucky_number = [];
            }

        $setRandom = [];
        for ($i=0; $i<$set;$i++) {
            $random_lucky_number = rand(0, 99);
            if ($random_lucky_number < 10) {
                $random_lucky_number = "0" . $random_lucky_number;
            }

            $random = (string)$random_lucky_number;

            while (in_array($random, $lucky_number)) {

                $random_lucky_number = rand(0, 99);
                if ($random_lucky_number < 10) {
                    $random_lucky_number = "0" . $random_lucky_number;
                }
                $random = (string)$random_lucky_number;

            }

            if ($type >2){
                     $randAll=null;
                for ($j=0;$j<$type-2;$j++){
                    $randAll = rand(0,9).$randAll;
                }

                    $randomType = $randAll.$random;
            }
            else{
                    $randomType = $random;
            }



            array_push($lucky_number , $random);
            if($set==1){
                $setRandom = $randomType;
            }else{
                array_push($setRandom,$randomType);
            }

        }

        $_SESSION[$name] = $lucky_number;

        return  $setRandom;


    }
}
