<?php
namespace App\Modules\Task\Http\Controllers;

use App\Http\Controllers\IndexController;
use App\Http\Requests;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Task\Model\SuccessCaseModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\TagsModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use App\Modules\Task\Model\BrainpowerUserLogoModel;
use Illuminate\Http\Request;
use App\Modules\Advertisement\Model\AdTargetModel;
use App\Modules\Advertisement\Model\AdModel;
use App\Modules\Advertisement\Model\RePositionModel;
use App\Modules\Advertisement\Model\RecommendModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\BrainpowerOrderModel;

use Omnipay;
use Log;

class SuccessCaseController extends IndexController
{
    public function __construct()
    {
        parent::__construct();
        $this->initTheme('main');
    }

    public function index(Request $request)
    {

        $data = $request->all();
        $this->theme->setTitle('成功案例');

		$NavName= \CommonClass::getNavName('/task/successCase');
		if(!$NavName){
			$NavName="成功案例";
		}

        if(isset($data['category']))
        {
            $category = TaskCateModel::findByPid([$data['category']]);
            $pid = $data['category'];
            if(empty($category))
            {
                $category_data = TaskCateModel::findById($data['category']);
                $category = TaskCateModel::findByPid([$category_data['pid']]);
                $pid = $category_data['pid'];
            }
        }else {

            $category = TaskCateModel::findByPid([0]);
            $pid = 0;
        }

        $query = SuccessCaseModel::select('success_case.*','tc.name as cate_name','ud.avatar as user_avatar','us.name as nickname');


        if(isset($data['category']) && $data['category']>0)
        {

            $category_ids = TaskCateModel::findCateIds($data['category']);
            $query->whereIn('success_case.cate_id',$category_ids);
        }
        if(isset($data['searche']))
        {

            $query->where('success_case.title','like','%'.e($data['searche']).'%');
        }

        if(isset($data['desc']))
        {
            $query->orderBy($data['desc'],'desc');
        }
        $paginate = ($this->themeName = 'black') ? 14 :12;
        $list =$query->join('cate as tc','success_case.cate_id','=','tc.id')
            ->leftjoin('users as us','us.id','=','success_case.uid')
            ->leftjoin('user_detail as ud','ud.uid','=','success_case.uid')
            ->paginate($paginate);
        $status = [
                0=>'暂不发布',
                1=>'已经发布',
                2=>'赏金托管',
                3=>'审核通过',
                4=>'威客交稿',
                5=>'雇主选稿',
                6=>'任务公示',
                7=>'交付验收',
                8=>'双方互评'
        ];

        $domain = \CommonClass::getDomain();

        $ad = AdTargetModel::getAdInfo('CASELIST_BOTTOM');
        $view = [
            'list'=>$list,
            'merge'=>$data,
            'category'=>$category,
            'pid'=>$pid,
            'domain'=>$domain,
            'ad'=>$ad,
			'NavName' =>$NavName,
        ];
        $this->theme->set('now_menu','/task/successCase');
        return $this->theme->scope('task.success', $view)->render();
    }


