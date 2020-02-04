<div class="location">
    <div class="container">
        <i class="home_icon"></i>&nbsp;&nbsp;&nbsp;<a href="{!! CommonClass::homePage() !!}">首页</a> <span class="ri_horn"></span><span>分类</span>
    </div>
</div>
<div class="container  si_container">
    <div class="personal">
        {{$catename}}私人定制
    </div>
    <div class="mate">为您匹配最适合您项目的设计者</div>
    <div class="custom-made">
        <a href="{{ URL('task/createnew/'.$cateid.'?a=01') }}">开始定制</a>
    </div>
</div>
<div class="safeguard clearfix">
    <div class="safeguard_left fl clearfix"><img src="{!! Theme::asset()->url('img/保障印章.png') !!}" ></div>
    <div class="safeguard_right fl clearfix">
        <p>平台保障计划</p>
        <p>作品满意交易成功or不满意维权</p>
        <a class="refund" href="javascript:showlayer()">服务协议详情</a>
    </div>
</div>
<div class="zklayer"></div>
<div class="layer"></div>
<div class="pop">
    <p class="clearfix">
        服务协议
        <img class="fr close_pop " src="{!! Theme::asset()->url('img/x.png') !!}" alt="">
    </p>
    <div class="pop_content clearfix">
        <a href="javascript:;">
            <img src="{!! Theme::asset()->url('/images/serve_icon.png') !!}" alt="">
        </a>
        <span class="large_title">服务协议</span>
        i3job为您的项目资金提供退款保证。
        这包括您在发布项目时向i3job支付的项目发布费。
        <span class="little_title">无人接项目？</span>
        在您的项目发布后15天内，无设计师接取项目可申请退款，退款包
        括项目启动资金、项目发布费，以及在该项目上消费的所有费用。
        项目发布在15天内（包含15天），如果有设计师接取了项目，则项目发布费将不再退还；如果超过15天之后，有设计师接取了项目，我们将退还30%的项目发布费，退还的费用直接到您的账户内。
        项目发布在30天之后，才有设计师接取项目，我们将100%退还项目发布费，退还的费用直接到您的账户内。
        选择指定发布的方式发布项目，设计师如果拒绝接受项目，则可以全额退还项目发布费用；设计师如果接受了项目，则项目发布费不再退还；如果超过5天（不包含），设计师未做回应，则自动撤销发布的项目，并退还所有的发布费用。</p>
        <span class="little_title">不喜欢作品？</span>
        当您在截稿验收时，对作品不满意，可在收到作品的3个工作日内，提出修改意见，设计师将会根据您提出的修改意见进行作品调整。
        如果经过多次修改后，扔不满意，则可向平台提出维权申请，提出申请时，必须保留相关证据，证据包括但不限于聊天记录、作品截图、修改意见、作品原需求等等，平台工作人员会根据维权提供的证据进行裁定。
        维权成功后，平台将会退还部分项目费用，该费用会由项目的持续时间，以及项目稿件的作品质量进行估价协商后，进行退款。
        <span class="little_title">设计师稿件不及时？</span>
        如果设计师延误交稿时间，您可以向平台申请维权，提出申请时，必须保留相关证据，证据包括但不限于聊天记录、作品截图、修改意见、作品原需求等等，平台工作人员会根据维权提供的证据进行裁定。
        维权成功后，平台将会退还部分项目费用，该费用会由项目的持续时间，以及项目稿件的作品质量进行估价协商后，进行退款。
    </div>
    <p>
        <a class="begin" href="{{ URL('task/createnew/'.$cateid.'?a=01') }}">开始发布</a>
    </p>
</div>
<!--素材商店-->
<div class="case">
    <div class="container">
        <h1 class="title">{{$catename}}</h1>
        <ul class="material clearfix">
            @if($goodsInfo)
                @foreach($goodsInfo as $gv)
                    <li class="l_pop">
                        <!-- <a> -->
                        <p>
                            <img src="{!! ossUrl($gv['cover']) !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                        </p>
                        <p>
                            <span class="fl">{{$gv['sales_num']}}</span>
                            <span class="fr">{{$gv['usersname']}}</span>
                        </p>
                        <p>
                            <span class="fl">下载量</span>
                            <span class="fr">设计师</span>
                        </p>
                        <div class="li_pop ">
                        </div>
                        <div class="lipop_content">
                            <p class="collect">
                                @if(Auth::check() && !in_array($gv['id'],$goods_focus))
                                    <a class="collect_a" id="goods_id" href="javascript:;" goods_id="{{$gv['id']}}">收藏</a>
                                @elseif(Auth::check())
                                    <a class="collect_a" >已经收藏</a>
                                @else
                                    <a class="collect_a" href="{!! URL('/login') !!}" >收藏</a>
                                @endif
                            </p>
                            <p class="see">
                                <a class="see_a" href="{{ URL('bre/shop/buyGoodsNew/'.$gv['id']) }}" >查看详情</a>
                            </p>
                            <p>
                                <span>{{$gv['catename']}}</span>
                            </p>
                        </div>
                        <!-- </a> -->
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="open_store">
            <a href="javascript:;">打开商店</a>
        </div>
    </div>
</div>
<!--项目流程-->
<div class="link">
    <div class="xm_box">
        <div class="container">
            <h1 class="title">项目流程</h1>
            <div class="Process">
                <img src="{!! Theme::asset()->url('img/项目流程.png') !!}" alt="">
            </div>
        </div>
    </div>
</div>
@if($task)
    <div class="related_cases">
        <div class="xm_box">
            <div class="container">
                <h1 class="title">{{$catename}}相关案例</h1>
                <ul class="related_cases_list clearfix">
                    @foreach($task as $t)
                        <li class="related_cases_li">
                            <div class="li_img_warp"><img src="" alt=""></div>
                            <div class="case_li_right">
                                <p class="case_li_right_title"><span>{{$catename}}</span></p>
                                <div class="case_li_content clearfix">
                                    <div class="li_content_left">
                                        <p>{{$t->title}}</p>
                                        <p>
                                            {{--{!! $t->desc !!}--}}
                                            {{$t->desc}}
                                        </p>
                                        <p>相关关联的项目</p>
                                    </div>
                                    <div class="li_content_right">
                                        <p><img src="{!! Theme::asset()->url('images/icon/icon-1.png') !!}" alt=""><span>{{date('Y年m月d日', strtotime($t->delivery_deadline))}}完成验收</span></p>
                                        <p><img src="{!! Theme::asset()->url('images/icon/icon-2.png') !!}" alt=""><span>{{$t->show_cash}}￥</span></p>
                                    </div>
                                </div>
                                <p class="case_other">
                                    @foreach($cate as $c)
                                        <span>{{$c->name}}</span>
                                    @endforeach
                                </p>
                                <p class="case_li_right_foot clearfix">
                                    <span>项目完成者：<span>{{$t->usersname}}</span></span>
                                    <a href="{{ URL('task/createnew/'.$cateid.'?a=01') }}">开始定制您的项目</a>
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
<div class="link">
    <div class="container">
        <div class="process">
            <img src="{!! Theme::asset()->url('img/平台logo.png') !!}" alt="">
        </div>
    </div>
</div>


{!! Theme::asset()->container('specific-css')->usepath()->add('homepage','css/homepage.blade.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('footer','css/footer.blade.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('sliderBox','plugins/jquery/sliderBox.js') !!}
{{--{!! Theme::asset()->container('specific-js')->usepath()->add('js','plugins/jquery/js.js') !!}--}}
{!! Theme::asset()->container('custom-css')->usepath()->add('index','css/index/index.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('js','plugins/jquery/js.js') !!}