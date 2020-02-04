
<header class="oheader" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                        <span class="sr-only">切换导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="" href="{!! CommonClass::homePage() !!}">
                        @if(Theme::get('site_config')['site_logo_1'] && is_file(Theme::get('site_config')['site_logo_1']))
                            <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" class="img-responsive wrap-side-img"
                                 onerror="onerrorImage('{{ Theme::asset()->url('images/logo.png')}}',$(this))">
                        @else
                            <img src="{!! Theme::asset()->url('images/logo.png') !!}" class="img-responsive wrap-side-img">
                        @endif
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="example-navbar-collapse">
                    <ul class="nav navbar-nav menu_list">

                        @if(!empty(Theme::get('nav_list')))
                           @if(count(Theme::get('nav_list')) > 4)
                               @for($i=1;$i<5;$i++)
                                   <li @if(Theme::get('nav_list')[$i-1]['link_url'] == Theme::get('now_menu')) class="active" @endif>
                                       <a class="text-center" href="{!! Theme::get('nav_list')[$i-1]['link_url'] !!}"
                                          @if(Theme::get('nav_list')[$i-1]['is_new_window'] == 1)target="_blank" @endif >
                                           {!! Theme::get('nav_list')[$i-1]['title'] !!}
                                       </a>
                                   </li>
                               @endfor
                                <li>
                                    <a class="vip_tq" href="javascript:showzklayer();">VIP特权</a><!-- {{ URL('vipshop') }} -->
                                </li>

                            @else
                                @foreach(Theme::get('nav_list') as $m => $n)
                                    @if($n['is_show'] == 1)
                                        <li @if($n['link_url'] == Theme::get('now_menu')) class="hActive" @endif>
                                            <a class="text-center" href="{!! $n['link_url'] !!}" @if($n['is_new_window'] == 1)target="_blank" @endif >
                                                {!! $n['title'] !!}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif

                        @else

                            <li @if('/bre/service' == Theme::get('now_menu')) class="hActive" @endif><a class="topborbtm" href="/bre/service">设计师</a></li>
                            <li @if('/task' == Theme::get('now_menu')) class="hActive" @endif><a class="topborbtm" href="/task">项目库</a></li>

                            <li @if('/task/successCase' == Theme::get('now_menu')) class="hActive" @endif><a class="topborbtm" href="/task/successCase">成功案例</a></li>
                            <li @if('/article' == Theme::get('now_menu')) class="hActive" @endif><a class="topborbtm" href="/article" > 资讯中心</a></li>
                        @endif
                    </ul>
                    <div class="issue clearfix row">
                        <form class="navbar-form navbar-left" action="/task" role="search" method="get" class="switchSearch">
                            {{--搜索--}}
                            <a  class="btn-green btn btn-default" href="{{ URL('task/type') }}">发布项目</a>
                        </form>

                        <div class="state clearfix">

                            @if(!Auth::check())
                            <a href="{!! url('login') !!}" class="hover_blue">登录</a>
                            <a class="hov hover_blue" href="{!! url('register') !!}" >注册</a>
                            @else

                            <div class="bd nav_bd  fl">
                            <a href="javascript:;" class="new_head dropdown-down"><span  >消息</span><b class="fa fa-angle-down" style="margin-left: 5px;"></b></a>
                                   <div class="news_list_box1 ">
                                   <ul class="news_list">
                                       <li><a href="/user/messageList/1">系统消息<span class="red">{!! Theme::get('system_message_count') !!}</span></a></li>
                                       <li><a href="/user/messageList/2">交易动态<span class="red">{!! Theme::get('trade_message_count') !!}</span></a></li>
                                       <li><a href="{!! url('/user/messageList/4') !!}">收件箱<span class="red">{!! Theme::get('receive_message_count') !!}</span></a></li>
                                   </ul>
                                   <div class="point3"></div>
                                   </div>
                                </div>
                                <div class="usercenter fl">
                                    <a href="{!! url('user/index') !!}" class="">个人中心</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>

    <div class="zk_div">
        <span>X</span>
        <p>即将开放，尽情期待！</p>
    </div>

    <div class="zklayer"></div>


    </div>
</header>

{!! Theme::asset()->container('specific-js')->usepath()->add('js','plugins/jquery/js.js') !!}