    public function detail($id)
    {
        $this->theme->setTitle('成功案例详情');
        $success_case = SuccessCaseModel::select('success_case.*','tc.name')
            ->where('success_case.id',$id)
            ->leftJoin('cate as tc','tc.id','=','success_case.cate_id')
            ->first();
        $view = [
            'success_case'=>$success_case,
        ];

        if($success_case['type']==1)
        {
            $user_data = UserModel::where('id',$success_case['uid'])->first();
            $user_detail = UserDetailModel::where('uid',$success_case['uid'])->first();
            $view = array_add($view,'user_data',$user_data);
            $view = array_add($view,'user_detail',$user_detail);
            $view = array_add($view,'domain',\CommonClass::getDomain());

            $tags = TagsModel::getUserTags($user_data['id']);
            $view['tags'] = $tags;
        }

        $ad = AdTargetModel::getAdInfo('CASEINFO_BOTTOM');


        $rightAd = AdTargetModel::getAdInfo('CASEINFO_RIGHT_TOP');


        $reTarget = RePositionModel::where('code','CASEINFO_SIDE')->where('is_open','1')->select('id','name')->first();
        if($reTarget->id){
            $recommend = RecommendModel::getRecommendInfo($reTarget->id)->select('*')->get();
            if(count($recommend)){
                foreach($recommend as $k=>$v){
                    $successCaseInfo = SuccessCaseModel::leftJoin('cate','cate.id','=','success_case.cate_id')
                        ->where('success_case.id',$v['recommend_id'])->select('success_case.view_count','cate.name')->first();
                    if($successCaseInfo){
                        $v['view_count'] = $successCaseInfo->view_count;
                        $v['cate_name'] = $successCaseInfo->name;
                    }
                    else{
                        $v['view_count'] = 0;
                        $v['cate_name'] = '';
                    }

                    $recommend[$k] = $v;
                }
                $hotList = $recommend;
            }
            else{
                $hotList = [];
            }
        }


        $view['ad'] = $ad;
        $view['rightAd'] = $rightAd;
        $view['hotList'] = $hotList;
        $view['targetName'] = $reTarget->name;
        return $this->theme->scope('task.successdetail', $view)->render();
    }


