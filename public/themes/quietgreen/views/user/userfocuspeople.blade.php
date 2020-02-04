<ul class="myfocu">
    <li class="myfocu_fenlei">
        <p class="myfocu_biaoti">
            <span><img src="{!! Theme::asset()->url('images/分享.png') !!}" alt="" class="myfocu_biaoti_photo"></span>
            <span class="myfocu_biaoti_text">我的关注</span>
        </p>
        <p class="myfocu_zr">
            <a class="myfocu_zr_gzdr " href="/user/userfocus">作品动态</a>
            <a class="myfocu_zr_gzdr daohang_dianji" href="/user/userfocuspeople">关注的人</a>
        </p>
    </li>

    <li class="foucusman_photo">
        <div class="foucusman_photo_biaoti">共<span>{{$num}}</span>个关注人</div>
        @if(count($focus_data)>0)
        @foreach($focus_data as $v)
        <div class="foucusman_photo_box" id="focus_remove_{{ $v['focus_uid'] }}">
            <div class="foucusman_photo_littlebox">
                <a href="{!! URL('/bre/serviceEvaluateDetail/'.$v['focus_uid']) !!}" target="_blank"><div class="foucusman_photo_littlebox_photobox">
                    @if($v['avatar'])
                        <img src="{!! ossUrl($v['avatar']) !!}" alt="" class="foucusman_photo_littlebox_photo">
                    @else
                        <img src="{{Theme::asset()->url('images/default_avatar.png')}}" alt="" >
                    @endif
                </div></a>
                <div class="foucusman_photo_text">
                    <p class="sjsmc">{{$v['nickname']}}</p>
                    <p class="dzzc"><span class="dz">{{$v['dtname']}}</span><span class="sx"></span><span class="zc">{{$v['profession']}}</span></p>
                    <p class="zofs"><span class="zp">作品&nbsp;{{$v['0']}}</span><span class="sx"></span><span class="fs">粉丝&nbsp;{{$v['1']}}</span></p>
                </div>
                <div class="gz algz" kjid="{{ $v['focus_uid'] }}" >已关注</div>
                <!-- <div  class="gz_qx">
                    <div class="gz_qx_gb"><label for="qxmyModal-{{ $v['id'] }}"><img src="{!! Theme::asset()->url('images/type/关闭icon.png') !!}" alt="" class="foucusman_photo_littlebox_photo"></label></div>
                    <div class="gz_qx_ms">是否取消关注？</div>
                    <div class="gz_qx_qdqx">
                        <button class="gz_qx_qdqx_qd" data-dismiss="modal" onclick="removeFocus({{ $v['id'] }})">确定</button>
                        <button id="qxmyModal-{{ $v['id'] }}" class="gz_qx_qdqx_qx" data-dismiss="modal">取消</button>
                    </div>
                </div> -->
            </div>
            @if($v['data'])
            @foreach($v['data'] as $cover)
                <a href="{!! URL('/bre/serviceCaseDetail/'.$cover->id.'/'.$cover->uid) !!}" target="_blank"><div class="foucusman_photo_png">
                    @if($cover->cover)
                        <img src="{!! ossUrl($cover->cover) !!}" alt="" class="foucusman_photo_pngone">
                    @else
                        <img src="{{Theme::asset()->url('images/employ/bg2.jpg')}}" alt="" class="foucusman_photo_pngone">
                    @endif
                </div></a>
            @endforeach
            @endif
            <div class="foucusman_photo_gd">
                <a href="{!! URL('/bre/serviceEvaluateDetail/'.$v['focus_uid']) !!}" target="_blank"><img src="{!! Theme::asset()->url('images/更多.png') !!}" alt="" class="foucusman_photo_gdxx"></a>
            </div>
        </div>
        @endforeach
        @else
        <div class="no_works">
            <img src="{{Theme::asset()->url('images/meishimeitu/personal/collect_img.png')}}" alt="">
        </div>
        @endif
        <div class="paging_bootstrap">
            {!! $focus->appends($_GET)->render() !!}
        </div>
    </li>

    
</ul>
{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('userfocus','js/doc/userfocus.js') !!}

{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('userfocus','css/meishimeitu/userfocus.css') !!}