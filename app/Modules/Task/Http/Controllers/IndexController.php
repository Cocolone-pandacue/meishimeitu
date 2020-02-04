<?php
namespace App\Modules\Task\Http\Controllers;

use App\Http\Controllers\IndexController as BasicIndexController;
use App\Http\Requests;
use App\Modules\Manage\Model\AgreementModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Task\Http\Requests\BountyRequest;
use App\Modules\Task\Http\Requests\TaskRequest;
use App\Modules\Task\Model\ServiceModel;
use App\Modules\Task\Model\TaskAttachmentModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskServiceModel;
use App\Modules\Task\Model\TaskTemplateModel;
use App\Modules\Task\Model\TaskFocusModel;
use App\Modules\Task\Model\TaskTypeModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\BankAuthModel;
use App\Modules\User\Model\BrokerModel;
use App\Modules\User\Model\BrokerTaskModel;
use App\Modules\User\Model\DistrictModel;
use App\Modules\User\Model\GoodsFocusModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use App\Modules\Order\Model\OrderModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Vipshop\Models\StylistPackageOrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Theme;
use QrCode;
use App\Modules\Advertisement\Model\AdTargetModel;
use App\Modules\Advertisement\Model\RePositionModel;
use App\Modules\Advertisement\Model\RecommendModel;
use App\Modules\User\Model\CommentModel;
use Cache;
use Omnipay;
use Toplan\TaskBalance\Task;

