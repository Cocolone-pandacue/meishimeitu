<?php

namespace App\Modules\User\Model;
use Illuminate\Database\Eloquent\Model;

class RewardModel extends Model
{
    protected $table = 'reward';

    public $timestamps = false;

    protected $fillable = [
        'name','pic','status','sort','created_at','updated_at'
    ];
    static function reward(){
        $reward = RewardModel::where('status',0)
            ->orderby('sort','desc')
            ->get();
        return $reward;
    }

}