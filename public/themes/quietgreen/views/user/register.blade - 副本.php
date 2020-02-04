<section class="clearfix">
    <div class="login_icon ">
        <img src="{!! Theme::asset()->url('images/meishimeitu/personal/loginl.png') !!}" alt="">
    </div>
    <div class="sign-main-bg register-main-bg ">


        <div class="register-main">
            <div class="login_head">
                <img src="{!! Theme::asset()->url('images/meishimeitu/personal/loginhead.png') !!}" alt="">
            </div>
            <div class="sign-main-head email_title clearfix">
                注册 <a href="javascript:;">通过手机注册&nbsp;&gt;</a>
            </div>
            <div class="sign-main-head phone_title clearfix hide">
                注册 <a href="javascript:;">通过邮箱注册&nbsp;&gt;</a>
            </div>
            <div class="sign-main-content tab-content">
                <div id="email" class="">
                    <form class="login-form registerform"  method="post" action="{!! url('register') !!}" >
                        {!! csrf_field() !!}
                        <input type="hidden" name="from_uid" value="{!! $from_uid !!}">
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input class="form-control inputxt bor-radius2 user_na"  type="text"  name="username" placeholder="用户名" ajaxurl="{!! url('checkUserName') !!}" datatype="*4-15" nullmsg="请输入用户名" errormsg="用户名长度为4到15位字符" value="{{old('username')}}">
                                <i class="sign-main-userico"></i>
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
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input  class="form-control inputxt bor-radius2 user_na" type="password" name="confirmPassword" placeholder="确认密码" datatype="*" recheck="password" nullmsg="请输入确认密码" errormsg="两次密码不一致">
                                <i class="sign-main-passico"></i>
                                <span class="Validform_checktip validform-login-form"></span>
                                <span class="border_span"></span>
                            </span>
                        </label>
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
                        <span class="has_lo">已有账号?</span><a href="{!! url('login') !!}" class="hover-word">登录&nbsp;&gt;</a>
                    </div>
                    </form>
                    <div class="space-16"></div>
                </div>
                <div id="phone" class=" hide">
                    <form class="login-form registerform" method="post" action="{!! url('register/phone') !!}" >
                        {!! csrf_field() !!}
                        <input type="hidden" name="from_uid" value="{!! $from_uid !!}">
                        <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control inputxt bor-radius2 user_na" placeholder="用户名" name="username" placeholder="用户名" ajaxurl="{!! url('checkUserName') !!}" datatype="*4-15" nullmsg="请输入用户名" errormsg="用户名长度为4到15位字符" value="{{old('username')}}">
                            <i class="sign-main-userico"></i>
                            <span class="Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red"></span>
                            </span>
                            <span class="border_span"></span>
                        </span>
                        </label>

                        <div class="space-12"></div>
                        <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control inputxt bor-radius2 user_na" placeholder="手机号" name="mobile" id="mobile" placeholder="常用手机号码" ajaxurl="{!! url('checkMobile') !!}" datatype="m" nullmsg="请输入手机号" errormsg="手机号格式错误！" value="{{old('mobile')}}">
                            <i class="sign-main-userico"></i>
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
                        <div class="space-10"></div>
                        <!-- </label> -->
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
                        <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input class="form-control inputxt bor-radius2 user_na" type="password"  name="confirm_password" placeholder="确认密码" datatype="*" recheck="password" nullmsg="请输入确认密码" errormsg="两次密码不一致">
                            <i class="sign-main-passico"></i>
                            <span class="Validform_checktip validform-login-form"></span>
                            <span class="border_span"></span>
                        </span>
                        </label>
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
                        <span class="has_lo">已有账号?</span><a href="{!! url('login') !!}" class="hover-word">登录&nbsp;&gt;</a>
                    </div>
                    <div class="space-16"></div>
                </div>
            </div>
        </div>
    </div>
</section>
{!! Theme::asset()->container('custom-js')->usepath()->add('main-js', 'plugins/bootstrap/js/bootstrap.min.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('registerjs', 'js/meishimeitu/register.js') !!}
        <!-- 拖拽验证 -->
{!! Theme::asset()->container('specific-js')->usepath()->add('register', 'js/user/gt.js') !!}

{!! Theme::asset()->container('custom-js')->usePath()->add('custom-validform-js', 'js/auth.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('payphoneword','js/doc/payphoneword.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('see','js/meishimeitu/see.js') !!}

