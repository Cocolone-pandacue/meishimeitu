<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ManageController;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\User\Model\AlipayAuthModel;
use App\Modules\User\Model\AuthRecordModel;
use App\Modules\User\Model\BankAuthModel;
use App\Modules\User\Model\EnterpriseAuthModel;
use App\Modules\User\Model\RealnameAuthModel;
use App\Modules\User\Model\StylistAuthModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends ManageController
{
    public function __construct()
    {
        parent::__construct();

        $this->initTheme('manage');
        $this->theme->setTitle('认证管理');
        $this->theme->set('manageType', 'auth');
    }


    
    public function realnameAuth($id)
    {
        $id = intval($id);
        $realnameInfo = RealnameAuthModel::where('id', $id)->first();
        if (!empty($realnameInfo)) {
            $data = array(
                'realname' => $realnameInfo
            );
            return $this->theme->scope('manage.realnameauthinfo', $data)->render();
        }
    }
//设计师查看
    public function stylistAuth($id){
        $id = intval($id);
        $stylistInfo = StylistAuthModel::where('id', $id)->first();
        if (!empty($stylistInfo)) {
//            $attachment_id = DB::table('auth_production')->where('stylist_id', $id)->lists('attachment_id');
            $stylist_case = DB::table('stylist_case')->where('stylist_id', $id)->get();
            for($i = 0;$i<count($stylist_case);$i++){
//                $attachmentnew=DB::table('attachment')->where('id', $attachment_id[$i])->first();
                $stylist_production=DB::table('stylist_production')->where('stylist_case_id', $stylist_case[$i]->id)->get();
                $stylist_casenew[] = [
                    $stylist_case[$i],
                    $stylist_production,
                ];
            }
//            dd($stylist_casenew);die;
//            dd($stylist_casenew);die;
            $case_type =[
                0=>'自由设计师',
                1=>'工作室',
                2=>'公司',
            ];
            $design_type = DB::table('design_type')->get();
            $data = array(
                'stylist' => $stylistInfo,
                'stylist_case' => $stylist_casenew,
                'design_type' => $design_type,
                'case_type' => $case_type,
                'stylist_production' => $stylist_production,
//                'attachment' => $attachment,
            );
            return $this->theme->scope('manage.stylistauthinfo', $data)->render();
        }
    }
    public function stylistDownload($id){
        $pathToFile = AttachmentModel::where('id',$id)->first();
        $pathToFile = $pathToFile['url'];
        return redirect(ossDownloadUrl($pathToFile));
    }

    
    public function realnameAuthList(Request $request)
    {
        $merge = $request->all();
        $realNameList = RealnameAuthModel::whereRaw('1=1');
//        dd($realNameList);die;
        if ($request->get('username')) {
            $realNameList = $realNameList->where('username','like','%' . $request->get('username') . '%');
        }
        
        if ($request->get('real_name')) {
            $realNameList = $realNameList->where('realname','like','%' . $request->get('real_name') . '%');
        }
        
        if ($request->get('status')) {
            switch($request->get('status')){
                case 1:
                    $status = 0;
                    $realNameList = $realNameList->where('status',$status);
                    break;
                case 2:
                    $status = 1;
                    $realNameList = $realNameList->where('status',$status);
                    break;
                case 3:
                    $status = 2;
                    $realNameList = $realNameList->where('status',$status);
                    break;
            }
        }
        
        if($request->get('time_type')){
            $timeType = $request->get('time_type');
            if($request->get('start')){
                $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
                $realNameList = $realNameList->where($timeType,'>',$start);

            }
            if($request->get('end')){
                $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
                $realNameList = $realNameList->where($timeType,'<',$end);
            }

        }

        $by = $request->get('by') ? $request->get('by') : 'id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;

        $realNameList = $realNameList->orderBy($by, $order)->paginate($paginate);


        $data = array(
            'merge' => $merge,
            'realname' => $realNameList,
        );


        $this->breadcrumb->add(array(
            array(
                'label' => '实名认证',
                'url' => '/manage/realnameAuthList'
            ),
            array(
                'label' => '认证列表'
            )
        ));
        $this->theme->set('manageAction', 'realname');
        return $this->theme->scope('manage.realnamelist', $data)->render();
    }


//设计师认证
    public function stylistAuthList(Request $request){
        $merge = $request->all();
        $realNameList = StylistAuthModel::whereRaw('1=1');
        if ($request->get('username')) {
            $realNameList = $realNameList->where('username','like','%' . $request->get('username') . '%');
        }
//        if ($request->get('social')) {
//            $realNameList = $realNameList->where('social','like','%' . $request->get('social') . '%');
//        }
        if ($request->get('status')) {
            switch($request->get('status')){
                case 1:
                    $status = 0;
                    $realNameList = $realNameList->where('status',$status);
                    break;
                case 2:
                    $status = 1;
                    $realNameList = $realNameList->where('status',$status);
                    break;
                case 3:
                    $status = 2;
                    $realNameList = $realNameList->where('status',$status);
                    break;
            }
        }

        if($request->get('time_type')){
            $timeType = $request->get('time_type');
            if($request->get('start')){
                $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
                $realNameList = $realNameList->where($timeType,'>',$start);

            }
            if($request->get('end')){
                $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
                $realNameList = $realNameList->where($timeType,'<',$end);
            }

        }
        $by = $request->get('by') ? $request->get('by') : 'id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;
        $realNameList = $realNameList->orderBy($by, $order)->paginate($paginate);
        $data = array(
            'merge' => $merge,
            'realname' => $realNameList,
        );
        $this->breadcrumb->add(array(
            array(
                'label' => '设计师认证',
                'url' => '/manage/stylistAuthList'
            ),
            array(
                'label' => '认证列表'
            )
        ));
        $this->theme->set('manageAction', 'realname');
        return $this->theme->scope('manage.stylistlist', $data)->render();
    }
//设计师认证成功失败
    public function stylistAuthHandle($id, $action){
        $domain = \CommonClass::getDomain();
        if (!$id) {
            return \CommonClass::showMessage('参数错误');
        }
        $id = intval($id);
        switch ($action) {
            case 'pass':
                $status = 1;
                break;
            case 'deny':
                $status = 2;
                break;
        }
        $Stylist = StylistAuthModel::where('id', $id)->first();
        $user = UserModel::where('id', $Stylist['uid'])->first();
        $site_name = \CommonClass::getConfig('site_name');
        if ($status == 1) {
            $result = StylistAuthModel::where('id', $id)->whereIn('status', [0])->update(array('status' => $status,'auth_time'=>date('Y-m-d H:i:s')));
            if (!$result) {
                return redirect()->back()->with(['error' => '操作失败！']);
            }
            $task_audit_failure = MessageTemplateModel::where('code_name', 'stylist_success')->where('is_open', 1)->first();
            if ($task_audit_failure) {
                $messageVariableArr = [
                    'username' => $user['name'],
                    'website' => $site_name,
                ];
                if($task_audit_failure->is_on_site == 1){
                    \MessageTemplateClass::getMeaasgeByCode('stylist_success',$user['id'],1,$messageVariableArr,$task_audit_failure['name']);
                }
                if($task_audit_failure->is_send_email == 1){
                    $email = $user->email;
                    \MessageTemplateClass::sendEmailByCode('stylist_success',$email,$messageVariableArr,$task_audit_failure['name']);
                }
            }
        }elseif ($status == 2) {
            $result = StylistAuthModel::where('id', $id)->whereIn('status', [0])->update(array('status' => $status,'auth_time'=>date('Y-m-d H:i:s')));
            if (!$result) {
                return redirect()->back()->with(['error' => '操作失败！']);
            }
            $task_audit_failure = MessageTemplateModel::where('code_name', 'Stylist_failure')->where('is_open', 1)->first();
            if ($task_audit_failure) {
                $messageVariableArr = [
                    'username' => $user['name'],
                    'website' => $site_name,
                ];
                if($task_audit_failure->is_on_site == 1){
                    \MessageTemplateClass::getMeaasgeByCode('Stylist_failure',$user['id'],1,$messageVariableArr,$task_audit_failure['name']);
                }
                if($task_audit_failure->is_send_email == 1){
                    $email = $user->email;
                    \MessageTemplateClass::sendEmailByCode('Stylist_failure',$email,$messageVariableArr,$task_audit_failure['name']);
                }
            }
        }
        return redirect()->back()->with(['message' => '操作成功！']);
    }
    
    public function realnameAuthHandle($id, $action)
    {
        $id = intval($id);
        switch ($action) {
            
            case 'pass':
                $status = RealnameAuthModel::realnameAuthPass($id);
                break;
            
            case 'deny':
                $status = RealnameAuthModel::realnameAuthDeny($id);
                break;
        }
        if ($status)
            return redirect('/manage/realnameAuthList')->with(array('message' => '操作成功'));
    }

    
    public function getBankAuth($id)
    {
        $id = intval($id);
        $info = BankAuthModel::where('id', $id)->first();

        if (!empty($info)){
            $data = array(
                'bank' => $info
            );
            return $this->theme->scope('manage.bankauthinfo', $data)->render();
        }
    }


    
    public function bankAuthPay(Request $request)
    {
        $authId = intval($request->get('authId'));
        $pay_to_user_cash = $request->get('pay_to_user_cash');

        $status = BankAuthModel::where('id', $authId)->update(array('pay_to_user_cash' => $pay_to_user_cash, 'status' => 1));
        if ($status)
            return redirect('manage/bankAuthList');
    }



    
    public function alipayAuthList(Request $request)
    {
        $merge = $request->all();
        $aliPayList = AlipayAuthModel::whereRaw('1=1');
        
        if ($request->get('alipayName')) {
            $aliPayList = $aliPayList->where('alipay_name','like','%'.$request->get('alipayName').'%');
        }
        
        if ($request->get('username')) {
            $aliPayList = $aliPayList->where('username','like','%'.$request->get('username').'%');
        }
        
        if ($request->get('alipay_account')) {
            $aliPayList = $aliPayList->where('alipay_account','like','%'.$request->get('alipay_account').'%');
        }
        
        if ($request->get('status')) {
            switch($request->get('status')){
                case 1:
                    $status = 0;
                    $aliPayList = $aliPayList->where('status',$status);
                    break;
                case 2:
                    $status = 1;
                    $aliPayList = $aliPayList->where('status',$status);
                    break;
                case 3:
                    $status = 2;
                    $aliPayList = $aliPayList->where('status',$status);
                    break;
                case 4:
                    $status = 3;
                    $aliPayList = $aliPayList->where('status',$status);
                    break;
            }
        }
        
        if($request->get('time_type')){
            $timeType = $request->get('time_type');
            if($request->get('start')){
                $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
                $aliPayList = $aliPayList->where($timeType,'>',$start);

            }
            if($request->get('end')){
                $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
                $aliPayList = $aliPayList->where($timeType,'<',$end);
            }

        }
        $by = $request->get('by') ? $request->get('by') : 'id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;

        $aliPayList = $aliPayList->orderBy($by, $order)->paginate($paginate);

        $data = array(
            'merge' => $merge,
            'alipay' => $aliPayList,
        );

        $this->breadcrumb->add(array(
            array(
                'label' => '支付宝认证',
                'url' => '/manage/alipayAuthList'
            ),
            array(
                'label' => '认证列表'
            )
        ));
        $this->theme->set('manageAction', 'alipay');
        return $this->theme->scope('manage.alipaylist', $data)->render();
    }


    
    public function alipayAuthHandle($id, $action)
    {
        $id = intval($id);
        switch ($action) {
            
            case 'pass':
                $status = AlipayAuthModel::alipayAuthPass($id);
                break;
            
            case 'deny':
                $status = AlipayAuthModel::alipayAuthDeny($id);
                break;
        }
        if ($status)
            return redirect('/manage/alipayAuthList')->with(array('message' => '操作成功'));
    }


    
    public function getAlipayAuth($id)
    {
        $id = intval($id);
        $info = AlipayAuthModel::where('id', $id)->first();

        if (!empty($info)){
            $data = array(
                'alipay' => $info
            );
            return $this->theme->scope('manage.alipayauthinfo', $data)->render();
        }
    }

    
    public function alipayAuthPay(Request $request)
    {
        $authId = intval($request->get('authId'));
        $pay_to_user_cash = $request->get('pay_to_user_cash');

        $status = AlipayAuthModel::where('id', $authId)->update(array('pay_to_user_cash' => $pay_to_user_cash, 'status' => 1));
        if ($status)
            return redirect('manage/alipayAuthList');
    }

    
    public function bankAuthList(Request $request)
    {
        $merge = $request->all();
        $bankList = BankAuthModel::whereRaw('1 = 1');
        
        if ($request->get('bankAccount')) {
            $bankList = $bankList->where('bank_account','like','%'.$request->get('bankAccount').'%');
        }
        
        if ($request->get('username')) {
            $bankList = $bankList->where('username','like','%'.$request->get('username').'%');
        }
        
        if ($request->get('status')) {
            switch($request->get('status')){
                case 1:
                    $status = 0;
                    $bankList = $bankList->where('status',$status);
                    break;
                case 2:
                    $status = 1;
                    $bankList = $bankList->where('status',$status);
                    break;
                case 3:
                    $status = 2;
                    $bankList = $bankList->where('status',$status);
                    break;
                case 4:
                    $status = 3;
                    $bankList = $bankList->where('status',$status);
                    break;
            }
        }
        
        if($request->get('time_type')){
            $timeType = $request->get('time_type');
            if($request->get('start')){
                $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
                $bankList = $bankList->where($timeType,'>',$start);

            }
            if($request->get('end')){
                $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
                $bankList = $bankList->where($timeType,'<',$end);
            }

        }
        $by = $request->get('by') ? $request->get('by') : 'id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;

        $bankList = $bankList->orderBy($by, $order)->paginate($paginate);

        $data = array(
            'merge' => $merge,
            'bank' => $bankList,
        );

        $this->breadcrumb->add(array(
            array(
                'label' => '银行认证',
                'url' => '/manage/bankAuthList'
            ),
            array(
                'label' => '认证列表'
            )
        ));
        $this->theme->set('manageAction', 'bank');
        return $this->theme->scope('manage.banklist', $data)->render();
    }


    
    public function bankAuthHandle($id, $action)
    {
        $id = intval($id);
        switch ($action) {
            
            case 'pass':
                $status = BankAuthModel::bankAuthPass($id);
                break;
            
            case 'deny':
                $status = BankAuthModel::bankAuthDeny($id);
                break;
        }
        if ($status)
            return redirect('/manage/bankAuthList')->with(array('message' => '操作成功'));
    }

    
    public function bankAuthMultiHandle(Request $request)
    {
        if (!$request->get('ckb')) {
            return \CommonClass::adminShowMessage('参数错误');
        }
        $objAuthRecord = new AuthRecordModel();
        $status = $objAuthRecord->multiHandle($request->get('ckb'), 'bank', 'pass');
        if ($status)
            return back();
    }

    
    public function enterpriseAuthList(Request $request)
    {
        $merge = $request->all();
        $enterpriseList = EnterpriseAuthModel::whereRaw('1 = 1');

        
        if ($request->get('name')) {
            $enterpriseList = $enterpriseList->where('users.name',$request->get('name'));
        }
        
        if ($request->get('company_name')) {
            $enterpriseList = $enterpriseList->where('enterprise_auth.company_name','like','%'.$request->get('company_name').'%');
        }
        
        if ($request->get('status')) {
            switch($request->get('status')){
                case 1:
                    $status = 1;
                    break;
                case 2:
                    $status = 2;
                    break;
                case 3:
                    $status = 0;
                    break;
                default:
                    $status = 0;
            }
            $enterpriseList = $enterpriseList->where('enterprise_auth.status',$status);
        }
        
        if($request->get('time_type')){
            if($request->get('start')){
                $start = date('Y-m-d H:i:s',strtotime($request->get('start')));
                $enterpriseList = $enterpriseList->where($request->get('time_type'),'>',$start);
            }
            if($request->get('end')){
                $end = date('Y-m-d H:i:s',strtotime($request->get('end')));
                $enterpriseList = $enterpriseList->where($request->get('time_type'),'<',$end);
            }

        }
        $by = $request->get('by') ? $request->get('by') : 'enterprise_auth.id';
        $order = $request->get('order') ? $request->get('order') : 'desc';
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;

        $enterpriseList = $enterpriseList->leftJoin('users','users.id','=','enterprise_auth.uid')
            ->select('enterprise_auth.*','users.name')
            ->orderBy($by, $order)->paginate($paginate);
        if($enterpriseList)
        {
            
            $cateId = array();
            foreach($enterpriseList as $k => $v){
                $cateId[] = $v['cate_id'];
            }
            $cate = TaskCateModel::whereIn('id',$cateId)->get();
            foreach($enterpriseList as $k => $v){
                foreach($cate as $key => $value){
                    if($v->cate_id == $value->id){
                        $enterpriseList[$k]['cate_name'] = $value->name;
                    }
                }
            }
        }
        $data = array(
            'merge' => $merge,
            'enterprise' => $enterpriseList,
        );

        $this->breadcrumb->add(array(
            array(
                'label' => '企业认证',
                'url' => '/manage/enterpriseAuthList'
            ),
            array(
                'label' => '认证列表'
            )
        ));
        $this->theme->set('manageAction', 'enterprise');
        return $this->theme->scope('manage.enterpriselist', $data)->render();
    }

    
    public function enterpriseAuthHandle($id, $action)
    {
        $id = intval($id);
        switch ($action) {
            
            case 'pass':
                $status = EnterpriseAuthModel::enterpriseAuthPass($id);
                break;
            
            case 'deny':
                $status = EnterpriseAuthModel::enterpriseAuthDeny($id);
                break;
        }
        if ($status){
            return redirect('/manage/enterpriseAuthList')->with(array('message' => '操作成功'));
        }
    }

    
    public function enterpriseAuth($id)
    {
        $id = intval($id);
        
        $preId = EnterpriseAuthModel::where('id','>',$id)->min('id');
        
        $nextId = EnterpriseAuthModel::where('id','<',$id)->max('id');
        
        $enterpriseInfo = EnterpriseAuthModel::getEnterpriseInfo($id);
        
        $enterpriseStatus = EnterpriseAuthModel::getEnterpriseAuthStatus($enterpriseInfo['uid']);
        if (!empty($enterpriseInfo)) {
            $data = array(
                'enterprise' => $enterpriseInfo,
                'enterprise_status' => $enterpriseStatus,
                'pre_id' => $preId,
                'next_id' => $nextId
            );
            return $this->theme->scope('manage.enterpriseauthinfo', $data)->render();
        }
    }

    
    public function allEnterprisePass(Request $request)
    {
        $ids = $request->get('ids');
        $idArr = explode(',',$ids);
        $res = EnterpriseAuthModel::AllEnterpriseAuthPass($idArr);
        if($res){
            $data = array(
                'code' => 1,
                'msg' => '操作成功'
            );
        }else{
            $data = array(
                'code' => 0,
                'msg' => '操作失败'
            );
        }
        return response()->json($data);
    }

    
    public function allEnterpriseDeny(Request $request)
    {
        $ids = $request->get('ids');
        $idArr = explode(',',$ids);
        $res = EnterpriseAuthModel::AllEnterpriseAuthDeny($idArr);
        if($res){
            $data = array(
                'code' => 1,
                'msg' => '操作成功'
            );
        }else{
            $data = array(
                'code' => 0,
                'msg' => '操作失败'
            );
        }
        return response()->json($data);
    }
}
