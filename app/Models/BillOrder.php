<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillOrder extends Model
{
    use HasFactory;

    public function msg($msg){
        $this->msg = $msg;
        $this->total = 0;
        $this->save();
    }
    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function billorder2d3d4d5d6ds(){
        return $this->hasMany(Billorder2d3d4d5d6d::class,'order_id');
    }
    public function bill340s(){
        return $this->hasMany(Billorder340::class,'order_id');
    }
    public function billSelect340s(){
        return $this->hasMany(Billorder340::class,'order_id')->select('id','digit','money','order_id','type_win','status_buy


        ','created_at','updated_at');
    }

    public function win2d3d4d5d6ds(){
        return $this->hasMany(Billorder2d3d4d5d6d::class,'order_id')->whereNotNull('type_win');
    }
    public function winAmount2d3d4d5d6d(){
        $amounts = $this->hasMany(Billorder2d3d4d5d6d::class,'order_id')->whereNotNull('type_win');
        $total = 0;
        $arrayAmount = $amounts->get()->toArray();
        for ($i=0;$i<$amounts->count();$i++){
            switch ($arrayAmount[$i]['type_win']){
                case 6:
                    $sum = $arrayAmount[$i]['money'] * 400000;
                    break;

                case 5:
                    $sum = $arrayAmount[$i]['money'] * 40000;
                    break;

                case 4:
                    $sum = $arrayAmount[$i]['money'] * 5000;
                    break;

                case 3:
                    $sum = $arrayAmount[$i]['money'] * 500;
                    break;

                case 2:
                    $sum = $arrayAmount[$i]['money'] * 60;
                    break;

                default:
                    echo "Don't have this digit";
            }

           $total+=  $sum;

        }
        return $total;

    }



    public function win340s(){
        return $this->hasMany(Billorder340::class,'order_id')->whereNotNull('type_win');
    }
    public function winAmount340(){
        $amounts = $this->hasMany(Billorder340::class,'order_id')->whereNotNull('type_win');
        $total = 0;
        $arrayAmount = $amounts->get()->toArray();
        for ($i=0;$i<$amounts->count();$i++){

            switch ($arrayAmount[$i]['type_win']){
                case 3:
                    $sum = $arrayAmount[$i]['money'] * 6000;
                    break;

                case 2:
                    $sum = $arrayAmount[$i]['money'] * 160;
                    break;

                case 1:
                    $sum = $arrayAmount[$i]['money'] * 8;
                    break;

                default:
                    echo "Don't have this digit";
            }

            $total+=  $sum;

        }
        return $total;

    }

}