    public function  jump($id)
    {
        $successCase = SuccessCaseModel::where('id',$id)->first();

        if(!$successCase)
            return redirect()->back()->with(['参数错误！']);


        SuccessCaseModel::where('id',$id)->increment('view_count',1);

        if(Auth::check() && Auth::user()->id == $successCase['uid'])
        {

            $shop = ShopModel::where('uid',Auth::id())->first();
            if($shop){
                return redirect()->to('/shop/successDetail/'.$id);
            }else{
                return redirect()->to('/user/personevaluationdetail/'.$id);
            }
        }elseif( !empty($successCase['url']))
        {
            return redirect()->to($successCase['url']);
        }else{
            return redirect()->to('/task/successDetail/'.$id);
        }

    }


//智能工具

//    public function brainpower(){
//        $this->theme->setTitle('智能工具');
//        $view = [
//        ];
//        return $this->theme->scope('task.brainpower', $view)->render();
//    }

//    智能工具问卷
    public function questionnaire(){
        $this->theme->setTitle('智能工具');
        $industry = DB::table('brainpower_classify')
            ->select('name','pic','pic_hover','value_id')
            ->where('attribute',1)
            ->orderBy('sort', 'asc')
            ->get();
        $logo1 = DB::table('brainpower_classify')
            ->select('name','pic','pic_hover','value_id')
            ->where('attribute',3)
            ->orderBy('sort', 'asc')
            ->get();
//        dd($logo1);die;
        $view = [
            'industry' => $industry,
            'logo1' => $logo1,
        ];
        return $this->theme->scope('task.questionnaire', $view)->render();
    }

//    请求post接口
    public function post_curls($url, $post){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
//        curl_exec($curl);
//        curl_close($curl);
        $res = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话
        return $res; // 返回数据，json格式

    }

//    智能工具结果
    public function result(Request $request){
        $data = $request->all();
        if ($data==null){
            return redirect()->to('task/brainpower/questionnaire');
        }
        $this->theme->setTitle('智能工具');
        if (empty($data['color'])) {
            $data['color'] = [
                0 => 1,
                1 => 2,
                2 => 3,
                3 => 4,
                4 => 5,
                5 => 6,
                6 => 7,
                7 => 8,
            ];
        }
        if (empty($data['tiele'])) {
            $data['tiele'] ="";
        }

        $view = [
            'data' => $data,
        ];
        return $this->theme->scope('task.result', $view)->render();
    }

//    自动加载svg
    public function processingajaxshow(Request $request){
        $data = $request->all();
        $logo_template = DB::table('logo_icon')
            ->select('icon_data','id')
            ->Where('classify_ind_id', 'like', '%,'.$data['industry'].',%');
        $logo = array_unique(json_decode($data['logo']));
        $logo_template->where(function ($query) use($logo) {
            foreach ($logo as $l){
                $query->orWhere('classify_logo_id', 'like', '%,'.$l.',%');
            }
        });
        $color = json_decode($data['color']);
        $logo_template->where(function ($query) use($color){
            foreach ($color as $c){
                $query->orWhere('classify_color_id', 'like', '%,'.$c.',%');
            }
        });
        $datanew = $logo_template->get();
        $result = collect($datanew)->toArray();
        $classifynew = array_rand($result,3);
        $classifynews = [
            $result[$classifynew[0]],
            $result[$classifynew[1]],
            $result[$classifynew[2]],
        ];
        $logo_data = DB::table('logo_template')
            ->select('logo_data','id');
        $logo_data = $logo_data->get();
        $data_result = collect($logo_data)->toArray();
        $data_arry =  array_rand($data_result,3);
        $data_arry = [
            $data_result[$data_arry[0]],
            $data_result[$data_arry[1]],
            $data_result[$data_arry[2]],
        ];
        foreach ($data_arry as $d){
            $darry[] =json_decode($d->logo_data);
        };
        $darry[0]->icon->iconSource = $classifynews[0]->icon_data;
        $darry[1]->icon->iconSource = $classifynews[1]->icon_data;
        $darry[2]->icon->iconSource = $classifynews[2]->icon_data;
        $darry=[
            0 =>[
                'logo_data' => json_encode($darry[0]),
                'id' => $classifynews[0]->id
            ],
            1 =>[
                'logo_data' => json_encode($darry[1]),
                'id' => $classifynews[1]->id
            ],
            2 =>[
                'logo_data' => json_encode($darry[2]),
                'id' => $classifynews[2]->id
            ],
        ];
//        $url [请求的URL地址]
//        $post [请求的参数]
        $iconSource ='';
        $url = "https://www.meishimeitu.com/api/logo/generate";
        foreach ($darry as $c){
            $post = json_encode([
                "logoData" => $c['logo_data'],
                "nameText" => $data['name'],
                "slogonText" => $data['title'],
                "iconSource" => $iconSource
            ]);
            $svg = $this->post_curls($url,$post);
            $svnew[] = json_decode($svg);
            $sv = json_decode($svg);
            if ($sv->code==0){
                $svgnew[] =[
                    "code" => $sv->code,
                    "message" => $sv->message,
                    "data"  => $sv->data,
                    "id" => $c['id']
                ];
            }
        }
        $view = [
            'data' => $data,
            'svg' => $svgnew,
            'sv' => $svnew
        ];
        return response()->json($view);
    }

//    点击出现下一张图片
    public function processingajaxtwo(Request $request){
        $data = $request->all();
        $logo_template = DB::table('logo_icon')
            ->select('icon_data','id')
            ->whereNotIn('id',array_unique($data['logoid']))
            ->Where('classify_ind_id', 'like', '%,'.$data['industry'].',%');
        $logo = array_unique(json_decode($data['logo']));
        $logo_template->where(function ($query) use($logo) {
            foreach ($logo as $l){
                $query->orWhere('classify_logo_id', 'like', '%,'.$l.',%');
            }
        });
        $color = json_decode($data['color']);
        $logo_template->where(function ($query) use($color){
            foreach ($color as $c){
                $query->orWhere('classify_color_id', 'like', '%,'.$c.',%');
            }
        });
        $datanew = $logo_template->get();
        $result = collect($datanew)->toArray();
        $classifynew = array_rand($result,1);
        $classifynews = $result[$classifynew];
        $logo_data = DB::table('logo_template')
            ->select('logo_data','id');
        $logo_data = $logo_data->get();
        $data_result = collect($logo_data)->toArray();
        $data_arry =  array_rand($data_result,1);
        $data_arry = $data_result[$data_arry] ;
        $darry =json_decode($data_arry->logo_data);
        $darry->icon->iconSource = $classifynews->icon_data;
        $darry=[
                'logo_data' => json_encode($darry),
        ];
        $iconSource ='';
        $url = "https://www.meishimeitu.com/api/log/generate";
            $post = json_encode([
                "logoData" => $darry['logo_data'],
                "nameText" => $data['name'],
                "slogonText" => $data['title'],
                "iconSource" => $iconSource
            ]);
            $svg = $this->post_curls($url,$post);
            $svgnew = json_decode($svg);
        $view = [
            'svg' => $svgnew->data,
            'id' => $classifynews->id,
//            'a' => $darry
        ];
        return response()->json($view);
    }

//  svg下载功能
    public function processingajaxdown(Request $request){
        $data = $request->all();
//        $uid = Auth::id();
        $url = "https://www.meishimeitu.com/api/logo/download";
        $post = json_encode([
            "width" => 800,
            "height" => 600,
            "format" => "png",
            "svg" => $data['svg']
        ]);
        $svg = $this->post_curls($url,$post);
        $svgnew = json_decode($svg);
        $view = [
            'url' => $svgnew->data
        ];
        return response()->json($view);
    }

