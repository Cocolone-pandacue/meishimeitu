<div class="advertising_photo">
    <img src="{!! Theme::asset()->url('images/banner.png') !!}" alt="">
</div>
<div class="vip_type">
    <img src="{!! Theme::asset()->url('images/接单凭证.png') !!}" alt="" class="clicked">
</div>
<div class="detail">
    <div class="detail_left">
        <p>接单凭证</p>
        <p>{{intval($stylist_package[0]['cash'])}}元/月</p>
        <p><span>{{$stylist_package[0]['cash']*$stylist_package[0]['stylist_success_draw_ratio']}}元/月</span><img src="{!! Theme::asset()->url('images/hoticon 拷贝.png') !!}" alt=""></p>
        <h5>功能 :</h5>
        <h6>1、普通项目库所有项目免费查看</h6>
        <h6>2、普通项目库所有项目随意接取</h6>
        <h6>3、免除项目成交后平台服务费</h6>
        <h6>4、优质、大额订单免费推送</h6>
        <h6>5、直接成为美视美图合作服务商</h6>
        <h6>6、新人推荐</h6>
    </div>
    <div class="detail_right">
        <form  method="post" action="/vipshop">
        {{csrf_field()}}
        <div class="appropriate">适合用户：学生、试水尝试、短期工时等短周期服务</div>
        <div class="buy_deadline">购买期限 :</div>
        <div class="package">
        {{--@foreach($stylist_package as $k => $s)--}}
            <div class="package_choose">
                <input type="hidden" name="packag_id" value="1{{--{{$s['id']}}--}}">
                <label for="package_{{--{{$s['id']}}--}}">
                    <input  class="ace" name="price_rule_id" type="radio"  value="{{--{{$s['time']}}--}}">
                </label>
                <input {{--@if($s['id'] == 3)  @endif--}} type="radio" class="package_radio" name="packag_id" value="1{{--{{$s['id']}}--}}" id="package_{{--{{$s['id']}}--}}">
                <span class="package_style"></span>
                <p class="package_description_one"> 原价：<span class="deadline">{{--{{intval($s['time']/30)}}--}}一个月</span> （<span class="past_money">{{--{{$s['cash']}}--}}128</span><span>/月</span>) </p>
                <p class="package_description_two"> 活动价：{{--{{intval($s['time']/30)}}--}}一个月（<span class="now_money">{{--{{$s['cash']*$s['stylist_success_draw_ratio']}}--}}12.8</span><span>/月</span>) </p>
                <p class="package_description_three"> 一折<img src="{!! Theme::asset()->url('images/hoticon.png') !!}" alt=""></p>
            </div>
            {{--@endforeach--}}
            <div class="package_choose">
                <label for="package_two"></label>
                <input type="radio" class="package_radio" name="packag_id" value="2" id="package_two">
                <span class="package_style"></span>
                <p class="package_description_one"> 原价：<span class="deadline">三个月</span> （<span class="past_money">298</span><span>/季</span>) </p>
                <p class="package_description_two"> 活动价：三个月（<span class="now_money">29.8</span><span>/季</span>) </p>
                <p class="package_description_three"> 一折<img src="{!! Theme::asset()->url('images/hoticon.png') !!}" alt=""></p>
            </div>
            <div class="package_choose">
                <label for="package_three"></label>
                <input  checked="checked" type="radio" class="package_radio" name="packag_id" value="3" id="package_three">
                <span class="package_style"></span>
                <p class="package_description_one"> 原价：<span class="deadline">一年</span> （<span class="past_money">998</span><span>/年</span></span>) </p>
                <p class="package_description_two transform_x_one"> 活动价：一年（<span class="now_money">99.8</span><span>/年</span>) </p>
                <p class="package_description_three transform_x_two"> 一折<img src="{!! Theme::asset()->url('images/hoticon.png') !!}" alt=""></p>
            </div>
        </div>
        <div class="special_offers">特价活动 :</div>
        <div class="special_offers_detail"><span>前1000名</span>入驻的设计师，最低享受<span>一折</span>福利，<span>超过1000名</span>设计师入驻后，接单凭证<span>恢复原价</span>！欢迎设计师加入合作！</div>
        <div class="settle_accounts"></div>
        <div class="settle_accounts_detail">接单凭证（<span class="deadline">一年</span>）：<span class="past_money">998</span><span>元</span></div>
        <div class="money_count">应付总额：<span class="now_money">99.8</span><span>0</span>元</div>
        <button class="paymoney">立即支付</button>
        </form>
    </div>
</div>





















{!! Theme::asset()->container('custom-css')->usePath()->add('vip-css', 'css/vip_member.css') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('vip_member','js/vip_member.js') !!}
