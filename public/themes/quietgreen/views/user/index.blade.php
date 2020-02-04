<!--  -->


<div class="container">
    <div class="row">
        <div class="col-lg-3 col-left">
           <div class="focuside clearfix nodel">
               <div class="text-center col-md-4 col-sm-6 col-lg-12">
                   <div class="s-usercenterimg focusideimg profile-picture col-sm-6 col-lg-12">
                       <img id="avatar" class='user-image editable img-responsive' src="@if(!empty(Theme::get('avatar'))) {!!  ossUrl(Theme::get('avatar')) !!} @else {!! Theme::asset()->url('images/default_avatar.png') !!} @endif"/>
                   </div>
                   <div class="col-sm-6 col-lg-12">
                       <div class="space-8"></div>
                       <div class="space-20 visible-sm-block visible-md-block"></div>
                       <p class="cor-gray51 text-size12 p-space">{{ $user_data['nickname'] }}</p>
                       <div class="space-2 col-lg-12"></div>
                       <div class=" g-usericon">
                           @if($auth_user['bank'] == true)
                               <a class="u-bankiconact" data-toggle="tooltip" data-placement="top" title="银行卡已认证"></a>
                           @else
                               <a class="u-bankicon" data-toggle="tooltip" data-placement="top" title="银行卡未认证"></a>
                           @endif

                           @if($auth_user['realname'] == true)
                               <a class="u-infoiconact" data-toggle="tooltip" data-placement="top" title="实名已认证" ></a>
                           @else
                               <a class="u-infoicon" data-toggle="tooltip" data-placement="top" title="实名未认证" ></a>
                           @endif

                           @if(Auth::User()->email_status != 2)
                               <a class="u-messageicon" data-toggle="tooltip" data-placement="top" title="邮箱未认证"></a>
                           @else
                               <a class="u-messageiconact" data-toggle="tooltip" data-placement="top" title="邮箱已认证"></a>
                           @endif

                           @if($auth_user['alipay'] == true)
                               <a  class="u-aliiconact" data-toggle="tooltip" data-placement="top" title="支付已认证"></a>
                           @else
                               <a  class="u-aliicon" data-toggle="tooltip" data-placement="top" title="支付未认证"></a>
                           @endif
                           @if($auth_user['enterprise'] == true)
                               <a  class="u-comicon" data-toggle="tooltip" data-placement="top" title="企业已认证"></a>
                           @else
                               <a  class="u-comicon-no" data-toggle="tooltip" data-placement="top" title="企业未认证"></a>
                           @endif

                       </div>
                   </div>
               </div>
               <div class="space-14 col-lg-12"></div>
               <div class="row g-userinfo visible-lg-block col-lg-12">
                   <div class="col-xs-6 text-center g-userborr">
                       <a href="/user/userfocus" target="_blank">
                           <b>{{ $focus_num }}</b>
                       </a>
                       <p class="text-size14 g-usermarbot2">关注</p>
                   </div>
                   <div class="col-xs-6 text-center">
                       <a href="/user/userfans" target="_blank">
                           <b>{{ $fans_num }}</b>
                       </a>
                       <p class="text-size14 g-usermarbot2">粉丝</p>
                   </div>
                   <div class="space-6 col-xs-12 visible-lg-block"></div>
               </div>
               <div class="space-14 col-lg-12"></div>
               <div class="g-userassets text-center col-md-4 col-sm-6 col-lg-12">
                   <b class="text-size18 cor-gray51">我的资产</b>
                   <div class="space-4"></div>
                   <p class="text-size20 cor-orange"><b>￥{{ $user_data['balance'] }}</b></p>
                   <div class="space-4"></div>
                   <div>
                       <a href="/finance/cash" class="btn-big bg-orange bor-radius2 hov-bgorg88" >充值</a>
                       <a href="/finance/cashout" class="btn-big bg-gary bor-radius2 hov-bggryb0" >提现</a>
                   </div>
                   <div class="space-10"></div>
                   <div class="g-usersidebor row">
                       <a class="text-under" class="text-size12" href="/finance/list" target="_blank">查看明细></a>
                       <p class="space-14"></p>
                   </div>
               </div>
               <div class="space-14 col-lg-12 visible-lg-block"></div>
               <div class="g-usersidelist visible-lg-block visible-md-block col-md-4 col-lg-12">
                   <div class="cor-gray51 text-size16 text-center">我的关注</div>
                   <div class="space-4"></div>
                   <div class="{{ (count($focus_data)>0)?'g-userimglist':'g-userimglistno' }} ">
                       @if(count($focus_data)>0)
                       <ul class="text-center row">
                           @foreach($focus_data as $v)
                           <li class="col-md-4"><a href="/bre/serviceCaseList/{{$v['focus_uid']}}"><img src="{{ ossUrl($v['avatar']) }}"  onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))"><p class="p-space">{{ str_limit($v['nickname'],8) }}<p></a></li>
                           @endforeach
                       </ul>
                       @else
                           <p class="text-size16 cor-gray87">这里的世界静悄悄~</p>
                           <a href="/bre/service" class="text-size14">快去逛逛</a>
                       @endif
                   </div>
                   @if(count($focus_data)>6)
                   <div class="text-center g-usersidetog">
                       <a class="g-usersideleft" href="javascript:;">
                           <i class="fa fa-angle-left"></i>
                       </a>
                       <a class="g-usersideright" href="javascript:;">
                           <i class="fa fa-angle-right"></i>
                       </a>
                   </div>
                   @endif
               </div>
            </div>



        </div>
       <div class="col-lg-9 g-side2 martop20 col-left">
           <div class="g-userhint">
               <p class="personal-center">个人中心</p>
               <div class="g-userhintwrap row">
                   <div class="col-lg-4 col-sm-6 text-center">
                       <div class="g-userhintdata">
                           <div class="space-20"></div>
                           <div class="g-userdatabg"></div>
                           <div class="space-10"></div>
                           <p class="cor-gray51 text-size14">做一个有“脸面”的人</p>
                           <p class="cor-gray51 text-size14">上传头像，完善资料！</p>
                           <div class="space-10"></div>
                           <div class="g-userhintbtn"><a href="/user/info">完善个人资料</a></div>
                           <div class="space-20"></div>
                       </div>
                   </div>
                   <div class="col-lg-4 text-center visible-lg-block">
                       <div class="g-userhinthall">
                           <div class="space-20"></div>
                           <div class="g-userhallbg"></div>
                           <div class="space-10"></div>
                           <p class="cor-gray51 text-size14">这儿潜伏着哪些项目？</p>
                           <p class="cor-gray51 text-size14">他们都有哪些需求？</p>
                           <div class="space-10"></div>
                           <div class="g-userhintbtn"><a href="/task">查看项目库</a></div>
                           <div class="space-20"></div>
                       </div>
                   </div>
                   <div class="col-sm-6 col-lg-4 text-center">
                       <div class="g-userhintrelease">
                           <div class="space-20"></div>
                           <div class="g-userreleasebg"></div>
                           <div class="space-10"></div>
                           <p class="cor-gray51 text-size14">我有天大的需求</p>
                           <p class="cor-gray51 text-size14">需要大神帮我解决！</p>
                           <div class="space-10"></div>
                           <div class="g-userhintbtn"><a href="/task/type">发布项目</a></div>
                           <div class="space-20"></div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="space-10"></div>
           <div class="g-userhint g-userlist tabbable">
               <div class="clearfix g-userlisthead">
                   <ul class="pull-left text-size16 nav nav-tabs">
                       <li class="active"><a href="#useraccept" onclick="changeurl($(this))" url="/user/acceptTasksList" data-toggle="tab">我接受的项目</a></li>
                       <div class="pull-left">|</div><li><a onclick="changeurl($(this))"  url="/user/myTasksList" href="#userrelease" data-toggle="tab">我发布的项目</a></li>
                       <div class="pull-left">|</div><li><a onclick="changeurl($(this))"  url="/user/myTasksList" href="#userrelease" data-toggle="tab">我服务的项目</a></li>
                   </ul>
                   <a id="more-task" class="pull-right hov-corblue2f" href="/user/acceptTasksList" target="_blank">更多</a>
               </div>

               <div class="tab-content">
                   @if(count($my_task)>0)
                   <ul id="useraccept" class="{{ (count($my_task)>0)?'':'g-userlistno' }} tab-pane g-releasetask g-releasnopt g-releasfirs fade active in dialogs">
                           @foreach($my_task as $v)
                           <li class="row width590">
                               <div class="col-sm-1 col-xs-2 u-headimg"><img class="user-image2" src="{{ ossUrl($v['avatar']) }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))"></div>
                               <div class="col-sm-11 col-xs-10 usernopd">
                                   <div class="col-sm-9 col-xs-8">
                                       <div class="text-size14 cor-gray51"><span class="cor-orange">￥{{ $v['bounty'] }}</span>&nbsp;&nbsp;<a class="cor-blue42" href="/task/{{ $v['id'] }}">{{ $v['title'] }}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;{{ $v['status_text'] }}</div>
                                       <div class="space-6"></div>
                                       <p class="cor-gray87"><i class="ace-icon fa fa-user bigger-110 cor-grayd2"></i> {{ str_limit($v['nickname'],10) }}&nbsp;&nbsp;&nbsp;<i class="fa fa-eye cor-grayd2"></i> {{ $v['view_count'] }}人浏览/{{ $v['delivery_count'] }}人投稿&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o cor-grayd2"></i> {{ date('d',time()-strtotime($v['created_at'])) }}天前&nbsp;&nbsp;&nbsp;<i class="fa fa-unlock-alt cor-grayd2"></i> {{ $v['bounty_status']==1?'已托管赏金':'待托管赏金' }}</p>
                                       <div class="space-6"></div>
                                       <p class="cor-gray51 userrelp p-space">{!! strip_tags(htmlspecialchars_decode($v['desc'])) !!}</p>
                                       <div class="space-2"></div>
                                       <div class="g-userlabel"><a href="">{{ $v['category_name'] }}</a>
                                           @if($v['region_limit']==1)
                                               <a href="">{{ CommonClass::getRegion($v['city']) }}</a>
                                           @endif
                                       </div>
                                   </div>
                                   <div class="col-sm-3 col-xs-4 text-right hiden590"><a class="btn-big bg-blue bor-radius2 hov-blue1b" href="/task/{{ $v['id'] }}" target="_blank">查看</a></div>
                                   <div class="col-xs-12"><div class="g-userborbtm"></div></div>
                               </div>
                           </li>
                           @endforeach
                           {{--@else
                           <li class="g-usernoinfo g-usernoinfo-noinfo text-size18">暂无项目哦！快去<a href="/task" target="_blank">接收项目</a>吧</li>
                      --}}
                   </ul>
                   @endif
                       @if(count($my_task)==0)
                   <ul id="useraccept" class="g-userlistno tab-pane g-releasetask g-releasnopt g-releasfirs fade active in">
                       <li class="g-usernoinfo g-usernoinfo-noinfo">暂无项目哦！快去<a href="/task" target="_blank">接收项目</a>吧</li>
                   </ul>
                       @endif
                       @if(count($task)>0)
                   <ul id="userrelease" class="{{ (count($task)>0)?'':'g-userlistno' }} tab-pane g-releasetask g-releasnopt g-releasfirs fade dialogs">

                       @foreach($task as $value)
                           <li class="row width590">
                               <div class="col-sm-1 col-xs-2 u-headimg"><img class="user-image2" src="{{ ossUrl($value['avatar']) }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))" ></div>
                               <div class="col-sm-11 col-xs-10 usernopd">
                                   <div class="col-sm-9 col-xs-8">
                                       <div class="text-size14 cor-gray51"><span class="cor-orange">￥{{ $value['bounty'] }}</span>&nbsp;&nbsp;<a class="cor-blue42" href="/task/{{ $value['id'] }}" target="_blank">{{ $value['title'] }}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;{{ $value['status_text'] }}</div>
                                       <div class="space-6"></div>
                                       <p class="cor-gray87"><i class="ace-icon fa fa-user bigger-110 cor-grayd2"></i> {{ str_limit($value['nickname'],10) }}&nbsp;&nbsp;&nbsp;<i class="fa fa-eye cor-grayd2"></i> {{ $value['view_count'] }}人浏览/{{ $value['delivery_count'] }}人投稿&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o cor-grayd2"></i> {{ date('d',time()-strtotime($value['created_at'])) }}天前&nbsp;&nbsp;&nbsp;<i class="fa fa-unlock-alt cor-grayd2"></i> {{ $value['bounty_status']==1?'已托管赏金':'待托管赏金' }}</p>
                                       <div class="space-6"></div>
                                       <p class="cor-gray51 userrelp p-space">{!! strip_tags(htmlspecialchars_decode($value['desc'])) !!}</p>
                                       <div class="space-2"></div>
                                       <div class="g-userlabel"><a href="">{{ $value['category_name'] }}</a>
                                           @if($value['region_limit']==1)
                                               <a href="">{{ CommonClass::getRegion($value['city']) }}</a>
                                           @endif
                                       </div>

                                   </div>
                                   <div class="col-sm-3 col-xs-4 text-right hiden590"><a class="btn-big bg-blue bor-radius2 hov-blue1b" href="/task/{{ $value['id'] }}" target="_blank">查看</a></div>
                                   <div class="col-xs-12"><div class="g-userborbtm"></div></div>
                               </div>
                           </li>
                       @endforeach
                          {{-- @else
                           <li class="g-usernoinfo g-usernoinfo-noinfo">暂无项目哦！快去<a href="/task/type" target="_blank">发布项目</a>吧</li>
                           @endif--}}
                   </ul>
                   @endif
                   @if(count($task)==0)
                   <ul id="userrelease" class="g-userlistno tab-pane g-releasetask g-releasnopt g-releasfirs fade">

                       <li class="g-usernoinfo g-usernoinfo-noinfo">暂无项目哦！快去<a href="/task/type" target="_blank">发布项目</a>吧</li>

                   </ul>
                   @endif
               </div>
           </div>
       </div>



    </div>
