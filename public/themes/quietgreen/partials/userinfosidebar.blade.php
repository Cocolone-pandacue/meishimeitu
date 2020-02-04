
<div class="text-center userinfo_head">
    <div class="s-usercenterimg focusideimg profile-picture ">
        <img src="@if(!empty(Theme::get('avatar'))) {!!  ossUrl(Theme::get('avatar')) !!} @else {!! Theme::asset()->url('images/meishimeitu/personal/pic.png') !!} @endif" alt="">
        {{--<img src="{!! Theme::asset()->url('images/meishimeitu/personal/pic.png') !!}" alt="">--}}
    </div>
    <div class="space-8">
    </div>
    <p class="cor-gray51  user_n">{{ Auth::user()['name'] }}</p>
    <div class="space-8">
    </div>
    <p class="user_class"><span>@if(!empty(Theme::get('province_name'))) {{Theme::get('province_name')}}@else 省份未填写@endif</span>
        /<span>@if(!empty(Theme::get('profession'))) {{Theme::get('profession')}}@else 职业未填写@endif</span></p>
    <div class="space-12">
    </div>
    <a href="{{URL('user/pubGoods')}}" class="up_works gray_up_works">上传作品</a>
    <div class="space-20">
    </div>
</div>
<div class="space-20"></div>
<div class="accordion-style1 panel-group accordion-style2 g-side1 tips_box clearfix" id="accordion">
    <ul class="left_tips clearfix">
        <li class="sele_tip myfocus">
            <a class=" ho_color1" href="{{URL('user/userfocus')}}">我的关注</a>
        </li>
        <li class="mypro">
            <a class="ho_color1" href="{{URL('user/myTasksList?judge=1')}}">我的项目</a>
        </li>
        <li class="myworks">
            <a class="ho_color1" href="{{URL('user/goodsShop')}}">我的作品</a>
        </li>
        <li class="myshop">
            <a class="ho_color1" href="{{URL('user/shop')}}">我的店铺</a>
        </li>
        <li class="mycoll">
            <a class="ho_color1" href="{{URL('user/myfocus')}}">我的收藏</a>
        </li>
        <li class="myvip">
            <a class="ho_color1" href="{{URL('user/member')}}">我的会员</a>
        </li>
        <li class="myload">
            <a class="ho_color1" href="{{URL('user/DownloadBrainpower')}}">我的下载</a>
        </li>
        <li class="mymoney">
            <a class="ho_color1" href="{{URL('finance/list')}}">财务管理</a>
        </li>
        <li class="myinfo">
            <a class="ho_color1" href="{{URL('user/info')}}">个人资料</a>
        </li>
        <li class="mymiddleman">
            <a class="ho_color1" href="{{URL('user/broker')}}">我是经纪人</a>
        </li>
    </ul>
</div>


