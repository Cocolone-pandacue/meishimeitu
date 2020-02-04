<?php

namespace App\Modules\Bre\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GoodsCommentsModel extends Model
{
    protected $table = 'goods_comments';

    public $timestamps = true;

    protected $fillable = [
        'suid','comment','uid','nickname','pid','praise','created_at','updated_at','rid'
    ];

//查询设计师父级评论
    static public function selectStylistComments($id,$paginate){
        $scomments = GoodsCommentsModel::where('goods_comments.suid',$id)
            ->where('goods_comments.pid','0')
            ->select('goods_comments.*','ud.avatar')
            ->leftjoin('user_detail as ud','ud.uid','=','goods_comments.uid')
            ->orderBy('goods_comments.praise', 'desc')
            ->orderBy('goods_comments.updated_at', 'desc')
            ->paginate($paginate);
        return $scomments;
    }

//查询设计师子级评论
    static public function selectStylistPidComments($id,$pid,$paginate){
        $scomments = GoodsCommentsModel::where('goods_comments.suid',$id)
            ->where('goods_comments.pid',$pid)
            ->select('goods_comments.*','ud.avatar')
            ->leftjoin('user_detail as ud','ud.uid','=','goods_comments.uid')
            ->with('parentComment')
            ->orderBy('goods_comments.praise', 'desc')
            ->orderBy('goods_comments.updated_at', 'desc')
            ->get();
//            ->paginate($paginate);
//        dd($scomments->toArray());
        return $scomments;
    }

    public function parentComment()
    {
        return $this->belongsTo('App\Modules\Bre\Model\GoodsCommentsModel','rid','id');
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