    public function processsave(Request $request) {
        $req = $request->all();
        $uid = Auth::id();

        $data = [
            'uid'=> $uid,
            'name'=> $req['name'],
            'slogan'=> $req['slogan'],
            'industry'=> $req['industry'],
            'logo'=> $req['logo'],
            'color'=> $req['color'],
            'svg'=> $req['svg'],
            'status'=> 0
        ];
        
        $result = BrainpowerUserLogoModel::create($data);
        return response()->json([
            'id'=> $result['id']
        ]); 
    }
//购买套餐
    public function purchaseLogo(Request $request) {
        $req = $request->all();
        $uid = Auth::id();

        $type = $req['type'] || '1';

        switch ($type) {
            case '1':
//                $cash = 0.01;
                $cash = 1.00;
                break;
            case '2':
                $cash = 149;
                break;
            case '3':
                $cash = 399;
                break;
        }

        $bought = BrainpowerOrderModel::where('logo_id', $req['id'])->where('status', 1)->first();
//        $result = BrainpowerUserLogoModel::update(['votes' => 1]);
        if($bought) {
            die('已购买过');
        }

        $data = [
            'logo_id'=> $req['id'],
            'type'=> $type,
            'cash'=> $cash
        ];

        $order = BrainpowerOrderModel::createOne($data, $uid);
         
//        if(!$order->type == 1){
        if($order){
            $config = ConfigModel::getPayConfig('alipay');
            $objOminipay = Omnipay::gateway('alipay');
            $objOminipay->setPartner($config['partner']);
            $objOminipay->setKey($config['key']);
            $objOminipay->setSellerEmail($config['sellerEmail']);
            $objOminipay->setReturnUrl(env('ALIPAY_RETURN_URL', url('/order/pay/alipay/return')));
            $objOminipay->setNotifyUrl(env('ALIPAY_NOTIFY_URL', url('/order/pay/alipay/notify')));
            $response = Omnipay::purchase([
                'out_trade_no' => $order->code, 
                'subject' => '['. \CommonClass::getConfig('site_name') . ']购买简单套餐', 
                'total_fee' => $cash, 
            ])->send();
            $response->redirect();
        }
//        else{
//            $ordernew = BrainpowerOrderModel::where('code',$order->code)->update(['status' => 1]);
//            if ($ordernew){
//                return redirect()->to('user/DownloadBrainpower');
//            }
//        }
    }

    public function checkPay(Request $request) {
        $req = $request->all();
        $uid = Auth::id();

        $orderInfo = BrainpowerOrderModel::where('uid', $uid)->where('logo_id', $req['logo_id'])->where('status', 1)->first();
        
        $paid =  0;

        if($orderInfo){
            $paid = 1;
        }

        return response()->json([
            'status'=> $paid,
            'id'=> $req['logo_id']
        ]); 
    }
}