class IndexController extends BasicIndexController
{
    public function __construct()
    {
        parent::__construct();
        $this->user = Auth::user();
        $this->initTheme('main');
    }

//    项目库旧
    public function tasksold(Request $request)
    {
        
        $seoConfig = ConfigModel::getConfigByType('seo');
        if(!empty($seoConfig['seo_task']) && is_array($seoConfig['seo_task'])){
            $this->theme->setTitle($seoConfig['seo_task']['title']);
            $this->theme->set('keywords',$seoConfig['seo_task']['keywords']);
            $this->theme->set('description',$seoConfig['seo_task']['description']);
        }else{
            $this->theme->setTitle('项目库');
        }
		
		$NavName= \CommonClass::getNavName('/task');
		if(!$NavName){
			$NavName="项目库";
		}
        
        $data = $request->all();
        
        if (isset($data['category']) && $data['category']!=0) {
            $category = TaskCateModel::findByPid([intval($data['category'])]);
            $pid = $data['category'];
            if (empty($category)) {
                $category_data = TaskCateModel::findById( intval($data['category']));
                $category = TaskCateModel::findByPid([intval($category_data['pid'])]);
                $pid = $category_data['pid'];
            }
        } else {
            
            $category = TaskCateModel::findByPid([0]);
            $pid = 0;
        }

        if (isset($data['province'])) {
            $area_data = DistrictModel::findTree(intval($data['province']));
            $area_pid = $data['province'];
            
            if($this->themeName=='quietgreen') {
                $province = DistrictModel::findTree(0);
                $province_id = $area_pid;
                $city = $area_data;
                $city_id = 0;
                $areas = DistrictModel::findTree($area_data[0]['id']);
                $areas_id = 0;
            }
        } elseif (isset($data['city'])) {
            $area_data = DistrictModel::findTree(intval($data['city']));
            $area_pid = $data['city'];
            
            if($this->themeName=='quietgreen') {
                $province = DistrictModel::findTree(0);
                $city = DistrictModel::findTree($province[0]['id']);
                $city_id = $area_pid;
                $areas = $area_data;
                $areas_id  = 0;
                $province_id = DistrictModel::where('id',$city_id)->first();
                $province_id = $province_id['upid'];
            }
        } elseif (isset($data['area'])) {
            $area = DistrictModel::where('id', '=', intval($data['area']))->first();
            $area_data = DistrictModel::findTree(intval($area['upid']));
            $area_pid = $area['upid'];
            
            if($this->themeName=='quietgreen') {
                $province = DistrictModel::findTree(0);
                $city = DistrictModel::findTree($province[0]['id']);
                $areas = $area_data;
                $areas_id = $data['area'];
                $city_data = DistrictModel::where('id',$area['upid'])->first();
                $city_id = $city_data['id'];
                $province_id = $city_data['upid'];
            }
        } else {
            $area_data = DistrictModel::findTree(0);
            $area_pid = 0;
            
            if($this->themeName=='quietgreen') {
                $province = $area_data;
                $province_id = 0;
                $city = DistrictModel::findTree($area_data[0]['id']);
                $city_id = 0;
                $areas = DistrictModel::findTree($city[0]['id']);
                $areas_id = 0;
            }
        }
        
        $paginate = ($this->themeName == 'black') ? 12 : 6;
        $list = TaskModel::findBy($data,$paginate);

        $lists = $list->toArray();
        if(!empty($lists['data'])){
            foreach($list as $key => $val){
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
        }
        $task_ids = array_pluck($lists['data'],['id']);
        $taskType = TaskTypeModel::select('id','alias')->get()->toArray();
        $taskType = array_reduce($taskType,function(&$taskType,$v){
            $taskType[$v['alias']] = $v['id'];
            return $taskType;
        });
        $this->taskType = $taskType;
        
        $order = OrderModel::select('order.*','task.type_id')->whereIn('order.task_id',$task_ids)->where('order.status',1)->where(function($query){
            $query->where(function($query){
                $query->where('task.type_id',$this->taskType['xuanshang']);
            })->orWhere(function($query){
                $query->where('task.type_id',$this->taskType['zhaobiao'])->where('order.code','like','ts%');
            });
        })
            ->leftJoin('task','task.id','=','order.task_id')
            ->get()->toArray();
        $task_ids = array_keys(\CommonClass::keyByGroup($order,'task_id'));
        $task_service = TaskServiceModel::select('task_service.*','sc.title')->whereIn('task_id',$task_ids)
            ->join('service as sc','sc.id','=','task_service.service_id')
            ->get()->toArray();
        $task_service = \CommonClass::keyByGroup($task_service,'task_id');

        
        $my_focus_task_ids = [];
        if(Auth::check())
        {
            
            $my_focus_task_ids = TaskFocusModel::where('uid',Auth::user()['id'])->lists('task_id');
            $my_focus_task_ids = array_flatten($my_focus_task_ids);
        }

        
        $ad = AdTargetModel::getAdInfo('TASKLIST_BOTTOM');

        
        $rightAd = AdTargetModel::getAdInfo('TASKLIST_RIGHT_TOP');

        
        $hotList = [];
        $reTarget = RePositionModel::where('code','TASKLIST_SIDE')->where('is_open','1')->select('id','name')->first();
        
		$taskType=TaskTypeModel::getTaskTypeAll();
        if($reTarget->id){
            $recommend = RecommendModel::getRecommendInfo($reTarget->id)->select('*')->get();
            if(count($recommend)){
                foreach($recommend as $k=>$v){
                    $comment = CommentModel::where('to_uid',$v['recommend_id'])->count();
                    $goodComment = CommentModel::where('to_uid',$v['recommend_id'])->where('type',1)->count();
                    if($comment){
                        $v['percent'] = $goodComment/$comment;
                    }
                    else{
                        $v['percent'] = 0;
                    }
                    $recommend[$k] = $v;
                }
                $hotList = $recommend;
            }
            else{
                $hotList = [];
            }
        }

        $view = [
            'list_array' => $lists,
            'list'=>$list,
            'merge' => $data,
            'category' => $category,
            'pid' => $pid,
            'area' => $area_data,
            'area_pid' => $area_pid,
            'ad' => $ad,
            'rightAd' => $rightAd,
            'hotList' => $hotList,
            'targetName' => $reTarget->name,
            'my_focus_task_ids' => $my_focus_task_ids,
            'task_service' => $task_service,
			'task_type'=>$taskType,
			'NavName'  =>$NavName
        ];
        if($this->themeName=='quietgreen')
        {
            $view = array_merge($view,[
                'province'=>$province,
                'city'=>$city,
                'areas'=>$areas,
                'province_id'=>$province_id,
                'city_id'=>$city_id,
                'areas_id'=>$areas_id
            ]);
        }

        
        \CommonClass::taskScheduling();
        $this->theme->set('now_menu','/task');
        return $this->theme->scope('task.tasks', $view)->render();
    }

//    项目库新
    public function tasks(Request $request){
        $this->theme->setTitle('项目库');
        $data = $request->all();
        $category = TaskCateModel::findByPid([0]);
        $pid = 0;

        $paginate = ($this->themeName == 'black') ? 10 : 6;
        $list = TaskModel::findBy($data,$paginate);
        $lists = $list->toArray();
        $lists['data'];
        $catenew =[];
        foreach ($lists['data'] as $l){
            $cate = DB::table('cate')->where('id', $l['cate_id'])->first();
            $catenew[] =[
                'id' => $cate->id,
                'name' => $cate->name,
                'pic' => $cate->pic,
            ];
        }
        $taskidnew = [];
        $workidnew = [];
        $stylistid = null;
        $stylistpackage = null;
        if(Auth::user()){
            $uid = Auth::user()['id'];
            $taskid = TaskModel::findTask($uid);
            foreach ($taskid as $t){
                $taskidnew[] = $t['id'];
            }
            $workid = WorkModel::findwork($uid);
            foreach ($workid as $t){
                $workidnew[] = $t['task_id'];
            }
            $stylistid = DB::table('stylist_auth')->where('uid',$uid)->where('status','=',1)->orderby('created_at','desc')->get();
            $stylistpackage = StylistPackageOrderModel::where('uid',$uid)->where('status','=',0)->orderby('created_at','desc')->first();
        }
//        dd($stylistpackage);die;
        $view = [
            'list' => $list,
            'merge' => $data,
            'category' => $category,
            'pid' => $pid,
            'cate' => $catenew,
            'taskid' => $taskidnew,
            'workid' => $workidnew,
            'stylistid' => $stylistid,
            'stylistpackage' => $stylistpackage,
        ];
//        dd($list->toArray()['data']);die;
        return $this->theme->scope('task.tasks', $view)->render();
    }
//    项目库ajax详情
    public function taskAjax (Request $request){
        $task_id = $request->get('task_id');
        $task = DB::table('task')
            ->select('task.title','task.status','c.pic','c.name as catename','task.show_cash','task.time_interval','task.desc', 'task.delivery_deadline','task.region_limit',
                'i.name as industryname','task.reference','task.task_style','task.task_tonality','task.province','task.city','task.area')
            ->join('cate as c','c.id','=','task.cate_id')
            ->join('industry as i','i.id','=','task.industry')
//            ->leftjoin('task_attachment as ta','ta.task_id','=','task.id')
//            ->leftjoin('attachment as att','att.id','=','ta.attachment_id')
            ->where('task.id',$task_id)
            ->where('task.status','>=','-1')->first();
//      截止日期
        $delivery_deadline = date('Y-m-d',strtotime($task->delivery_deadline));
//        附件
        $file = DB::table('task_attachment as ta')
            ->select('att.id','att.type')
            ->leftjoin('attachment as att','att.id','=','ta.attachment_id')
            ->where('ta.task_id',$task_id)
            ->get();
//        是否有指定地址
        $region_limit =$task->region_limit;
        if ($region_limit ==1){
            $province = DB::table('district')->select('name')->where('id',$task->province)->first();
            $city = DB::table('district')->select('name')->where('id',$task->city)->first();
            $area = DB::table('district')->select('name')->where('id',$task->area)->first();
        }else{
            $province=0;    $city=0;    $area=0;
        }
        if (in_array($task->status,[3])){
            $status = '项目托管中';
        }elseif (in_array($task->status,[4,5,6,7])){
            $status = '项目进行中';
        }elseif (in_array($task->status,[8,9])){
            $status = '项目结束';
        }else{
            $status = '项目';
        }
        $pic = ossUrl($task->pic);
        $desc =  strip_tags(htmlspecialchars_decode($task->desc));
        $view = [
            'task_id' => $task_id,
            'task' => $task,
            'province' => $province,
            'city' => $city,
            'area' => $area,
            'region_limit' => $region_limit,
            'status' => $status,
            'delivery_deadline' => $delivery_deadline,
            'file' => $file,
            'pic' => $pic,
            'desc' => $desc,
        ];
        return response()->json($view);
    }
//私人订制
    public function privateDesign($id){
        $this->theme->setTitle('私人订制');
        $cate = DB::table('cate')->where('id', $id)->first();
        $catename = $cate->name;
        $cateall = DB::table('cate')->where('pid',$cate->pid)->whereNotIn('id', [$id])->get();

        $goodsInfo = GoodsModel::where('goods.cate_id',$id)
            ->join('users', 'goods.uid', '=', 'users.id')
            ->join('cate', 'goods.cate_id', '=', 'cate.id')
            ->select('goods.*', 'users.name as usersname','cate.name as catename')
            ->paginate(8);
        $gnum = count($goodsInfo);

        if ($gnum<8){
            $gnum = 8-$gnum;
            foreach ($cateall as $g =>$a){
                foreach ($a as $v => $s){
                    $ggid[] = $s;
                    break;
                }
            }
            $goodsInfo1New = GoodsModel::whereIn('goods.cate_id',$ggid)
                ->join('users', 'goods.uid', '=', 'users.id')
                ->join('cate', 'goods.cate_id', '=', 'cate.id')
                ->select('goods.*', 'users.name as usersname','cate.name as catename')
//            ->orderBy(\DB::raw('FIND_IN_SET(`kppw_cate`.`id`, "' . implode(",", $ggid) . '"' . ")"))
                ->paginate($gnum);
            $goodsArr[] = $goodsInfo->toArray()['data'];
            $goodsArr[] = $goodsInfo1New->toArray()['data'];
            foreach ($goodsArr as $g =>$a){
                foreach ($a as $v => $s){
                    $goodsArrNew[] = $s;
                }
            }
        }
        if (!isset($goodsArrNew)){
            $goodsArrNew = $goodsInfo;
        }

        $goods_focus = [];
        if(Auth::check()){
            $goods_focus = DB::table('goods_focus')->where('uid',Auth::user()['id'])->lists('goods_id');
            $goods_focus = array_flatten($goods_focus);
        }

        $task = DB::table('task')
            ->where('cate_id', $id)
//            ->where('status', 1)
            ->join('users', 'task.uid', '=', 'users.id')
            ->select('task.*', 'users.name as usersname')
            ->get();

        $data = [
            'catename' => $catename,
            'cateid' => $id,
            'goodsInfo' => $goodsArrNew,
            'cate' => $cateall,
            'task' => $task,
            'goods_focus' => $goods_focus
        ];
        return $this->theme->scope('task.privatedesign',$data)->render();
    }
//收藏设计师作品ajax
    public function ajaxGoodAdd(Request $request){
        $uid = Auth::id();
        $goodId = $request->get('goods_id');
        $goodfocus = GoodsFocusModel::where('uid',Auth::id())->where('goods_id',$goodId)->first();
        if ($goodfocus ==null){
            $collect = DB::table('goods')
                ->where('id',$goodId)
                ->select('collect')
                ->first();
            DB::table('goods')
                ->where('id',$goodId)
                ->update(['collect' => $collect->collect+1]);
            $res = DB::table('goods_focus')->insert(
                [
                    'uid' => $uid,
                    'goods_id' => $goodId,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            if ($res) {
                return response()->json(['code' => 1]);
            } else {
                return response()->json(['code' => 2]);
            }
        }
        return response()->json(['code' => 3]);
    }

//取消收藏设计师作品ajax
    public function ajaxGoodDel(Request $request){
        $uid = Auth::id();
        $goodId = $request->get('goods_id');
        $collect = DB::table('goods')
            ->where('id',$goodId)
            ->select('collect')
            ->first();
        DB::table('goods')
            ->where('id',$goodId)
            ->update(['collect' => $collect->collect-1]);
        $res = DB::table('goods_focus')->where('uid','=',$uid)->where('goods_id','=',$goodId)->delete();
        if ($res) {
            return response()->json(['code' => 1]);
        } else {
            return response()->json(['code' => 2]);
        }
    }
//  发布任务类型
    public function type(Request $request ,$orderNumber = null)
    {
        $this->theme->setTitle('项目类型');
//        查看项目的id不能删
//        $cate = DB::table('cate')->get();
//        var_dump($cate);die;
//        $id=[
//            0=>232,
//            1=>225,
//            2=>192,
//            3=>204,
//            4=>174,
//            5=>272,
//            6=>237
//        ];
        $cate = DB::table('cate')->where('pid', 0)->orderby('sort','asc')->get();
//        dd($cate);die;
//        for($i=0;$i<7;$i++){
//            foreach ($cate as $c) {
//                if ($c->id == $id[$i]) {
////                    $name =DB::table('cate')->where('id', $c->id)->first();
//                    $catenew[] = array(
//                        'name' => $c->name,
//                        'pic' => $c->pic,
//                        'id' => $c->id
//                    );
//                    break;
//                }
//            }
//        }
        $broker = $request->all();
        $data =[
           'catenew' => $cate,
            'orderNumber' => $orderNumber,
            'broker' => $broker,
        ];
        return $this->theme->scope('task.type',$data)->render();
    }
//    新发布任务详情
    public function createnewdetail(Request $request ,$id,$orderNumber = null){
        $this->theme->setTitle('发布任务');
        $task = TaskCateModel::findById($id);
        //        接受经纪人id
        $broker = $request->all();
        if ($task == null){
//            return redirect('task/type');
            return redirect()->back()->with(['error' => '非法操作！']);
        }
        $industry = DB::table('brainpower_classify')
            ->select('name','value_id')
            ->where('attribute',1)
            ->orderBy('sort', 'asc')
            ->get();
//  添加项目类型到项目库
//        订单号
        $tasknew = null;
        if (isset($broker['bid'])){         //判断是不是经纪人发布
            $buid = 'brokerid';
            $buidvalu = $broker['bid'];
        }else{
            $buid = 'uid';
            $buidvalu = $this->user['id'];
        }
        if ($orderNumber == null){
            $orderNumber = date('Ymd') . str_pad(mt_rand(1, 99999), 4, '0', STR_PAD_LEFT);
                DB::table('task')->insert([
                    'cate_id' => $id,
                    $buid => $buidvalu,
                    'status' => -2,
                    'order_number' => $orderNumber,
                    'created_at' =>date('Y-m-d H:i:s', time()),
                ]);
            if (isset($broker['bid'])){     //检测经纪人
               $taskid = TaskModel::findTaskOrderNumber($orderNumber);
                $brolerid = BrokerModel::findBroker($this->user['id']);
                BrokerTaskModel::insert([
                    'bid' => $brolerid,
                    'tid' => $taskid,
                    'uid' => $this->user['id'],
                    'status' => 0,
                    'created_at' =>date('Y-m-d H:i:s', time()),
                ]);
            }
        }else{
            $taskon = DB::table('task')->where('order_number',$orderNumber)->where($buid,$buidvalu)->first();
            if ($taskon){
                DB::table('task')->where('order_number',$orderNumber)->where($buid,$buidvalu)->update(['cate_id' => $id]);
                $tasknew = DB::table('task')->where('order_number',$orderNumber)->where($buid,$buidvalu)->first();
            }else{
//                return redirect('task/type');
                return redirect()->back()->with(['error' => '非法操作！']);
            }
        }
//        判断是否有地址
        $province = DistrictModel::findTree(0);
        $color = null;
        $style = null;
        $file = null;
        $status = null;
        if ($tasknew != null){
            $color = json_decode($tasknew->task_tonality);
            $style = json_decode($tasknew->task_style);
            $status = $tasknew->status;
            $file = DB::table('task_attachment as ta')->select('a.*')
                ->join('attachment as a','ta.attachment_id','=','a.id')
                ->where('ta.task_id',$tasknew->id)
                ->get();
            if ((!is_null($tasknew->province)) && $tasknew->region_limit ==1){
                $city = DistrictModel::findTree($tasknew->province);
            }else{
                $city = DistrictModel::findTree($province[0]['id']);
            }
            if ((!is_null($tasknew->city)) && $tasknew->region_limit ==1){
                $area = DistrictModel::findTree($tasknew->city);
            }else{
                $area = DistrictModel::findTree($city[0]['id']);
            }
        }else{
            $city = DistrictModel::findTree($province[0]['id']);
            $area = DistrictModel::findTree($city[0]['id']);
        }
//        dd($tasknew);die;
        $view = [
            'task' => $task,
            'province' => $province,
            'area' => $area,
            'city' => $city,
            'industry' => $industry,
            'orderNumber' => $orderNumber,
            'color' => $color,
            'style' => $style,
            'file' => $file,
            'tasknew' => $tasknew,
            'status' => $status,
            'broker' =>$broker,
        ];
        return $this->theme->scope('task.createnewdetail', $view)->render();
    }
//新发布任务详情ajaxpost
    public function createnewdetailpost (Request $request){
        $data = $request->except('_token');
//        判断是否付款
        $task = TaskModel::findByOrderNumber($data['orderNumber']);
        if ($task['status'] >= 2) {
            $view = [
                'code' => 2,
                'id' => $task['id'],
                ];
            return response()->json($view);
        }
        if (!$data['brokerid'] ==''){        //判断经纪人发布
            $buid = 'brokerid';
            $buidvalu = $data['brokerid'];
        }else{
            $buid = 'uid';
            $buidvalu = $this->user['id'];
        }
        $data['uid'] = $this->user['id'];   //        用户id
        $data['desc'] = \CommonClass::removeXss($data['description']);  //        描述
        $data['created_at'] = date('Y-m-d H:i:s', time());  //修改时间
        if($data['area']!=0)    //       地域限制
        {
            $data['region_limit'] = 1;
        }else{
            $data['region_limit'] = 0;
        }
        if(empty($data['sele_input1'])){    //      项目的时间间隔
            $data['time_interval'] = $data['sele_input'];
            $da = $data['sele_input'];
        }else{
            $da = $data['sele_input1'];
            $data['time_interval']  = $data['sele_input1'];
        }
        if(empty($data['bounty1'])){    //      项目预算
            $data['bounty'] = $data['bounty2'];
        }else{
            $data['bounty'] = $data['bounty1'];
        }
        $data['begin_at'] = $data['created_at'];    //任务开始时间
        $data['delivery_deadline'] = date("Y-m-d H:i:s",strtotime("+$da days",strtotime($data['begin_at'])));   //任务交稿结束时间
        $data['kee_status'] = 0;    //        接入交付平台
        $data['show_cash'] = $data['bounty'];    //        展示赏金
        //        发布状态判断是否新增修改状态
        if ($task['status']==-2){
            DB::table('task')->where('order_number',$data['orderNumber'])->where($buid,$buidvalu)
                ->update([
                    'status' => -1,
                ]);
        }
        $controller = 'bounty';   //跳转路由
//        设计风格中间表
        if (!empty($data['style'])){
            DB::table('task')->where('order_number',$data['orderNumber'])->where($buid,$buidvalu)
                ->update([
                    'task_style' => json_encode($data['style']),
                ]);
        }
//        色调中间表
        if (!empty($data['tonality'])) {
            DB::table('task')->where('order_number',$data['orderNumber'])->where($buid,$buidvalu)
                ->update([
                    'task_tonality' => json_encode($data['tonality']),
                ]);
        }
//        $data['type_id'] = 1;   //任务类型
        $data['worker_num'] = 1;   //  服务商数量
//        判断是否有附件
        if (!empty($data['file_id'])) {
//            查找task的id
            $taskid =  DB::table('task')->where('order_number',$data['orderNumber'])->where($buid,$buidvalu)->select('id')->first();
            $file_able_ids = AttachmentModel::fileAble($data['file_id']);
            $file_able_ids = array_flatten($file_able_ids);
            if(isset($data['task_id'])){
                TaskAttachmentModel::where('task_id',$data['task_id'])->delete();
            }
            foreach ($file_able_ids as $v) {
                $attachment_data = [
                    'task_id' => $taskid->id,
                    'attachment_id' => $v,
                    'created_at' => date('Y-m-d H:i:s', time()),
                ];

                TaskAttachmentModel::create($attachment_data);
            }

            $attachmentModel = new AttachmentModel();
            $attachmentModel->statusChange($file_able_ids);
        }
//        修改task
        DB::table('task')->where('order_number',$data['orderNumber'])->where($buid,$buidvalu)
            ->update([
                'title'=>$data['title'],
                'phone'=>$data['phone'],
                'cate_id'=>$data['cate_id'],
                'province'=>$data['province'],
                'city'=>$data['city'],
                'area'=>$data['area'],
                'bounty'=>$data['bounty'],
                'worker_num'=>$data['worker_num'],
//                'type_id'=>$data['type_id'],
                'begin_at'=>$data['begin_at'],
                'delivery_deadline'=>$data['delivery_deadline'],
                'desc'=>$data['desc'],
//                'created_at'=>$data['created_at'],
                'updated_at'=>$data['created_at'],
                'show_cash'=>$data['show_cash'],
//                'status'=>$data['status'],
                'kee_status' => $data['kee_status'],
                'region_limit' => $data['region_limit'],
                'time_interval' => $data['time_interval'],
//                'task_style_id' => $data['task_style_id'],
//                'task_tonality_id' => $data['task_tonality_id'],
                'industry' => $data['industry'],
                'reference' => $data['reference'],
                'brokerid' => $data['brokerid'],
            ]);

        $view = [
            'orderNumber' => $data['orderNumber'],
            'data' => $data,
            'code' => 1,
            'bid' => $data['brokerid'],
            'man' => 0,
        ];
        return response()->json($view);
    }
//    新发布任务
    public function createnew(Request $request ,$orderNumber = null)
    {
        $this->theme->setTitle('发布任务');
        //        接受经纪人id
        $broker = $request->all();
        $uid = $this->user['id'];
        $brokeruid = null;
        if (isset($broker['bid'])){         //判断是不是经纪人发布
            $buid = 'brokerid';
            $buidvalu = $broker['bid'];
            if ($broker['man'] == 1){       //判断链接是不是复制来的
                $taskb = TaskModel::where('order_number',$orderNumber)->where($buid,$buidvalu)->first();
                $brokeruid = BrokerModel::findBrokerid($taskb->brokerid);
                $brokerstatus = BrokerTaskModel::where('tid',$taskb->id)->first();
                if ($brokerstatus->status == 1){            //判断链接是不是有人点击
                    return redirect()->back()->with(['error' => '该连接已经失效！']);
                }elseif ($taskb->uid == null && $brokeruid != $uid){         //判断链接经纪人点击没有用
                   TaskModel::where('order_number',$orderNumber)->where($buid,$buidvalu)->update(['uid' => $uid,]);
                   BrokerTaskModel::where('bid',$buidvalu)->where('tid',$taskb->id)->update(['status' => 1]);
                }
            }
        }else{
            $buid = 'uid';
            $buidvalu = $uid;
        }
        if ($orderNumber == null){
//            return redirect('task/type');
            return redirect()->back()->with(['error' => '非法操作！']);
        }else{
            $task = DB::table('task')->where('order_number',$orderNumber)->where($buid,$buidvalu)->first();
            if (!$task){
//                return redirect('task/type');
                return redirect()->back()->with(['error' => '非法操作！']);
            }
        }
//        dd($task);die;
        $view = [
            'task' => $task,
            'broker' => $broker,
            'brokeruid' =>$brokeruid,
            'uid' => $uid,
        ];
        return $this->theme->scope('task.createnew', $view)->render();
    }

//新发布任务ajaxpost
    public function createnewpost(Request $request){
        $data = $request->except('_token');
        $task = TaskModel::findById($data['id']);
        if ($task['status'] >= 2) {
            return redirect()->to('task/tasksuccess/'.$data['id'].'?a=04');
        }elseif(!($task['status'] > 2)){
            if (isset($data['bid'])){         //判断是不是经纪人发布
                $buid = 'brokerid';
                $buidvalu = $data['bid'];
            }else{
                $buid = 'uid';
                $buidvalu = $this->user['id'];
            }
            TaskModel::where('order_number',$data['order_number'])->where($buid,$buidvalu)
                ->update([
                    'status' => 1,
                    'type_id' =>1,
                ]);
            if (isset($data['man']) && $data['man']==0 ){
                $link = url().'/task/createnew/'.$task['order_number'].'?bid='.$data['bid'].'&man=1&a=03';
                $taskid = TaskModel::findTaskOrderNumber($data['order_number']);
                BrokerTaskModel::updatedBroler($taskid,$link);
                return redirect()->to('task/brokerSuccess'.'/'.$task['id']);
            }else{
                $controller = 'bounty';   //跳转路由
                $view = [
                    'task' => $task['id'],
                    'controller' => $controller,
                ];
                return redirect()->to('task/' . $controller . '/' . $task['id']);
            }
        }else{
            return redirect()->back()->with(['error' => '非法操作！']);
        }
    }
//    及时查询
    public function publishajax(Request $request)
    {
        $a = $request->get('q');
//        dd($a);die;
        return response()->json($a);
//        $tmp=$_GET['q'];
//        dd($tmp);die;
//        $publish = DB::select('select name from test where title like '%$tmp%' order by addtime desc limit 10');
//        $provinces=array("beijing","tianjin","shanghai","chongqing","hebei","henan","heilongjiang","jilin","changchun",
//            "shandong","anhui","shanxi","guangzhou","yunnan","hainan","xizang","qinghai","fujian","guizhou","jiangsu",
//            "zhejiang","guangzhou","yunan","hainan","xizang","neimenggu","sichuan","gansu","ningxia","xianggang","aomen");
//        $tmp=$_GET['q'];
//        $val=array();
//        $k=0;
//        if (strlen($tmp)>0)
//        {
//            for($i=0;$i<31;$i++){
//                if(strpos($provinces[$i],$tmp)!==false){
//                    //传递值给val
//                    $val[$k]=$provinces[$i];
//                    //下标增加
//                    $k=$k+1;
//                }
//            }
//            //遍历val数组
//            for($j=0;$j<count($val);$j++)
//            {
//                echo $val[$j];
//                echo "<br>";
//            }
//        }
    }

//  旧发布任务
    public function create(Request $request)
    {
        $this->theme->setTitle('发布任务');

        $isKee = ConfigModel::isOpenKee();

        
        $agree = AgreementModel::where('code_name','task_publish')->first();

        
        $hotCate = TaskCateModel::hotCate(6);
        
        $category_all = TaskCateModel::findByPid([0],['id']);
        $category_all = array_flatten($category_all);
        $category_all = TaskCateModel::findByPid($category_all);
        
        $province = DistrictModel::findTree(0);
        
        $city = DistrictModel::findTree($province[0]['id']);
        
        $area = DistrictModel::findTree($city[0]['id']);
        
        $service = ServiceModel::where('status',1)->where('type',1)->get()->toArray();
        
        $templet_cate = ['设计', '文案', '开发', '装修', '营销', '商务', '生活'];
        $templet = TaskTemplateModel::all();
        
        $taskType = [
            'xuanshang','zhaobiao'
        ];
        $rewardModel = TaskTypeModel::whereIn('alias',$taskType)->get()->toArray();
        
        $phone = \CommonClass::getConfig('phone');
        $qq = \CommonClass::getConfig('qq');
        
        $ad = AdTargetModel::getAdInfo('TASKINFO_RIGHT');
        $view = [
            'hotcate' => $hotCate,
            'category_all' => $category_all,
            'province' => $province,
            'area' => $area,
            'city' => $city,
            'service' => $service,
            'templet_cate' => $templet_cate,
            'templet' => $templet,
            'rewardModel'=>$rewardModel,
            'phone'=>$phone,
            'qq'=>$qq,
            'agree' => $agree,
            'ad' => $ad,
            'isKee' => $isKee
        ];

        return $this->theme->scope('task.create', $view)->render();
    }

//  新添加form
    public function createTaskNew(Request $request)
    {
        $data = $request->except('_token'); //  接受form表单
//        dd($data);die;
        $data['uid'] = $this->user['id'];   //        用户id
        $data['desc'] = \CommonClass::removeXss($data['description']);  //        描述
        $data['created_at'] = date('Y-m-d H:i:s', time());  //修改时间
        if($data['area']!=0)    //       地域限制
        {
            $data['region_limit'] = 1;
        }else{
            $data['region_limit'] = 0;
        }
        if(empty($data['sele_input1'])){    //      项目的时间间隔
            $data['time_interval'] = $data['sele_input'];
            $da = $data['sele_input'];
        }else{
            $da = $data['sele_input1'];
            $data['time_interval']  = $data['sele_input1'];
        }
        if(empty($data['bounty1'])){    //      项目预算
            $data['bounty'] = $data['bounty2'];
        }else{
            $data['bounty'] = $data['bounty1'];
        }
        $data['begin_at'] = $data['created_at'];    //任务开始时间
        $data['delivery_deadline'] = date("Y-m-d H:i:s",strtotime("+$da days",strtotime($data['begin_at'])));   //任务交稿结束时间
        $data['kee_status'] = 0;    //        接入交付平台
        $data['show_cash'] = $data['bounty'];    //        展示赏金
        $data['status'] = 1;    //        发布状态
        $controller = 'bounty';   //跳转路由
//        设计风格中间表
        if (!empty($data['style'])){
            $style_num = count($data['style']);
            $max_id = 0;
            $max_id=DB::table('style_task')->max('task_style_id');
            $task_style_id =  $max_id +1 ;
//            数据库事务报错回滚
            DB::transaction(function () use ($style_num, $task_style_id,$data) {
                for($i=0;$i<$style_num;$i++) {
                    DB::table('style_task')->insert(
                        ['task_style_id' => $task_style_id, 'style_id' => $data['style'][$i] ]
                    );
                }
            });
            $data['task_style_id'] = $task_style_id;    //设计风格id
        }
//        色调中间表
        if (!empty($data['tonality'])) {
            $tonality_num = count($data['tonality']);
            $max_tonality_id = 0;
            $max_tonality_id = DB::table('tonality_task')->max('task_tonality_id');
            $task_tonality_id = $max_tonality_id + 1;
            //            数据库事务报错回滚
            DB::transaction(function () use ($tonality_num, $task_tonality_id,$data) {
                for($i=0;$i<$tonality_num;$i++) {
                    DB::table('tonality_task')->insert(
                        ['task_tonality_id' => $task_tonality_id, 'tonality_id' => $data['tonality'][$i] ]
                    );
                }
            });
            $data['task_tonality_id'] = $task_tonality_id;  //色调外键id
        }
        $data['type_id'] = 1;   //任务类型
        $data['worker_num'] = 1;   //  服务商数量
//        dd($data);die;
//        添加操作
        $taskModel = new TaskModel();
        $result = $taskModel->createTask($data);
        if (!$result) {
            return redirect()->back()->with('error', '创建任务失败！');
        }
        return redirect()->to('task/' . $controller . '/' . $result['id']);
//        return redirect()->to('task/audit/?a=03' );
    }
//    返回审查页面
    public function audit(Request $request)
    {
        $this->theme->setTitle('平台审查');
        return $this->theme->scope('task.audit')->render();
    }
//    旧添加form
    public function createTask(TaskRequest $request)
    {
        $data = $request->except('_token');
        $data['uid'] = $this->user['id'];
        $data['desc'] = \CommonClass::removeXss($data['description']);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        if($data['area']!=0)
        {
            $data['region_limit'] = 1;
        }else{
            $data['region_limit'] = 0;
        }
        $isKee = ConfigModel::isOpenKee();


        $taskTypeAlias = 'xuanshang';
        if(isset($data['type_id'])){
            $taskType = TaskTypeModel::where('id',$data['type_id'])->first();
            if(!empty($taskType)){
                $taskTypeAlias = $taskType['alias'];
            }
        }
        $data['kee_status'] = 0;
        
        switch($taskTypeAlias){
            case 'xuanshang':
                
                $task_percentage = \CommonClass::getConfig('task_percentage');
                $task_fail_percentage = \CommonClass::getConfig('task_fail_percentage');
                break;
            case 'zhaobiao':
                $task_percentage = \CommonClass::getConfig('bid_percentage');
                $task_fail_percentage = \CommonClass::getConfig('bid_fail_percentage');
                $data['kee_status'] = ($isKee && isset($data['is_to_kee']) && $data['is_to_kee'] == 1) ? 1 : 0;
                break;
            default:
                $task_percentage = \CommonClass::getConfig('task_percentage');
                $task_fail_percentage = \CommonClass::getConfig('task_fail_percentage');
                break;
        }
		
        $data['task_success_draw_ratio'] = $task_percentage; 
        $data['task_fail_draw_ratio'] = $task_fail_percentage;

        $data['begin_at'] = preg_replace('/([\x80-\xff]*)/i', '', $data['begin_at'.$taskTypeAlias]);
        $data['delivery_deadline'] = preg_replace('/([\x80-\xff]*)/i', '', $data['delivery_deadline'.$taskTypeAlias]);
        $data['begin_at'] = date('Y-m-d H:i:s', strtotime($data['begin_at']));
        $data['delivery_deadline'] = date('Y-m-d H:i:s', strtotime($data['delivery_deadline']));
        $data['bounty'] = $data['bounty'.$taskTypeAlias];
        $data['show_cash'] = $data['bounty'];
        $data['worker_num'] = $data['worker_num'.$taskTypeAlias];


        
        $controller = '';
        if ($data['slutype'] == 1) {

            switch($taskTypeAlias){
                case 'xuanshang':
                    $data['status'] = 1;
                    $controller = 'bounty';
                    break;
                case 'zhaobiao' :
                    
                    $bid_examine = \CommonClass::getConfig('bid_examine');
                    if($bid_examine == 1){ 
                        $data['status'] = 1;
                    }else{ 
                        $data['status'] = 3;
                    }
                    if(!empty($data['product'])){
                        $controller = 'buyServiceTaskBid';
                    }else{
                        $controller = 'tasksuccess';
                    }
                    break;
                default :
                    $data['status'] = 1;
                    $controller = 'bounty';
                    break;
            }


        } elseif ($data['slutype'] == 2) {
            return redirect()->to('task/preview')->with($data);
        } elseif ($data['slutype'] == 3) {
            $data['status'] = 0;
        }

//        dd($data);die;

        $taskModel = new TaskModel();
		$result = $taskModel->createTask($data);
        if (!$result) {
            return redirect()->back()->with('error', '创建任务失败！');
        }

        if($data['slutype']==3){
            return redirect()->to('user/unreleasedTasks');
        }
        return redirect()->to('task/' . $controller . '/' . $result['id']);
    }

    
    public function preview(Request $request)
    {
        $this->theme->setTitle('任务预览');

        $data = $request->session()->all();

        if (empty($data['uid'])) {
            return redirect()->back()->with('error', '数据过期，请重新预览！');
        }

        $user_detail = UserDetailModel::where('uid', $data['uid'])->first();
        $task_cate = TaskCateModel::where('id',$data['cate_id'])->first();
        $attatchment = array();
        if (!empty($data['file_id']) && count($data['file_id']) > 0) {
            
            $file_able_ids = AttachmentModel::fileAble($data['file_id']);
            $file_able_ids = array_flatten($file_able_ids);
            $attatchment = AttachmentModel::whereIn('id', $file_able_ids)->get();
        }
        $phone = \CommonClass::getConfig('phone');
        $qq = \CommonClass::getConfig('qq');
        
        $ad = AdTargetModel::getAdInfo('TASKINFO_RIGHT');
        $taskTypeAlias = TaskTypeModel::getTaskTypeAliasById($data['type_id']);
        $view = [
            'user_detail' => $user_detail,
            'attatchment' => $attatchment,
            'data' => $data,
            'task_cate' => $task_cate,
            'phone'=>$phone,
            'qq'=>$qq,
            'ad' => $ad,
            'task_type_alias' => $taskTypeAlias
        ];
        return $this->theme->scope('task.preview', $view)->render();
    }

    
    public function getTemplate(Request $request)
    {
        $id = $request->get('id');
        if(is_array($id))
            $id = $id[0];
        
        $cate = TaskCateModel::findById($id);
        
        TaskCateModel::where('id',$id)->increment('choose_num',1);
        
        $pid = $cate['pid'];

        $template = TaskTemplateModel::where('cate_id',$pid)->where('status',1)->first();
        if (!$template) {
            return response()->json(['errMsg' => '没有模板']);
        }
        $template['content'] = htmlspecialchars_decode($template['content']);
        return response()->json($template);
    }

    
    public function ajaxTask(TaskRequest $request)
    {
        $data = $request->except('_token');
    }

    
    public function bounty($id)
    {
        $this->theme->setTitle('赏金托管');
        
        $task = TaskModel::findById($id);

        
        if ($task['uid'] != $this->user['id'] || $task['status'] >= 2) {
            return redirect()->back()->with(['error' => '非法操作！']);
        }

        
        $user_money = UserDetailModel::where(['uid' => $this->user['id']])->first();
        $user_money = $user_money['balance'];

        
        $service = TaskServiceModel::select('task_service.service_id')
            ->where('task_id', '=', $id)->get()->toArray();
        $service = array_flatten($service);
        $serviceModel = new ServiceModel();
        $service_money = $serviceModel->serviceMoney($service);

        
        $balance_pay = false;
        if ($user_money >= ($task['bounty'] + $service_money)) {
            $balance_pay = true;
        }

        
        $bank = BankAuthModel::where('uid', '=', $id)->where('status', '=', 4)->get();
        
        $payConfig = ConfigModel::getConfigByType('thirdpay');
        $view = [
            'task' => $task,
            'bank' => $bank,
            'service_money' => $service_money,
            'id' => $id,
            'user_money' => $user_money,
            'balance_pay' => $balance_pay,
            'payConfig' => $payConfig
        ];
        return $this->theme->scope('task.bounty', $view)->render();
    }

    
    public function bountyUpdate(BountyRequest $request)
    {
        $data = $request->except('_token');
        $data['id'] = intval($data['id']);
        
        $task = TaskModel::findById($data['id']);

        
        if ($task['uid'] != $this->user['id'] || $task['status'] >= 2) {
            return redirect()->to('/task')->with('error', '非法操作！');
        }

        
        $balance = UserDetailModel::where(['uid' => $this->user['id']])->first();
        $balance = (float)$balance['balance'];

        
        $taskModel = new TaskModel();
        $money = $taskModel->taskMoney($data['id']);
        
        $is_ordered = OrderModel::bountyOrder($this->user['id'], $money, $task['id']);

        if (!$is_ordered) return redirect()->back()->with(['error' => '任务托管失败']);

        
        if ($balance >= $money && $data['pay_canel'] == 0)
        {
            
            $password = UserModel::encryptPassword($data['password'], $this->user['salt']);
            if ($password != $this->user['alternate_password']) {
                return redirect()->back()->with(['error' => '您的支付密码不正确']);
            }
            
            $result = TaskModel::bounty($money, $data['id'], $this->user['id'], $is_ordered->code);
            if (!$result) return redirect()->back()->with(['error' => '赏金托管失败！']);
            
            $task = TaskModel::where('id',$data['id'])->first();
            if($task['status']==3){
                $url = 'task';
            }elseif($task['status']==2){
                $url = 'task/tasksuccess/'.$data['id'].'?a=04';
            }
            return redirect()->to($url);
        } else if (isset($data['pay_type']) && $data['pay_canel'] == 1) {
            
            if ($data['pay_type'] == 1) {
                $config = ConfigModel::getPayConfig('alipay');
                $objOminipay = Omnipay::gateway('alipay');
                $objOminipay->setPartner($config['partner']);
                $objOminipay->setKey($config['key']);
                $objOminipay->setSellerEmail($config['sellerEmail']);
                $siteUrl = \CommonClass::getConfig('site_url');
                $objOminipay->setReturnUrl($siteUrl . '/order/pay/alipay/return');
                $objOminipay->setNotifyUrl($siteUrl . '/order/pay/alipay/notify');

                $response = Omnipay::purchase([
                    'out_trade_no' => $is_ordered->code, 
                    'subject' => \CommonClass::getConfig('site_name'), 
                    'total_fee' => $money, 
                ])->send();
                $response->redirect();
            } else if ($data['pay_type'] == 2) {
                $config = ConfigModel::getPayConfig('wechatpay');
                $wechat = Omnipay::gateway('wechat');
                $wechat->setAppId($config['appId']);
                $wechat->setMchId($config['mchId']);
                $wechat->setAppKey($config['appKey']);
                $out_trade_no = $is_ordered->code;
                $params = array(
                    'out_trade_no' => $is_ordered->code, 
                    'notify_url' => \CommonClass::getDomain() . '/order/pay/wechat/notify?out_trade_no=' . $out_trade_no . '&task_id=' . $data['id'], 
                    'body' => \CommonClass::getConfig('site_name') . '余额充值', 
                    'total_fee' => $money, 
                    'fee_type' => 'CNY', 
                );
                $response = $wechat->purchase($params)->send();

                $img = QrCode::size('280')->generate($response->getRedirectUrl());

                $view = array(
                    'cash'=>$money,
                    'img' => $img
                );
                return $this->theme->scope('task.wechatpay', $view)->render();
            } else if ($data['pay_type'] == 3) {
                dd('银联支付！');
            }
        } else if (isset($data['account']) && $data['pay_canel'] == 2) {
            dd('银行卡支付！');
        } else
        {
            return redirect()->back()->with(['error' => '请选择一种支付方式']);
        }

    }

    
    public function fileUpload(Request $request)
    {
        $file = $request->file('file');
        
        $attachment = \FileClass::uploadFile($file, 'task');
        $attachment = json_decode($attachment, true);
        
        if($attachment['code']!=200)
        {
            return response()->json(['errCode' => 0, 'errMsg' => $attachment['message']]);
        }
        $attachment_data = array_add($attachment['data'], 'status', 1);
        $attachment_data['created_at'] = date('Y-m-d H:i:s', time());
        
        $result = AttachmentModel::create($attachment_data);
        $result = json_decode($result, true);
        if (!$result) {
            return response()->json(['errCode' => 0, 'errMsg' => '文件上传失败！']);
        }
        
        return response()->json(['id' => $result['id']]);
    }

    
    public function fileDelet(Request $request)
    {
        $id = $request->get('id');
        
        $file = AttachmentModel::where('id',$id)->first()->toArray();
        if(!$file)
        {
            return response()->json(['errCode' => 0, 'errMsg' => '附件没有上传成功！']);
        }
        
        if(is_file($file['url']))
            unlink($file['url']);
        $result = AttachmentModel::destroy($id);
        if (!$result) {
            return response()->json(['errCode' => 0, 'errMsg' => '删除失败！']);
        }
        return response()->json(['errCode' => 1, 'errMsg' => '删除成功！']);
    }


//    删除发布任务的图片
    public function taskFileDelet(Request $request){
        $id = $request->get('id');
        $file = AttachmentModel::where('id',$id)->first()->toArray();
        if(is_file($file['url']))
            unlink($file['url']);
        $result = AttachmentModel::destroy($id);
        $task =  DB::table('task_attachment')->where('attachment_id',$id)->delete();
        if (!$result || !$task){
            return response()->json(['errCode' => 0, 'errMsg' => '删除失败！']);
        }
        return response()->json(['errCode' => 1, 'errMsg' => '删除成功！']);
    }



    public function weixinNotify()
    {
        
        $arrNotify = \CommonClass::xmlToArray($GLOBALS['HTTP_RAW_POST_DATA']);

        $data = [
            'pay_account' => $arrNotify['buyer_email'],
            'code' => $arrNotify['out_trade_no'],
            'pay_code' => $arrNotify['trade_no'],
            'money' => $arrNotify['total_fee'],
            'task_id' => $arrNotify['task_id']
        ];

        $content = '<xml>
                    <return_code><![CDATA[SUCCESS]]></return_code>
                    <return_msg><![CDATA[OK]]></return_msg>
                    </xml>';

        if ($arrNotify['result_code'] == 'SUCCESS' && $arrNotify['return_code'] = 'SUCCESS') {

            
            
            
            return response($content)->header('Content-Type', 'text/xml');
        }
    }

    
    public function result(Request $request)
    {
        $data = $request->all();
        $data = [
            'pay_account' => $data['buyer_email'],
            'code' => $data['out_trade_no'],
            'pay_code' => $data['trade_no'],
            'money' => $data['total_fee'],
        ];
        $gateway = Omnipay::gateway('alipay');

        $options = [
            'request_params' => $_REQUEST,
        ];
        $response = $gateway->completePurchase($options)->send();

        if ($response->isSuccessful() && $response->isTradeStatusOk()) {
            
            $result = UserDetailModel::recharge($this->user['id'], 2, $data);

            if (!$result) {
                echo '支付失败！';
                return redirect()->back()->withErrors(['errMsg' => '支付失败！']);
            }
            
            $task_id = OrderModel::where('code', $data['code'])->first();

            TaskModel::bounty($data['money'], $task_id['task_id'], $this->user['id'], $data['code'], 2);
            echo '支付成功';
            return redirect()->to('task/' . $task_id['task_id']);
        } else {
            
            echo '支付失败';
            return redirect()->to('task/bounty')->withErrors(['errMsg' => '支付失败！']);
        }
    }

    
    public function notify(Request $request)
    {
        $data = $request->all();
        $data = [
            'pay_account' => $data['buyer_email'],
            'code' => $data['out_trade_no'],
            'pay_code' => $data['trade_no'],
            'money' => $data['total_fee'],
        ];
        $gateway = Omnipay::gateway('alipay');
        $options = [
            'request_params' => $_REQUEST,
        ];
        $response = $gateway->completePurchase($options)->send();

        if ($response->isSuccessful() && $response->isTradeStatusOk()) {
            
            $result = UserDetailModel::recharge($this->user['id'], 2, $data);
            if (!$result) {
                echo '支付失败！';
                return redirect()->back()->withErrors(['errMsg' => '支付失败！']);
            }
            
            $task_id = OrderModel::where('code', $data['code'])->first();

            TaskModel::bounty($data['money'], $task_id['task_id'], $this->user['id'], $data['code'], 2);
            echo '支付成功';
            return redirect()->to('task/' . $task_id['task_id']);
        } else {
            
            return redirect()->to('task/bounty')->withErrors(['errMsg' => '支付失败！']);
        }
    }

    
    public function ajaxcity(Request $request)
    {
        $id = intval($request->get('id'));
        if (!$id) {
            return response()->json(['errMsg' => '参数错误！']);
        }
        $province = DistrictModel::findTree($id);
        
        $area = DistrictModel::findTree($province[0]['id']);
        $data = [
            'province' => $province,
            'area' => $area
        ];
        return response()->json($data);
    }

    
    public function ajaxarea(Request $request)
    {
        $id = intval($request->get('id'));
        if (!$id) {
            return response()->json(['errMsg' => '参数错误！']);
        }
        $area = DistrictModel::findTree($id);
        return response()->json($area);
    }

    
    public function release($id)
    {
        $this->theme->setTitle('发布任务');
        
        $task = TaskModel::where('id', $id)->first();
        if(!$task)
        {
            return redirect()->to('user/unreleasedTasks')->with(['error'=>'非法操作！']);
        }
        $isKee = ConfigModel::isOpenKee();
        
        $category = TaskCateModel::findAll();

        
        $hotCate = TaskCateModel::hotCate(6);
        
        $category_all = TaskCateModel::findByPid([0],['id']);
        $category_all = array_flatten($category_all);
        $category_all = TaskCateModel::findByPid($category_all);
        
        
        $service = ServiceModel::where('status',1)->where('type',1)->get()->toArray();
        $task_service = TaskServiceModel::where('task_id', $id)->lists('service_id')->toArray();
        $task_service_ids = array_flatten($task_service);
        
        $task_service_money = ServiceModel::serviceMoney($task_service_ids);


        $province = DistrictModel::findTree(0);
        
        if ($task['region_limit'] == 1) {
            $city = DistrictModel::findTree($task['province']);
            $area = DistrictModel::findTree($task['city']);
        } else {
            $city = DistrictModel::findTree($province[0]['id']);
            $area = DistrictModel::findTree( $city[0]['id']);
        }

        
        $task_attachment = TaskAttachmentModel::where('task_id', $id)->lists('attachment_id')->toArray();
        $task_attachment_ids = array_flatten($task_attachment);
        $task_attachment_data = AttachmentModel::whereIn('id', $task_attachment_ids)->get();
        $domain = \CommonClass::getDomain();
        
        $taskType = [
            'xuanshang','zhaobiao'
        ];
        $rewardModel = TaskTypeModel::whereIn('alias',$taskType)->get()->toArray();
        $taskTypeAlias = TaskTypeModel::getTaskTypeAliasById($task['type_id']);
        
        $phone = \CommonClass::getConfig('phone');
        $qq = \CommonClass::getConfig('qq');
        
        $ad = AdTargetModel::getAdInfo('TASKINFO_RIGHT');
        
        $agree = AgreementModel::where('code_name','task_publish')->first();
        $view = [
            'hotcate' => $hotCate,
            'category' => $category,
            'category_all' => $category_all,
            'service' => $service,
            'task' => $task,
            'province' => $province,
            'city' => $city,
            'area' => $area,
            'task_service_ids' => $task_service_ids,
            'task_service_money' => $task_service_money,
            'task_attachment_data' => $task_attachment_data,
            'domain' => $domain,
            'rewardModel'=>$rewardModel,
            'phone'=>$phone,
            'qq'=>$qq,
            'agree' => $agree,
            'ad' => $ad,
            'task_type_alias' => $taskTypeAlias,
            'isKee' => $isKee
        ];

        return $this->theme->scope('task.release', $view)->render();
    }

    
    public function checkBounty(Request $request)
    {
        $data = $request->except('_token');
		if(isset($data['name']) && $data['name']=='bountyzhaobiao'){
			unset($data['begin_at']);
			
			$bid_bounty_limit = \CommonClass::getConfig('bid_bounty_limit');
			$bid_bounty_min_limit = \CommonClass::getConfig('bid_bounty_min_limit');
			
			if ($bid_bounty_min_limit > $data['param']) {
				$data['info'] = '赏金应该大于' . $bid_bounty_min_limit . '小于' . $bid_bounty_limit;
				$data['status'] = 'n';
				return json_encode($data);
			}
			
			if ($bid_bounty_limit < $data['param'] && $bid_bounty_limit != 0) {
				$data['info'] = '赏金应该大于' . $bid_bounty_min_limit . '小于' . $bid_bounty_limit;
				$data['status'] = 'n';
				return json_encode($data);
			}
			$data['status'] = 'y';
			return json_encode($data);
		}else{
			$begin_at = preg_replace('/([\x80-\xff]*)/i', '', $data['begin_at']);
			
			$task_bounty_max_limit = \CommonClass::getConfig('task_bounty_max_limit');
			$task_bounty_min_limit = \CommonClass::getConfig('task_bounty_min_limit');

			
			if ($task_bounty_min_limit > $data['param']) {
				$data['info'] = '赏金应该大于' . $task_bounty_min_limit . '小于' . $task_bounty_max_limit;
				$data['status'] = 'n';
				return json_encode($data);
			}
			
			if ($task_bounty_max_limit < $data['param'] && $task_bounty_max_limit != 0) {
				$data['info'] = '赏金应该大于' . $task_bounty_min_limit . '小于' . $task_bounty_max_limit;
				$data['status'] = 'n';
				return json_encode($data);
			}

			
			$task_delivery_limit_time = \CommonClass::getConfig('task_delivery_limit_time');
			$task_delivery_limit_time = json_decode($task_delivery_limit_time, true);
			$task_delivery_limit_time_key = array_keys($task_delivery_limit_time);

			$task_delivery_limit_time_key = \CommonClass::get_rand($task_delivery_limit_time_key, $data['param']);
			if(in_array($task_delivery_limit_time_key,array_keys($task_delivery_limit_time))){
				$task_delivery_limit_time = $task_delivery_limit_time[$task_delivery_limit_time_key];
			}else{
				$task_delivery_limit_time = 100;
			}


			$data['status'] = 'y';
			$data['info'] = '您当前的发布的任务金额是' . $data['param'] . ',截稿时间是' . $task_delivery_limit_time . '天';
			$data['deadline'] = date('Y年m月d日',strtotime($begin_at)+$task_delivery_limit_time*24*3600);

			return json_encode($data);
		}
        
    }

    
    public function checkDeadline(Request $request)
    {
        $data = $request->except('_token');
        $delivery_deadline = preg_replace('/([\x80-\xff]*)/i', '', $data['delivery_deadline']);
        $begin_at = preg_replace('/([\x80-\xff]*)/i', '', $data['begin_at']);
        
        if (empty($data['param'])) {
            return json_encode(['info' => '请先填写任务赏金', 'status' => 'n']);
        }
        
        if (empty($data['begin_at'])) {
            return json_encode(['info' => '请先填写任务开始时间', 'status' => 'n']);
        }
        
        if (strtotime($data['begin_at'])>=strtotime(date('Y-m-d',time()))) {
            return json_encode(['info' => '开始时间不能在今天之前', 'status' => 'n']);
        }
        
        if (empty($data['delivery_deadline'])) {
            return json_encode(['info' => '请填写任务截稿时间', 'status' => 'n']);
        }
        
        if(date('Ymd',strtotime($delivery_deadline))==date('Ymd',strtotime($begin_at)))
        {
            return json_encode(['info' => '投稿时间最少一天', 'status' => 'n','begin_at'=>$data['begin_at'],'delivery_deadline'=>date('Ymd',strtotime($data['delivery_deadline']))]);
        }
        
        $task_bounty_max_limit = \CommonClass::getConfig('task_bounty_max_limit');
        $task_bounty_min_limit = \CommonClass::getConfig('task_bounty_min_limit');
        
        $task_delivery_limit_time = \CommonClass::getConfig('task_delivery_limit_time');
        $task_delivery_limit_time = json_decode($task_delivery_limit_time, true);
        $task_delivery_limit_time_key = array_keys($task_delivery_limit_time);
        $task_delivery_limit_time_key = \CommonClass::get_rand($task_delivery_limit_time_key, $data['param']);
        $task_delivery_limit_time = $task_delivery_limit_time[$task_delivery_limit_time_key];
        
        if ($task_bounty_min_limit > $data['param']) {
            $info = '赏金应该大于' . $task_bounty_min_limit . '小于' . $task_bounty_max_limit;
            return json_encode(['info' => $info, 'status' => 'n']);
        }
        
        if ($task_bounty_max_limit < $data['param'] && $task_bounty_max_limit != 0) {
            $info = '赏金应该大于' . $task_bounty_min_limit . '小于' . $task_bounty_max_limit;
            return json_encode(['info' => $info, 'status' => 'n']);
        }
        
        $delivery_deadline = strtotime($delivery_deadline);
        $task_delivery_limit_time = $task_delivery_limit_time * 24 * 3600;
        $begin_at = strtotime($begin_at);
        
        if ($begin_at > $delivery_deadline) {
            $info = '截稿时间不能小于开始时间';
            return json_encode(['info' => $info, 'status' => 'n']);
        }
        if (($begin_at + $task_delivery_limit_time) < $delivery_deadline) {
            $info = '当前截稿时间最晚可设置为' . date('Y-m-d', ($begin_at + $task_delivery_limit_time));
            return json_encode(['info' => $info, 'status' => 'n']);
        }
        $info = '当前截稿时间最晚可设置为' . date('Y-m-d', ($begin_at + $task_delivery_limit_time));
        $status = 'y';
        $data = array(
            'info' => $info,
            'status' => $status
        );
        return json_encode($data);

    }


    
    public function checkDeadlineByBid(Request $request)
    {
        $data = $request->except('_token');
        $delivery_deadline = preg_replace('/([\x80-\xff]*)/i', '', $data['delivery_deadline']);
        $begin_at = preg_replace('/([\x80-\xff]*)/i', '', $data['begin_at']);
        
        if (empty($data['begin_at'])) {
            return json_encode(['info' => '请先填写任务开始时间', 'status' => 'n']);
        }
        
        if (strtotime($data['begin_at'])>=strtotime(date('Y-m-d',time()))) {
            return json_encode(['info' => '开始时间不能在今天之前', 'status' => 'n']);
        }
        
        if (empty($data['delivery_deadline'])) {
            return json_encode(['info' => '请填写任务截稿时间', 'status' => 'n']);
        }
        
        if(date('Ymd',strtotime($delivery_deadline))==date('Ymd',strtotime($begin_at))) {
            return json_encode(['info' => '投稿时间最少一天', 'status' => 'n','begin_at'=>$data['begin_at'],'delivery_deadline'=>date('Ymd',strtotime($data['delivery_deadline']))]);
        }
        
        if (isset($data['param']) && !empty($data['param'])) {
            $task_bounty_max_limit = \CommonClass::getConfig('bid_bounty_limit');
            $task_bounty_min_limit = \CommonClass::getConfig('bid_bounty_min_limit');
            
            if ($task_bounty_min_limit > $data['param']) {
                $info = '赏金应该大于' . $task_bounty_min_limit . '小于' . $task_bounty_max_limit;
                return json_encode(['info' => $info, 'status' => 'n']);
            }
            
            if ($task_bounty_max_limit < $data['param'] && $task_bounty_max_limit != 0) {
                $info = '赏金应该大于' . $task_bounty_min_limit . '小于' . $task_bounty_max_limit;
                return json_encode(['info' => $info, 'status' => 'n']);
            }
        }

        
        $delivery_deadline = strtotime($delivery_deadline);
        $begin_at = strtotime($begin_at);
        $max_limit_delivery = \CommonClass::getConfig('bid_delivery_max');
        $max_limit_delivery = $max_limit_delivery * 24 * 3600;
        $deadlineMax = $begin_at + $max_limit_delivery;
        
        if ($begin_at > $delivery_deadline) {
            $info = '截稿时间不能小于开始时间';
            return json_encode(['info' => $info, 'status' => 'n']);
        }
        if ($deadlineMax < $delivery_deadline) {
            $info = '当前截稿时间最晚可设置为' . date('Y-m-d', $deadlineMax);
            return json_encode(['info' => $info, 'status' => 'n']);
        }
        $info = '当前截稿时间最晚可设置为' . date('Y-m-d', $deadlineMax);
        $status = 'y';
        $data = array(
            'info' => $info,
            'status' => $status
        );
        return json_encode($data);

    }

    public function imgupload(Request $request)
    {
        $data = $request->all();
        dd($data);
    }

    
    public function collectionTask($taskId)
    {
        
        $userId = $this->user['id'];
        if ($userId && $taskId) {
            
            $focus = TaskFocusModel::where('uid',$userId)->where('task_id',$taskId)->first();
            if($focus) {
                $route = '/task';
                $msg = '该任务已经收藏过';
            }else{
                $focusArr = array(
                    'uid' => $userId,
                    'task_id' => $taskId,
                    'created_at' => date('Y-m-d H:i:s', time())
                );
                $res = TaskFocusModel::create($focusArr);
                if ($res) {
                    $route = '/task';
                    $msg = '收藏成功';

                } else {
                    $route = '/task';
                    $msg = '收藏失败';
                }
            }
        } else {
            $route = '/task';
            $msg = '没有登录，不能收藏';
        }
        return redirect($route)->with(array('message' => $msg));
    }

    
    public function postCollectionTask(Request $request)
    {
        
        $userId = $this->user['id'];
        if(!empty($userId)){
            $taskId = $request->get('task_id');
            $type = $request->get('type');
            switch($type){
                
                case 1 :
                    
                    $focus = TaskFocusModel::where('uid',$userId)->where('task_id',$taskId)->first();
                    if($focus) {
                        $data = array(
                            'code' => 2,
                            'msg' => '该任务已经收藏过'
                        );
                    }else{
                        $focusArr = array(
                            'uid' => $userId,
                            'task_id' => $taskId,
                            'created_at' => date('Y-m-d H:i:s', time())
                        );
                        $res = TaskFocusModel::create($focusArr);
                        if ($res) {
                            $data = array(
                                'code' => 1,
                                'msg' => '收藏成功'
                            );

                        } else {
                            $data = array(
                                'code' => 2,
                                'msg' => '收藏失败'
                            );
                        }
                    }
                    break;
                
                case 2 :
                    
                    $focus = TaskFocusModel::where('uid',$userId)->where('task_id',$taskId)->first();
                    if(empty($focus)) {
                        $data = array(
                            'code' => 2,
                            'msg' => '该任务已经取消收藏'
                        );
                    }else{
                        $res = TaskFocusModel::where('uid',$userId)->where('task_id',$taskId)->delete();
                        if ($res) {
                            $data = array(
                                'code' => 1,
                                'msg' => '取消成功'
                            );

                        } else {
                            $data = array(
                                'code' => 2,
                                'msg' => '取消失败'
                            );
                        }
                    }
                    break;
            }
        }else{
            $data = array(
                'code' => 0,
                'msg' => '没有登录，不能收藏'
            );
        }
        return response()->json($data);
    }

    public function checkDesc(Request $request)
    {
        $data = $request->except('_token');
        dd($data);
    }

    
    public function taskSuccess($id)
    {
        $id = intval($id);
        
        $task = TaskModel::where('id',$id)->first();

        $taskTypeAlias = 'xuanshang';
        $taskType = TaskTypeModel::find($task['type_id']);
        if(!empty($taskType)){
            $taskTypeAlias = $taskType['alias'];
        }

        switch($taskTypeAlias){
            case 'xuanshang' :
                if($task['status']!=2){
                    return redirect()->back()->with(['error'=>'数据错误，当前任务不处于等待审核状态！']);
                }
                break;

            case 'zhaobiao' :
                if($task['status'] == 3){ 
                    return redirect('/task/'.$id);
                }
                break;

            default:
                break;
        }


        $qq = \CommonClass::getConfig('qq');
        $view = [
            'id'=>$id,
            'qq'=>$qq,
        ];

//        return $this->theme->scope('task.tasksuccess',$view)->render();
        return $this->theme->scope('task/audit',$view)->render();
    }


    
    public function buyServiceTaskBid($id)
    {
        $this->theme->setTitle('招标任务购买增值服务');
        
        $task = TaskModel::findById($id);

        
        $user_money = UserDetailModel::where(['uid' => $this->user['id']])->first();
        $user_money = $user_money['balance'];

        
        $service = TaskServiceModel::select('task_service.service_id')
            ->where('task_id', '=', $id)->get()->toArray();
        $service = array_flatten($service);
        $service_money = ServiceModel::serviceMoney($service);
        
        $balance_pay = false;
        if ($user_money > $service_money) {
            $balance_pay = true;
        }

        
        $bank = BankAuthModel::where('uid', '=', $id)->where('status', '=', 4)->get();
        
        $payConfig = ConfigModel::getConfigByType('thirdpay');
        $view = [
            'task' => $task,
            'bank' => $bank,
            'service_money' => $service_money,
            'id' => $id,
            'user_money' => $user_money,
            'balance_pay' => $balance_pay,
            'payConfig' => $payConfig
        ];
        return $this->theme->scope('task.bid.buyservice', $view)->render();
    }


    
    public function postBuyServiceTaskBid(BountyRequest $request)
    {
        $data = $request->except('_token');
        $data['id'] = intval($data['id']);
        
        $task = TaskModel::findById($data['id']);

        
        if ($task['uid'] != $this->user['id'] || $task['bounty_status'] != 0) {
            return redirect()->to('/task/' . $task['id'])->with('error', '非法操作！');
        }

        
        $balance = UserDetailModel::where(['uid' => $this->user['id']])->first();
        $balance = (float)$balance['balance'];

        
        $service = TaskServiceModel::select('task_service.service_id')
            ->where('task_id', '=', $data['id'])->get()->toArray();
        $service = array_flatten($service);
        $money = ServiceModel::serviceMoney($service);
        
        $is_ordered = OrderModel::buyServicebyTaskBid($this->user['id'], $money, $task['id']);
        if (!$is_ordered) {
            return redirect()->back()->with(['error' => '任务发布失败']);
        }

        
        if ($balance >= $money && $data['pay_canel'] == 0)
        {
            
            $password = UserModel::encryptPassword($data['password'], $this->user['salt']);
            if ($password != $this->user['alternate_password']) {
                return redirect()->back()->with(['error' => '您的支付密码不正确']);
            }
            
            $result = TaskModel::buyServiceTaskBid($money, $data['id'], $this->user['id'], $is_ordered->code);
            if (!$result) return redirect()->back()->with(['error' => '赏金托管失败！']);
            
            $task = TaskModel::where('id',$data['id'])->first();
            if($task['status'] == 3){
                $url = 'task/'.$data['id'];
            }elseif($task['status'] == 1){
                $url = 'task/tasksuccess/'.$data['id'];
            }
            return redirect()->to($url);
        } else if (isset($data['pay_type']) && $data['pay_canel'] == 1) {
            
            if ($data['pay_type'] == 1) {
                $config = ConfigModel::getPayConfig('alipay');
                $objOminipay = Omnipay::gateway('alipay');
                $objOminipay->setPartner($config['partner']);
                $objOminipay->setKey($config['key']);
                $objOminipay->setSellerEmail($config['sellerEmail']);
                $siteUrl = \CommonClass::getConfig('site_url');
                $objOminipay->setReturnUrl($siteUrl . '/order/pay/alipay/return');
                $objOminipay->setNotifyUrl($siteUrl . '/order/pay/alipay/notify');

                $response = Omnipay::purchase([
                    'out_trade_no' => $is_ordered->code, 
                    'subject' => \CommonClass::getConfig('site_name'), 
                    'total_fee' => $money, 
                ])->send();
                $response->redirect();
            } else if ($data['pay_type'] == 2) {
                $config = ConfigModel::getPayConfig('wechatpay');
                $wechat = Omnipay::gateway('wechat');
                $wechat->setAppId($config['appId']);
                $wechat->setMchId($config['mchId']);
                $wechat->setAppKey($config['appKey']);
                $out_trade_no = $is_ordered->code;
                $params = array(
                    'out_trade_no' => $is_ordered->code, 
                    'notify_url' => \CommonClass::getDomain() . '/order/pay/wechat/notify?out_trade_no=' . $out_trade_no . '&task_id=' . $data['id'], 
                    'body' => \CommonClass::getConfig('site_name') . '余额充值', 
                    'total_fee' => $money, 
                    'fee_type' => 'CNY', 
                );
                $response = $wechat->purchase($params)->send();

                $img = QrCode::size('280')->generate($response->getRedirectUrl());

                $view = array(
                    'cash'=>$money,
                    'img' => $img
                );
                return $this->theme->scope('task.wechatpay', $view)->render();
            } else if ($data['pay_type'] == 3) {
                dd('银联支付！');
            }
        } else if (isset($data['account']) && $data['pay_canel'] == 2) {
            dd('银行卡支付！');
        } else
        {
            return redirect()->back()->with(['error' => '请选择一种支付方式']);
        }
    }

    
    public function bidBounty($id)
    {
        $this->theme->setTitle('赏金托管');
        
        $task = TaskModel::find($id);

        
        if ($task['uid'] != $this->user['id'] || $task['bounty_status'] != 0) {
            return redirect()->to('/task/'.$id)->with(['error' => '非法操作！']);
        }
        
        $user_money = UserDetailModel::where(['uid' => $this->user['id']])->first();
        $user_money = $user_money['balance'];

        
        $balance_pay = false;
        if ($user_money > $task['bounty']) {
            $balance_pay = true;
        }

        
        $bank = BankAuthModel::where('uid', '=', $id)->where('status', '=', 4)->get();
        
        $payConfig = ConfigModel::getConfigByType('thirdpay');
        $view = [
            'task' => $task,
            'bank' => $bank,
            'id' => $id,
            'user_money' => $user_money,
            'balance_pay' => $balance_pay,
            'payConfig' => $payConfig
        ];
        return $this->theme->scope('task.bid.bounty', $view)->render();
    }


    
    public function bidBountyUpdate(BountyRequest $request)
    {
        $data = $request->except('_token');
        $data['id'] = intval($data['id']);
        
        $task = TaskModel::findById($data['id']);

        
        if ($task['uid'] != $this->user['id'] || $task['bounty_status'] == 1) {
            return redirect()->to('/task/' . $task['id'])->with('error', '非法操作！');
        }

        
        $balance = UserDetailModel::where(['uid' => $this->user['id']])->first();
        $balance = (float)$balance['balance'];

        $money = $task['bounty'];
        
        $is_ordered = OrderModel::bountyOrderByTaskBid($this->user['id'], $money, $task['id']);

        if (!$is_ordered) return redirect()->back()->with(['error' => '任务托管失败']);

        
        if ($balance >= $money && $data['pay_canel'] == 0)
        {
            
            $password = UserModel::encryptPassword($data['password'], $this->user['salt']);
            if ($password != $this->user['alternate_password']) {
                return redirect()->back()->with(['error' => '您的支付密码不正确']);
            }
            
            $result = TaskModel::bidBounty($money, $data['id'], $this->user['id'], $is_ordered->code);
            if (!$result){
                return redirect()->back()->with(['error' => '赏金托管失败！']);
            }
            $url = 'task/'.$data['id'];
            return redirect()->to($url);
        } else if (isset($data['pay_type']) && $data['pay_canel'] == 1) {
            
            if ($data['pay_type'] == 1) {
                $config = ConfigModel::getPayConfig('alipay');
                $objOminipay = Omnipay::gateway('alipay');
                $objOminipay->setPartner($config['partner']);
                $objOminipay->setKey($config['key']);
                $objOminipay->setSellerEmail($config['sellerEmail']);
                $siteUrl = \CommonClass::getConfig('site_url');
                $objOminipay->setReturnUrl($siteUrl . '/order/pay/alipay/return');
                $objOminipay->setNotifyUrl($siteUrl . '/order/pay/alipay/notify');

                $response = Omnipay::purchase([
                    'out_trade_no' => $is_ordered->code, 
                    'subject' => \CommonClass::getConfig('site_name'), 
                    'total_fee' => $money, 
                ])->send();
                $response->redirect();
            } else if ($data['pay_type'] == 2) {
                $config = ConfigModel::getPayConfig('wechatpay');
                $wechat = Omnipay::gateway('wechat');
                $wechat->setAppId($config['appId']);
                $wechat->setMchId($config['mchId']);
                $wechat->setAppKey($config['appKey']);
                $out_trade_no = $is_ordered->code;
                $params = array(
                    'out_trade_no' => $is_ordered->code, 
                    'notify_url' => \CommonClass::getDomain() . '/order/pay/wechat/notify?out_trade_no=' . $out_trade_no . '&task_id=' . $data['id'], 
                    'body' => \CommonClass::getConfig('site_name') . '余额充值', 
                    'total_fee' => $money, 
                    'fee_type' => 'CNY', 
                );
                $response = $wechat->purchase($params)->send();

                $img = QrCode::size('280')->generate($response->getRedirectUrl());

                $view = array(
                    'cash'=>$money,
                    'img' => $img
                );
                return $this->theme->scope('task.wechatpay', $view)->render();
            } else if ($data['pay_type'] == 3) {
                dd('银联支付！');
            }
        } else if (isset($data['account']) && $data['pay_canel'] == 2) {
            dd('银行卡支付！');
        } else
        {
            return redirect()->back()->with(['error' => '请选择一种支付方式']);
        }

    }

//    专栏
    public function column($id){
        $this->initTheme('accepttask');
        $this->theme->setTitle('专栏');
//        $task = TaskModel::where('status','>','2')
        $view =[

        ];

        switch($id){
            case '1':
//                $task = TaskModel::where('')
                return $this->theme->scope('task.column', $view)->render();
                break;
            case '2':
                return $this->theme->scope('task.column2', $view)->render();
                break;
            case '3':
                return $this->theme->scope('task.column3', $view)->render();
                break;
            default:
                return $this->theme->scope('task.column', $view)->render();
                break;
        }
    }

//    经纪人发布项目
    public function brokerSuccess($tid){
        $this->initTheme('accepttask');
        $this->theme->setTitle('经纪人');
        $uid = Auth::user()['id'];
        $broker = BrokerModel::findBroker($uid);
        $brokerTask = BrokerTaskModel::findBrokerTask($broker,$tid);
//        dd($brokerTask->link);
        $view =[
            'link' => $brokerTask->link,
            'id' => $brokerTask->bid,
        ];
        return $this->theme->scope('task.brokersuccess', $view)->render();
    }
}
