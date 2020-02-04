<!-- loading -->
<div class="artificial_intelligence_wrap ">
<!-- loading -->
    <div class="content ">
        <div class="wordTip">
        </div>
        <div class="loding_box">
            <div class="loading">
            <div class="bg">
                <ul class="word-wrap">
                    <li class="word one">美</li>
                    <li class="word two">视</li>
                    <li class="eye"></li>
                    <li class="word three">美</li>
                    <li class="word four">图</li>
                </ul>
            </div>
            <div class="robot">
                <div class="hand left"></div>
                <div class="body"></div>
                <div class="hand right"></div>
            </div>
        </div>
        </div>

    </div>
</div>

<!-- 智能工具结果 -->
<!-- logo生成 -->
<div class="make_logo_wrap hide">
    {{--<input type="hidden" name="brainpower_num" id="brainpower_num" value="{{$brainpower_num}}">--}}
    <input type="hidden" name="name" id="name" value="{{$data['name']}}">
    <input type="hidden" name="title" id="title" value="{{$data['title']}}">
    <input type="hidden" name="industry" id="industry" value="{{$data['industry']}}">
    <input type="hidden" name="logo" id="logo" value="{{json_encode($data['logo'])}}">
    <input type="hidden" name="color" id="color" value="{{json_encode($data['color'])}}">
    <div class="preview_logo">
        <p class="preview_title">左右翻页预览LOGO</p>
        {{--@foreach($sv as $s)--}}
            {{--<p style="color: #ff000c">{!! $s->message !!}</p>--}}
        {{--@endforeach--}}
        <div class="logo_container">
                  <div class="swiper-container swiper-no-swiping">
                        <div class="swiper-wrapper">
                            {{--@foreach($svg as $s)--}}
                                {{--<div class="swiper-slide ">--}}
                                    {{--<a href="javascript:;" class="sw_a shui" id="add">--}}
                                        {{--{!! $s['data'] !!}--}}
                                        {{--<span class="collect_span collect"></span>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        </div>
                  </div>
                  <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
        </div>
        <p class="brand_wrap"><a class="upload_btn" download="" href="javascript:;">下载LOGO</a>
        <a class=""  href="{{url('task/createnewdetail/170/?a=01')}}">品牌优化</a></p>
       {{--<!--  <p class="brand_wrap"><a href="{{url('task/createnew/232/'.$id.'?a=01')}}">品牌优化</a></p> -->--}}
        <p class="preview_title">LOGO场景应用</p>
        <div class="scenario_application_wrap clearfix">
            <div class="logo_make_one">
                <div class="img_case lo_one_seat shui">
                    <img src="" alt="">
                </div>
                <div class="img_case lo_onet_seat shui">
                    <img src="" alt="">
                </div>
            </div>
            <div class="logo_make_two ">
                <div class="img_case lo_two_seat shui">
                    <img src="" alt="">
                </div>
            </div>
            <div class="logo_make_three">
                <div class="img_case lo_three_seat shui">
                    <img src="" alt="">
                </div>
            </div>

            <div class="logo_make_four">
                <div class="img_case lo_four_seat shui">
                    <img src="" alt="">
                </div>
            </div>
            <div class="logo_make_five">
                <div class="img_case lo_five_seat shui">
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- 登录注册 -->
    @if(!Auth::check())
        <div class="topdiv ">
            <div class="shade_div ">

            </div>

            <div class="user_div">
                <div class="user_login ">
                    <p>登录</p>
                    <div class="sign-main-content">
                        <form class="login-form" method="post" action="{!! url('login') !!}" >
                            {{ csrf_field() }}
                            <label class="block clearfix">
                        <span class="block input-icon input-icon-right ">
                            <input type="text" class="form-control inputxt bor-radius2 user_na" placeholder="用户名/邮箱/手机号" name="username" value="{!! old('username') !!}" nullmsg="请输入您的账号" datatype="*" errormsg="请输入您的账号">
                            <i class="sign-main-userico"></i>
                            <span class="Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red">{!! $errors->first('username') !!}</span>
                            </span>

                            <span class="border_span"></span>

                        </span>
                            </label>

                            <label class="block clearfix label-bottom">
                        <span class="block input-icon input-icon-right login-error_wrong Validform-wrong-red Validform-wrong-red-height">
                            <input type="password" class="form-control inputxt bor-radius2 user_na" placeholder="密码" name="password" nullmsg="请输入您的密码" datatype="*6-16" errormsg="请输入6-12个字符，支持英文、数字" autocomplete="off" disableautocomplete>

                            <i class="sign-main-passico"></i>
                            <i class="see_ps paw_see"></i>
                            <span class="Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red">{!! $errors->first('password') !!}</span>
                            </span>
                            <span class="border_span"></span>
                        </span>
                            </label>
                            @if(!empty($errors->first('password')) || !empty($errors->first('code')))
                                <div class="clearfix codeImg">
                                    <label class="inline pull-left">
                                        <input type="text" class="form-control" placeholder="验证码" name="code">

                                        <div class="error_wrong">{!! $errors->first('code') !!}</div>
                                    </label>
                                    <img src="{!! $code !!}" alt="" class="pull-right" onclick="flushCode(this)">
                                </div>
                            @endif

                            <div class="clearfix">

                                <a href="{!! url('password/email') !!}" class="pull-right  hover-word">忘记密码？</a>
                            </div>
                            <div class="space-12"></div>

                            <div class="login_btn_box">
                                <button type="submit" class=" login_btn bor-radius2">
                                    <div class="button-mask"></div>
                                    <span>登录</span>
                                </button>
                            </div>
                            <div class="space"></div>
                            <div class="go_re">
                                <p>没有账号？<a href="javascript:;" class=" hover-word user_register_div">立即注册&nbsp;&gt;</a></p>
                            </div>
                        </form>

                        <div class="space"></div>
                        <div class="space-6"></div>
                    </div>
                </div>
                <div class="user_register hide">
                    <p>注册</p>

                    <div class="sign-main-content">
                        <div id="email" class="">
                            <form class="login-form registerform"  method="post" action="{!! url('register') !!}" >
                                {!! csrf_field() !!}
                                <input type="hidden" name="from_uid" value="">{{-- {!! $from_uid !!} --}}
                                <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input class="form-control inputxt bor-radius2 user_na"  type="text"  name="username" placeholder="用户名" ajaxurl="{!! url('checkUserName') !!}" datatype="*4-15" nullmsg="请输入用户名" errormsg="用户名长度为4到15位字符" value="{{old('username')}}">
                                <i class="sign-main-userico"></i>
                                <span class="go_phone">通过手机注册</span>
                                <span class="Validform_checktip validform-login-form login-validform-static">
                                    <span class="login-red"></span>
                                </span>

                                <span class="border_span"></span>

                            </span>
                                </label>
                                <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input class="form-control inputxt bor-radius2 user_na" type="email"  name="email" placeholder="邮箱" ajaxurl="{!! url('checkEmail') !!}" datatype="e" nullmsg="请输入邮箱帐号" errormsg="邮箱地址格式不对！" value="{{old('email')}}">
                                 <i class="ace-icon fa  fa-envelope cor-grayD3"></i>
                                <span class="Validform_checktip validform-login-form"></span>
                                <span class="border_span"></span>
                            </span>
                                </label>
                                <label class="block clearfix label-bottom">
                            <span class="block input-icon input-icon-right login-error_wrong Validform-wrong-red Validform-wrong-red-height">
                                <input class="form-control inputxt bor-radius2 user_na"  type="password" name="password" placeholder="密码" datatype="*6-16" nullmsg="请输入密码" errormsg="密码长度为6-16位字符" >
                                <i class="sign-main-passico"></i>
                                <i class="see_ps"></i>
                                <span class="Validform_checktip validform-login-form login-validform-static">
                                    <span class="login-red"></span>
                                </span>
                                <span class="border_span"></span>

                            </span>
                                </label>
                                <!-- <label class="block clearfix">
                                    <span class="block input-icon input-icon-right">
                                        <input  class="form-control inputxt bor-radius2 user_na" type="password" name="confirmPassword" placeholder="确认密码" datatype="*" recheck="password" nullmsg="请输入确认密码" errormsg="两次密码不一致">
                                        <i class="sign-main-passico"></i>
                                        <span class="Validform_checktip validform-login-form"></span>
                                        <span class="border_span"></span>
                                    </span>
                                </label> -->
                                <div class="space-10"></div>
                                <div class="agreement">
                                    <p><input type="checkbox" name="">我已经阅读并同意<a href="#" class="hover-word">《美视美图用户协议》</a></p>
                                </div>
                                <div class="space-12"></div>
                                <div class="login_btn_box">

                                    <button type="submit" class="register_btn bor-radius2 ">
                                        <div class="button-mask-r"></div>
                                        <span>注册</span>
                                    </button>
                                </div>
                                <div class="space-8"></div>
                                <div class="clearfix">
                                    <span class="has_lo">已有账号?</span><a href="javascript:;" class="hover-word user_login_div">登录&nbsp;&gt;</a>
                                </div>
                            </form>
                            <div class="space-16"></div>
                        </div>
                        <div id="phone" class="hide ">
                            <form class="login-form registerform" method="post" action="{!! url('register/phone') !!}" >
                                {!! csrf_field() !!}
                                <input type="hidden" name="from_uid" value="">{{-- {!! {!! $from_uid !!} --}}
                            <!-- <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control inputxt bor-radius2 user_na" placeholder="用户名" name="username" placeholder="用户名" ajaxurl="{!! url('checkUserName') !!}" datatype="*4-15" nullmsg="请输入用户名" errormsg="用户名长度为4到15位字符" value="{{old('username')}}">
                            <i class="sign-main-userico"></i>
                            <span class="Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red"></span>
                            </span>
                            <span class="border_span"></span>
                        </span>
                        </label> -->

                                <div class="space-12"></div>
                                <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control inputxt bor-radius2 user_na" placeholder="手机号" name="mobile" id="mobile" placeholder="常用手机号码" ajaxurl="{!! url('checkMobile') !!}" datatype="m" nullmsg="请输入手机号" errormsg="手机号格式错误！" value="{{old('mobile')}}">
                            <i class="sign-main-userico"></i>
                            <span class="go_email">通过邮箱注册</span>
                            <span class="mobile_check Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red"></span>
                            </span>
                            <span class="border_span"></span>
                        </span>
                                </label>
                                <div class="input-icon">
                                    <input class="inputxt yan_in  bor-radius2 user_na" name="code" type="text" placeholder="短信验证码"  nullmsg="请输入验证码" datatype="*" id="form-field-3" value="">
                                    <i class="sign-main-passico"></i>
                                    <input class=" yanzheng " type="button" token="{{csrf_token()}}" onclick="sendRegisterCode()"  value="获取验证码" id="sendMobileCode">
                                    <span class="Validform_checktip block validform-login-form {{ ($errors->first('code'))?'Validform_wrong':'' }}">{!! $errors->first('code') !!}</span>
                                    <span class="border_span"></span>
                                </div>

                                <label class="block clearfix label-bottom">
                        <span class="block input-icon input-icon-right login-error_wrong Validform-wrong-red Validform-wrong-red-height">
                            <input class="form-control inputxt bor-radius2 user_na" type="password"  name="password" placeholder="密码" datatype="*6-16" nullmsg="请输入密码" errormsg="密码长度为6-16位字符" autocomplete="off" disableautocomplete>
                            <i class="sign-main-passico"></i>
                            <i class="see_ps"></i>
                            <span class="Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red"></span>
                            </span>
                            <span class="border_span"></span>
                        </span>
                                </label>
                                <!-- <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input class="form-control inputxt bor-radius2 user_na" type="password"  name="confirm_password" placeholder="确认密码" datatype="*" recheck="password" nullmsg="请输入确认密码" errormsg="两次密码不一致">
                                    <i class="sign-main-passico"></i>
                                    <span class="Validform_checktip validform-login-form"></span>
                                    <span class="border_span"></span>
                                </span>
                                </label> -->
                                <div class="space-10"></div>
                                <div class="agreement">
                                    <p><input type="checkbox" name="">我已经阅读并同意<a href="#" class="hover-word">《美视美图用户协议》</a></p>
                                </div>
                                <div class="space-12"></div>
                                <div class="login_btn_box">

                                    <button type="submit" class="register_btn bor-radius2 ">
                                        <div class="button-mask-r"></div>
                                        <span>注册</span>
                                    </button>
                                </div>
                            </form>
                            <div class="space-8"></div>
                            <div class="clearfix">
                                <span class="has_lo">已有账号?</span><a href="javascript:;" class="hover-word user_login_div">登录&nbsp;&gt;</a>
                            </div>
                            <div class="space-16"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif

</div>




<!-- 付费购买 -->
<div class="buy_div hide">
    <div class="shade_div ">

    </div>

    <div class="buy_detail_div hide">
        <span class="close_parent close_btn">X</span>
        <ul class="buy_detail_list clearfix">
            <li>
                <p class="detail_head">简单套餐<span class="free_icon"></span></p>
                <div class="detail_li_list">
                    <p>JPG(800X800px)</p>
                    <p>PNG(800X800px)</p>
                    <p>--</p>
                    <p>--</p>
                    <p>--</p>
                    <p>--</p>
                    <p>--</p>
                    <p>--</p>
                    <p>--</p>
                    <p>--</p>
                    <p class="detail_li_list_p" ><span>(原价￥99元)</span>现价￥1元</p>
                    <a href="javascript:;" data-type="1"  class="price_free_btn price_btn">￥1元</a>
                </div>

            </li>
            <li>
                <p class="detail_head no_allow">普通套餐</p>
                <div class="detail_li_list">
                    <p>JPG(2000X2000px)</p>
                    <p>PNG(2000X2000px)</p>
                    <p>ESP(适量编辑)</p>
                    <p>LOGO头像图标</p>
                    <p>LOGO品牌规范</p>
                    <p>--</p>
                    <p>--</p>
                    <p>--</p>
                    <p>--</p>
                    <p>--</p>
                    <a href="javascript:;" data-type="2" class="price_btn no_allow no_allow_cur">￥149元</a>
                </div>

            </li>
            <li>
                <p class="detail_head no_allow">专业套餐</p>
                <div class="detail_li_list">
                    <p>JPG(2000X2000px)</p>
                    <p>PNG(2000X2000px)</p>
                    <p>ESP(适量编辑)</p>
                    <p>LOGO头像图标</p>
                    <p>LOGO品牌规范</p>
                    <p>配套品牌VI</p>
                    <p>配套名片</p>
                    <p>修改指导意见</p>
                    <p>商标注册指导</p>
                    <p>商标注册100元优惠券</p>
                    <a href="javascript:;" data-type="3" class="price_btn no_allow no_allow_cur">￥399元</a>
                </div>

            </li>
        </ul>


    </div>

    <!-- 下载图片 -->
    <div class="onload_img hide">
        <span class="close_parent close_btn">X</span>
        <div class="img_show">

        </div>
        <p class="clearfix">
            <a href="javascript:;" class=" ai_one_next waves onloadJpg">JPG下载</a>
            <span class="img_word show_word_color">尺寸为800*800px的高清LOGO，不可编辑</span>
        </p>
        <p class="clearfix">
            <a href="javascript:;" class="ai_one_next waves  onloadPng">PNG下载</a>
            <span class="img_word show_word_color">尺寸为800*800px的高清LOGO，不可编辑</span>
        </p>
        <p class="clearfix">
            <a href="javascript:;" class="img_onload_btn noshow_word_color">EPS下载(矢量)</a>
            <span class="img_word noshow_word_color">可编辑的矢量图源文件</span>
        </p>

    </div>

</div>





{!! Theme::asset()->container('custom-css')->usepath()->add('brainpower','css/meishimeitu/brainpower.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('reset','css/meishimeitu/reset.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('swipercss','css/meishimeitu/swiper/swiper.min.css') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('brainpower','js/meishimeitu/brainpower.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('swiperjs','js/meishimeitu/swiper/swiper.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('lunbojs','js/meishimeitu/swiper/lunbo.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('resultjs','js/meishimeitu/result.js') !!}

<!-- <script type="text/javascript" src="http://gosspublic.alicdn.com/aliyun-oss-sdk-6.0.0.min.js"></script> -->


{!! Theme::asset()->container('custom-css')->usepath()->add('robot','css/meishimeitu/robot.css') !!}


{!! Theme::asset()->container('specific-js')->usepath()->add('waves','js/meishimeitu/waves.js') !!}


{{--{!! Theme::asset()->container('specific-js')->usepath()->add('processing','js/meishimeitu/processing.js') !!}--}}

{!! Theme::asset()->container('specific-js')->usepath()->add('hide','js/meishimeitu/hide.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('resultcss','css/meishimeitu/result.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('logincss','css/meishimeitu/login.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('signcss','css/sign/sign.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('see','js/meishimeitu/see.js') !!}

{!! Theme::asset()->container('specific-css')->usepath()->add('validform-style','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('register', 'js/user/gt.js') !!}

{!! Theme::asset()->container('custom-js')->usePath()->add('custom-validform-js', 'js/auth.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('payphoneword','js/doc/payphoneword.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('see','js/meishimeitu/see.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('main-js', 'plugins/bootstrap/js/bootstrap.min.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('registerjs', 'js/meishimeitu/register.js') !!}