<?php

namespace App\Modules\Vipshop\Models;

use Illuminate\Database\Eloquent\Model;

class StylistPackageOrderModel extends Model
{
    protected $table = 'stylist_package_order';

    protected $fillable = [
        'stylist_id', 'package_id', 'uid', 'time_period', 'cash', 'start_time', 'end_time', 'status','created_at','updated_at'
    ];
}
