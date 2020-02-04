<nav class="navbar bg-blue navbar-default nav-usercenter-top" role="navigation">
    <div class="navbar-header  g-logo nopad480 nopad-bottom">
        <button type="button" class="navbar-toggle f-navbtn left-480" data-toggle="collapse"
                data-target="#example-navbar-collapse">
            <span class="sr-only">切换导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="{!! CommonClass::homePage() !!}" class="g-logo hidden-xs hidden-sm">
            @if(is_file(Theme::get('site_config')['site_logo_2']) && Theme::get('site_config')['site_logo_2'])
                <img src="{!! url(Theme::get('site_config')['site_logo_2'])!!}" alt="kppw" onerror="onerrorImage('{{ Theme::asset()->url('images/logo1.png')}}',$(this))">
            @else
                <img src="{!! Theme::asset()->url('images/logo1.png') !!}" alt="kppw">
            @endif
        </a>
        <div class="z-navactive topheadposi1">
            <a href="javascript:;" class="u-img topheadimg topheadimg-user" data-toggle="dropdown" class="dropdown-toggle">
                <img src="@if(!empty(Theme::get('avatar'))) {!!  ossUrl(Theme::get('avatar')) !!} @else {!! Theme::asset()->url('images/default_avatar.png') !!} @endif" alt="..." class="img-circle head-uploade-after" width="31" height="34" >
            </a>
            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                <li @if(Theme::get('TYPE') == 1) class="hActive" @endif>
                <a href="{!! url('user/index') !!}">
                        我的主页
                    </a>
                </li>
                <li>
                    <a href="{!! url('/user/info') !!}">
                        账号设置
                    </a>
                </li>
                <li>
                    <a href="{!! url('finance/list') !!}">
                        财务管理
                    </a>
                </li>
                <li class="divider">
                    <a href="#"></a>
                </li>
                <li>
                    <a href="{!! url('logout') !!}">
                        <i class="fa fa-sign-out fa-rotate-270"></i>
                        退出
                    </a>
                </li>
            </ul>
    </div>
    <div class="z-navactive topheadposi2">
        <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle topmessage"><i class="fa fa-bell-o text-size16 f-message"></i>
            @if(Theme::get('system_message_count') +  Theme::get('trade_message_count') + Theme::get('receive_message_count') > 0)<span class="badge badge-info">{!!  Theme::get('system_message_count') +  Theme::get('trade_message_count') + Theme::get('receive_message_count') !!}</span>@endif
        </a>
        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close100">
            <li>
                <a href="{!! url('/user/messageList/1') !!}">
                    系统消息
                    <span class="red">{!! Theme::get('system_message_count') !!}</span>
                </a>
            </li>

            <li>
                <a href="{!! url('/user/messageList/2') !!}">
                    交易动态
                    <span class="red">{!! Theme::get('trade_message_count') !!}</span>
                </a>
            </li>
            <li>
                <a href="{!! url('/user/messageList/4') !!}">
                    收件箱
                    <span class="red">{!! Theme::get('receive_message_count') !!}</span>
                </a>
            </li>
        </ul>
    </div>
        <button class="navbar-toggle mg-right0 text-size16 searbtn480" type="button" data-toggle="collapse"
                    data-target=".bs-js-navbar-scrollspy1">
            <span class="fa fa-search"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse col-md-9 g-nav left768  gr div-nav" id="example-navbar-collapse">
        <!-- <div class="div-hover hidden-md hidden-sm hidden-xs"></div> -->
        <ul class="nav navbar-nav topborbtmul topborbtmul-nav nofloat">
            @if(Theme::get('TYPE') == 1)<li class="hidden-sm hActive"> @else <li class="hidden-sm "> @endif<a class="topborbtm" href="/user/index">我的主页</a></li>
            @if(Theme::get('TYPE') == 2)<li class="hidden-sm hidden-md hActive"> @else <li class="hidden-sm hidden-md"> @endif <a class="topborbtm" href="/user/myTasksList">我是雇主</a></li>
            @if(Theme::get('TYPE') == 3)
                <li class="hidden-sm hidden-md hActive">
            @else
                <li class="hidden-sm hidden-md ">
            @endif
                @if(Theme::get('realname') ==1)
                    {{--实名认证成功的--}}
                        <a class="topborbtm" href="/user/productionUploading">我是设计师</a>
                @elseif(Theme::get('realname') ==2 || Theme::get('realname') ==3)
                    {{--没有实名认证，等待中或者失败的--}}
                        <a class="topborbtm apply" href="javascript:;">我是设计师</a>
                @endif
            </li>
            @if(Theme::get('TYPE') == 4)<li class="hidden-sm hidden-md hActive"> @else <li class="hidden-sm hidden-md "> @endif <a class="topborbtm vip_tq" href="javascript:showzklayer();">我是经纪人</a></li><!-- /user/acceptBroker -->
            {{--@if(Theme::get('TYPE') == 4)<li class="hidden-sm hidden-md hActive"> @else <li class="hidden-sm hidden-md "> @endif <a class="topborbtm vip_tq" href="/user/acceptBroker">我是经纪人</a></li>--}}
            <li class="z-navactive pdtom480 more_li">
                <a href="#" class="dropdown-toggle" ><!-- data-toggle="dropdown" -->
                    更多 <i class="fa fa-angle-down"></i>
                </a>
                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close50 z-navactive more_ul">
                    <li class="visible-sm-block">
                        <a href="{!! CommonClass::homePage() !!}">
                            返回首页
                        </a>
                    </li>
                    <li @if(Theme::get('TYPE') == 1) class="visible-sm-block hActive" @else class="visible-sm-block"@endif>
                    <a href="{!! url('user/index') !!}">
                            我的主页
                        </a>
                    </li>
                    <li @if(Theme::get('TYPE') == 2) class="visible-sm-block visible-md-block hActive" @else class="visible-sm-block visible-md-block"@endif>
                        <a href="{!! url('/user/myTasksList') !!}">
                            我是雇主
                        </a>
                    </li>
                    <li @if(Theme::get('TYPE') == 3) class="visible-sm-block visible-md-block hActive" @else class="visible-sm-block visible-md-block"@endif>
                        <a href="{!! url('user/acceptTasksList') !!}">
                            我是设计师
                        </a>
                    </li>
                    <li>
                        <a href="{!! url('user/info') !!}">
                            账户设置
                        </a>
                    </li>

                    <li>
                        <a href="{!! url('finance/list') !!}">
                            财务管理
                        </a>
                    </li>

                    <li>
                        <a href="{!! url('user/userfocus') !!}">
                            我的关注
                        </a>
                    </li>

                    <li>
                        <a href="{!! url('user/myfocus') !!}">我的收藏</a>
                    </li>
                    <li class=""><!-- text-center -->
                        @if(Theme::get('question_switch')==1)
                        <a href="{!! url('user/myAnswer') !!}">&nbsp;&nbsp;&nbsp;应用&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        @elseif(Theme::get('question_switch')!=1 && Theme::get('promote_switch')==1)
                        <a href="{!! url('/user/promoteUrl') !!}">&nbsp;&nbsp;&nbsp;应用&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        @endif
                    </li>
                </ul>
            </li>
        </ul>
    </div>

   <form class="navbar-form navbar-left gr_box" action="/task" role="search" method="get" class="switchSearch" >
        <div class="login login-end clearfix">
            <div class="bd  fl">

               <a href="javascript:;" class="new_head dropdown-down"><span>消息</span><b class="fa fa-angle-down" style="margin-left: 5px;"></b></a>
               <div class="news_list_box  ">
                   <ul class="news_list">
                       <li><a href="/user/messageList/1">系统消息<span class="red">{!! Theme::get('system_message_count') !!}</span></a></li>
                       <li><a href="/user/messageList/2">交易动态<span class="red">{!! Theme::get('trade_message_count') !!}</span></a></li>
                       <li><a href="{!! url('/user/messageList/4') !!}">收件箱<span class="red">{!! Theme::get('receive_message_count') !!}</span></a></li>
                   </ul>
               <div class="point3"></div>
               </div>
            </div>
            <div class="usercenter fl">
                <a href="javascript:;" class="personal dropdown-down">个人中心<i class="fa fa-angle-down" style="margin-left: 5px;"></i></a>
                <div class="gr_list_box   ">
                   <ul class="gr_list">
                       <li><a href="{!! url(CommonClass::homePage()) !!}">返回首页</a></li>
                       <li><a href="{!! url('user/index') !!}">我的主页</a></li>
                       <li><a href="{!! url('user/personCase') !!}">我的空间</a></li>
                       <li><a href="{!! url('user/loginPassword') !!}">修改密码</a></li>
                       <li><a href="{!! url('user/payPassword') !!}">支付密码</a></li>
                       <li><a href="{!! url('finance/list') !!}">收支明细</a></li>
                       <li><a href="{!! url('logout') !!}"><span class="quit_img"></span>退出</a></li>
                   </ul>
               <div class="point4"></div>
               </div>
            </div>
            <div class="fl">
                <a href="/task/type" class="release">发布项目</a>
            </div>
        </div>
    </form>

    <div class="collapse navbar-collapse bs-js-navbar-scrollspy1 searhide480">
            <ul class="nav navbar-nav clearfix">
                <form action="{{ URL('task') }}" method="get">
                <li class="clearfix">
                    <a href="javascript:;" class="clearfix search-btn">
                        <div class="g-tasksearch clearfix bg-white bg-white">
                            <i class="fa fa-search"></i>
                            <input type="search" name='keywords' placeholder="输入关键词" class=" search-input"/>
                            <button type="submit " class="btn-search">搜索</button>
                        </div>
                    </a>
                </li>
                </form>
            </ul>
        </div>
</nav>

<div class="prompt hide">
    <p>提示</p>
    <p>设计师入驻需要先进行实名认证，<span id="time1">15</span>s后会自动跳转到实名认证界面；</p>
    <p>如果自动跳转失败，请进行手动跳转<a href="{!! url('user/realnameAuth') !!}">&gt;&gt;&gt;点击跳转</a></p>
</div>

<!-- <div class="zk_div">
    <span>X</span>
    <p>即将开放，尽情期待！</p>
</div> -->
<div class="zklayer"></div>
{!! Theme::asset()->container('specific-js')->usepath()->add('js','plugins/jquery/js.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userpicmutual-js', 'js/userpicmutual.js') !!}