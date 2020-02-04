<link rel="stylesheet" type="text/css" href="themes/quietgreen/assets/css/swiper/swiper.min.css">
<div class="customer">
    <div class="position border_bottom flex_column">
        <img class="commom_imgstyle ssss" src="{!! Theme::asset()->url('images/kefu.png') !!}" alt="">
        <img class="commom_imgstyle sss" src="{!! Theme::asset()->url('images/kefu_choose.png') !!}" alt="">
        <span>客服</span>
    </div>
    <div class="position border_bottom flex_column">
        <img class="commom_imgstyle ssss" src="{!! Theme::asset()->url('images/weixin.png') !!}" alt="">
        <img class="commom_imgstyle sss" src="{!! Theme::asset()->url('images/weixin_choose.png') !!}" alt="">
        <span>微信</span>
    </div>
    <div class="position border_bottom flex_column">
        <img class="commom_imgstyle ssss" src="{!! Theme::asset()->url('images/weiquan.png') !!}" alt="">
        <img class="commom_imgstyle sss" src="{!! Theme::asset()->url('images/weiquan_choose.png') !!}" alt="">
        <span>建议</span>
    </div>
    <div class="position flex_column">
        <img class="commom_imgstyle ssss" src="{!! Theme::asset()->url('images/hezuo.png') !!}" alt="">
        <img class="commom_imgstyle sss" src="{!! Theme::asset()->url('images/hezuo_choose.png') !!}" alt="">
        <span>合作</span>
    </div>
    <div class="customer_phone hover_show" style="display:none">
        <img class="background_160" src="{!! Theme::asset()->url('images/客服背景.png') !!}" alt="">
        <a target="_blank"  href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}"><img class="qq_button" src="{!! Theme::asset()->url('images/QQ按钮.png') !!}" alt=""></a>
        <div class="conect">联系客服</div>
        <div>在线：9:00-22:00</div>
        <div class="space_40"></div>
        <div class="flex">
            <img src="{!! Theme::asset()->url('images/Telephone (1).png') !!}" alt="">
            <span>021-56723829</span>
        </div>
        <div class="flex">
            <img src="{!! Theme::asset()->url('images/Arroba (1).png') !!}" alt="">
            <span>msmt@i3junyukeji.com</span>
        </div>
    </div>
    <div class="customer_wechat hover_show" style="display:none">
        <img class="background_160" src="{!! Theme::asset()->url('images/客服背景.png') !!}" alt="">
        <img class="qr_code" src="{!! Theme::asset()->url('images/二维码 (1).png') !!}" alt="">
        <div>
            <p>美视美图官微</p>
            <p>及时关注网站动态</p>
            <p>订单推送早知道</p>
        </div>
        <p>您还可以关注美视美图新浪微博&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="https://weibo.com/p/1006066691252025?is_all=1" target="view_window" style="color:#125BE0;">+关注</a></p>
    </div>
    <div class="customer_rights hover_show" style="display:none;">
        <img class="background_401" src="{!! Theme::asset()->url('images/客服背景 (1).png') !!}" alt="">
        <form class="form-horizontal" action="/bre/feedbackInfo" method="post" enctype="multipart/form-data" id="complain">
        {!! csrf_field() !!}
            <input type="text" name="uid" @if(!empty(Theme::get('complaints_user'))) value="{!! Theme::get('complaints_user')->uid !!}" @endif style="display:none">
            <textarea name="desc" id="suggest" cols="30" rows="10" placeholder="期待您的一句话点评，不管是批评、感谢、建议，我们都细心聆听、心存感激、及时回复..."></textarea>
            {!! $errors->first('desc') !!}
            <div class="flex formbtn">
                <input name="phone" @if(!empty(Theme::get('complaints_user')['mobile'])) value="{!! Theme::get('complaints_user')['mobile'] !!}" readonly="readonly" @endif  type="text" id="phone" placeholder="请输入手机号码">
                {!! $errors->first('phone') !!}
                <button type="submit"  id="home_btn">提交</button>
            </div>
        </form>
        <p class="rights">维权与监督</p>
        <p>固话：021-56723829</p>
        <p>QQ：<a target="_blank"  href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}"><img src="{!! Theme::asset()->url('images/QQ按钮.png') !!}" alt=""></a></p>
        <p>手机：18901948110</p>
        <p>微信：junyuxinxikeji</p>
        <img class="charge_qr_code" src="{!! Theme::asset()->url('images/微信二维码 (1).png') !!}" alt="">
        <p class="director_aftersale">客诉主管</p>
    </div>
    <div class="customer_cooperation hover_show" style="display:none;">
        <img class="background_198" src="{!! Theme::asset()->url('images/客服背景 (3).png') !!}" alt="">
        <p class="adver_cooperation">咨询广告合作</p>
        <p>微信：junyuxinxikeji</p>
        <img class="adver_qr_code" src="{!! Theme::asset()->url('images/微信二维码 (1).png') !!}" alt="">
    </div>
</div>
<div class="lunbo_wrap">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                {{--<img class="img_start" src="{!! Theme::asset()->url('images/icon/banner3.jpg') !!}" alt="">--}}
                <a href="/task/type"><img class="img_start" src="{!! ossUrl('attachment/icon/banner3.jpg') !!}" alt="">
            </div>
            <div class="swiper-slide">
                {{--<img src="{!! Theme::asset()->url('images/icon/VIP banner.jpg') !!}" alt="">--}}
                <a href="/vipshop"><img class="img_start" src="{!! ossUrl('attachment/icon/VIP banner.jpg') !!}" alt=""></a>
                <!-- <div class="start_design ">
                    <a href="#" class="a_img_box">
                        <span class="begin_word_box">
                        <span class="img-mask"></span>
                            <span>开始设计</span>
                        </span>
                        <img class="po_ja" src="{!! Theme::asset()->url('images/icon/jian.png') !!}" alt="">
                    </a>
                </div> -->
            </div>
            <div class="swiper-slide">
                {{--<img class="img_start" src="{!! Theme::asset()->url('images/icon/lunbo2.jpg') !!}" alt="">--}}
                <img class="img_start" src="{!! ossUrl('attachment/icon/lunbo2.jpg') !!}" alt="">
            </div>
            <!-- <div class="swiper-slide"><img src="{!! Theme::asset()->url('images/icon/lunbo1.jpg') !!}" alt=""></div> -->
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<div class="enter_wrap">
    <p class="enter_word">
        <a href="javascript:;" class="enter_word_a">
            <span>进入主题</span>
            <span class="enter_border"></span>
            <img class="enter_img" src="{!! Theme::asset()->url('images/icon/bo_jian.png') !!}" alt="">
        </a>
    </p>
</div>







{!! Theme::asset()->container('specific-js')->usepath()->add('js','plugins/jquery/js.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('swiper','js/swiper.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('lunbo','js/lunbo.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('design','js/meishimeitu/design.js') !!}
