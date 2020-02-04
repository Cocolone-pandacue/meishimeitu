<?php

namespace App\Http\Controllers;

use App\Modules\Manage\Model\ConfigModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\RealnameAuthModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Route;
use Theme;
use App\Modules\Task\Model\TaskCateModel;
use Cache;

class BasicController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public $theme;
    public $themeName;
    
    public $breadcrumb;


    public function __construct()
    {
        
        $this->themeName = \CommonClass::getConfig('theme');
        

        $this->theme = $this->initTheme();
        
        $skin_color_config = \CommonClass::getConfig('skin_color_config');
        if($skin_color_config)
        {
            $this->theme->set('color', $skin_color_config);
        }
        
        $siteConfig = ConfigModel::getConfigByType('site');
        if(isset($siteConfig['record_number'])){
            
            $siteConfig['record_number'] ="<a href='http://www.miitbeian.gov.cn/' target='_blank'>" .$siteConfig['record_number']."</a>";
        }
        $this->theme->set('site_config',$siteConfig);

        if (Auth::check()){
            $user = Auth::User();
//                用户的地址和行业
            $userDetail = UserDetailModel::select('user_detail.alternate_tips','user_detail.avatar','dc.name as province_name','pr.profession')
            ->leftjoin('district as dc', 'dc.id', '=', 'user_detail.province')
            ->leftjoin('profession as pr','pr.id','=','user_detail.profession_id')
            ->where('user_detail.uid', $user->id)
            ->first();
//            dd($userDetail->toArray());
            $this->theme->set('username', $user->name);
            $this->theme->set('tips', empty($userDetail)?'':$userDetail->alternate_tips);
            $this->theme->set('avatar',empty($userDetail)?'':$userDetail->avatar);
            $this->theme->set('province_name',empty($userDetail)?'':$userDetail->province_name);
            $this->theme->set('profession',empty($userDetail)?'':$userDetail->profession);


            $systemMessage =  MessageReceiveModel::where('js_id', $user->id)->where('message_type',1)->where('status',0)->count();
            $tradeMessage =  MessageReceiveModel::where('js_id',$user->id)->where('message_type',2)->where('status',0)->count();
            $receiveMessage =  MessageReceiveModel::where('js_id',$user->id)->where('message_type',3)->where('status',0)->count();
            $this->theme->set('system_message_count',$systemMessage);
            $this->theme->set('trade_message_count',$tradeMessage);
            $this->theme->set('receive_message_count',$receiveMessage);

            //        设计师是否实名认证
            if ($user){
                $realnameInfo = RealnameAuthModel::where('uid', $user->id)->orderBy('created_at', 'desc')->first();
                if (isset($realnameInfo->status)) {
                    if ($realnameInfo->status == 1){
                        $this->theme->set('realname',1);
                        $stylist = DB::table('stylist_auth')->where('uid', $user->id)->first();
                        if (isset($stylist->status)) {
                            if ($stylist->status == 1){
                                $this->theme->set('stylist',1);
                            }else{
                                $this->theme->set('stylist',2);
                            }
                        }else{
                            $this->theme->set('stylist',2);
                        }
                    }else{
                        $this->theme->set('realname',2);
                    }
                }else{
                    $this->theme->set('realname',3);
                }
            }
        }
    }

    
    public function initTheme($layout = 'default')
    {
        return Theme::uses($this->themeName)->layout($layout);
    }

    
    public function manageBreadcrumb()
    {
        return $this->theme->breadcrumb()->setTemplate('
            <ul class="breadcrumb">
            @foreach ($crumbs as $i => $crumb)
                @if ($i != (count($crumbs) - 1))
                <li>
                <i class="ace-icon fa fa-tasks home-icon"></i>
                <a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a>
                </li>
                @else
                <li class="active">{{ $crumb["label"] }}</li>
                @endif
            @endforeach
            </ul>
        ');
    }
}
