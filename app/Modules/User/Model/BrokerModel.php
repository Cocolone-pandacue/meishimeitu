<?php

namespace App\Modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BrokerModel extends Model
{
    protected $table = 'broker';

    public $timestamps = true;

    protected $fillable = [
        'uid', 'username', 'status', 'auth_time', 'created_at', 'updated_at'
    ];

//    根据uid查找经纪人id
    public static function  findBroker($uid){
        $broker = self::select('id')->where('uid',$uid)->where('status',1)->orderBy('created_at','desc')->first();
        return $broker->id;
    }

  //    根据经纪人id查找uid
    public static function  findBrokerid($id){
        $broker = self::select('uid')->where('id',$id)->first();
        return $broker->uid;
    }


}