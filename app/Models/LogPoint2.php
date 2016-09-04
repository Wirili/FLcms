<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPoint2 extends Model
{
    //
    public $timestamps = false;
    protected $fillable=['user_id','price','about','type','ip','add_time'];

    public function user(){
        return $this->hasOne(User::class,'user_id','user_id');
    }

    public static function create_mult($data)
    {
        foreach ($data as $item) {
            $item['ip'] = array_get($data,'ip',\Request::getClientIp());
            $item['add_time'] = array_get($data,'add_time',date('Y-m-d H:i:s'));
            self::create($item);
        }

    }
}
