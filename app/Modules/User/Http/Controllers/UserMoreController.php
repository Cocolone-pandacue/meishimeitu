<?php
namespace App\Modules\User\Http\Controllers;


use App\Http\Controllers\UserCenterController;
use App\Http\Requests;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\User\Model\BrokerModel;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Manage\Model\ServiceModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Task\Model\TaskAttachmentModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\Task\Model\TaskFocusModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\Task\Model\WorkAttachmentModel;
use App\Modules\User\Http\Requests\PubGoodsRequest;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\RewardListModel;
use App\Modules\User\Model\RewardModel;
use App\Modules\User\Model\TagsModel;
use App\Modules\User\Model\UserFocusModel;
use App\Modules\User\Model\GoodsFocusModel;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Model\RealnameAuthModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Theme;
use App\Modules\User\Model\UserDetailModel;

class UserMoreController extends UserCenterController
{
    public function __construct()
    {
        parent::__construct();
        $this->user = Auth::user();
    }
//    轮训
    public function postInquire(Request $request){
        $data = $request->all();
        $day = date('Y-m-d H:i:s',time()-60);
        $mess = MessageReceiveModel::where('js_id',$data['uid'])->where('receive_time','>=',$day)->where('status',0)->where('statusnew',0)->first();
        $message = MessageReceiveModel::where('id',$mess['id'])->update(['statusnew' => 1]);
        if ($mess){
            switch ($mess['code_name']){
                case 'stylist_apply':
                    $desc = '您发布的项目有新的设计师申请了';
                    break;
                case 'employ_acceptnew':
                    $desc = '需求方同意了您的项目的申请';
                    break;
                case 'employ_refusenew':
                    $desc = '需求方拒接了您的项目的申请';
                    break;
                case 'stylist_accept':
                    $desc = '设计师接受了您的项目雇佣';
                    break;
                case 'stylist_refuse':
                    $desc = '设计师拒绝了您的项目雇佣';
                    break;
                case 'stylist_way':
                    $desc = '设计师设置了项目验收方式';
                    break;
                case 'stylist_file':
                    $desc = '设计师上传了设计稿件，请及时查收';
                    break;
                case 'manuscript_settlement_new':
                    $desc = '您的项目通过验收了,项目款已到账';
                    break;
                default:
                    $desc = '收到新的系统消息，请注意查收';
            }
            $view =[
                'code' => 1,
                'desc' => $desc,
            ];
        }else{
            $view =[
                'code' => 2,
            ];
        }

        return response()->json($view);
    }

//    我的任务收藏
    public function myTocusTask(Request $request)
    {
        $data = $request->all();
        $this->initTheme('userinfo');
        $this->theme->setTitle('用户收藏');

        
        $query = TaskFocusModel::select('task_focus.id as focus_id','tk.*','tc.name as category_name','ud.avatar')
            ->where('task_focus.uid',$this->user['id'])->orderby('task_focus.created_at','DESC')
            ->join('task as tk','tk.id','=','task_focus.task_id');
        if(!empty($data['search']))
        {
            $query->where('tk.title','like','%'.e($data['search'])."%");
        }
        $query = $query->leftjoin('cate as tc','tc.id','=','tk.cate_id')
            ->leftjoin('user_detail as ud','ud.uid','=','tk.uid');

        $task = $query->paginate(5);
        $task_focus = $task->toArray();
        if(!empty($task_focus['data']) && is_array($task_focus['data'])){
            foreach($task_focus['data'] as $k => $v){
                $provinceName = DistrictModel::getDistrictName($v['province']);
                $cityName = DistrictModel::getDistrictName($v['city']);
                $task_focus['data'][$k]['province_name'] = $provinceName;
                $task_focus['data'][$k]['city_name'] = $cityName;
            }
        }
        $status = [
            'status'=>[
                0=>'暂不发布',
                1=>'已经发布',
                2=>'赏金托管',
                3=>'审核通过',
                4=>'威客交稿',
                5=>'雇主选稿',
                6=>'任务公示',
                7=>'交付验收',
                8=>'双方互评'
            ]
        ];
        $task_focus['data'] = \CommonClass::intToString($task_focus['data'],$status);
        $domain = \CommonClass::getDomain();

        $view = [
            'task'=>$task,
            'task_focus'=>$task_focus,
            'domain'=>$domain,
        ];
        return $this->theme->scope('user.myfocus', $view)->render();
    }


    //    我的作品收藏
    public function myTocusGoods(Request $request){
        $data = $request->all();
        $this->initTheme('userinfo');
        $this->theme->setTitle('我的收藏');
//        显示数据
        $goods = GoodsFocusModel::select('gd.*','ud.avatar','us.name as nickname','ct.name as ctname')
            ->where('goods_focus.uid',$this->user['id'])
            ->where('gd.status',1)
            ->where('gd.is_delete',0)
            ->join('goods as gd','goods_focus.goods_id','=','gd.id')
            ->join('user_detail as ud','gd.uid','=','ud.uid')
            ->leftjoin('cate as ct','gd.cate_id','=','ct.id')
            ->leftjoin('users as us','gd.uid','=','us.id')
            ->orderby('gd.updated_at','desc')
            ->groupBy('goods_focus.goods_id')
            ->paginate(9);
        $goods_data = $goods->toArray();
//        计数
        $goodsnum = GoodsFocusModel::select('goods_focus.id')
            ->where('goods_focus.uid',$this->user['id'])
            ->where('gd.status',1)
            ->where('gd.is_delete',0)
            ->join('goods as gd','goods_focus.goods_id','=','gd.id')
            ->groupBy('goods_focus.goods_id')
            ->get()
            ->toArray();
        $goodsnum = count($goodsnum);
//        计算时间
        if(!empty($goods_data['data'])){
            $goods_data = $this->time($goods_data);
        }
//        dd($goods_data);die;
        $view =  [
            'goods' => $goods,
            'goods_data' => $goods_data,
            'goodsnum' => $goodsnum,
        ];
        return $this->theme->scope('user.myfocus', $view)->render();
    }

    public function ajaxDeleteFocus($id)
    {
        $result = TaskFocusModel::where('uid',$this->user['id'])
            ->where('id',$id)->delete();
        if(!$result) return response()->json(['errCode'=>0,'errMsg'=>'删除失败！']);

        return response()->json(['errCode'=>1,'id'=>$id]);
    }

//    时间计算函数
    public function time($data){
        foreach($data['data'] as $key => $val){
            if((time()-strtotime($val['created_at']))> 0 && (time()-strtotime($val['created_at'])) < 3600){
                $data['data'][$key]['created_at'] = intval((time()-strtotime($val['created_at']))/60).'分钟前';
            }
            if((time()-strtotime($val['created_at']))> 3600 && (time()-strtotime($val['created_at'])) < 24*3600){
                $data['data'][$key]['created_at'] = intval((time()-strtotime($val['created_at']))/3600).'小时前';
            }
            if((time()-strtotime($val['created_at']))> 24*3600 && (time()-strtotime($val['created_at'])) < 360*24*3600){
                $data['data'][$key]['created_at'] = intval((time()-strtotime($val['created_at']))/(24*3600)).'天前';
            }
            if((time()-strtotime($val['created_at']))> 360*24*3600 ){
                $data['data'][$key]['created_at'] = intval((time()-strtotime($val['created_at']))/(360*24*3600)).'年前';
            }
        }
        return $data;
    }

//    我的关注作品动态
    public function userFocus()
    {
//        $this->initTheme('usercenter');
        $this->initTheme('userinfo');
        $this->theme->setTitle('作品动态');
        $focus = UserFocusModel::select('user_focus.*','ud.avatar','us.name as nickname','gd.*','ct.name as ctname')
            ->where('user_focus.uid',$this->user['id'])
            ->where('gd.status',1)
            ->where('gd.is_delete',0)
            ->join('user_detail as ud','user_focus.focus_uid','=','ud.uid')
            ->leftjoin('goods as gd','user_focus.focus_uid','=','gd.uid')
            ->leftjoin('cate as ct','gd.cate_id','=','ct.id')
            ->leftjoin('users as us','user_focus.focus_uid','=','us.id')
//            ->with('tags')
            ->orderby('gd.updated_at','desc')
            ->paginate(9);
        $focus_data = $focus->toArray();
        $domain = \CommonClass::getDomain();
//        时间计算
        if(!empty($focus_data['data'])){
            $focus_data = $this->time($focus_data);
        }
//        dd($focus_data['data']);die;
        $view = [
            'focus'=>$focus,
            'focus_data'=>$focus_data,
            'domain'=>$domain,
        ];
        return $this->theme->scope('user.userfocus', $view)->render();
    }

//我的关注关注的人
    public function userFocusPeople(){
        $this->initTheme('userinfo');
        $this->theme->setTitle('关注的人');

        $focus = UserFocusModel::select('user_focus.*','ud.avatar','us.name as nickname','pf.profession','dt.name as dtname')
            ->where('user_focus.uid',$this->user['id'])
            ->join('user_detail as ud','user_focus.focus_uid','=','ud.uid')
            ->join('users as us','user_focus.focus_uid','=','us.id')
            ->leftjoin('district as dt','ud.province','=','dt.id')
            ->leftjoin('profession as pf','ud.profession_id','=','pf.id')
//            ->join('goods as gd','user_focus.focus_uid','=','gd.uid')
            ->paginate(9);
        $focus_data = $focus->toArray();
//        封面
        foreach ($focus as $f){
            $cover[] = DB::table('goods')
                ->select('id','cover','uid')
                ->where('uid',$f->focus_uid)
                ->where('status','1')
                ->where('is_delete','0')
                ->orderby('updated_at','desc')
                ->paginate(2)
                ->toArray();
        }
//        作品个数
        foreach ($focus as $f){
            $productionnum[] = DB::table('goods')
                ->where('uid',$f->focus_uid)
                ->where('status','1')
                ->where('is_delete','0')
                ->count();
        }
//        粉丝
        foreach ($focus as $f){
            $fansnum[] = UserFocusModel::where('focus_uid',$f->focus_uid)
                ->count();
        }
        $focus_datanew = null;
        for ($i=0;$i<count($focus_data['data']);$i++){
            $focus_datanew[] =array_merge($focus_data['data'][$i],$cover[$i]);
            array_push($focus_datanew[$i],$productionnum[$i],$fansnum[$i]);
        }

//        dd($productionnum);die;
//        计算多少个关注
        $focusnum = UserFocusModel::select('user_focus.id')
            ->where('user_focus.uid',$this->user['id'])
            ->join('users as us','user_focus.focus_uid','=','us.id')
            ->get()->toArray();
        $num = count($focusnum);
//        dd($focus_datanew);
        $view = [
            'focus'=>$focus,
            'focus_data'=>$focus_datanew,
            'num' => $num,
        ];
        return $this->theme->scope('user.userfocuspeople', $view)->render();
    }


