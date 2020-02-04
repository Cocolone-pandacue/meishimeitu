<?php

namespace App\Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GoodsSlideshowModel extends Model
{
    protected $table = 'goods_slideshow';

//    public $timestamps = false;

    protected $fillable = [
        'id','name', 'url','status','sort','created_at','updated_at'
    ];
}