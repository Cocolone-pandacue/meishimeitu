<?php
namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\UserCenterController;
use App\Modules\Employ\Models\UnionAttachmentModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsModel;
use App\Modules\Shop\Models\ShopModel;
use App\Modules\Task\Model\ServiceModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Http\Requests\PubGoodsRequest;
use App\Modules\User\Model\AttachmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Crypt;

class GoodsController extends UserCenterController
{

    public function __construct()
    {
        parent::__construct();
        $this->initTheme('accepttask');
    }

    
    public function getPubGoods()
    {
        $uid = Auth::id();
//        $shopId = ShopModel::getShopIdByUid($uid);
//        $isOpenShop = ShopModel::isOpenShop($uid);
        $arrCate = TaskCateModel::select('id', 'name')->where('pid', 0)->get();
        $tags_production = DB::table('tags_production')->orderBy('sort', 'asc')->get();

//        $isOpenArr = ServiceModel::where('identify','ZUOPINTUIJIAN')->first();
//        if(!empty($isOpenArr) && $isOpenArr->status == 1){
//            $isOpen = 1;
//            $price = $isOpenArr->price;
//        }else{
//            $isOpen = 2;
//            $price = 0.00;
//        }

//        $unitAbout = ConfigModel::getConfigByAlias('recommend_goods_unit');
//        if(!empty($unitAbout)){
//            $recommendUnit = $unitAbout->rule;
//        }else{
//            $recommendUnit = '';
//        }
        
//        $tradeRateArr = ConfigModel::getConfigByAlias('trade_rate');
//        if(!empty($tradeRateArr)){
//            $tradeRate = $tradeRateArr->rule;
//        }else{
//            $tradeRate = 0;
//        }
        
//        $minPriceArr = ConfigModel::getConfigByAlias('min_price');
//        if(!empty($minPriceArr)){
//            $minPrice = $minPriceArr->rule;
//        }else{
//            $minPrice = 0;
//        }
        $data = [
//            'is_open_shop' => $isOpenShop,
//            'shop_id' => $shopId,
            'arr_cate' => $arrCate,
            'tags_production' => $tags_production,
//            'is_open' => $isOpen,
//            'price' => $price,
//            'recommend_unit' =>$recommendUnit,
//            'trade_rate' => $tradeRate,
//            'min_price' => $minPrice
        ];
//        dd($data);die;
        $this->initTheme('userinfo');
        $this->theme->setTitle('发布作品');
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.usershopfb', $data)->render();
    }

    
    public function postPubGoods(PubGoodsRequest $request)
    {
        $data = $request->except('_token');
        $data['cate_id'] = $data['second_cate'];

        $minPriceArr = ConfigModel::getConfigByAlias('min_price');
        if(!empty($minPriceArr)){
            $minPrice = $minPriceArr->rule;
        }else{
            $minPrice = 0;
        }
        if($minPrice > 0 && $data['cash'] < $minPrice){
            $error['cash'] = '作品金额设定错误';
            if (!empty($error)) {
                return redirect('/user/pubGoods')->withErrors($error);
            }
        }
        isset($data['is_recommend']) ? $is_service = true : $is_service = false;
        
        if (!empty($data['cover'])){
            $cover = $request->file('cover');
            $result = \FileClass::uploadFile($cover,'sys');
            if ($result){
                $result = json_decode($result, true);
                $data['cover'] = $result['data']['url'];
            }
        }else{
            $error['cover'] = '请上传作品封面';
            return redirect('/user/pubGoods')->withErrors($error);
        }
        
        $config = ConfigModel::getConfigByAlias('goods_check');
        if(!empty($config) && $config->rule == 1){
            $goodsCheck = 0;
        }else{
            $goodsCheck = 1;
        }
        $data['status'] = $goodsCheck;
        $data['is_recommend'] = 0;
        $data['uid'] = Auth::id();
        $data['shop_id'] = ShopModel::where('uid', Auth::id())->first()->id;
        $goods = GoodsModel::create($data);
        
        if (!empty($data['file_id'])){
            $arrAttachment = array();
            foreach ($data['file_id'] as $v){
                $arrAttachment[] = [
                    'object_id' => $goods->id,
                    'object_type' => 4,
                    'attachment_id' => $v,
                    'created_at' => date('Y-m-d H:i:s', time())
                ];
            }
            UnionAttachmentModel::insert($arrAttachment);
        }

        
        if ($is_service){
            return redirect('finance/getpay/' . $goods->id);
        }


        if ($goods && $goodsCheck == 0){
            return redirect('user/waitGoodsHandle/'.$goods->id);
        }else{
            return redirect('user/goodsShop');
        }
    }


//新作品上传
    public function postNewPubGoods(Request $request){
        $data = $request->except('_token');

//        判断second_cate是否存在，是来自新增还是修改
        if (!empty($data['first_cate'])){
            $data['cate_id'] = $data['first_cate'];
            $data = array_except($data, ['first_cate']);
        }
//        dd(json_decode($data['cover'][0]) -> url);die;
//        上传作品
        if (empty($data['file1'])){
            $data['file1'] = array();
        }
//        dd($data);
        if (!empty($data['file']) ){
            foreach ($data['file'] as $file){
//                $cover = $request->file('file');
//                if($file != null){
//                    $cover = $file;
//                    $result = \FileClass::uploadFile($cover,'sys');
//                    if ($result){
//                        $result = json_decode($result, true);
//                        $datafile[] = $result['data']['url'];
//                    }
//                }
                $datafile[] = json_decode($file) -> url;
            }
        }else{
//            $data = array_except($data, ['file']);
            $datafile[] = array();
        }
        $data['file'] = json_encode(array_merge($data['file1'],$datafile));

//        上传作品封面
        if (!empty($data['cover'][0])){
//            $cover = $request->file('cover');
//            $result = \FileClass::uploadFile($cover,'sys');
//            if ($result){
//                $result = json_decode($result, true);
//                $data['cover'] = $result['data']['url'];
//            }
            $data['cover'] = json_decode($data['cover'][0]) -> url;
        }
        $config = ConfigModel::getConfigByAlias('goods_check');   //判断是否审核
        if(!empty($config) && $config->rule == 1){
            $goodsCheck = 0;
        }else{
            $goodsCheck = 1;
        }
//        标签
        if(!empty($data['tags'])){
            $data['tags'] = json_encode($data['tags']);
        }
        $data['status'] = $goodsCheck;
        $data['is_recommend'] = 0;
        $data['uid'] = Auth::id();
        if($data['nature']==2){
            $shop_id = ShopModel::where('uid', Auth::id())->first();
            if(!$shop_id == ""){
                $data['shop_id'] = $shop_id->id;
            }
        }
        $data = array_except($data, ['file1']);
//        dd($data);die;
        if (!isset($data['id'])){
            $goods = GoodsModel::create($data);
            if ($goods){
                return redirect()->to('user/goodsShop')->with('error','上传成功！');
            }else{
                return redirect()->to('user/goodsShop')->with('error','上传失败！');
            }
        }else{
            $goodup = GoodsModel::where('id',$data['id'])->update($data);
            if ($goodup){
                return redirect()->to('user/goodsShop')->with('error','修改成功！');
            }else{
                return redirect()->to('user/goodsShop')->with('error','修改失败！');
            }
        }

        return redirect('user/goodsShop');
    }


//    我的作品编辑
    public function goodsShopedit($godsId){
        $this->initTheme('userinfo');
        $this->theme->setTitle('修改作品');
        $this->theme->set('TYPE',3);
        $uid = Auth::id();
        $arrCate = TaskCateModel::select('id', 'name')->where('pid', 0)->get();
        $tags_production = DB::table('tags_production')->orderBy('sort', 'asc')->get();
//        $arrCate = TaskCateModel::select('id', 'name')->where('pid', 0)->get();
        $shopGoods =  DB::table('goods')
            ->where('id',$godsId)
            ->where('uid',$uid)
//            ->join('tags_production', 'tags_production.id', '=', 'goods.tags')
            ->first();
//        $cateidtwo = $shopGoods->cate_id;
//        $cateidtone = DB::table('cate')->where('id',$cateidtwo)->select('pid','name')->first();
//        dd($cateidtwo);die;
        $tags = json_decode($shopGoods->tags);
        foreach ($tags as $t){
            $tagsval[] = DB::table('tags_production')->where('id',$t)->first();
        }
//        dd($tagsval);die;
        $data = [
            'shopGoods' => $shopGoods,
//            'arr_cate' => $arrCate,
//            'cateidtwo' => $cateidtwo,
//            'cateidtone' => $cateidtone,
            'arr_cate' => $arrCate,
            'tags_production' => $tags_production,
            'tagsval' => $tagsval,
        ];
        return $this->theme->scope('user.usershopedit', $data)->render();
    }


