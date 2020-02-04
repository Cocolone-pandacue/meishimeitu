{{--<ul class="pagination pull-right">--}}
        {{--{!! $task->appends($_GET)->render() !!}--}}
    {{--</ul> -->--}}
<!-- </div>
    <img src="{{Theme::asset()->url('images/meishimeitu/personal/noopen.png')}}" alt="">
</div> -->

<!-- myfocus -->
<!-- 导航栏 -->

<ul class="myfocus">
    <li class="myfocus_fenlei">
        <p class="myfocus_biaoti">
            <span><img src="{!! Theme::asset()->url('images/File.png') !!}" alt="" class="myfocus_biaoti_photo"></span>
            <span class="myfocus_biaoti_text">我的收藏</span>
        </p>
        <!-- <p class="myfocus_zr">
            <span class="myfocus_zr_zpdt">作品动态</span>
            <span class="myfocus_zr_gzdr">关注的人</span>
        </p> -->
    </li>

<!-- 导航栏 结束 -->


<!-- 当有关注的作品 -->
    <li class="myfocus_photo">
        <div class="myfocus_photo_biaoti">共{{$goodsnum}}个收藏品</div>
        <div class="myfocus_photo_box">
        @if($goods_data['total']>0)
            @foreach($goods_data['data'] as $g)
            <div class="myfocus_photo_littlebox">
                <a href="{!! URL('/bre/serviceCaseDetail/'.$g['id'].'/'.Auth::id()) !!}" target="_blank">
                    <p class="myfocus_photo_littlebox_photobox">
                        @if($g['cover'])
                            <img src="{!! ossUrl($g['cover']) !!}" alt="" class="myfocu_photo_littlebox_photo">
                        @else
                            <img src="{{Theme::asset()->url('images/employ/bg2.jpg')}}" alt="" class="myfocu_photo_littlebox_photo">
                        @endif
                    </p>
                </a>
                <p class="myfocus_photo_littlebox_text">{{$g['title']}}</p>
                <p class="myfocus_photo_littlebox_atext">{{$g['ctname']}}</p>
                <p class="myfocus_photo_littlebox_icon">
                    <span class="myfocus_photo_littlebox_icon_liulanshu"><img src="{!! Theme::asset()->url('images/浏览图标.png') !!}" alt="">{{$g['view_num']}}</span>
                    <span class="myfocus_photo_littlebox_icon_shoucangshu"><img src="{!! Theme::asset()->url('images/收藏图标.png') !!}" alt="">{{$g['collect']}}</span>
                    <span class="myfocus_photo_littlebox_icon_xiazaishu"><img src="{!! Theme::asset()->url('images/下载图标.png') !!}" alt="">{{$g['sales_num']}}</span>
                </p>
                <p class="myfocus_photo_littlebox_zuidibu">
                    <span class="myfocus_photo_littlebox_zuidibu_bj">
                        @if($g['avatar'])
                            <img src="{!! ossUrl($g['avatar']) !!}" alt="">
                        @else
                            <img src="{{Theme::asset()->url('images/default_avatar.png')}}" alt="" >
                        @endif
                    </span>
                    <span class="myfocus_photo_littlebox_zuidibu_sc">{{$g['nickname']}}</span>
                    <span class="myfocus_photo_littlebox_zuidibu_djs">{{$g['created_at']}}</span>
                </p>
            </div>
            @endforeach
        @else
            <div class="no_works">
                <img src="{{Theme::asset()->url('images/meishimeitu/personal/no_works.png')}}" alt="">
            </div>
        @endif
        </div>
        <div class="paging_bootstrap">
            {!! $goods->appends($_GET)->render() !!}
        </div>
    </li>
    
<!-- 当有关注的作品 结束  -->

<!-- 当没有关注的作品 结束 -->

<!-- myfocus 结束 -->






{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('myfocus','css/meishimeitu/myfocus.css') !!}

<script>
    function deleteFocus(obj){
        var url = obj.attr('url');
        $.get(url,function(data){
            if(data.errCode==1){
                $('#task-focus-'+data.id).remove();
                $('#task-focus-space-'+data.id).remove();
            }else{
                alert(data.errMsg);
            }
        });
    }
</script>