</div>


<!-- <div class="c_wrap">
    <div class="container">
        <div class="row">
            <div class="black_wrap">
               <img class="meishi" src="{!! Theme::asset()->url('images/meishimeitu/personal/meishi.png') !!}" alt="">
               <img class="sheji" src="{!! Theme::asset()->url('images/meishimeitu/personal/sheji.png') !!}" alt="">
            </div>
        </div>
    </div>

</div>
 -->

<!-- <div class="container">
    <div class="row">
        <div class="info_wrap">
            <div class="pic_wrap">
                <img src="{!! Theme::asset()->url('images/meishimeitu/personal/pic.png') !!}" alt="">
            </div>
            <div class="user_info">
                <p class="user_name">用户名</p>
                <p class=" follow_wrap">
                    <a href="#" class=" follow">关注</a>
                    <a href="#" class="letter">私信</a>
                </p>
            </div>
            <ul class="clearfix title_wrap">
                <li><a class="ho_color" href="#">首页</a></li>
                <li><a class="ho_color" href="#">收藏</a></li>
                <li><a class="ho_color" href="#">店铺</a></li>
                <li><a class="ho_color" href="#">资料</a></li>
            </ul>
        </div>
    </div>
</div> -->

<!-- <div class="list_wrap">
    <div class="container">
        <div class="row">
            <ul class="lit_wrap clearfix">
                <li>
                    <div class="img_box">
                        <img src="" alt="">
                    </div>
                    <p class="word_box">
                        <span class="blue_word">NEVER GIVE....UP</span>
                        <span class="glay_word">Richard Perea</span>
                        <span class="y_star"></span>
                    </p>
                </li>
                <li>
                    <div class="img_box">
                        <img src="" alt="">
                    </div>
                    <p class="word_box">
                        <span class="bla_word">COMPUTER CHILDREN</span>
                        <span class="glay_word">Richard Perea</span>
                        <span class="b_star"></span>
                    </p>
                </li>
                <li>
                    <div class="img_box">
                        <img src="" alt="">
                    </div>
                    <p class="word_box">
                        <span class="bla_word">COMPUTER CHILDREN</span>
                        <span class="glay_word">Richard Perea</span>
                        <span class="b_star"></span>
                    </p>
                </li>
                <li>
                    <div class="img_box">
                        <img src="" alt="">
                    </div>
                    <p class="word_box">
                        <span class="bla_word">COMPUTER CHILDREN</span>
                        <span class="glay_word">Richard Perea</span>
                        <span class="b_star"></span>
                    </p>
                </li>

                <li>
                    <div class="img_box">
                        <img src="" alt="">
                    </div>
                    <p class="word_box">
                        <span class="bla_word">COMPUTER CHILDREN</span>
                        <span class="glay_word">Richard Perea</span>
                        <span class="b_star"></span>
                    </p>
                </li>
                <li>
                    <div class="img_box">
                        <img src="" alt="">
                    </div>
                    <p class="word_box">
                        <span class="bla_word">COMPUTER CHILDREN</span>
                        <span class="glay_word">Richard Perea</span>
                        <span class="b_star"></span>
                    </p>
                </li>
                <li>
                    <div class="img_box">
                        <img src="" alt="">
                    </div>
                    <p class="word_box">
                        <span class="bla_word">COMPUTER CHILDREN</span>
                        <span class="glay_word">Richard Perea</span>
                        <span class="b_star"></span>
                    </p>
                </li>
                <li>
                    <div class="img_box">
                        <img src="" alt="">
                    </div>
                    <p class="word_box">
                        <span class="bla_word">COMPUTER CHILDREN</span>
                        <span class="glay_word">Richard Perea</span>
                        <span class="b_star"></span>
                    </p>
                </li>

            </ul>

            <div class="page_box">
                    <span>&lt;</span>
                    <span>1</span>
                    <span>2</span>
                    <span class="sel_page">3</span>
                    <span>&gt;</span>
            </div>


            <div class="leave_word_wrap">
                <textarea>留下要说的话....</textarea>
                <span class="leave_word_btn">留言</span>
            </div>


            <p class="all_title">全部留言<span class="word_num">3</span></p>
            <div class="all_leave_word">
                <div class="word_content clearfix">
                    <span class="head_pic"><img src="{!! Theme::asset()->url('images/meishimeitu/personal/head_pic.png') !!}" alt=""></span>
                    <div class="user_word">
                        <p><span class="uname">用户名称</span><span class="word_date">1天前</span></p>
                        <p>
                            全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言
                        </p>
                    </div>
                    <span class="report"><span></span>举报</span>
                    <span class="omit"></span>
                </div>
            </div>
            <div class="all_leave_word">
                <div class="word_content clearfix">
                    <span class="head_pic"><img src="{!! Theme::asset()->url('images/meishimeitu/personal/head_pic.png') !!}" alt=""></span>
                    <div class="user_word">
                        <p><span class="uname">用户名称</span><span class="word_date">1天前</span></p>
                        <p>
                            全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言
                        </p>
                    </div>
                    <span class="report"><span></span>举报</span>
                    <span class="omit h_more"></span>
                </div>
            </div>
            <div class="all_leave_word">
                <div class="word_content clearfix">
                    <span class="head_pic"><img src="{!! Theme::asset()->url('images/meishimeitu/personal/head_pic.png') !!}" alt=""></span>
                    <div class="user_word">
                        <p><span class="uname">用户名称</span><span class="word_date">1天前</span></p>
                        <p>
                            全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言全部留言
                        </p>
                    </div>
                    <span class="report"><span></span>举报</span>
                    <span class="omit reply_news"></span>
                </div>
            </div>
            <p class="more_word"><a href="#">查看更多留言</a></p>

        </div>
    </div>
