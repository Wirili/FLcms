<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserMsg extends Model
{
    //
    public $timestamps=false;

    public function user()
    {
        return $this->hasOne(User::class,'user_id','user_id');
    }

    public function touser()
    {
        return $this->hasOne(User::class,'user_id','to_user_id');
    }

    public function getUserNameAttribute()
    {
        return empty($this->user_id)?$this->type:$this->user->name;
    }

    public function getToUserNameAttribute()
    {
        return empty($this->to_user_id)?$this->type:$this->touser->name;
    }
}
