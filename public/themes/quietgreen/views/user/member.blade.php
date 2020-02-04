<p class="mymember_biaoti">
    <span><img src="{!! Theme::asset()->url('images/Vip.png') !!}" alt="" class="mymember_biaoti_photo"></span>
    <span class="mymember_biaoti_text">我的会员</span>
</p>
<div class="member_outbox">
    <p class="member_outbox_count">您已开通1个会员</p>
    <div class="member_innerbox">
        @if($stylistPackageOrder)
        <div class="member_innerbox_sample">
            <!-- 接单凭证已开通时的图片 -->
            <img src="{!! Theme::asset()->url('images/yes_vip.png')!!}" alt="" class="allcover">
            <!-- 正常时的右上角图片为空 -->
            {{--<img src="" alt="" class="right_top">--}}
            <!-- 正常时的右上角图片为限时秒杀 -->
            <img src="{!! Theme::asset()->url('images/限额秒杀.png')!!}" alt="" class="right_top">
            <p class="member_innerbox_sample_price">限额秒杀低至：<span class="now_price">{{$stylistPackage['cash']*$stylistPackage['stylist_success_draw_ratio']}}元</span></p>
            <a href="/vipshop" class="open_vip" target="_blank">立即续费</a>
            <p class="countdown">有效期{{$stylistPackage['time']}}天</p>
        </div>
        @else
            <div class="member_innerbox_sample">
                <!-- 接单凭证未开通时的图片 -->
                <img src="{!! Theme::asset()->url('images/no_vip.png')!!}" alt="" class="allcover z_index_on">
                <img src="{!! Theme::asset()->url('images/yes_vip.png')!!}" alt="" class="allcover z_index_ender">
                <!-- 接单凭证已开通时的图片 -->
            <!-- <img src="{!! Theme::asset()->url('images/yes_vip.png')!!}" alt="" class="allcover"> -->
                <!-- 正常时的右上角图片为空 -->
                <img src="" alt="" class="right_top">
                <!-- 正常时的右上角图片为限时秒杀 -->
                <img src="{!! Theme::asset()->url('images/限额秒杀.png')!!}" alt="" class="right_top">
                <p class="member_innerbox_sample_price">限额秒杀低至：<span class="now_price">12.80元</span></p>
                <a href="/vipshop" class="open_vip" target="_blank">立即开通</a>
                <p class="countdown">有效期30天</p>
            </div>
        @endif
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('myfocus','css/meishimeitu/member.css') !!}


<!-- 个人中心 我的会员 -->
{!! Theme::asset()->container('custom-js')->usepath()->add('member','js/doc/member.js') !!}
