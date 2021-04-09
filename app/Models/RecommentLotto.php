<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RecommentLotto extends Model
{
    use HasFactory,LogsActivity;
    protected static $logName = 'recommend lotto';
    protected static $logAttributes = ['title','content','draw'];
    protected static $logOnlyDirty = true;

    public function recommendImages(){
        return $this->hasMany(RecommentImage::class,'recommend_id');
    }

    public function makeRecommend($title,$contentShow,$draw){
        $this->title = $title;
        $this->content = $contentShow;
        $this->draw = $draw;
        $this->save();
    }
}
