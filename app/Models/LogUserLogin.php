<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LogUserLogin extends Model
{
    //
    public $timestamps=false;

    public function user()
    {
        return $this->hasOne(User::class,'user_id','user_id');
    }
}
