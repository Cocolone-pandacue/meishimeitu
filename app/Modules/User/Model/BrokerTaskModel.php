<?php

namespace App\Modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BrokerTaskModel extends Model
{
    protected $table = 'broker_task';

    public $timestamps = true;

    protected $fillable = [
        'bid', 'tid', 'status', 'link', 'created_at', 'updated_at'
    ];


//  添加链接
    static public function  updatedBroler($taskid,$link){
       $broker = BrokerTaskModel::where('tid',$taskid)->update([
           'link' => $link
       ]);
//       dd($broker);
       return $broker;
    }

//    查询经纪人发布记录
    static public function  findBrokerTask($broker,$tid){
        $brokerTask = self::where('bid',$broker)->where('tid',$tid)->first();
//            ->toArray();
        return $brokerTask;
    }





}