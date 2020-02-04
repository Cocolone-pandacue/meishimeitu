<div class="container footerAdjust">
@if(Auth::user()['id'])
    <div id="uid" uid="{{Auth::user()['id']}}" style="display:none;"></div>
@endif
    <!-- <p class="foot_img"><img src="{!! Theme::asset()->url('images/cooperate/footlogo.png') !!}" alt=""></p> -->

    <ul class="foot_list">
        <li><a class="go_top ho_color" href="#">返回顶端</a></li>
        <li><a href="#" class="ho_color">项目库</a></li>
        <li><a href="#" class="ho_color">案例中心</a></li>
        <li><a href="#" class="ho_color">商务合作</a></li>
        <div class="foot_list_weixin_location">
            <img src="{!! Theme::asset()->url('images/选中.png') !!}" class="foot_list_weixin" alt="">
            <img src="{!! Theme::asset()->url('images/二维码.png') !!}" alt="" class="foot_list_weixin_code">
        </div>
        <a href="https://weibo.com/p/1006066691252025?is_all=1" target="view_window"><img src="{!! Theme::asset()->url('images/微博.png') !!}" class="foot_list_weibo" alt=""></a>
    </ul>
    <div class="contact_way">
        <p><img src="{!! Theme::asset()->url('images/Telephone.png') !!}" alt="">  021-56723829</p>
        <p><img src="{!! Theme::asset()->url('images/Arroba.png') !!}" alt="">  msmt@i3junyukeji.com</p>
    </div>
</div>

<div class="beian">
    <p>MEISHIMEITU-Copyright&nbsp;2009-2020&nbsp;MEISHIMEITU&nbsp;|&nbsp;沪ICP备18014036号-3&nbsp;安全实名验证&nbsp; 信用网站</p>
</div>

@if(Auth::user()['id'])
    {!! Theme::asset()->container('specific-js')->usepath()->add('messageInterval','js/messageInterval.js') !!}
@endif
{!! Theme::asset()->container('specific-css')->usepath()->add('footer','css/footer.blade.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('footer','js/footer.js') !!}

{{--{!! Theme::get('site_config')['statistic_code'] !!}--}}
{!! Theme::widget('popup')->render() !!}
{{--
{!! Theme::widget('statement')->render() !!}
@if(Theme::get('is_IM_open') == 1)
    {!! Theme::widget('im',
    array('attention' => Theme::get('attention'),
    'ImIp' => Theme::get('basis_config')['IM_config']['IM_ip'],
    'ImPort' => Theme::get('basis_config')['IM_config']['IM_port']))->render() !!}
@endif
--}}