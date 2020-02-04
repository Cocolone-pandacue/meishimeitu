<section class="clearfix">
    <div class="login_icon ">
        <img src="{!! Theme::asset()->url('images/meishimeitu/personal/loginl.png') !!}" alt="">
    </div>
    <div class="sendemail-bg ">
        <!-- <div class="sendmail-main password-main"> -->
            <div class="forget_content">
                <div class="login_head">
                    <img src="{!! Theme::asset()->url('images/meishimeitu/personal/loginhead.png') !!}" alt="">
                </div>
                <div class="forget_wrap" >
                    <ul class="clearfix">
                        <li class="find_title"><p>找回密码</p></li>
                        <li>
                            <i class="sign-main-userico "></i>
                            <input type="text" id="phone" class="form-control inputxt bor-radius2 Validform_error user_na" placeholder="手机号">
                            <span class="border_span"></span>
                        </li>
                        <div id="phoneP">
                            <span></span>
                        </div>
                        <li class="achieve clearfix">
                            <i class="sign-main-userico "></i>
                            <input type="text" class="user_na form-control inputxt bor-radius2 Validform_error fl" placeholder="验证码">
                            <a href="javascript:;" class="fl get_code hover-word">获取验证码</a>
                            <span class="border_span"></span>
                        </li>

                        <li>
                            <i class="sign-main-userico t"></i>
                            <input type="password" class="form-control inputxt bor-radius2 Validform_error user_na" placeholder="输入新密码">
                            <i class="pw see_ps"></i>
                            <span class="border_span"></span>
                        </li>

                        <li>
                            <i class="sign-main-userico "></i>
                            <input type="password" class="form-control inputxt bor-radius2 Validform_error user_na" placeholder="再次输入新密码">
                            <i class="pw see_ps"></i>
                            <span class="border_span"></span>
                        </li>

                        <li class="agreement">
                            <p><input type="checkbox" name="">我已经阅读并同意<a href="#" class="hover-word">《美视美图用户协议》</a></p>
                        </li>

                        <li class="login_btn_box">
                            <!-- <a href="javascript:;" class="resetting"></a> -->
                            <button type="submit" class=" login_btn bor-radius2">
                                <div class="button-mask"></div>
                                <span>重置密码</span>
                            </button>
                        </li>

                    </ul>
                </div>
            </div>
        <!-- </div> -->

    </div>
</section>
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-css', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('auth-js', 'js/password.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('main-js', 'js/main.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('see','js/meishimeitu/see.js') !!}
<!-- <div class="clearfix password-head">
                <div class="pull-left text-size20 cor-gray4c">
                    通过邮箱找回
                </div>
                <a class="pull-right cor-gray4c" href="{{url('password/mobile')}}">

                </a>
            </div>
            <div class="space-26"></div>
            <div class="password-wizard no-margin">
                <ul class="wizard-steps hidden-xs">
                    <li class="active">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">输入邮箱</span>
                    </li>
                    <li class="">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">验证信息</span>
                    </li>

                    <li class="">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">重置密码</span>
                    </li>

                    <li class="">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">完成</span>
                    </li>
                </ul>
            </div>
            <div class="space-26"></div>
            <form class="passwordform form-horizontal" method="post" action="{!! url('password/email') !!}">
                {!! csrf_field() !!}
                <div class="form-group step-validform sign-inputradiu" >
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right" for="email">邮箱 </label>
                    <div class="col-xs-12 col-lg-8 col-md-9 col-sm-10">
                        <div class="clearfix block login-form">
                            <input class="forminput  inputxt col-sm-7 col-xs-12" type="text" name="email" id="email"  placeholder="请出入您的邮箱" datatype="e" ajaxurl="{!! url('password/checkEmail') !!}" nullmsg="请输入您的邮箱" errormsg="邮箱地址格式不对！">
                            <div class="col-sm-5 Validform_checktip validform-base"><span class="password-email"></span></div>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="form-group step-validform sign-inputradiu">
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right">验证码 </label>
                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix block login-form">
                            <input class="col-xs-12 col-sm-5 inputxt forminput-code" type="text"  id="code" name="code"  placeholder="请输入验证码" datatype="s" ajaxurl="{!! url('password/checkCode') !!}" nullmsg="请输入验证码">
                            <div class="space-8 col-xs-12 visible-xs-block"></div>
                            <img class="register-codeimg" src="{!! $code !!}" id="codeimg" onclick="flushCode(this)" > </span>
                        </div>
                    </div>
                </div>
                <div class="space-14"></div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right"></label>

                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix">
                            <input type="submit"  class="password-btn bor-radius2 text-size16" value="下一步">
                        </div>
                    </div>
                </div>
            </form> -->