<?php

namespace App\Modules\Task\Model;

use Illuminate\Database\Eloquent\Model;


class BrainpowerUserLogoModel extends Model
{
    protected $table = 'brainpower_user_logo';
    protected $fillable = [
        'id', 'uid', 'name', 'slogan', 'industry', 'logo', 'color', 'svg', 'status', 'create_time', 'update_time'
    ];
    public $timestamps = false;
}