    public function userFocusDelete($id)
    {
        $result = UserFocusModel::where('uid',$this->user['id'])
            ->where('id',$id)->delete();
        if(!$result) return response()->json(['errCode'=>0,'errMsg'=>'删除失败！']);

        return response()->json(['errCode'=>1,'id'=>$id]);
    }


    public function userNotFocus($id)
    {
        $result = UserFocusModel::where('uid',$this->user['id'])
            ->where('focus_uid',$id)->delete();
        if(!$result) return response()->json(['errCode'=>0,'errMsg'=>'删除失败！']);

        return response()->json(['errCode'=>1,'id'=>$id]);
    }

//旧我的发布
    public function myTasksListold(Request $request)
    {
        $this->initTheme('userinfo');
        $this->theme->setTitle('我发布的任务');

        $data = $request->all();

        $data['uid'] = $this->user['id'];

		$taskType=TaskTypeModel::getTaskTypeAll();
		foreach($taskType as $Vtt){
			$Vtt->counts=TaskModel::where('uid',$data['uid'])->where('type_id',$Vtt['id'])->where('status','>',0)->where('task.status', '<=', 11);
                if($Vtt['alias'] == 'xuanshang'){
                    $Vtt->counts = $Vtt->counts->where('task.bounty_status',1);
                }else{
                    $Vtt->counts = $Vtt->counts->whereIn('task.bounty_status',[0,1]);
                }
            $Vtt->counts = $Vtt->counts->count();
		}
		$data['type']=isset($data['type'])?$data['type']:$taskType[0]['id'];
		$data['status']=isset($data['status'])?$data['status']:0;
		if($taskType[0]['alias'] == 'xuanshang' && !isset($data['type'])){
			$taskStatus=[
				15=>'投标中',
				2=>'选标中',
				1=>'公示中',
				3=>'交付中',
				4=>'已结束',
				5=>'其他'
		    ];
		}else{
			$taskTM=TaskTypeModel::select('alias')->where('id',$data['type'])->first();
			switch($taskTM['alias']){
				case 'xuanshang':
				$taskStatus=[
                    15=>'投标中',
                    2=>'选标中',
					1=>'公示中',
					3=>'交付中',
					4=>'已结束',
					5=>'其他'
		        ];
				$status = [
					2=>'已发布',
					3=>'投标中',
					4=>'投标中',
					5=>'选标中',
					6=>'公示中',
					7=>'交付中',
					8=>'已结束',
					9=>'已结束',
					10=>'已结束',
					11=>'维权中'
				];
				if(isset($data['status']) && !in_array($data['status'],[1,2,3,4,5,15])){
					$data['status']=0;
				}
				break;
				case 'zhaobiao':
				$taskStatus=[
					6=>'待审核',
					7=>'投标中',
					8=>'选标中',
					9=>'公示中',
					10=>'验收中',
					11=>'维权中',
					12=>'交易成功',
					13=>'交易关闭'
		        ];
				$status = [
					1=>'待审核',
					3=>'投标中',
					4=>'投标中',
					5=>'选标中',
					6=>'公示中',
					7=>'验收中',
					8=>'交易成功',
					9=>'交易成功',
					10=>'交易关闭',
					11=>'维权中'
				];
				if(isset($data['status']) && !in_array($data['status'],[6,7,8,9,10,11,12,13])){
					$data['status']=0;
				}
				break;
			}
		}
        $my_tasks = TaskModel::myTasks($data);
		foreach($my_tasks as $key => $val){
                if((time()-strtotime($val['created_at']))> 0 && (time()-strtotime($val['created_at'])) < 3600){
                    $val['show_publish'] = intval((time()-strtotime($val['created_at']))/60).'分钟前';
                }
                if((time()-strtotime($val['created_at']))> 3600 && (time()-strtotime($val['created_at'])) < 24*3600){
                    $val['show_publish'] = intval((time()-strtotime($val['created_at']))/3600).'小时前';
                }
                if((time()-strtotime($val['created_at']))> 24*3600){
                    $val['show_publish'] = intval((time()-strtotime($val['created_at']))/(24*3600)).'天前';
                }
        }
        $domain = \CommonClass::getDomain();



        $pie_data = \CommonClass::pie($this->user['id']);
        $view = [
            'my_tasks'=>$my_tasks,
            'domain'=>$domain,
            'pie_data'=>$pie_data,
            'status'=>$status,
			'task_type'=>$taskType,
			'merge'    =>$data,
			'task_status'=>$taskStatus
        ];
        $this->theme->set('TYPE',2);
        return $this->theme->scope('user.mytasklist', $view)->render();
    }


//我的发布
    public function myTasksList(Request $request){
        $this->initTheme('userinfo');
        $this->theme->setTitle('我发布的任务');
        $data = $request->all();
//        判断是否是服务商
        if (isset($data['judge']) ){
            switch ($data['judge']){
                case '1':
                    $task = DB::table('task')->where('uid',$this->user['id'])->where('status','>=',2)->first();
                    $work = DB::table('work')->where('uid',$this->user['id'])->where('status','>=',1)->first();
                    if ($task==null && $work!=null){
                        return redirect('user/acceptTasksList');
                    }
                    break;
                default:

                    break;
            }
        }
        $data['uid'] = $this->user['id'];
        $data['status']=isset($data['status'])?$data['status']:0;
        $countData = [              //统计发布项目个数参数
            'uid' => $data['uid'],
            'status' => $data['status'],
            'count' => 0
        ];
        $my_tasks = TaskModel::myTasksNew($data);
        $count = TaskModel::myTasksNew($countData);
        $taskid = $my_tasks->toArray()['data'];
        foreach ($taskid as $t){
            $workid[] = WorkModel::myWork($t['id']);
            $Attachment[] = WorkAttachmentModel::myTaskAttachment($t['id']);
        }
        foreach ($taskid as $t => $value){
            array_push($taskid[$t],$workid[$t],$Attachment[$t]);
        }
//        dd($workid);
//        dd($taskid);
        $pie_data = \CommonClass::pie($this->user['id']);           //统计某个人发布的任务各种状态的数值
        $view = [
            'my_tasks' => $my_tasks,
            'pie_data' => $pie_data,
            'merge'    =>$data,
            'count' => $count,
            'taskid' => $taskid,
        ];
        return $this->theme->scope('user.mytasklist', $view)->render();
    }


//    我的发布项目删除
    public function postmyTasksListDel(Request $request){
        $data = $request->all();
        $data['uid'] = $this->user['id'];
        $task = TaskModel::myTasksListDel($data);
        $task?$code = 1:$code = 2;
        $view =[
            'code' => $code,
        ];
        return response()->json($view);
    }

//    我的发布项目取消
    public function postmyTasksListCancel(Request $request){
        $data = $request->all();
        $data['uid'] = $this->user['id'];
        $task = TaskModel::myTasksListCancel($data);
        $task?$code = 1:$code = 2;
        $view =[
            'code' => $code,
        ];
        return response()->json($view);
    }

//    雇佣设计师
    public function posthireStylist(Request $request){
        $data = $request->all();
        $uid = Auth::user()['id'];
        $work = WorkModel::where('task_id',$data['id'])->where('uid',$data['uid'])->where('status','0')->update(['status' => 1]);
//发送申请信息
        $domain = \CommonClass::getDomain();
        $task = TaskModel::where('id', $data['id'])->first();
        $user = UserModel::where('id', $uid)->first();
        $site_name = \CommonClass::getConfig('site_name');
        $stylist = UserModel::where('id', $data['uid'])->first();
        $task_audit_failure = MessageTemplateModel::where('code_name', 'employ_acceptnew')->where('is_open', 1)->first();
        if ($task_audit_failure){
            $messageVariableArr = [
                'username' => $stylist['name'],
                'stylist_name' => $user['name'],
                'task_name' => $task['title'],
                'phone' => $user['mobile'],
                'website' => $site_name,
                'task_name_href' => $domain .'/user/acceptTasksList',
            ];
            if($task_audit_failure->is_on_site == 1){
                \MessageTemplateClass::getMeaasgeByCode('employ_acceptnew',$data['uid'],2,$messageVariableArr,$task_audit_failure['name'],$uid);
            }
            if($task_audit_failure->is_send_email == 1){
                $email = $user->email;
                \MessageTemplateClass::sendEmailByCode('employ_acceptnew',$email,$messageVariableArr,$task_audit_failure['name']);
            }
        }
//        发送短信信息
        $scheme = ConfigModel::phpSmsConfig('phpsms_scheme');
        $templateId = ConfigModel::phpSmsConfig('sendAcceptnew');
        $templates = [
            $scheme => $templateId,
        ];
        $tempData = [
            'username' => $stylist['name'],
            'stylist_name' => $user['name'],
            'task_name' => $task['title'],
            'phone' => $user['mobile'],
        ];
        //          \SmsClass::sendSms(手机号, 短信模板配置项, 传的变量);
        $status = \SmsClass::sendSms($stylist['mobile'], $templates, $tempData);

        $work?$code = 1:$code = 2;
        $view =[
            'code' => $code,
        ];
        return response()->json($view);
    }

//    拒绝设计师
    public function postrefuseStylist(Request $request){
        $data = $request->all();
        $uid = Auth::user()['id'];
        $work = WorkModel::where('task_id',$data['id'])->where('uid',$data['uid'])->where('status','0')->update(['status' => 2]);
//发送申请信息
        $domain = \CommonClass::getDomain();
        $task = TaskModel::where('id', $data['id'])->first();
        $user = UserModel::where('id', $uid)->first();
        $site_name = \CommonClass::getConfig('site_name');
        $stylist = UserModel::where('id', $data['uid'])->first();
        $task_audit_failure = MessageTemplateModel::where('code_name', 'employ_refusenew')->where('is_open', 1)->first();
        if ($task_audit_failure){
            $messageVariableArr = [
                'username' => $stylist['name'],
                'stylist_name' => $user['name'],
                'task_name' => $task['title'],
//                'phone' => $user['mobile'],
                'website' => $site_name,
            ];
            if($task_audit_failure->is_on_site == 1){
                \MessageTemplateClass::getMeaasgeByCode('employ_refusenew',$data['uid'],2,$messageVariableArr,$task_audit_failure['name'],$uid);
            }
            if($task_audit_failure->is_send_email == 1){
                $email = $user->email;
                \MessageTemplateClass::sendEmailByCode('employ_refusenew',$email,$messageVariableArr,$task_audit_failure['name']);
            }
        }

        $work?$code = 1:$code = 2;
        $view =[
            'code' => $code,
        ];
        return response()->json($view);
    }

//    接受项目
    public function posthireProject(Request $request){
        $data = $request->all();
        $uid = $this->user['id'];
        $work = WorkModel::where('id',$data['id'])->where('uid',$uid)->where('status','1')->update(['status' => 3]);
        $worktask = WorkModel::where('id',$data['id'])->where('uid',$uid)->first();
//发送申请信息
        $domain = \CommonClass::getDomain();
        $task = TaskModel::where('id', $worktask['task_id'])->first();
        $user = UserModel::where('id', $uid)->first();
        $site_name = \CommonClass::getConfig('site_name');
        $stylist = UserModel::where('id', $task['uid'])->first();
        $task_audit_failure = MessageTemplateModel::where('code_name', 'stylist_accept')->where('is_open', 1)->first();
        if ($task_audit_failure){
            $messageVariableArr = [
                'username' => $stylist['name'],
                'stylist_name' => $user['name'],
                'task_name' => $task['title'],
                'phone' => $user['mobile'],
                'website' => $site_name,
                'task_name_href' => $domain .'/user/myTasksList?status=2',
                'stylist_name_href' => $domain .'/bre/serviceEvaluateDetail/'.$uid,
            ];
            if($task_audit_failure->is_on_site == 1){
                \MessageTemplateClass::getMeaasgeByCode('stylist_accept',$task['uid'],2,$messageVariableArr,$task_audit_failure['name'],$uid);
            }
            if($task_audit_failure->is_send_email == 1){
                $email = $user->email;
                \MessageTemplateClass::sendEmailByCode('stylist_accept',$email,$messageVariableArr,$task_audit_failure['name']);
            }
        }
        //        发送短信信息
        $scheme = ConfigModel::phpSmsConfig('phpsms_scheme');
        $templateId = ConfigModel::phpSmsConfig('sendStylistAccept');
        $templates = [
            $scheme => $templateId,
        ];
        $tempData = [
            'username' => $stylist['name'],
            'stylist_name' => $user['name'],
            'task_name' => $task['title'],
            'phone' => $user['mobile'],
        ];
//          \SmsClass::sendSms(手机号, 短信模板配置项, 传的变量);
        $status = \SmsClass::sendSms($stylist['mobile'], $templates, $tempData);


        $work?$code = 1:$code = 2;
        $view =[
            'code' => $code,
        ];
        return response()->json($view);
    }

//拒绝项目
    public function postrefuseProject(Request $request){
        $data = $request->all();
        $uid = $this->user['id'];
        $work = WorkModel::where('id',$data['id'])->where('uid',$uid)->where('status','1')->update(['status' => 8]);
        $worktask = WorkModel::where('id',$data['id'])->where('uid',$uid)->first();
        //发送申请信息
        $domain = \CommonClass::getDomain();
        $task = TaskModel::where('id', $worktask['task_id'])->first();
        $user = UserModel::where('id', $uid)->first();
        $site_name = \CommonClass::getConfig('site_name');
        $stylist = UserModel::where('id', $task['uid'])->first();
        $task_audit_failure = MessageTemplateModel::where('code_name', 'stylist_refuse')->where('is_open', 1)->first();
        if ($task_audit_failure){
            $messageVariableArr = [
                'username' => $stylist['name'],
                'stylist_name' => $user['name'],
                'task_name' => $task['title'],
//                'phone' => $user['mobile'],
                'website' => $site_name,
            ];
            if($task_audit_failure->is_on_site == 1){
                \MessageTemplateClass::getMeaasgeByCode('stylist_refuse',$task['uid'],2,$messageVariableArr,$task_audit_failure['name'],$uid);
            }
            if($task_audit_failure->is_send_email == 1){
                $email = $user->email;
                \MessageTemplateClass::sendEmailByCode('stylist_refuse',$email,$messageVariableArr,$task_audit_failure['name']);
            }
        }
        //        发送短信信息
        $scheme = ConfigModel::phpSmsConfig('phpsms_scheme');
        $templateId = ConfigModel::phpSmsConfig('sendStylistRefuse');
        $templates = [
            $scheme => $templateId,
        ];
        $tempData = [
            'username' => $stylist['name'],
            'stylist_name' => $user['name'],
            'task_name' => $task['title'],
        ];
//          \SmsClass::sendSms(手机号, 短信模板配置项, 传的变量);
        $status = \SmsClass::sendSms($stylist['mobile'], $templates, $tempData);


        $work?$code = 1:$code = 2;
        $view =[
            'code' => $code,
        ];
        return response()->json($view);
    }

//    设置项目验收方式
    public function postwayProject(Request $request){
        $data = $request->all();
        $uid = $this->user['id'];
        if ($data['way'] == 0){
            WorkModel::where('id',$data['id'])->where('uid',$uid)->where('status','3')->update(['status' => 4,'way' => 0]);
            $way = '一次验收';
        }elseif($data['way'] == 1){
            WorkModel::where('id',$data['id'])->where('uid',$uid)->where('status','3')->update(['status' => 4,'way' => 1]);
            $way = '二次验收';
        }
        $work = WorkModel::select('task_id')->where('id',$data['id'])->where('uid',$uid)->where('status','4')->first();
        $task = TaskModel::where('id',$work->task_id)->update(['status' => 4]);
        //发送申请信息
        $worktask = WorkModel::where('id',$data['id'])->where('uid',$uid)->first();
        $domain = \CommonClass::getDomain();
        $task = TaskModel::where('id', $worktask['task_id'])->first();
        $user = UserModel::where('id', $uid)->first();
        $site_name = \CommonClass::getConfig('site_name');
        $stylist = UserModel::where('id', $task['uid'])->first();
        $task_audit_failure = MessageTemplateModel::where('code_name', 'stylist_way')->where('is_open', 1)->first();
        if ($task_audit_failure){
            $messageVariableArr = [
                'username' => $stylist['name'],
                'stylist_name' => $user['name'],
                'way' => $way,
//                'phone' => $user['mobile'],
                'website' => $site_name,
                'task_name_href' => $domain .'/user/myTasksList?status=3',
                'task_name' => $task['title'],
                'stylist_name_href' => $domain .'/bre/serviceEvaluateDetail/'.$uid,
            ];
            if($task_audit_failure->is_on_site == 1){
                \MessageTemplateClass::getMeaasgeByCode('stylist_way',$task['uid'],2,$messageVariableArr,$task_audit_failure['name'],$uid);
            }
            if($task_audit_failure->is_send_email == 1){
                $email = $user->email;
                \MessageTemplateClass::sendEmailByCode('stylist_way',$email,$messageVariableArr,$task_audit_failure['name']);
            }
        }

        $task?$code = 1:$code = 2;
        $view =[
            'code' => $code,
        ];
        return response()->json($view);
    }
//    接受项目的文件ajax
    public function postfileAjax(Request $request){
        $data = $request->all();
        $uid = $this->user['id'];
        $datanew = [
            'task_id'=>$data['task_id'],
            'work_id'=>$data['workid'],
            'attachment_id'=>$data['fileid'],
//            'type'=>$v['type'],
            'created_at'=>date('Y-m-d H:i:s',time()),
        ];
        $quey = WorkAttachmentModel::create($datanew);
        //发送申请信息
        $domain = \CommonClass::getDomain();
        $task = TaskModel::where('id', $data['task_id'])->first();
        $user = UserModel::where('id', $uid)->first();
        $site_name = \CommonClass::getConfig('site_name');
        $stylist = UserModel::where('id', $task['uid'])->first();
        $task_audit_failure = MessageTemplateModel::where('code_name', 'stylist_file')->where('is_open', 1)->first();
        if ($task_audit_failure){
            $messageVariableArr = [
                'username' => $stylist['name'],
                'stylist_name' => $user['name'],
                'task_name' => $task['title'],
//                'phone' => $user['mobile'],
                'website' => $site_name,
                'task_name_href' => $domain .'/user/myTasksList?status=3',
                'stylist_name_href' => $domain .'/bre/serviceEvaluateDetail/'.$uid,
            ];
            if($task_audit_failure->is_on_site == 1){
                \MessageTemplateClass::getMeaasgeByCode('stylist_file',$task['uid'],2,$messageVariableArr,$task_audit_failure['name'],$uid);
            }
            if($task_audit_failure->is_send_email == 1){
                $email = $user->email;
                \MessageTemplateClass::sendEmailByCode('stylist_file',$email,$messageVariableArr,$task_audit_failure['name']);
            }
        }
//        发送短信信息
        $scheme = ConfigModel::phpSmsConfig('phpsms_scheme');
        $templateId = ConfigModel::phpSmsConfig('sendStylistFile');
        $templates = [
            $scheme => $templateId,
        ];
        $tempData = [
            'username' => $stylist['name'],
            'stylist_name' => $user['name'],
            'task_name' => $task['title'],
//            'phone' => $user['mobile'],
        ];
//          \SmsClass::sendSms(手机号, 短信模板配置项, 传的变量);
        $status = \SmsClass::sendSms($stylist['mobile'], $templates, $tempData);


        $quey?$code = 1:$code = 2;
        $view =[
            'code' => $code,
        ];
        return response()->json($view);
    }

