<section class="clearfix login_wrap">
    <div class="login_icon">
        <img src="{!! Theme::asset()->url('images/meishimeitu/personal/loginl.png') !!}" alt="">
    </div>
    <div class="sign-main-bg ">

        <div class="sign-main">
        <div class="login_head">
            <img src="{!! Theme::asset()->url('images/meishimeitu/personal/loginhead.png') !!}" alt="">
        </div>
            <div class="sign-main-head">
                登录
            </div>
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
                            <input type="password" class="form-control inputxt bor-radius2 user_na" placeholder="密码" name="password" value="{!! old('password') !!}" nullmsg="请输入您的密码" datatype="*6-16" errormsg="请输入6-12个字符，支持英文、数字" autocomplete="off" disableautocomplete>

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

                                <div class="error_wrong" style="color: red;">{!! $errors->first('code') !!}</div>
                            </label>
                            <img src="{!! $code !!}" alt="" class="pull-right" onclick="flushCode(this)">
                        </div>
                    @endif

                    <div class="clearfix">

                        <a href="{!! url('password/mobile') !!}" class="pull-right cor-green hover-word">忘记密码？</a>
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
                        <p>没有账号？<a href="{!! url('register') !!}" class="cor-green hover-word">立即注册&nbsp;&gt;</a></p>
                    </div>
                </form>

                <div class="space"></div>
                <div class="space-6"></div>
            </div>

        </div>
    </div>
</section>
{!! Theme::asset()->container('specific-css')->usepath()->add('logincss','css/meishimeitu/login.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('main-js', 'js/main.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-style','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('see','js/meishimeitu/see.js') !!}