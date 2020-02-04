<!-- 有作品 -->
<ul class="myfocu">
    <li class="myfocu_fenlei">
        <p class="myfocu_biaoti">
            <span><img src="{!! Theme::asset()->url('images/分享.png') !!}" alt="" class="myfocu_biaoti_photo"></span>
            <span class="myfocu_biaoti_text">我的关注</span>
        </p>
        <p class="myfocu_zr">
            <a class="myfocu_zr_zpdt daohang_dianji" href="/user/userfocus">作品动态</a>
            <a class="myfocu_zr_gzdr" href="/user/userfocuspeople">关注的人</a>
        </p>
    </li>

    <!-- 有作品 作品动态-->  

     <li class="myfocu_photo">
        <div class="myfocu_photo_biaoti">作品动态</div>
        <div class="myfocu_photo_box">
            @if($focus_data['total']>0)
                @foreach($focus_data['data'] as $v)
                <div class="myfocu_photo_littlebox">
                    <a href="{!! URL('/bre/serviceCaseDetail/'.$v['id'].'/'.$v['uid']) !!}" target="_blank"><p class="myfocu_photo_littlebox_photobox">
                        @if($v['cover'])
                            <img src="{!! ossUrl($v['cover']) !!}" alt="" class="myfocu_photo_littlebox_photo">
                        @else
                            <img src="{{Theme::asset()->url('images/employ/bg2.jpg')}}" alt="" class="myfocu_photo_littlebox_photo">
                        @endif
                    </p></a>
                    <p class="myfocu_photo_littlebox_text">{{$v['title']}}</p>
                    <p class="myfocu_photo_littlebox_atext">{{$v['ctname']}}</p>
                    <p class="myfocu_photo_littlebox_icon">
                        <span class="myfocu_photo_littlebox_icon_liulanshu"><img src="{!! Theme::asset()->url('images/浏览图标.png') !!}" alt="">{{$v['view_num']}}</span>
                        <span class="myfocu_photo_litt lebox_icon_shoucangshu"><img src="{!! Theme::asset()->url('images/收藏图标.png') !!}" alt="">{{$v['collect']}}</span>
                        <span class="myfocu_photo_littlebox_icon_xiazaishu"><img src="{!! Theme::asset()->url('images/下载图标.png') !!}" alt="">{{$v['sales_num']}}</span>
                    </p>
                    <p class="myfocu_photo_littlebox_zuidibu">
                        <a href="{!! URL('/bre/serviceEvaluateDetail/'.$v['uid']) !!}" target="_blank">
                        <span class="myfocu_photo_littlebox_zuidibu_bj">
                            @if($v['avatar'])
                                <img src="{!! ossUrl($v['avatar']) !!}" alt="">
                            @else
                                <img src="{{Theme::asset()->url('images/default_avatar.png')}}" alt="" >
                            @endif
                        </span>
                        </a>
                        <span class="myfocu_photo_littlebox_zuidibu_sc">{{$v['nickname']}}</span>
                        <span class="myfocu_photo_littlebox_zuidibu_djs">{{$v['created_at']}}</span>
                    </p>
                </div>
                @endforeach
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
                {!! $focus->appends($_GET)->render() !!}
            </div>
        </div>  
    </li>
    <!-- 有作品 作品动态 结束 -->
    <!-- 有作品  关注的人 -->
    {{--<li class="foucusman_photo">--}}
        {{--<div class="foucusman_photo_biaoti">共18个关注人</div>--}}
        {{--@foreach($focus_data['data'] as $v)--}}
        {{--<div class="foucusman_photo_box" id="focus-remove-{{ $v['id'] }}">--}}
            {{--<div class="foucusman_photo_littlebox">--}}
                {{--<div class="foucusman_photo_littlebox_photobox">--}}
                    {{--<a><img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="foucusman_photo_littlebox_photo"></a>--}}
                {{--</div>--}}
                {{--<div class="foucusman_photo_text">--}}
                    {{--<p class="sjsmc">设计师名称</p>--}}
                    {{--<p class="dzzc"><span class="dz">上海</span><span class="sx"></span><span class="zc">平面设计师</span></p>--}}
                    {{--<p class="zofs"><span class="zp">作品&nbsp;999</span><span class="sx"></span><span class="fs">粉丝&nbsp;999</span></p>--}}
                {{--</div>--}}
                {{--<div class="gz" data-toggle="modal" data-target="#myModal-{{ $v['id'] }}">已关注</div>--}}
                {{--<div id="myModal-{{ $v['id'] }}" tabindex="-1" role="dialog" class="modal fade gz_qx">--}}
                    {{--<div class="gz_qx_gb"><label for="qxmyModal-{{ $v['id'] }}"><img src="{!! Theme::asset()->url('images/type/关闭icon.png') !!}" alt="" class="foucusman_photo_littlebox_photo"></label></div>--}}
                    {{--<div class="gz_qx_ms">是否取消关注？</div>--}}
                    {{--<div class="gz_qx_qdqx">--}}
                        {{--<button class="gz_qx_qdqx_qd" data-dismiss="modal" onclick="removeFocus({{ $v['id'] }})">确定</button>--}}
                        {{--<button id="qxmyModal-{{ $v['id'] }}" class="gz_qx_qdqx_qx" data-dismiss="modal">取消</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="foucusman_photo_png">--}}
                {{--<img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="foucusman_photo_pngone">--}}
            {{--</div>--}}
            {{--<div class="foucusman_photo_png">--}}
                {{--<img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="foucusman_photo_pngone">--}}
            {{--</div>--}}
            {{--<div class="foucusman_photo_gd">--}}
                {{--<a><img src="{!! Theme::asset()->url('images/更多.png') !!}" alt="" class="foucusman_photo_gdxx"></a>--}}
            {{--</div>--}}
        {{--</div>  --}}
    {{--@endforeach--}}
    {{--</li>--}}
    <!-- 有作品  关注的人  结束 -->

    
</ul>

{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('userfocus','js/doc/userfocus.js') !!}

{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('userfocus','css/meishimeitu/userfocus.css') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('userfocus','js/doc/usermenu.js') !!}