    public function myTaskAxis(Request $request)
    {
        $this->initTheme('usertask');
        $this->theme->setTitle('我发布的任务');

        $data = $request->all();
        $query =  $query = TaskModel::select('task.*', 'tt.name as type_name', 'us.name as nickname','ud.avatar','tc.name as cate_name','province.name as province_name','city.name as city_name')
            ->where('task.status', '>', 1)
            ->where('task.status', '<=', 11)->where('task.uid',$this->user['id']);

        if(!empty($data['search']))
        {
            $query->where('task.title','like','%'.e($data['search']).'%');
        }

        $my_tasks = $query->join('task_type as tt','task.type_id','=','tt.id')
            ->leftjoin('district as province','province.id','=','task.province')
            ->leftjoin('district as city','city.id','=','task.city')
            ->leftjoin('users as us','us.id','=','task.uid')
            ->leftjoin('user_detail as ud','ud.uid','=','task.uid')
            ->leftjoin('cate as tc','tc.id','=','task.cate_id')
            ->orderBy('task.created_at','desc')
            ->paginate(5)->toArray();
        $status = [
            'status'=>[
                2=>'审核中',
                3=>'工作中',
                4=>'工作中',
                5=>'选稿中',
                6=>'工作中',
                7=>'交付中',
                8=>'已结束',
                9=>'已结束',
                10=>'已结束',
                11=>'维权中'
            ]
        ];
        $my_tasks['data'] = \CommonClass::intToString($my_tasks['data'],$status);
        $my_tasks_data = collect($my_tasks['data']);
        $my_tasks_data_group = $my_tasks_data->keyBy('created_at')->toArray();

        $my_tasks_group = array();
        foreach($my_tasks_data_group as $k=>$v)
        {
            $my_tasks_group[date('Ymd',strtotime($k))][] = $v;
        }
        $my_tasks['data'] = $my_tasks_group;

        $domain = \CommonClass::getDomain();
        $pie_data = \CommonClass::pie($this->user['id']);
        $view = [
            'my_tasks'=>$my_tasks,
            'num'=>0,
            'domain'=>$domain,
            'pie_data'=>$pie_data,
        ];
        $this->theme->set('TYPE',2);
        return $this->theme->scope('user.mytaskaxis', $view)->render();
    }