</div> -->

<!-- 收藏 -->
<!-- <div class="collect_wrap">
    <div class="container">
        <div class="row">
            <div class="collect_content">
                <img src="{{Theme::asset()->url('images/meishimeitu/personal/collect_img.png')}}" alt="">
            </div>
        </div>
    </div>
</div> -->


<!-- 店铺 -->
<!-- <div class="shop_wrap">
    <div class="container">
        <div class="row">
            <div class="shop_content">
                <img src="{{Theme::asset()->url('images/meishimeitu/personal/shop_img.png')}}" alt="">
            </div>
        </div>
    </div>
</div> -->


<!-- 资料 -->
<!-- <div class="info_wrap">
    <div class="container">
        <div class="row">
            <div class="info_content">
                <p class="info_title">基本信息</p>
                <p class="u_name">用户名</p>
                <p>性别</p>
                <p>签名</p>
                <p>家乡</p>
                <p>现居</p>
                <p>职业</p>
                <p>简介</p>
                <div class="link_wrap"><span class="link_title">个人链接</span><span><img src="{{Theme::asset()->url('images/meishimeitu/personal/weibo.png')}}" alt=""></span></div>
                <div class="tag_wrap"><span class="tag_title">个人标签</span>
                    <p>
                        <span>名片设计</span>
                        <span>传单设计</span>
                    </p>
                </div>
                <p></p>
            </div>
        </div>
    </div>
</div> -->


{!! Theme::asset()->container('custom-css')->usepath()->add('froala_editor', 'css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('index', 'css/meishimeitu/index.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('indexjs', 'js/meishimeitu/index.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('userindex', 'js/doc/userindex.js') !!}


{!! Theme::asset()->container('custom-js')->usepath()->add('more-js', 'js/doc/more.js') !!}
{!! Theme::widget('avatar')->render() !!}