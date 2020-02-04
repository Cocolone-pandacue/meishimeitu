<?php

namespace App\Modules\Vipshop\Models;

use Illuminate\Database\Eloquent\Model;

class StylistOrderModel extends Model
{
    protected $table = 'stylist_order';

    protected $fillable = [
        'code', 'title', 'uid', 'package_id', 'stylist_id', 'time_period', 'cash', 'status','created_at','updated_at'
    ];
}