    public function myTaskAxisAjax(Request $request)
    {
        $data = $request->all();
        $query = TaskModel::select('task.*', 'tt.name as type_name', 'us.name as nickname','ud.avatar','tc.name as cate_name','province.name as province_name','city.name as city_name')
            ->where('task.status', '>', 1)
            ->where('task.status', '<=', 11)
            ->where('task.uid',$this->user['id']);

        $pageSize =  $data['page']*5;

        $my_tasks = $query->join('task_type as tt','task.type_id','=','tt.id')
            ->leftjoin('district as province','province.id','=','task.province')
            ->leftjoin('district as city','city.id','=','task.city')
            ->leftjoin('users as us','us.id','=','task.uid')
            ->leftjoin('user_detail as ud','ud.uid','=','task.uid')
            ->leftjoin('cate as tc','tc.id','=','task.cate_id')
            ->orderBy('task.created_at','desc')
            ->limit($pageSize)->get()->toArray();
        $status = [
            'status'=>[
                2=>'审核中',
                3=>'工作中',
                4=>'工作中',
                5=>'选稿中',
                6=>'工作中',
                7=>'交付中',
                8=>'已结束',
                9=>'已结束',
                10=>'已结束',
                11=>'维权中'
            ]
        ];
        $my_tasks = \CommonClass::intToString($my_tasks,$status);

        foreach($my_tasks as $k=>$v)
        {
            $my_tasks[$k]['task_axis_time'] = date('m-d',strtotime($v['created_at']));
            $my_tasks[$k]['task_axis_endat'] = round((time()-strtotime($v['created_at']))/(3600*24));
        }
        $my_tasks_data = collect($my_tasks);
        $my_tasks_data_group = $my_tasks_data->keyBy('created_at')->toArray();
        $tasks_group = array();
        foreach($my_tasks_data_group as $k=>$v)
        {
            $tasks_group[date('Ymd',strtotime($k))][] = $v;
        }
        $my_tasks_group = array();
        $number = 0;
        $domain = \CommonClass::getDomain();
        foreach($tasks_group as $k=>$v)
        {
            foreach($v as $key=>$value)
            {
                $v[$key]['desc'] = str_limit(strip_tags(htmlspecialchars_decode($v[$key]['desc'])));
                if(empty($v[$key]['avatar']))
                {
                    $v[$key]['avatar'] = $this->theme->asset()->url('images/defauthead.png');
                }
            }
            $my_tasks_group[$number]['datas'] = $v;
            $my_tasks_group[$number]['times']['taskaxis_year'] = date('Y',strtotime($k));
            $my_tasks_group[$number]['times']['taskaxis_month'] = date('m',strtotime($k));
            $my_tasks_group[$number]['times']['taskaxis_day'] = date('d',strtotime($k));
            $number++;
        }
        $my_tasks = $my_tasks_group;


        $total_num = TaskModel::where('task.status','>',1)->where('task.uid',$this->user['id'])->count();

        $view = [
            'my_tasks'=>$my_tasks,
            'num'=>0,
            'domain'=>$domain,
            'pagesize'=>$pageSize,
            'total_num'=>$total_num
        ];
        return response()->json($view);
    }

    public function myCommentOwner(Request $request)
    {
        $this->initTheme('usertask');
        $this->theme->setTitle('雇主交易评价');
        $data = $request->all();

        $taskIds = TaskModel::where('uid',Auth::id())->select('id')->get()->toArray();
        $taskIds = array_unique(array_flatten($taskIds));

        $query = CommentModel::whereIn('task_id',$taskIds)->select('comments.*','tk.title','tk.bounty','tk.created_at as task_create','us.name as nickname','ud.avatar')
            ->join('task as tk','tk.id','=','comments.task_id');


        if(!empty($data['from']) && $data['from']=1){
            $query->where('comments.to_uid',$this->user['id'])->leftjoin('user_detail as ud','ud.uid','=','comments.from_uid')
            ->leftjoin('users as us','us.id','=','comments.from_uid');
        }else{
            $query->where('comments.from_uid',$this->user['id'])->leftjoin('user_detail as ud','ud.uid','=','comments.to_uid')
                ->leftjoin('users as us','us.id','=','comments.to_uid');
        }

        if(!empty($data['type']) && $data['type']!=0){
            $query->where('type',$data['type']);
        }
        $comment = $query->orderBy('created_at','desc')->paginate(5);
        $comment_data = $comment->toArray();
        foreach($comment_data['data'] as $k=>$v){
            $comment_data['data'][$k]['globle_score'] = round(($v['speed_score']+$v['quality_score']+$v['attitude_score'])/3,1);
        }

        $domain = \CommonClass::getDomain();

        $view = [
            'merge' => $data,
            'comment'=>$comment,
            'comment_data'=>$comment_data,
            'domain'=>$domain
        ];
        $this->theme->set('TYPE',2);
        return $this->theme->scope('user.mycommentowner', $view)->render();
    }


    public function myWorkHistory(Request $request)
    {
        $this->initTheme('usercenter');
        $this->theme->setTitle('雇主交易评价');
        $data = $request->all();

        $query = WorkModel::select(
            'work.*',
            'tk.title as task_title',
            'tk.bounty',
            'tk.uid as task_uid',
            'tk.desc as task_desc',
            'tk.view_count',
            'tk.delivery_count',
            'tk.bounty_status',
            'us.name as nickname',
            'ud.avatar',
            'tc.name as cate_name')
            ->where('work.uid',$this->user['id'])
            ->join('task as tk','tk.id','=','work.task_id')
            ->leftjoin('user_detail as ud','ud.uid','=','tk.uid')
            ->leftjoin('users as us','us.id','=','tk.uid')
            ->leftjoin('cate as tc','tc.id','=','tk.cate_id');









        if (isset($data['status']) && $data['status']!=0)
        {
            switch($data['status'])
            {
                case 1:
                    $status = [3,4,6];
                    break;
                case 2:
                    $status = [5];
                    break;
                case 3:
                    $status = [7];
                    break;
                case 4:
                    $status = [8,9,10];
                    break;
                case 5:
                    $status = [2.11];
            }
            $query->whereIn('tk.status',$status);
        }

        if(isset($data['time']))
        {
            switch($data['time'])
            {
                case 1:
                    $query->whereBetween('work.created_at',[date('Y-m-d H:i:s',strtotime('-1 month')),date('Y-m-d H:i:s',time())]);
                    break;
                case 2:
                    $query->whereBetween('work.created_at',[date('Y-m-d H:i:s',strtotime('-3 month')),date('Y-m-d H:i:s',time())]);
                    break;
                case 3:
                    $query->whereBetween('work.created_at',[date('Y-m-d H:i:s',strtotime('-6 month')),date('Y-m-d H:i:s',time())]);
                    break;
            }

        }
        $my_works = $query->paginate(5)->toArray();
        $domain = \CommonClass::getDomain();

        $view = [
            'my_works'=>$my_works,
            'domain'=>$domain
        ];

        return $this->theme->scope('user.myworkhistory', $view)->render();
    }

