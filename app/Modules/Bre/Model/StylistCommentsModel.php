<?php

namespace App\Modules\Bre\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StylistCommentsModel extends Model
{
    protected $table = 'stylist_comments';

    public $timestamps = true;

    protected $fillable = [
        'suid','comment','uid','nickname','pid','praise','created_at','updated_at','rid'
    ];

//计算时间
    static public function time($shopGoods_data){
        if(!empty($shopGoods_data['data'])){
            foreach($shopGoods_data['data'] as $key => $val){
                if((time()-strtotime($val['created_at']))>= 0 && (time()-strtotime($val['created_at'])) < 60){
                    $shopGoods_data['data'][$key]['created_at'] = intval((time()-strtotime($val['created_at']))).'秒前';
                }
                if((time()-strtotime($val['created_at']))> 60 && (time()-strtotime($val['created_at'])) < 3600){
                    $shopGoods_data['data'][$key]['created_at'] = intval((time()-strtotime($val['created_at']))/60).'分钟前';
                }
                if((time()-strtotime($val['created_at']))> 3600 && (time()-strtotime($val['created_at'])) < 24*3600){
                    $shopGoods_data['data'][$key]['created_at'] = intval((time()-strtotime($val['created_at']))/3600).'小时前';
                }
                if((time()-strtotime($val['created_at']))> 24*3600 && (time()-strtotime($val['created_at'])) < 360*24*3600){
                    $shopGoods_data['data'][$key]['created_at'] = intval((time()-strtotime($val['created_at']))/(24*3600)).'天前';
                }
                if((time()-strtotime($val['created_at']))> 360*24*3600 ){
                    $shopGoods_data['data'][$key]['created_at'] = intval((time()-strtotime($val['created_at']))/(360*24*3600)).'年前';
                }
            }
        }
        return $shopGoods_data;
    }
//查询设计师父级评论
    static public function selectStylistComments($uid,$paginate){
        $scomments = StylistCommentsModel::where('stylist_comments.suid',$uid)
            ->where('stylist_comments.pid','0')
            ->select('stylist_comments.*','ud.avatar')
            ->leftjoin('user_detail as ud','ud.uid','=','stylist_comments.uid')
            ->orderBy('stylist_comments.praise', 'desc')
            ->orderBy('stylist_comments.updated_at', 'desc')
            ->paginate($paginate);
        return $scomments;
    }

//查询设计师子级评论
    static public function selectStylistPidComments($uid,$pid,$paginate){
        $scomments = StylistCommentsModel::where('stylist_comments.suid',$uid)
            ->where('stylist_comments.pid',$pid)
            ->select('stylist_comments.*','ud.avatar')
            ->leftjoin('user_detail as ud','ud.uid','=','stylist_comments.uid')
            ->with('parentComment')
            ->orderBy('stylist_comments.praise', 'desc')
            ->orderBy('stylist_comments.updated_at', 'desc')
            ->get();
//            ->paginate($paginate);
//        dd($scomments->toArray());
        return $scomments;
    }

    public function parentComment()
    {
        return $this->belongsTo('App\Modules\Bre\Model\StylistCommentsModel','rid','id');
    }
    public function user()
    {
        return $this->hasOne('App\Modules\User\Model\UserDetailModel','uid','uid');
    }
    public function users()
    {
        return $this->hasOne('App\Modules\User\Model\UserModel','id','uid');
    }

}
