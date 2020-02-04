<?php

namespace App\Modules\User\Model;
use Illuminate\Database\Eloquent\Model;

class RewardListModel extends Model
{
    protected $table = 'reward_list';

    public $timestamps = false;

    protected $fillable = [
        'uid','uname','status','reward_id','source','created_at','updated_at'
    ];
//      循环中奖列表
    static function rewardlist(){
        $reward = RewardListModel::select('us.name as usname','rd.name as rdname')
            ->where('reward_list.source','2')
            ->leftjoin('users as us','us.id','=','reward_list.uid')
            ->leftjoin('reward as rd','rd.id','=','reward_list.reward_id')
            ->get();
        return $reward;
    }
    //    *代替汉字
    static function substr_cut($user_name){
        $strlen = mb_strlen($user_name, 'utf-8');
        $firstStr= mb_substr($user_name, 0, 1, 'utf-8');
        $lastStr= mb_substr($user_name, -1, 1, 'utf-8');
        return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
    }

}