    public function myWorkHistoryAxis(Request $request)
    {
        $this->initTheme('usercenter');
        $this->theme->setTitle('我发布的任务');

        $data = $request->all();
        $query = WorkModel::select(
            'work.*',
            'tk.title as task_title',
            'tk.bounty',
            'tk.uid as task_uid',
            'tk.desc as task_desc',
            'tk.view_count',
            'tk.delivery_count',
            'tk.bounty_status',
            'ud.nickname',
            'ud.avatar',
            'tc.name as cate_name')
            ->where('work.uid',$this->user['id'])
            ->join('task as tk','tk.id','=','work.task_id')
            ->leftjoin('user_detail as ud','ud.uid','=','tk.uid')
            ->leftjoin('users as us','us.id','=','tk.uid')
            ->leftjoin('cate as tc','tc.id','=','tk.cate_id');

        if(!empty($data['search']))
        {
            $query->where('tk.title','like','%'.e($data['search']).'%');
        }

        $my_tasks = $query->paginate(5)->toArray();

        $my_tasks_data = collect($my_tasks['data']);
        $my_tasks_data_group = $my_tasks_data->keyBy('created_at')->toArray();
        $my_tasks_group = array();

        foreach($my_tasks_data_group as $k=>$v)
        {
            $my_tasks_group[date('Ym',strtotime($k))][] = $v;
        }
        $my_tasks['data'] = $my_tasks_group;

        $domain = \CommonClass::getDomain();
        $view = [
            'my_tasks'=>$my_tasks,
            'num'=>0,
            'domain'=>$domain
        ];

        return $this->theme->scope('user.myworkhistoryaxis', $view)->render();
    }


    public function unreleasedTasks(Request $request)
    {
        $this->initTheme('usertask');
        $this->theme->setTitle('未发布的任务');

		$taskType=TaskTypeModel::getTaskTypeAll();

        $unreleased = TaskModel::select('task.*','task_type.alias')->where('task.uid',$this->user['id'])
            ->where(function($query){
                $query->where(function($query){
                    $query->where('task_type.alias','xuanshang')
                        ->whereIn('task.status',[0,1]);
                })->orWhere(function($query){
                    $query->where('task_type.alias','zhaobiao')
                        ->where('task.status',0);
                });
            })
			->leftJoin('task_type','task.type_id','=','task_type.id')
			->orderBy('task.created_at','desc');

        if($request->get('type') && $request->get('type') !=0){
            $unreleased=$unreleased->where('task.type_id',$request->get('type'));
		}
         $unreleased=$unreleased->paginate(5)->toArray();
        foreach($unreleased['data'] as $k=>$v)
        {
            $cate = TaskCateModel::findById($v['cate_id']);
            if(!empty($cate['name'])){
                $unreleased['data'][$k]['cate_name'] = $cate['name'];
            }else{
                $unreleased['data'][$k]['cate_name'] = '';
            }

        }
        $view = [
            'unreleased'=>$unreleased,
			'task_type' =>$taskType,
			'type'      =>$request->get('type')
        ];
        $this->theme->set('TYPE',2);
        return $this->theme->scope('user.unreleasedtasks', $view)->render();
    }


    public function unreleasedTasksDelete($id)
    {

        $task = TaskModel::where('id',$id)->first();
        if($task['uid']!=$this->user['id'])
        {
            return redirect()->back()->with('error','你不是任务的发布者不能删除！');
        }

        $result = DB::transaction(function() use($id){
            TaskModel::destroy($id);
            $task_attachment = TaskAttachmentModel::where('task_id',$id)->lists('attachment_id');
            $task_attachment_ids = array_flatten($task_attachment);
            if(!empty($task_attachment_ids)){
                AttachmentModel::destroy([$task_attachment_ids]);
            }
        });

        if(!is_null($result))
            return redirect()->to('/user/unreleasedTasks')->with(['error'=>'删除失败！']);

        return redirect()->to('/user/unreleasedTasks')->with(['message'=>'删除成功！']);
    }


    public function myTask(Request $request)
    {
        $this->initTheme('accepttask');
        $this->theme->setTitle('我承接的任务');


        $pie_chart = \CommonClass::myTaskPie($this->user['id']);
        $domain = \CommonClass::getDomain();
        $my_tasks_group = array();

        $taskIDs = WorkModel::where('uid',$this->user['id'])->select('task_id')->get()->toArray();
        if(count($taskIDs)){
            $taskIDs = array_unique(array_flatten($taskIDs));
            $id = [2,3,4,5,6,7,8,9,10,11];
            $taskInfo = TaskModel::whereIn('id',$taskIDs)->whereIn('status',$id);
            if($request->get('search')){
                $taskInfo = $taskInfo->where('title','like','%'.$request->get('search').'%');
            }
            $taskInfo = $taskInfo->orderBy('created_at','desc')->select('*')->paginate(5)->toArray();
            $userInfo = UserDetailModel::where('uid',$this->user['id'])->select('avatar')->first();
            foreach($taskInfo['data'] as $k=>$v){
                $taskTypeInfo = TaskTypeModel::where('id',$v['type_id'])->select('name')->first();
                if($taskTypeInfo){
                   $v['type_name'] =  $taskTypeInfo->name;
                }
                else{
                    $v['type_name'] =  '';
                }
                $taskCateInfo = TaskCateModel::findById($v['cate_id']);
                if($taskCateInfo){
                    $v['cate_name'] =  $taskCateInfo['name'];
                }
                else{
                    $v['cate_name'] =  '';
                }
                $v['nickname'] = $this->user['name'];
                $v['avatar'] = $userInfo->avatar;
                $taskInfo['data'][$k] = $v;
            }
            $my_tasks_data = collect($taskInfo['data']);
            $my_tasks_data_group = $my_tasks_data->toArray();
            $status = [
                'status'=>[
                    2=>'审核中',
                    3=>'工作中',
                    4=>'工作中',
                    5=>'选稿中',
                    6=>'工作中',
                    7=>'交付中',
                    8=>'已结束',
                    9=>'已结束',
                    10=>'已结束',
                    11=>'维权中'
                ]
            ];
            $my_tasks_data_group = \CommonClass::intToString($my_tasks_data_group,$status);
            foreach($my_tasks_data_group as $k=>$v)
            {
                $my_tasks_group[date('YmdHis',strtotime($k))][] = $v;
            }
            $taskInfo['data'] = $my_tasks_group;

            $view = [
                'my_tasks'=>$taskInfo,
                'pie_data'=>$pie_chart,
                'num'=>0,
                'domain'=>$domain,
                'search'=>$request->get('search')
            ];

        }
        else{
            $view = [
                'my_tasks'=>$my_tasks_group,
                'pie_data'=>$pie_chart,
                'num'=>0,
                'domain'=>$domain
            ];

        }
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.mytask', $view)->render();
    }

//    我承接的旧
    public function acceptTasksListold(Request $request)
    {
        $this->initTheme('userinfo');
        $this->theme->setTitle('我承接的任务');

        $pie_chart = \CommonClass::myTaskPie($this->user['id']);
        $domain = \CommonClass::getDomain();
        $data=$request->all();
        $taskIDs = WorkModel::where('uid',$this->user['id'])->select('task_id')->get()->toArray();


		$taskType=TaskTypeModel::getTaskTypeAll();
		$data['type']=$request->get('type')?$request->get('type'):$taskType[0]['id'];
		$data['status']=$request->get('status')?$request->get('status'):0;
		if($taskType[0]['alias'] == 'xuanshang' && !isset($data['type'])){
			$taskStatus=[
                15=>'投标中',
                2=>'选标中',
                1=>'公示中',
                3=>'交付中',
                4=>'已结束',
                5=>'其他'
		    ];
		}else{
			$taskTM=TaskTypeModel::select('alias')->where('id',$data['type'])->first();
			switch($taskTM['alias']){
				case 'xuanshang':
				$taskStatus=[
                    15=>'投标中',
                    2=>'选标中',
                    1=>'公示中',
                    3=>'交付中',
                    4=>'已结束',
                    5=>'其他'
		        ];
                    $tsStatus = [
                        'status'=>[
                            2=>'已发布',
                            3=>'投标中',
                            4=>'选标中',
                            5=>'选标中',
                            6=>'公示中',
                            7=>'交付中',
                            8=>'已结束',
                            9=>'已结束',
                            10=>'已结束',
                            11=>'维权中'
                        ]
                    ];
				if(isset($data['status']) && !in_array($data['status'],[1,2,3,4,5,15])){
					$data['status']=0;
				}
				break;
				case 'zhaobiao':
				$taskStatus=[
					7=>'投标中',
					8=>'选标中',
					9=>'公示中',
					10=>'验收中',
					11=>'维权中',
					12=>'交易成功',
					13=>'交易关闭'
		        ];
                    $tsStatus = [
                        'status'=>[
                            1=>'待审核',
                            3=>'投标中',
                            4=>'选标中',
                            5=>'选标中',
                            6=>'公示中',
                            7=>'验收中',
                            8=>'交易成功',
                            9=>'交易成功',
                            10=>'交易关闭',
                            11=>'维权中'
                        ]
                    ];
				if(isset($data['status']) && !in_array($data['status'],[6,7,8,9,10,11,12,13])){
					$data['status']=0;
				}
				break;
			}
		}
		if(count($taskIDs)){
            $taskIDs = array_unique(array_flatten($taskIDs));
            $id = [2,3,4,5,6,7,8,9,10,11];
            $taskInfo = TaskModel::whereIn('id',$taskIDs)->whereIn('status',$id);

			foreach($taskType as $Vtt){
				$Vtt->counts=TaskModel::whereIn('id',$taskIDs)->whereIn('status',$id)->where('type_id',$Vtt->id)->count();
			}

            if($request->get('type')){
                $taskInfo = $taskInfo->where('type_id',$request->get('type'));
            }else{
				$taskInfo = $taskInfo->where('type_id',$taskType[0]['id']);
			}

            if ($request->get('status'))
            {
                switch($request->get('status'))
                {
					case 1:
						$status = [3, 4, 6];
						break;
					case 2:
						$status = [4];
						break;
					case 3:
						$status = [7];
						break;
					case 4:
						$status = [8, 9, 10];
						break;
					case 5:
						$status = [2, 11];
						break;
					case 6:
						$status = [1];
						break;
					case 7:
						$status = [3,4];
						break;
					case 8:
						$status = [5];
						break;
					case 9:
						$status = [6];
						break;
					case 10:
						$status = [7];
						break;
					case 11:
						$status = [11];
						break;
					case 12:
						$status = [8,9];
						break;
					case 13:
						$status = [10];
						break;
					case 14:
						$status = [8,9,10];
						break;
                    case 15:
                        $status = [3];
                        break;


                }
                $taskInfo->whereIn('status',$status);
            }


            if($request->get('time'))
            {
                switch($request->get('time'))
                {
                    case 1:
                        $taskInfo->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-1 month')),date('Y-m-d H:i:s',time())]);
                        break;
                    case 2:
                        $taskInfo->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-3 month')),date('Y-m-d H:i:s',time())]);
                        break;
                    case 3:
                        $taskInfo->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-6 month')),date('Y-m-d H:i:s',time())]);
                        break;
                }

            }

            $taskInfoO = $taskInfo->with('province')->with('city')->orderBy('created_at','desc')->select('*')->paginate(5);
            $taskInfo = $taskInfoO->toArray();

            foreach($taskInfo['data'] as $k=>$v){
                $taskTypeInfo = TaskTypeModel::where('id',$v['type_id'])->select('name')->first();
                if($taskTypeInfo){
                    $v['type_name'] =  $taskTypeInfo->name;
                }
                else{
                    $v['type_name'] =  '';
                }
                $taskCateInfo = TaskCateModel::findById($v['cate_id']);
                if($taskCateInfo){
                    $v['cate_name'] =  $taskCateInfo['name'];
                }
                else{
                    $v['cate_name'] =  '';
                }
                $userInfo = UserDetailModel::where('uid',$v['uid'])->select('avatar')->first();
                if($userInfo){
                    $v['avatar'] =  $userInfo->avatar;
                }
                else{
                    $v['avatar'] =  '';
                }
                $username = UserModel::where('id',$v['uid'])->select('name')->first();
                if($username){
                    $v['nickname'] =  $username->name;
                }
                else{
                    $v['nickname'] =  '';
                }


                $taskInfo['data'][$k] = $v;
            }


            $taskInfo['data'] = \CommonClass::intToString($taskInfo['data'],$tsStatus);
            if(!empty($taskInfo['data'])){
				foreach($taskInfo['data'] as $key => $val){
					if((time()-strtotime($val['created_at']))> 0 && (time()-strtotime($val['created_at'])) < 3600){
						$taskInfo['data'][$key]['show_publish'] = intval((time()-strtotime($val['created_at']))/60).'分钟前';
					}
					if((time()-strtotime($val['created_at']))> 3600 && (time()-strtotime($val['created_at'])) < 24*3600){
						$taskInfo['data'][$key]['show_publish'] = intval((time()-strtotime($val['created_at']))/3600).'小时前';
					}
					if((time()-strtotime($val['created_at']))> 24*3600){
						$taskInfo['data'][$key]['show_publish'] = intval((time()-strtotime($val['created_at']))/(24*3600)).'天前';
					}
				}
            }
            $view = [
                'my_tasks'  =>  $taskInfo,
                'taskInfo_obj' => $taskInfoO,
                'pie_data' =>  $pie_chart,
                'domain'    =>  $domain,
                'merge' => $data,
                'type'      =>  $request->get('type'),
                'status'    =>  $request->get('status'),
                'time'      =>  $request->get('time'),
				'task_type'  =>  $taskType,
				'task_status' => $taskStatus,
				'ts_status'   =>$tsStatus
            ];
        }
        else{
            $view = [
                'my_tasks'=>[],
                'taskInfo_obj' => [],
                'merge' => $data,
                'pie_data'=>$pie_chart,
                'domain'=>$domain,
				'task_type'  =>  $taskType,
				'task_status' => $taskStatus
            ];

        }
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.accepttaskslist', $view)->render();
    }



//    我承接的
    public function acceptTasksList(Request $request){
        $this->initTheme('userinfo');
        $this->theme->setTitle('我承接的任务');
        $data = $request->all();
        $data['uid'] = $this->user['id'];
        $data['status']=isset($data['status'])?$data['status']:0;
        $countData = [              //统计发布项目个数参数
            'uid' => $data['uid'],
            'status' => $data['status'],
            'count' => 0
        ];
        $my_work = WorkModel::myWorks($data);
        $count = WorkModel::myWorks($countData);
        $workAttachment = $my_work->toArray()['data'];
//        dd($workAttachment);
        foreach ($workAttachment as $w){
            $Attachment[] = WorkAttachmentModel::myWorkAttachment($w['id']);
        }
        foreach ($workAttachment as $t => $value){
            array_push($workAttachment[$t],$Attachment[$t]);
        }
//        dd($workAttachment);
//        dd($my_work ->toarray());
        $pie_chart = \CommonClass::myTaskPie($this->user['id']);    //统计某个人发布的任务各种状态的数值
        $view = [
            'pie_data'=>$pie_chart,
            'my_work' => $my_work,
            'merge'    =>$data,
            'count' => $count,
            'workAttachment' => $workAttachment,
        ];
        return $this->theme->scope('user.accepttaskslist', $view)->render();
    }

