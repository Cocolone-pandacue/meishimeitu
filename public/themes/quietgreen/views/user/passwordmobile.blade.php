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
                <form class="passwordform form-horizontal" method="post" action="{!! url('password/mobile') !!}">
                {!! csrf_field() !!}    
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

{!! Theme::asset()->container('custom-js')->usepath()->add('payphoneword','js/doc/payphoneword.js') !!}
