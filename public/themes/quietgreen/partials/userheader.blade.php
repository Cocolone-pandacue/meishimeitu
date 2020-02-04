<div class="container" xmlns="http://www.w3.org/1999/html">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="/">
                    <img src="{!! Theme::asset()->url('images/s_LOGO.png') !!}">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="example-navbar-collapse">

                <ul class="nav navbar-nav menu_list" style="margin-left:643px; width:232px;">
                <li>
                        <a class="ho_color" href="/"> ← </a><!-- {{ URL('vipshop') }} -->
                    </li>
                    <li>
                        <a class="ho_color" href="/"> 回到首页 </a><!-- {{ URL('vipshop') }} -->
                    </li>
                    <li>
                        <a class=" ho_color" href="{{ URL('task/brainpower/questionnaire') }}">  智能工具 </a>
                        <!-- task/brainpower -->
                    </li>
                </ul>



                <div class="issue clearfix row home_release" style="float: right; width:272px;" >
                    <form class="navbar-form navbar-left" action="/task" role="search" method="get" class="switchSearch">
                        @if(!Auth::check())
                        <div class="form-mask clearfix">
                            <a href="{!! url('login') !!}" class="hover_blue hol_color">登录</a>
                            <a class="hov hover_blue hol_color" href="{!! url('register') !!}">注册</a>
                            {{--<a class="" href="{{ URL('task/create') }}" id="release">发布项目</a>--}}
                            <a class="" href="{{ URL('task/type') }}" id="release">
                                <span class="pro-mask"></span>
                                <span>发布项目</span>
                            </a>
                        </div>
                        @else
                        <div class="login login-end clearfix" style="margin-left:242px; width:262px;">
                            <!-- <div class="bd  fl">
                                <a href="javascript:;" class="new_head dropdown-down">消息<b class="fa fa-angle-down"
                                        style="margin-left: 5px;"></b></a>
                                <div class="news_list_box">
                                    <ul class="news_list">
                                        <li><a href="/user/messageList/1">系统消息<span class="red">{!!
                                                    Theme::get('system_message_count') !!}</span></a></li>
                                        <li><a href="/user/messageList/2">交易动态<span class="red">{!!
                                                    Theme::get('trade_message_count') !!}</span></a></li>
                                        <li><a href="{!! url('/user/messageList/4') !!}">收件箱<span class="red">{!!
                                                    Theme::get('receive_message_count') !!}</span></a></li>
                                    </ul>
                                    <div class="point3"></div>
                                </div>
                            </div> -->
                            <div class="usercenter fl">
                                <a href="javascript:;" class="usercenter_a">我的账户</a>
                                <div class="auth_list_box">
                                    <ul class="auth_list clearfix">
                                        <li>
                                            <a href="/user/myTasksList?judge=1">
                                                <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/my_project.png') !!}"
                                                        alt=""></span>
                                                <span>我的项目</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/task">
                                                <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/discovery_projects.png') !!}"
                                                        alt=""></span>
                                                <span>发现项目</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{!! url('user/goodsShop') !!}">
                                                <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/sample_reels.png') !!}"
                                                        alt=""></span>
                                                <span>作品集</span>
                                            </a>
                                        </li>
                                        <li>
                                                @if(Auth::check())
                                                @if(Theme::get('realname') ==1)
                                                    {{--实名认证成功的--}}
                                                    @if(Theme::get('stylist') ==1)
                                                        {{--设计师入驻成功（不显示）--}}
                                                    @elseif(Theme::get('stylist') ==2)
                                                        {{--设计师入驻过程中--}}
                                                    <a href="/user/productionUploading" >
                                                        <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/applicationfor residence.png') !!}" alt=""></span>
                                                        <span>入驻申请</span>
                                                    </a>
                                                    @endif
                                                @elseif(Theme::get('realname') ==2)
                                                    {{--实名认证等待或者失败的--}}
                                                <a href="/user/realnameAuth" >
                                                    <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/applicationfor residence.png') !!}" alt=""></span>
                                                    <span>入驻申请</span>
                                                </a>
                                                @elseif(Theme::get('realname') ==3)
                                                    {{--没有实名认证的--}}
                                                <a href="/user/realnameAuth" >
                                                    <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/applicationfor residence.png') !!}" alt=""></span>
                                                    <span>入驻申请</span>
                                                </a>
                                                @endif
                                                @else
                                                <a href="javascript:;" >
                                                    <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/applicationfor residence.png') !!}" alt=""></span>
                                                        <span>入驻申请</span>
                                                </a>
                                                @endif
                                                <!-- <a href="">
                                                    <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/applicationfor residence.png') !!}" alt=""></span>
                                                    <span>入驻申请</span>
                                                </a> -->
                                            </li>
                                        <li>
                                            <a href="{!! url('user/goodsShop') !!}">
                                                <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/personal.png') !!}"
                                                        alt=""></span>
                                                <span>个人中心</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{!! url('user/info') !!}">
                                                <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/security_center.png') !!}"
                                                        alt=""></span>
                                                <span>安全中心</span>
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="javascript:;">
                                                <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/other.png') !!}"
                                                        alt=""></span>
                                                <span>其他</span>
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="{!! url('logout') !!}">
                                                <span><img src="{!! Theme::asset()->url('images/meishimeitu/header/out.png') !!}"
                                                        alt=""></span>
                                                <span>退出</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="fl">
                                <a href="/task/type" class="release">
                                    <span class="pro-mask"></span>
                                    <span>发布项目</span>
                                </a>
                            </div>
                        </div>
                        @endif
                    </form>
                    <form class="navbar-form navbar-left clearfix " action="/task" role="search" method="get" class=""
                        style="display: none;">
                        <div class="form-mask">
                            <a href="javascript:;" class="my_account">我的账户</a><i class="fa fa-angle-down"></i>
                            <a class="" href="{{ URL('task/type') }}" id="release">
                                <span class="pro-mask"></span>
                                <span>发布项目</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
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
</div>
{{--{!! Theme::asset()->container('specific-js')->usepath()->add('js','plugins/jquery/js.js') !!}--}}
{!! Theme::asset()->container('specific-js')->usepath()->add('see','js/meishimeitu/see.js') !!}