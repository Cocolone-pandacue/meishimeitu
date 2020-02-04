<?php

namespace App\Modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class StylistAuthModel extends Model
{
    protected $table = 'stylist_auth';

    protected $fillable = [
        'uid', 'username', 'stylist_type', 'status', 'auth_time','years'
    ];
}