<?php

namespace App\Modules\Vipshop\Models;

use Illuminate\Database\Eloquent\Model;

class StylistPackageModel extends Model
{
    protected $table = 'stylist_package';

    protected $fillable = [
        'title', 'logo', 'status', 'price_rules', 'list', 'created_at', 'updated_at', 'deleted_at','time','cash','stylist_success_draw_ratio'
    ];
}
