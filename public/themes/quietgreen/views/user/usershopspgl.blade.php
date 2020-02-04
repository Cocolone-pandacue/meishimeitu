<!-- 暂无作品 -->
<!-- <div class="no_works">
    <img src="{{Theme::asset()->url('images/meishimeitu/personal/no_works.png')}}" alt="">
</div> -->


<!-- 有作品 -->
<ul class="mywork">
    <li class="mywork_fenlei">
        <p class="mywork_biaoti">
            <span><img src="{!! Theme::asset()->url('images/我的作品icon.png') !!}" alt="" class="mywork_biaoti_photo"></span>
            <span class="mywork_biaoti_text">我的作品</span>
        </p>
        <p class="mywork_xifen_leixing">
            <span>类型</span>
            <a href="{!! URL('/user/goodsShop').'?'.http_build_query(array_except(array_except($merge,'page'),['cate',])) !!}">全部</a>
            @foreach($cateall as $c)
                <a href="{!! URL('/user/goodsShop').'?'.http_build_query(array_merge(array_except($merge,'page'), ['cate'=> $c->id])) !!}">{{$c->name}}</a>
            @endforeach
        </p>
        <p class="mywork_xifen_zhuangtai">
            <span>状态</span>
            <a href="{!! URL('/user/goodsShop').'?'.http_build_query(array_except(array_except($merge,'page'),['status',])) !!}">全部</a>
            <a href="{!! URL('/user/goodsShop').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=> 0])) !!}">待审核</a>
            <a href="{!! URL('/user/goodsShop').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=> 1])) !!}">已通过</a>
            <a href="{!! URL('/user/goodsShop').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=> 3])) !!}">未通过</a>
        </p>
    </li>
    <li class="mywork_photo">
        @if(!empty($goods_list_data['data']))
            <div class="mywork_photo_biaoti">共<span>{{$shopGoodsnum}}</span>个作品</div>
            <div class="mywork_photo_box">
                @foreach($goods_list_data['data'] as $item)
                <div class="mywork_photo_littlebox" id="{{$item['id']}}">
                    <a href="{!! URL('/bre/serviceCaseDetail/'.$item['id'].'/'.Auth::id()) !!}" target="_blank"><p class="mywork_photo_littlebox_photobox">
                        @if($item['cover'])
                            <img src="{!! ossUrl($item['cover']) !!}" alt="" class="mywork_photo_littlebox_photo">
                        @else
                            <img src="{{Theme::asset()->url('images/employ/bg2.jpg')}}" alt="" class="mywork_photo_littlebox_photo">
                        @endif
                        @if($item['status']==0)
                            <span class="mywork_photo_littlebox_photobox_text">审核中</span>
                        @elseif($item['status']==3)
                            <span class="mywork_photo_littlebox_photobox_text">未通过</span>
                        @endif
                    </p></a>
                    <p class="mywork_photo_littlebox_text">{{$item['title']}}</p>
                    <p class="mywork_photo_littlebox_atext">{{$item['catename']}}</p>
                    <p class="mywork_photo_littlebox_icon">
                        <span class="mywork_photo_littlebox_icon_liulanshu"><img src="{!! Theme::asset()->url('images/浏览图标.png') !!}" alt="">{{$item['view_num']}}</span>
                        <span class="mywork_photo_littlebox_icon_shoucangshu"><img src="{!! Theme::asset()->url('images/收藏图标.png') !!}" alt="">{{$item['collect']}}</span>
                        <span class="mywork_photo_littlebox_icon_xiazaishu"><img src="{!! Theme::asset()->url('images/下载图标.png') !!}" alt="">{{$item['sales_num']}}</span>
                    </p>
                    <div class="mywork_photo_littlebox_zuidibu">
                        <a href="{{URL('/user/goodsShopedit/'.$item['id'])}}" target="_blank"><span class="mywork_photo_littlebox_zuidibu_bj">编辑</span></a>
                        <div class="mywork_photo_littlebox_zuidibu_sc" zpid = "{{$item['id']}}" url = "{{URL('/user/goodsShopdel/'.$item['id'])}}">删除</div>
                        <div class="mywork_photo_littlebox_zuidibu_djs">{{$item['created_at']}}</div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
        <div class="no_works">
            <img src="{{Theme::asset()->url('images/meishimeitu/personal/no_works.png')}}" alt="">
        </div>
        @endif
        <div class="paging_bootstrap">
            {{--<ul class="pagination case-page-list">--}}
                {{--<ul class="pagination">--}}
                    {{--<li class="disabled"><span>«</span></li>--}}
                    {{--<li class="active"><span>1</span></li>--}}
                    {{--<li><span><a href="#">2</a></span></li>--}}
                    {{--<li><span><a href="#">3</a></span></li>--}}
                    {{--<li><span><a href="#">4</a></span></li>--}}
                    {{--<li><span><a href="#">5</a></span></li>--}}
                    {{--<li><span><a href="#" rel="next">»</a></span></li>--}}
                {{--</ul>--}}
            {{--</ul>--}}
            {!! $goods_list->appends($merge)->render() !!}
        </div>
    </li>
    
</ul>




<!-- 店铺设计 -->
    <!-- <div class="row close-space-tip">
        <div class="col-md-12 text-center">
            <div class="space-30"></div>
            <div class="space-30"></div>
            <div class="space-30"></div>
            <img src="{!! Theme::asset()->url('images/nomessage.png') !!}" >
            <div class="space-10"></div>
            <p class="text-size16 cor-gray87">您的店铺还没设置，暂不能查看作品管理！<a href="/user/shop">店铺设置</a></p>
        </div>
    </div> -->


{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usershopspql','css/meishimeitu/usershopspql.css') !!}

{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('usershopspql','js/meishimeitu/usershopspql.js') !!}

<!-- 个人中心 我的项目 导航栏点击效果 -->
{!! Theme::asset()->container('custom-js')->usepath()->add('usermenu','js/doc/usermenu.js') !!}

