<?php

namespace App\Http\Controllers\Trail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

trait MyFunction
{
    public function laoNumber($value){

        switch ((int) $value) {
            case 0:
                $n = '໐';
                break;
            case 1:
               $n = '໑';
           break;
            case 2:
                $n = '໒';
            break;
            case 3:
                $n = '໓';
            break;
            case 4:
                $n = '໔';
                break;
            case 5:
                $n = '໕';
                break;
            case 6:
                $n = '໖';
                break;
            case 7:
                $n = '໗';
                break;
            case 8:
                $n = '໘';
                break;
            case 9:
                $n = '໙';
                break;
            default:
                $n = '';
        }
        return $n;
    }
}
