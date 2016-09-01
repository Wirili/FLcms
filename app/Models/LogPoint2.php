<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPoint2 extends Model
{
    //
    public $timestamps = false;

    public function user(){
        return $this->hasOne(User::class,'user_id','user_id');
    }
}
