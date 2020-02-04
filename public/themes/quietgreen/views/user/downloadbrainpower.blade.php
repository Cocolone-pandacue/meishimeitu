<!-- 下载模态框 -->
@if($brainpower_data['data'] !=null)
    @foreach($brainpower_data['data'] as $b)
<div id="mydownload_{{$b->logo_id}}" class="xz_model">
    <div class="xz_model_photo">
        {{--<img src="" alt="" class="">--}}
        {!! $b->svg !!}
    </div>
    <div class="xz_model_photo">
        {{--<img src="" alt="" class="">--}}
        {!! $b->svg !!}
    </div>
    <div class="xz_model_photo">
        {{--<img src="" alt="" class="">--}}
        {!! $b->svg !!}
    </div>
    <div class="xz_model_photo_big">
        {{--<img src="" alt="" class="">--}}
        {!! $b->svg !!}
    </div>
    <div class="xz_model_lbbox">
        <div class="jpgxz">
            <a href="javascript:;" class="jpgxz_lj onloadJpg">JPG下载</a>
            <span>尺寸为800*800px的高清LOGO，不可编辑</span>
        </div>
        <div class="pngxz">
            <a href="javascript:;" class="pngxz_lj onloadPng">PNG下载</a>
            <span>尺寸为800*800px的高清无背景LOGO</span>
        </div>
        <!-- <div class="epsxz">
            <a href="javascript:;" class="epsxz_lj onloadEps">EPS下载</a>
            <span>可编辑的矢量图源文件</span>
        </div> -->
    </div>
</div>
    @endforeach
@endif
<!-- 下载模态框 结束 -->
<ul class="mydownload">
    <li class="mydownload_fenlei">
        <p class="mydownload_biaoti">
            <span><img src="{!! Theme::asset()->url('images/Download.png') !!}" alt="" class="mydownload_biaoti_photo"></span>
            <span class="mydownload_biaoti_text">我的下载</span>
        </p>
        <div class="mydownload_xifen_leixing">
            <a href="/user/download" >作品下载</a>
            <a href="/user/DownloadBrainpower" class="clickys">辅助工具</a>
        </div>
        <p class="mydownload_xifen_zhuangtai">
            <span>类型</span>
            <a href="#">全部</a>
            <a href="#">简单套餐</a>
            <a href="#">普通套餐</a>
            <a href="#">专业套餐</a>
        </p>
    </li>
    <li class="mydownload_photo">
        <div class="mydownload_photo_biaoti">共{{$brainpowernum}}个下载</div>
        <div class="mydownload_photo_box">
            @if($brainpower_data['data'] !=null)
                @foreach($brainpower_data['data'] as $b)
                <div class="mydownload_photo_littlebox_fuzhu" data-target="#mydownload_{{$b->logo_id}}">
                    {{--<img src="" alt="" class="mydownload_photo_littlebox_fuzhu_pnoto">--}}
                    {!! $b->svg !!}
                </div>
                @endforeach
            @else
                <div class="no_works">
                    <img src="{{Theme::asset()->url('images/meishimeitu/personal/no_works.png')}}" alt="">
                </div>
            @endif
        </div>
        <div class="paging_bootstrap">
            {!! $brainpower->appends($_GET)->render() !!}
        </div>
    </li>
    <!-- 辅助工具 结束 -->
</ul>

{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('myfocus','css/meishimeitu/download.css') !!}
{{--{!! Theme::asset()->container('specific-js')->usepath()->add('resultjs','js/meishimeitu/result.js') !!}--}}
{!! Theme::asset()->container('custom-js')->usepath()->add('download','js/meishimeitu/download.js') !!}
