<!-- <div class="g-main g-releasetask g-usershop">
    <h4 class="text-size16 cor-blue2f u-title">店铺设置</h4>
    <div class="space-12"></div>
    {{--开启店铺前提示--}}
    <div class="space-32"></div><div class="space-32"></div><div class="space-22"></div>
    <div class="text-center g-bankhint1 g-bankhint">
        <img src="{!! Theme::asset()->url('images/withdrawhint.png') !!}"><span class="text-size24 shop-hinttxt">
            &nbsp;&nbsp;&nbsp;开启店铺前，请进行<a href="/user/realnameAuth">实名认证</a>！</span>
    </div>
</div> -->
<!-- 进入店铺时，没有实名认证时的页面 -->
<!-- 店铺信息菜单栏 -->

<div class="mystore_top">
    <div class="mystore_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Shop.png') !!}" alt="" class="mystore_biaoti_photo"></span>
        <span class="mystore_biaoti_text">我的店铺</span>
    </div>
    <div class="mystore_dpzp qxboder">
        <span class="mystore_dpzp_zuopinxinxi daohang_dianji">店铺信息</span>
        <span class="mystore_dpzp_zuopinguanli">作品管理</span>
    </div>
</div>

<!-- 店铺信息菜单栏 结束 -->
<!-- 店铺信息 -->
<div class="not_verify">
    <div class="not_verify_title">店铺信息</div>
    <a href="/user/realnameAuth"><img src="{!! Theme::asset()->url('images/实名认证.png') !!}" alt="" class="not_verify_photo"></a>
</div>
<!-- 店铺信息结束 -->
<!-- 进入店铺时，没有实名认证时的页面 结束 -->




{!! Theme::asset()->container('specific-css')->usePath()->add('webui-css', 'plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('usercenter-css', 'css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('chosen','plugins/ace/css/chosen.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('case-css', 'css/index/case.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('chosen','plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-min-js', 'plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-elements-js', 'plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('realname-js', 'js/realnameauth.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('skill','js/doc/skill.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shop','js/doc/shop.js') !!}