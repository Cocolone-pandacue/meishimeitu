<?php

namespace App\Http\Controllers;

use App\Modules\Manage\Model\ArticleCategoryModel;
use App\Modules\Manage\Model\ConfigModel;
use App\Modules\Task\Model\TaskCateModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\PromoteTypeModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserCenterController extends BasicController
{

    public function __construct()
    {
        parent::__construct();

        
        
        $siteConfig = $this->theme->get('site_config');
        if ($siteConfig['site_close'] == 2){
            abort('404');
        }

        


        
        $parentCate = ArticleCategoryModel::select('id')->where('cate_name','页脚配置')->first();
        if(!empty($parentCate)){
            $articleCate = ArticleCategoryModel::where('pid',$parentCate->id)->limit(4)->get()->toArray();
            $this->theme->set('article_cate', $articleCate);
        }

        
        $basisConfig = ConfigModel::getConfigByType('basis');
        if(!empty($basisConfig)){
            $this->theme->set('basis_config',$basisConfig);
        }
        

        $contact = 2;

        
        $messageConfig = [];
        $config = ConfigModel::getConfigByAlias('app_message');
        if($config && !empty($config['rule'])){
            $messageConfig = json_decode($config['rule'],true);
        }
        if(!empty($messageConfig)){
            
            if(isset($messageConfig['appkey'])){
                $contact = 1;
                $this->theme->set('open_im_appkey',$messageConfig['appkey']);
            }
            if (Auth::check()){
                $username = strval( Auth::id());
                $c = new \TopClient();
                $c->appkey = isset($messageConfig['appkey']) ? $messageConfig['appkey'] : '';
                $c->secretKey = isset($messageConfig['secretKey']) ? $messageConfig['secretKey'] : '';

                $end = date('Ymd');
                $start = date('Ymd', strtotime("-30 day"));
                
                $req = new \OpenimRelationsGetRequest();
                $req->setBegDate($start);
                $req->setEndDate($end);
                $user = new \OpenImUser();
                $user->uid=$username;
                $req->setUser(json_encode($user));
                $resp = $c->execute($req);
                $openImUid = [];
                if(!empty($resp->users->open_im_user)){
                    foreach($resp->users->open_im_user as $k => $v){
                        $openImUid[] = $v->uid;
                    }
                }
                if(!empty($openImUid)){
                    $arrAttention = UserModel::select('users.id', 'users.name', 'user_detail.avatar', 'user_detail.autograph')->whereIn('users.id', $openImUid)
                        ->leftJoin('user_detail', 'users.id', '=', 'user_detail.uid')->get()->toArray();
                    $this->theme->set('attention', $arrAttention);
                }else{
                    $this->theme->set('attention', []);
                }
            }
        }
        $this->theme->set('is_IM_open',$contact);

        
        $question_switch = \CommonClass::getConfig('question_switch');
        $this->theme->set('question_switch',$question_switch);

        
        $promoteType = PromoteTypeModel::where('is_open',1)->where('code_name','ZHUCETUIGUANG')->first();
        if(!empty($promoteType)){
            if($promoteType->is_open == 1){
                $this->theme->set('promote_switch',1);
            }
        }

    }


}