    public function acceptBroker(Request $request)
    {
        $this->initTheme('acceptbroker');
        $this->theme->setTitle('我承接的任务');

        $pie_chart = \CommonClass::myTaskPie($this->user['id']);
        $domain = \CommonClass::getDomain();
        $data=$request->all();
        $taskIDs = WorkModel::where('uid',$this->user['id'])->select('task_id')->get()->toArray();


        $taskType=TaskTypeModel::getTaskTypeAll();
        $data['type']=$request->get('type')?$request->get('type'):$taskType[0]['id'];
        $data['status']=$request->get('status')?$request->get('status'):0;
        if($taskType[0]['alias'] == 'xuanshang' && !isset($data['type'])){
            $taskStatus=[
                15=>'投标中',
                2=>'选标中',
                1=>'公示中',
                3=>'交付中',
                4=>'已结束',
                5=>'其他'
            ];
        }else{
            $taskTM=TaskTypeModel::select('alias')->where('id',$data['type'])->first();
            switch($taskTM['alias']){
                case 'xuanshang':
                    $taskStatus=[
                        15=>'投标中',
                        2=>'选标中',
                        1=>'公示中',
                        3=>'交付中',
                        4=>'已结束',
                        5=>'其他'
                    ];
                    $tsStatus = [
                        'status'=>[
                            2=>'已发布',
                            3=>'投标中',
                            4=>'选标中',
                            5=>'选标中',
                            6=>'公示中',
                            7=>'交付中',
                            8=>'已结束',
                            9=>'已结束',
                            10=>'已结束',
                            11=>'维权中'
                        ]
                    ];
                    if(isset($data['status']) && !in_array($data['status'],[1,2,3,4,5,15])){
                        $data['status']=0;
                    }
                    break;
                case 'zhaobiao':
                    $taskStatus=[
                        7=>'投标中',
                        8=>'选标中',
                        9=>'公示中',
                        10=>'验收中',
                        11=>'维权中',
                        12=>'交易成功',
                        13=>'交易关闭'
                    ];
                    $tsStatus = [
                        'status'=>[
                            1=>'待审核',
                            3=>'投标中',
                            4=>'选标中',
                            5=>'选标中',
                            6=>'公示中',
                            7=>'验收中',
                            8=>'交易成功',
                            9=>'交易成功',
                            10=>'交易关闭',
                            11=>'维权中'
                        ]
                    ];
                    if(isset($data['status']) && !in_array($data['status'],[6,7,8,9,10,11,12,13])){
                        $data['status']=0;
                    }
                    break;
            }
        }
        if(count($taskIDs)){
            $taskIDs = array_unique(array_flatten($taskIDs));
            $id = [2,3,4,5,6,7,8,9,10,11];
            $taskInfo = TaskModel::whereIn('id',$taskIDs)->whereIn('status',$id);

            foreach($taskType as $Vtt){
                $Vtt->counts=TaskModel::whereIn('id',$taskIDs)->whereIn('status',$id)->where('type_id',$Vtt->id)->count();
            }

            if($request->get('type')){
                $taskInfo = $taskInfo->where('type_id',$request->get('type'));
            }else{
                $taskInfo = $taskInfo->where('type_id',$taskType[0]['id']);
            }

            if ($request->get('status'))
            {
                switch($request->get('status'))
                {
                    case 1:
                        $status = [3, 4, 6];
                        break;
                    case 2:
                        $status = [4];
                        break;
                    case 3:
                        $status = [7];
                        break;
                    case 4:
                        $status = [8, 9, 10];
                        break;
                    case 5:
                        $status = [2, 11];
                        break;
                    case 6:
                        $status = [1];
                        break;
                    case 7:
                        $status = [3,4];
                        break;
                    case 8:
                        $status = [5];
                        break;
                    case 9:
                        $status = [6];
                        break;
                    case 10:
                        $status = [7];
                        break;
                    case 11:
                        $status = [11];
                        break;
                    case 12:
                        $status = [8,9];
                        break;
                    case 13:
                        $status = [10];
                        break;
                    case 14:
                        $status = [8,9,10];
                        break;
                    case 15:
                        $status = [3];
                        break;


                }
                $taskInfo->whereIn('status',$status);
            }


            if($request->get('time'))
            {
                switch($request->get('time'))
                {
                    case 1:
                        $taskInfo->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-1 month')),date('Y-m-d H:i:s',time())]);
                        break;
                    case 2:
                        $taskInfo->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-3 month')),date('Y-m-d H:i:s',time())]);
                        break;
                    case 3:
                        $taskInfo->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-6 month')),date('Y-m-d H:i:s',time())]);
                        break;
                }

            }

            $taskInfoO = $taskInfo->with('province')->with('city')->orderBy('created_at','desc')->select('*')->paginate(5);
            $taskInfo = $taskInfoO->toArray();

            foreach($taskInfo['data'] as $k=>$v){
                $taskTypeInfo = TaskTypeModel::where('id',$v['type_id'])->select('name')->first();
                if($taskTypeInfo){
                    $v['type_name'] =  $taskTypeInfo->name;
                }
                else{
                    $v['type_name'] =  '';
                }
                $taskCateInfo = TaskCateModel::findById($v['cate_id']);
                if($taskCateInfo){
                    $v['cate_name'] =  $taskCateInfo['name'];
                }
                else{
                    $v['cate_name'] =  '';
                }
                $userInfo = UserDetailModel::where('uid',$v['uid'])->select('avatar')->first();
                if($userInfo){
                    $v['avatar'] =  $userInfo->avatar;
                }
                else{
                    $v['avatar'] =  '';
                }
                $username = UserModel::where('id',$v['uid'])->select('name')->first();
                if($username){
                    $v['nickname'] =  $username->name;
                }
                else{
                    $v['nickname'] =  '';
                }


                $taskInfo['data'][$k] = $v;
            }


            $taskInfo['data'] = \CommonClass::intToString($taskInfo['data'],$tsStatus);
            if(!empty($taskInfo['data'])){
                foreach($taskInfo['data'] as $key => $val){
                    if((time()-strtotime($val['created_at']))> 0 && (time()-strtotime($val['created_at'])) < 3600){
                        $taskInfo['data'][$key]['show_publish'] = intval((time()-strtotime($val['created_at']))/60).'分钟前';
                    }
                    if((time()-strtotime($val['created_at']))> 3600 && (time()-strtotime($val['created_at'])) < 24*3600){
                        $taskInfo['data'][$key]['show_publish'] = intval((time()-strtotime($val['created_at']))/3600).'小时前';
                    }
                    if((time()-strtotime($val['created_at']))> 24*3600){
                        $taskInfo['data'][$key]['show_publish'] = intval((time()-strtotime($val['created_at']))/(24*3600)).'天前';
                    }
                }
            }
            $view = [
                'my_tasks'  =>  $taskInfo,
                'taskInfo_obj' => $taskInfoO,
                'pie_data' =>  $pie_chart,
                'domain'    =>  $domain,
                'merge' => $data,
                'type'      =>  $request->get('type'),
                'status'    =>  $request->get('status'),
                'time'      =>  $request->get('time'),
                'task_type'  =>  $taskType,
                'task_status' => $taskStatus,
                'ts_status'   =>$tsStatus
            ];
        }
        else{
            $view = [
                'my_tasks'=>[],
                'taskInfo_obj' => [],
                'merge' => $data,
                'pie_data'=>$pie_chart,
                'domain'=>$domain,
                'task_type'  =>  $taskType,
                'task_status' => $taskStatus
            ];

        }
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.acceptbrokerproject', $view)->render();
    }


