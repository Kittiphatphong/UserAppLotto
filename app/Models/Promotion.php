<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Promotion extends Model
{
    use HasFactory,LogsActivity;
    protected static $logName = 'promotion';
    protected static $logAttributes = ['title','content','image','start','end'];
    protected static $logOnlyDirty = true;
    public function makePromotion($title,$content,$image,$start,$end){
        $this->title = $title;
        $this->content = $content;
        if($image != null){
            $this->image = $image;
        }
        $this->start =$start;
        $this->end = $end;
        $this->save();
    }
    public function differentTime(){
        $now = Carbon::now('Asia/Vientiane');
        $time = $now->diffInSeconds($this->end);
        $date = $now->diffInDays($this->end);
        $formatTime = gmdate('H:i:s',$time);
        if($date == 0)
            $dateTime = $formatTime;
        else
        $dateTime = $date."d ".$formatTime;

        return $dateTime;
    }

}
