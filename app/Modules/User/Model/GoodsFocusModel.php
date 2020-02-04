<?php

namespace App\Modules\User\Model;
use Illuminate\Database\Eloquent\Model;

class GoodsFocusModel extends Model
{
    protected $table = 'goods_focus';

    public $timestamps = false;

    protected $fillable = [
        'uid','goods_id','created_at'
    ];

}