    public function workComment(Request $request)
    {
        $this->initTheme('accepttask');
        $this->theme->setTitle('威客交易评价');
        $data = $request->all();
        
        $taskIDs = WorkModel::where('uid',$this->user['id'])->select('task_id')->get()->toArray();
        $taskIDs = array_unique(array_flatten($taskIDs));
        
        $query = CommentModel::whereIn('task_id',$taskIDs)->select('comments.*','tk.title','tk.bounty','tk.created_at as task_create','users.name as nickname','ud.avatar')
            ->join('task as tk','tk.id','=','comments.task_id');

        
        if(!empty($data['from']) && $data['from']=1)
        {
            $query->where('comments.to_uid',$this->user['id'])->leftjoin('user_detail as ud','ud.uid','=','comments.from_uid')
            ->leftJoin('users','users.id','=','comments.from_uid');
        }else{
            $query->where('comments.from_uid',$this->user['id'])->leftjoin('user_detail as ud','ud.uid','=','comments.to_uid')
                ->leftJoin('users','users.id','=','comments.to_uid');
        }
        
        if(!empty($data['type']) && $data['type']!=0){
            $query->where('type',$data['type']);
        }
        $comment_page = $query->paginate(5);
        $comment = $comment_page->toArray();

        foreach($comment['data'] as $k=>$v){
            if($request->get('from')){
                
                $comment['data'][$k]['globle_score'] = round(($v['speed_score']+$v['quality_score']+$v['attitude_score'])/3,1);
            }else{
                
                $comment['data'][$k]['globle_score'] = round(($v['speed_score']+$v['quality_score'])/2,1);
            }

        }
        $domain = \CommonClass::getDomain();
        $view = [
            'merge' => $data,
            'comment'=>$comment,
            'domain'=>$domain,
            'comment_page'=>$comment_page
        ];
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.workcomment', $view)->render();
    }


    
    public function myAjaxTask(Request $request)
    {
        $data = $request->all();
        $taskIDs = WorkModel::where('uid',$this->user['id'])->select('task_id')->get()->toArray();
        $taskIDs = array_unique(array_flatten($taskIDs));
        $query = TaskModel::select('task.*', 'tt.name as type_name', 'us.name as nickname','ud.avatar','tc.name as cate_name','province.name as province_name','city.name as city_name')
            ->where('task.status', '>', 1)
            ->where('task.status', '<=', 11)
            ->whereIn('task.id',$taskIDs);

        $pageSize =  $data['page']*5;

        $my_tasks = $query->join('task_type as tt','task.type_id','=','tt.id')
            ->leftjoin('district as province','province.id','=','task.province')
            ->leftjoin('district as city','city.id','=','task.city')
            ->leftjoin('users as us','us.id','=','task.uid')
            ->leftjoin('user_detail as ud','ud.uid','=','task.uid')
            ->leftjoin('cate as tc','tc.id','=','task.cate_id')
            ->orderBy('task.created_at','desc')
            ->limit($pageSize)->get()->toArray();
        $status = [
            'status'=>[
                2=>'审核中',
                3=>'工作中',
                4=>'工作中',
                5=>'选稿中',
                6=>'工作中',
                7=>'交付中',
                8=>'已结束',
                9=>'已结束',
                10=>'已结束',
                11=>'维权中'
            ]
        ];
        $my_tasks = \CommonClass::intToString($my_tasks,$status);
        
        foreach($my_tasks as $k=>$v)
        {
            $my_tasks[$k]['task_axis_time'] = date('m-d',strtotime($v['created_at']));
            $my_tasks[$k]['task_axis_endat'] = round((time()-strtotime($v['created_at']))/(3600*24));
        }
        $my_tasks_data = collect($my_tasks);
        $my_tasks_data_group = $my_tasks_data->keyBy('created_at')->toArray();
        $tasks_group = array();
        foreach($my_tasks_data_group as $k=>$v)
        {
            $tasks_group[date('Ymd',strtotime($k))][] = $v;
        }
        $my_tasks_group = array();
        $number = 0;
        $domain = \CommonClass::getDomain();
        foreach($tasks_group as $k=>$v)
        {
            foreach($v as $key=>$value)
            {
                $v[$key]['desc'] = str_limit(strip_tags(htmlspecialchars_decode($v[$key]['desc'])));
                if(empty($v[$key]['avatar']))
                {
                    $v[$key]['avatar'] = $this->theme->asset()->url('images/defauthead.png');
                }
            }
            $my_tasks_group[$number]['datas'] = $v;
            $my_tasks_group[$number]['times']['taskaxis_year'] = date('Y',strtotime($k));
            $my_tasks_group[$number]['times']['taskaxis_month'] = date('m',strtotime($k));
            $my_tasks_group[$number]['times']['taskaxis_day'] = date('d',strtotime($k));
            $number++;
        }
        $my_tasks = $my_tasks_group;


        $total_num = TaskModel::where('task.status','>',1)->where('task.uid',$this->user['id'])->count();

        $view = [
            'my_tasks'=>$my_tasks,
            'num'=>0,
            'domain'=>$domain,
            'pagesize'=>$pageSize,
            'total_num'=>$total_num
        ];
        return response()->json($view);
    }
    
    public function userfans()
    {
        $this->initTheme('usercenter');
        $this->theme->setTitle('我的粉丝');
        
        $focus = UserFocusModel::select('user_focus.*','ud.avatar','us.name as nickname')
            ->where('user_focus.focus_uid',$this->user['id'])
            ->leftjoin('users as us','user_focus.uid','=','us.id')
            ->leftjoin('user_detail as ud','ud.uid','=','user_focus.uid')
            ->with('tagsfans')
            ->paginate(10);
        
        $my_focus_ids = UserFocusModel::where('uid',$this->user['id'])->lists('focus_uid')->toArray();
        $tags_data = TagsModel::findAll();
        $tags = array();
        foreach($tags_data as $v)
        {
            $tags[$v['id']] = $v;
        }

        
        $focus_data = $focus->toArray();
        foreach($focus_data['data'] as $k=>$v)
        {
            foreach($v['tagsfans'] as $key=>$value)
            {
                if(!empty($tags[$value['tag_id']]['tag_name']))
                {
                    $focus_data['data'][$k]['tagsfans'][$key]['tag_name'] = $tags[$value['tag_id']]['tag_name'];
                }
            }
        }
        

        $domain = \CommonClass::getDomain();

        $view = [
            'focus'=>$focus,
            'focus_data'=>$focus_data,
            'domain'=>$domain,
            'my_focus_ids'=>$my_focus_ids
        ];

        return $this->theme->scope('user.userfans',$view)->render();
    }

    
    public function usershop()
    {
        $this->initTheme('usertask');
        return $this->theme->scope('user.usershop')->render();
    }
    
    public function usershopqy()
    {
        $this->initTheme('usertask');
        return $this->theme->scope('user.usershopqy')->render();
    }





    
    public function usershopfw()
    {
        $this->initTheme('usertask');
        return $this->theme->scope('user.usershopfw')->render();
    }
    
    public function usershopal()
    {
        $this->initTheme('usertask');
        return $this->theme->scope('user.usershopal')->render();
    }
    
    public function usershopspgl()
    {
        $this->initTheme('usertask');
        return $this->theme->scope('user.usershopspgl')->render();
    }

    
    public function usershopalgl()
    {
        $this->initTheme('usertask');
        return $this->theme->scope('user.usershopalgl')->render();
    }
    
