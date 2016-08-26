<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public $timestamps=false;

    public function category()
    {
        return $this->hasOne(Article::class,'cat_id','cat_id');
    }
}
