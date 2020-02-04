<?php


namespace App\Modules\Bre\Http\Controllers;

use App\Http\Controllers\IndexController;
use App\Modules\Bre\Model\GoodsCommentsModel;
use App\Modules\Bre\Model\StylistCommentsModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Routing\Controller;
//use App\Http\Requests\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends IndexController
{

    
    public function create()
    {

        return 'create';
        $this->initTheme('manage');

        return $this->theme->scope('bre.index')->render();

    }

    
    public function taskCreate(Request $request)
    {

        $this->initTheme('manage');

        return $this->theme->scope('bre.index')->render();

    }

    
    public function taskDetail($task_id){
        $this->initTheme('manage');

        return $this->theme->scope('bre.index')->render();
    }

    
    public function bounty($task_id){
        echo $task_id;
        return $this->theme->scope('bre.bounty')->render();
    }

    
    public function bountyCreate(Request $request){
        return $this->theme->scope('bre.bounty')->render();
    }

    
    public function taskVerify(Request $request){
        return true;
    }


//    设计师空间评论ajax
    public function ajaxComment(Request $request){
        $data = $request->except('_token');
        $data['comment'] = htmlspecialchars($data['comment']);
        $data['uid'] = Auth::id();
        $user = UserDetailModel::where('uid',$data['uid'])->first();
        $users = UserModel::where('id',$data['uid'])->first();
        $data['nickname'] = $users['name'];
        $data['created_at'] = date('Y-m-d H:i:s',time());
        $result = StylistCommentsModel::create($data);
        if(!$result) return response()->json(['errCode'=>0,'errMsg'=>'提交回复失败！']);
        $comment_data = StylistCommentsModel::where('id',$result['id'])->with('parentComment')->with('user')->with('users')->first()->toArray();
        $comment_data = StylistCommentsModel::time(['data' => [0 => $comment_data]]);
        $comment_data = $comment_data['data'][0];
//        $domain = \CommonClass::getDomain();
        if ($user['avatar'] == null){
            $comment_data['avatar_md5'] = $this->theme->asset()->url('images/meishimeitu/personal/pic.png');
        }else{
            $comment_data['avatar_md5'] = ossUrl('/'.$user['avatar']);
        }

        if(is_array($comment_data['parent_comment']))
        {
            $comment_data['parent_user'] = $comment_data['parent_comment']['nickname'];
        }
        $comment_data['errCode'] = 1;

        return response()->json($comment_data);

    }

//    设计师作品评论ajax
    public function ajaxCommentGoods(Request $request){
        $data = $request->except('_token');
        $data['comment'] = htmlspecialchars($data['comment']);
        $data['uid'] = Auth::id();
        $user = UserDetailModel::where('uid',$data['uid'])->first();
        $users = UserModel::where('id',$data['uid'])->first();
        $data['nickname'] = $users['name'];
        $data['created_at'] = date('Y-m-d H:i:s',time());
        $result = GoodsCommentsModel::create($data);
        if(!$result) return response()->json(['errCode'=>0,'errMsg'=>'提交回复失败！']);
        $comment_data = GoodsCommentsModel::where('id',$result['id'])->with('parentComment')->with('user')->with('users')->first()->toArray();
        $comment_data = StylistCommentsModel::time(['data' => [0 => $comment_data]]);
        $comment_data = $comment_data['data'][0];
//        $domain = \CommonClass::getDomain();
        if ($user['avatar'] == null){
            $comment_data['avatar_md5'] = $this->theme->asset()->url('images/meishimeitu/personal/pic.png');
        }else{
            $comment_data['avatar_md5'] = ossUrl('/'.$user['avatar']);
        }

        if(is_array($comment_data['parent_comment']))
        {
            $comment_data['parent_user'] = $comment_data['parent_comment']['nickname'];
        }
        $comment_data['errCode'] = 1;

        return response()->json($comment_data);

    }

}