    public function usershoppayfw()
    {
        $this->initTheme('usertask');
        return $this->theme->scope('user.usershoppayfw')->render();
    }
    
    public function usershoppaysp()
    {
        $this->initTheme('usertask');
        return $this->theme->scope('user.usershoppaysp')->render();
    }

    public function myshop()
    {
        $this->initTheme('usercenter');
        return $this->theme->scope('user.myshop')->render();
    }
//    设计师审核get请求
    public function getProductionUploading(Request $request){
        $this->initTheme('accepttask');
        $this->theme->setTitle('设计师');
        $user = Auth::User();
        $data = array();
        $realnameInfo = RealnameAuthModel::where('uid', $user->id)->where('status',1)->orderBy('created_at', 'desc')->first();
//        dd($realnameInfo->status);
//        判断是否实名认证
        if ($realnameInfo){
            $stylist = DB::table('stylist_auth')->where('uid', $user->id)->orderBy('created_at', 'desc')->first();
            if (isset($stylist->status)) {
//            $attachment_id = DB::table('auth_production')->where('stylist_id', $stylist->id)->lists('attachment_id');
//            for($i = 0;$i<count($attachment_id);$i++){
//                $attachment=DB::table('attachment')->where('id', $attachment_id[$i])->first();
//                $attachment_name[]=$attachment->name;
//            }
//            $data['name']=$attachment_name;
                switch ($stylist->status) {
                    case 0:
                        $view = 'user.productionwait';
                        break;
                    case 1:
                        $view = 'user.productionsucceed';
                        break;
                    case 2:
                        $view = 'user.productiondefeated';
                        break;
                }
            } else {
                $profession = DB::table('profession')->get();
                $years = DB::table('years_working')->get();
                $design_type = DB::table('design_type')->get();
                $user=UserModel::where('id', Auth::id())->first();
                $userdetail =UserDetailModel::where('id', Auth::id())->first();
    //        现居
                $province = DistrictModel::findTree(0);
    //        家乡
                $province_home = DistrictModel::findTree(0);

    //        现居
                if (!is_null($userdetail['province'])) {
                    $city = DistrictModel::findTree($userdetail['province']);
                } else {
                    $city = DistrictModel::findTree($province[0]['id']);
                }

                if (!is_null($userdetail['city'])) {
                    $area = DistrictModel::findTree($userdetail['city']);
                } else {
                    $area = DistrictModel::findTree($city[0]['id']);
                }
//        家乡
                if (!is_null($userdetail['province_home'])) {
                    $city_home = DistrictModel::findTree($userdetail['province_home']);
                } else {
                    $city_home = DistrictModel::findTree($province_home[0]['id']);
                }

                if (!is_null($userdetail['city_home'])) {
                    $area_home = DistrictModel::findTree($userdetail['city_home']);
                } else {
                    $area_home = DistrictModel::findTree($city_home[0]['id']);
                }

                $data = array(
                    'province_home' => $province_home,
                    'city_home' => $city_home,
                    'area_home' => $area_home,
                    'province' => $province,
                    'city' => $city,
                    'area' => $area,
                    'profession' => $profession,
                    'years' => $years,
                    'design_type' => $design_type,
                    'user' => $user,
                    'userdetail' => $userdetail
                );
                $view = 'user.productionuploading';
            }
        }else{
            return redirect('user/realnameAuth');
        }
        return $this->theme->scope($view, $data)->render();
    }
//    设计师审核post请求
    public function postProductionUploading(Request $request)
    {
//            数据库事务报错回滚
//        DB::transaction(function () use ($request) {
        $this->initTheme('accepttask');
        $data = $request->all();
        $datauser = $request->only('sex','province_home','city_home','area_home','province','city','area','profession_id','introduce');
        $result = UserDetailModel::where('uid', $this->user['id'])->update($datauser);
        $user = Auth::User();
        $stylist_id = DB::table('stylist_auth')->insertGetId(
            ['uid' => $user->id, 'username' =>$user->name ,'stylist_type' => $data['stylist_type'],'years' =>$data['years'],'created_at' => date('Y-m-d H:i:s', time())]
        );
        $case_title =[
            0 => $data['case_title_one'],
            1=> $data['case_title_two'],
            2=> $data['case_title_three'],
        ] ;
        $design_type =[
            0 => $data['design_type_one'],
            1=> $data['design_type_two'],
            2=> $data['design_type_three'],
        ] ;
        $case_type = [
            0 => $data['case_type_one'],
            1=> $data['case_type_two'],
            2=> $data['case_type_three'],
        ];
        $file = [
            0 =>  $data['fileone'],
            1=>  $data['filetwo'],
            2=> $data['filethree'],
        ];
        for ($i=0;$i<3;$i++){
            $StylistCase = [
                'case_title' => $case_title[$i],
                'design_type' => $design_type[$i],
                'case_type' => $case_type[$i],
                'file' => $file[$i],
            ];
            $this->insertStylistCase($stylist_id,$StylistCase);
        }

        return redirect('user/productionUploading');
    }
    public function insertStylistCase($stylist_id,$StylistCase){
        $stylist_case_id = DB::table('stylist_case')->insertGetId(
            ['stylist_id' => $stylist_id,
                'case_title' =>$StylistCase['case_title'] ,
                'design_type' => $StylistCase['design_type'],
                'case_type' =>$StylistCase['case_type'],
                'created_at' => date('Y-m-d H:i:s', time())
            ]
        );
        for ($i = 0; $i < count($StylistCase['file']); $i++) {
            if ($StylistCase['file'][$i]) {
                if($StylistCase['file'][$i] != null){
                    $fileInfo = json_decode($StylistCase['file'][$i]);
                    $data = [
                        'url' => $fileInfo -> url,
                        'name' => $fileInfo -> name,
                        'type' => $fileInfo -> type,
                        'size' => $fileInfo -> size / 1024,
                        'user_id' => Auth::user()['id'],
                        'disk' => 'oss',
                        'status' => 2,
                        'created_at' => date('Y-m-d H:i:s', time())
                    ];

                    $result = AttachmentModel::create($data);
                    $result = json_decode($result, true);
                    DB::table('stylist_production')->insert(
                        ['stylist_case_id' => $stylist_case_id, 'attachment_id' => $result['id'],'name' => $result['name'],'created_at' => date('Y-m-d H:i:s', time())]
                    );
                }
            }
        }
    }

//    审核失败连接
    public function productionFeatedNew(){
        $this->initTheme('accepttask');
        $this->theme->setTitle('设计师');
        $user = Auth::User();
        $realnameInfo = DB::table('stylist_auth')->where('uid', $user->id)->first();
//        $attachment_id = DB::table('auth_production')->where('stylist_id', $realnameInfo->id)->lists('attachment_id');
//        DB::table('auth_production')->where('stylist_id', $user->id)->delete();
        $profession = DB::table('profession')->get();
        $years = DB::table('years_working')->get();
        $design_type = DB::table('design_type')->get();
        $user=UserModel::where('id', Auth::id())->first();
        $userdetail =UserDetailModel::where('id', Auth::id())->first();
//        现居
        $province = DistrictModel::findTree(0);
//        家乡
        $province_home = DistrictModel::findTree(0);

//        现居
        if (!is_null($userdetail['province'])) {
            $city = DistrictModel::findTree($userdetail['province']);
        } else {
            $city = DistrictModel::findTree($province[0]['id']);
        }

        if (!is_null($userdetail['city'])) {
            $area = DistrictModel::findTree($userdetail['city']);
        } else {
            $area = DistrictModel::findTree($city[0]['id']);
        }
//        家乡
        if (!is_null($userdetail['province_home'])) {
            $city_home = DistrictModel::findTree($userdetail['province_home']);
        } else {
            $city_home = DistrictModel::findTree($province_home[0]['id']);
        }

        if (!is_null($userdetail['city_home'])) {
            $area_home = DistrictModel::findTree($userdetail['city_home']);
        } else {
            $area_home = DistrictModel::findTree($city_home[0]['id']);
        }

        $data = array(
            'province_home' => $province_home,
            'city_home' => $city_home,
            'area_home' => $area_home,
            'province' => $province,
            'city' => $city,
            'area' => $area,
            'profession' => $profession,
            'years' => $years,
            'design_type' => $design_type,
            'user' => $user,
            'userdetail' => $userdetail
        );
        if ($realnameInfo){
            return $this->theme->scope('user.productionuploading',$data)->render();
//            return $this->theme->scope($view, $data)->render();
        }
    }

//    经纪人
    public function broker(){
        $this->initTheme('userinfo');
        $this->theme->setTitle('经纪人');
        $user = Auth::User();
        $broker = BrokerModel::where('uid',$user->id)->where('status',1)->orderby('created_at','desc')->first();
//        dd($broker);
        $view = [
            'broker' => $broker,
        ];
        return $this->theme->scope('user.broker', $view)->render();
    }
//    抽奖
    public function reward(){
        $this->initTheme('accepttask');
        $this->theme->setTitle('抽奖');
        $user = Auth::User();;
//        查看抽奖次数
        $rewardlistnum = RewardListModel::where('uid',$user->id)->where('status',0)->count();
//        循环中奖列表
        $rewardlist = RewardListModel::rewardlist();
        foreach ($rewardlist as $r){
            $r->usname = RewardListModel::substr_cut($r->usname);
        }
        $reward = RewardModel::reward();
        $view = [
            'num' => $rewardlistnum,
            'rewardlist' => $rewardlist,
            'reward' => $reward,
        ];
        return $this->theme->scope('user.reward', $view)->render();
    }
//    抽奖ajax
    public function rewardajax(Request $request){
        $data = $request->all();
        $user = Auth::User();;
        $reward = RewardListModel::where('uid',$user->id)->where('status',0)->first();
        if ($reward){
//            修改中奖状态
            $reward->update(['status' => 1]);
            $view = [
                'code' => 0,
                'reward_id' => $reward->reward_id,
            ];
        }else{
            $view = [
                'code' => 1,
            ];
        }
        return response()->json($view);
    }


}