    public function waitGoodsHandle($godsId)
    {
        
        $goodsInfo = GoodsModel::where('id',$godsId)->where('type',1)->where('is_delete',0)->first();
        
        $orderInfo = ShopOrderModel::where('object_id',$godsId)->where('object_type',3)->first();
        
        if(!empty($goodsInfo) && $goodsInfo->status == 1){
            return redirect('user/goodsShop');
        }
        $qq = \CommonClass::getConfig('qq');
        $data = array(
            'id' => $godsId,
            'goods_info' => $goodsInfo,
            'order_info' => $orderInfo,
            'qq' => $qq
        );
        $this->theme->setTitle('作品审核');
        $this->theme->set('TYPE',3);
        return $this->theme->scope('finance.shopsuccess',$data)->render();
    }



//我的作品
    public function shopGoods(Request $request){
        $uid = Auth::id();
        $isOpenShop = ShopModel::isOpenShop($uid);
        $shopId = ShopModel::getShopIdByUid($uid);
        $merge = $request->all();
        $paginate = $request->get('paginate') ? $request->get('paginate') : 9;

//        $shopGoods = GoodsModel::getGoodsListByUid($uid,$merge);
        $shopGoods =  GoodsModel::select('goods.*', 'users.name as usersname','cate.name as catename','cate.pid as catepid','user_detail.avatar')
            ->where('goods.uid',$uid)
            ->where('goods.is_delete',0)
            ->join('users', 'goods.uid', '=', 'users.id')
            ->leftjoin('cate', 'goods.cate_id', '=', 'cate.id')
            ->join('user_detail', 'goods.uid', '=', 'user_detail.uid')
            ->orderBy('created_at', 'desc');
        $shopGoodsnum =  DB::table('goods')
            ->where('uid',$uid)
            ->where('is_delete',0);
//        审核状态
        if (isset($merge['status']) ){
            switch($merge['status']){
                case '0':
                    $shopGoods = $shopGoods->where('goods.status',0);
                    $shopGoodsnum = $shopGoodsnum->where('goods.status',0);
                    break;
                case '1':
                    $shopGoods = $shopGoods->where('goods.status',1);
                    $shopGoodsnum = $shopGoodsnum->where('goods.status',1);
                    break;
                case '3':
                    $shopGoods = $shopGoods->where('goods.status',3);
                    $shopGoodsnum = $shopGoodsnum->where('goods.status',3);
                    break;
                default:

                    break;
            }
        }
//        所有一级行业
        $cateall = DB::table('cate')
            ->where('pid',0)
            ->get();
//        行业选择
        if (isset($merge['cate']) ){
//            foreach($cateall as $call){
//                $cateallArr[]=$call->id;
//            }
//            if (in_array($merge['cate'],$cateallArr)){
//                $cate = DB::table('cate')
//                    ->where('pid',$merge['cate'])
//                    ->get();
//                foreach($cate as $c){
//                    $cateArr[]=$c->id;
//                }
                $shopGoods = $shopGoods->where('cate_id',$merge['cate']);
                $shopGoodsnum = $shopGoodsnum->where('cate_id',$merge['cate']);
//            }
        }
//        作品数量
        $shopGoodsnum = $shopGoodsnum->count();
        $shopGoods  = $shopGoods->paginate($paginate);
        $shopGoods_data = $shopGoods->toArray();
//        计算时间
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
//        dd($shopGoods_data['data']);die;
        $data = array(
            'goods_list_data' => $shopGoods_data,
            'goods_list' => $shopGoods,
            'merge' => $merge,
            'is_open_shop' => $isOpenShop,
            'shop_id' => $shopId,
            'cateall' => $cateall,
            'shopGoodsnum' => $shopGoodsnum,
        );
        $this->initTheme('userinfo');
        $this->theme->setTitle('我发布的作品');
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.usershopspgl',$data)->render();
    }
//软性删除
    public function goodsShopdel($godsId){

        DB::table('goods')->where('id',$godsId)->update(['is_delete' => 1]);
        return redirect('user/goodsShop');
    }


//    废弃原我的作品
    public function shopGoodsold(Request $request)
    {
        $uid = Auth::id();
        
        $isOpenShop = ShopModel::isOpenShop($uid);
        
        $shopId = ShopModel::getShopIdByUid($uid);
        $merge = $request->all();
        $uid = Auth::id();
        $shopGoods = GoodsModel::getGoodsListByUid($uid,$merge);
        $goodsStatistics = GoodsModel::goodsStatistics($uid);
        $data = array(
            'goods_list' => $shopGoods,
            'merge' => $merge,
            'goods_statistics' => $goodsStatistics,
            'is_open_shop' => $isOpenShop,
            'shop_id' => $shopId
        );
        $this->initTheme('userinfo');
        $this->theme->setTitle('我发布的作品');
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.usershopspgl',$data)->render();
    }


    
    public function editGoods($id)
    {
        $id = intval($id);
        $uid = Auth::id();
        
        $status = GoodsModel::getGoodsStatus($id);
        
        if($status == 3){
            $type = 1;
        }else{
            $type = 2;
        }
        
        $goodsInfo = GoodsModel::getGoodsInfoById($id);
        
        $cateFirst = TaskCateModel::findByPid([0],['id','name']);
        if(!empty($goodsInfo->cate_pid)){
            
            $cateSecond = TaskCateModel::findByPid([$goodsInfo->cate_pid],['id','name']);
        }else{
            $cateSecond = TaskCateModel::findByPid([$cateFirst[0]['id']],['id','name']);
        }
        
        $attachment = UnionAttachmentModel::where('object_id', $id)->where('object_type',4)
            ->lists('attachment_id')->toArray();
        $attachmentIds = array_flatten($attachment);
        $attachmentData = AttachmentModel::whereIn('id', $attachmentIds)->get();
        $domain = \CommonClass::getDomain();
        
        $isService = ShopOrderModel::isBuy($uid,$goodsInfo->id,3);
        
        $isOpenArr = ServiceModel::where('identify','ZUOPINTUIJIAN')->first();
        if(!empty($isOpenArr) && $isOpenArr->status == 1){
            $isOpen = 1;
            $price = $isOpenArr->price;
        }else{
            $isOpen = 2;
            $price = 0.00;
        }

        
        $unitAbout = ConfigModel::getConfigByAlias('recommend_goods_unit');
        if(!empty($unitAbout)){
            $recommendUnit = $unitAbout->rule;
        }else{
            $recommendUnit = '';
        }
        
        $minPriceArr = ConfigModel::getConfigByAlias('min_price');
        if(!empty($minPriceArr)){
            $minPrice = $minPriceArr->rule;
        }else{
            $minPrice = 0;
        }

        $data = array(
            'type' => $type,
            'goods_info' => $goodsInfo,
            'cate_first' => $cateFirst,
            'cate_second' => $cateSecond,
            'attachment_data' => $attachmentData,
            'domain' => $domain,
            'is_service' => $isService,
            'is_open' => $isOpen,
            'price' => $price,
            'recommend_unit' => $recommendUnit,
            'min_price' => $minPrice
        );
        $this->theme->setTitle('编辑作品');
        $this->theme->set('TYPE',3);
        return $this->theme->scope('user.editgoods', $data)->render();
    }

    
    public function postEditGoods(PubGoodsRequest $request)
    {
        $uid = Auth::id();
        
        $config = ConfigModel::getConfigByAlias('goods_check');
        if(!empty($config) && $config->rule == 1){
            $goodsCheck = 0;
        }else{
            $goodsCheck = 1;
        }
        $data = $request->except('_token');
        
        $minPriceArr = ConfigModel::getConfigByAlias('min_price');
        if(!empty($minPriceArr)){
            $minPrice = $minPriceArr->rule;
        }else{
            $minPrice = 0;
        }
        if($minPrice > 0 && $data['cash'] < $minPrice){
            $error['cash'] = '作品金额设定错误';
            if (!empty($error)) {
                return redirect('/user/editGoods/'.$data['id'])->withErrors($error);
            }
        }
        $data['cate_id'] = $data['second_cate'];
        $goodsInfo = GoodsModel::where('id',$data['id'])->first();
        if (isset($data['is_recommend'])){
            $is_service = true;
        } else {
            $is_service = false;
        }
        
        if (!empty($data['cover'])){
            $cover = $request->file('cover');
            $result = \FileClass::uploadFile($cover,'sys');
            if ($result){
                $result = json_decode($result, true);
                $data['cover'] = $result['data']['url'];
            }
        }else{
            $data['cover'] = $goodsInfo->cover;
        }
        
        if($request->get('status') == 3){

            $goodsArr = array(
                'uid' => $uid,
                'shop_id' => $goodsInfo->shop_id,
                'cate_id' => $data['cate_id'],
                'title' => $data['title'],
                'desc' => $data['desc'],
                'unit' => $data['unit'],
                'type' => 1,
                'cash' => $data['cash'],
                'cover' => $data['cover'],
                'status' => $goodsCheck,
                'is_recommend' => 0,
            );
            $goods = GoodsModel::create($goodsArr);
            
            if (!empty($data['file_id'])){
                $arrAttachment = [];
                foreach ($data['file_id'] as $v){
                    $arrAttachment[] = [
                        'object_id' => $goods->id,
                        'object_type' => 4,
                        'attachment_id' => $v,
                        'created_at' => date('Y-m-d H:i:s', time())
                    ];
                }
                UnionAttachmentModel::insert($arrAttachment);
            }
            
            if ($is_service){
                return redirect('finance/getpay/' . $goods->id);
            }
            if ($goods && $goodsCheck == 0){
                return redirect('user/waitGoodsHandle/'.$goods->id);
            }else{
                return redirect('user/goodsShop');
            }
        }else{
            
            $goodsArr = array(
                'cate_id' => $data['cate_id'],
                'title' => $data['title'],
                'desc' => $data['desc'],
                'unit' => $data['unit'],
                'cash' => $data['cash'],
                'cover' => $data['cover'],
            );
            $goods = GoodsModel::where('id',$data['id'])->update($goodsArr);

            if (!empty($data['file_id'])) {

                
                $fileAbleIds = AttachmentModel::fileAble($data['file_id']);
                $fileAbleIds = array_flatten($fileAbleIds);
                
                UnionAttachmentModel::where('object_id',$data['id'])->where('object_type',4)->delete();
                foreach ($fileAbleIds as $v) {
                    $attachmentData = [
                        'object_id' => $data['id'],
                        'object_type' => 4,
                        'attachment_id' => $v,
                        'created_at' => date('Y-m-d H:i:s', time())
                    ];
                    UnionAttachmentModel::create($attachmentData);
                }
                
                $attachmentModel = new AttachmentModel();
                $attachmentModel->statusChange($fileAbleIds);
            }

            
            if ($is_service){
                return redirect('finance/getpay/' . $data['id']);
            }

            if ($goods)
                return redirect('user/goodsShop');

        }

    }

    
    public function myBuyGoods(Request $request)
    {
        $uid = Auth::id();
        $merge = $request->all();
        $myGoods = ShopOrderModel::myBuyGoods($uid,2,$merge);
        
        $legalRightsArr = ConfigModel::getConfigByAlias('legal_rights');
        if(!empty($legalRightsArr)){
            $legalRights = floatval($legalRightsArr->rule);
        }else{
            $legalRights = 0;
        }

        $data = array(
            'goods_list' => $myGoods,
            'merge' => $merge,
            'legal_rights' => $legalRights
        );
        $this->theme->set('TYPE',2);
        $this->initTheme('usertask');
        $this->theme->setTitle('我购买的作品');
        return $this->theme->scope('user.usershoppaysp',$data)->render();

    }

    
    public function changeGoodsStatus(Request $request)
    {
        $type = $request->get('type');
        $id = $request->get('id');
        $res = GoodsModel::changeGoodsStatus($id,$type);
        if($res){
            $data = array(
                'code' => 1,
                'msg' => 'success'
            );
        }else{
            $data = array(
                'code' => 0,
                'msg' => 'failure'
            );
        }
        return response()->json($data);
    }

    
    public function goodsCashValid(Request $request)
    {
        $data = $request->except('_token');
        
        $minPriceArr = \CommonClass::getConfig('min_price');

        if(!preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$data['param'])){
            $data['info'] = '请输入正确的作品价格,数字最多两位小数' ;
            $data['status'] = 'n';
            return json_encode($data);
        }
        
        if ($minPriceArr > $data['param']) {
            $data['info'] = '作品价格应该大于' . $minPriceArr ;
            $data['status'] = 'n';
            return json_encode($data);
        }

        $data['status'] = 'y';

        return json_encode($data);
    }


    
    public function mySellGoods(Request $request)
    {
        $uid = Auth::id();
        $merge = $request->all();
        $myGoods = ShopOrderModel::sellGoodsList($uid,2,$merge);
        $data = array(
            'goods_list' => $myGoods,
            'merge' => $merge,
        );
        $this->theme->set('TYPE',3);
        $this->theme->setTitle('我卖出的作品');
        return $this->theme->scope('user.usershopselsp',$data)->render();

    }




}