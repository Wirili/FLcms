<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFarm extends Model
{
    //
    public $timestamps=false;
    public $appends=['is_settle'];

    public function user()
    {
        return $this->hasOne(User::class,'user_id','user_id');
    }

    public function getAddTimeAttribute($value)
    {
        return $value?date('Y-m-d',strtotime($value)):'';
    }

    public function getEndTimeAttribute($value)
    {
        return $value?date('Y-m-d',strtotime($value)):'';
    }

    public function getSettleTimeAttribute($value)
    {
        return $value?date('Y-m-d',strtotime($value)):'';
    }

    public function getIsSettleAttribute()
    {
        return date('Y-m-d')>$this->settle_time;
    }
}
