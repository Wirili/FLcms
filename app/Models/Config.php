<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //
    protected $table="config";
    public $timestamps=false;

    public function children(){
        return $this->hasMany(Config::class,'parent_id','id');
    }

    public function getStoreOptionsAttribute()
    {
        if($this->attributes['store_range'])
            return explode(',', $this->attributes['store_range']);
        else
            return false;
    }
}
