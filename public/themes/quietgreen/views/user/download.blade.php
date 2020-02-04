<!-- <div class="download_head_wrap g-releasetask clearfix">
    <p class="download_head"><span>我的下载</span></p>
    <div class="space-12"></div> -->

    <!-- 状态 -->
    <!-- <div class="col-lg-12 clearfix title_box">
        <div class="col-lg-1 cor-gray51 text-size14 col-sm-2 col-xs-12">
            <div class="row row_title">全部</div>
        </div>
        <div class="col-lg-11 col-sm-10  col-xs-12 g-task-select">
            <a class="all_title" href="">全部</a>
        </div>
    </div>
</div> -->
<!-- 以上为旧版本 -->

    <!-- 作品下载 -->
 <ul class="mydownload">
    <li class="mydownload_fenlei">
        <p class="mydownload_biaoti">
            <span><img src="{!! Theme::asset()->url('images/Download.png') !!}" alt="" class="mydownload_biaoti_photo"></span>
            <span class="mydownload_biaoti_text">我的下载</span>
        </p>
        <div class="mydownload_xifen_leixing">
            <a href="/user/download" class="clickys">作品下载</a>
            <a href="/user/DownloadBrainpower">辅助工具</a>
        </div>
        <p class="mydownload_xifen_zhuangtai ageshi">
            <span>类型</span>
            <a href="#">全部</a>
            <a href="#">LOGO/VI</a>
            <a href="#">网页</a>
            <a href="#">名片</a>
            <a href="#">海报</a>
            <a href="#">宣传册</a>
            <a href="#">传单</a>
            <a href="#">包装</a>
            <a href="#">字体</a>
        </p>
    </li>
    <li class="mydownload_photo">
        {{--<div class="mydownload_photo_biaoti">共22个下载</div>--}}
        {{--<div class="mydownload_photo_box">--}}
            {{--<div class="mydownload_photo_littlebox">--}}
                {{--<p class="mydownload_photo_littlebox_photobox">--}}
                    {{--<img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="mydownload_photo_littlebox_photo">--}}
                {{--</p>--}}
                {{--<p class="mydownload_photo_littlebox_text">标题</p>--}}
                {{--<p class="mydownload_photo_littlebox_atext">分类</p>--}}
                {{--<p class="mydownload_photo_littlebox_icon">--}}
                    {{--<span class="mydownload_photo_littlebox_icon_liulanshu"><img src="{!! Theme::asset()->url('images/浏览图标.png') !!}" alt="">0</span>--}}
                    {{--<span class="mydownload_photo_littlebox_icon_shoucangshu"><img src="{!! Theme::asset()->url('images/收藏图标.png') !!}" alt="">0</span>--}}
                    {{--<span class="mydownload_photo_littlebox_icon_xiazaishu"><img src="{!! Theme::asset()->url('images/下载图标.png') !!}" alt="">0</span>--}}
                {{--</p>--}}
                {{--<p class="mydownload_photo_littlebox_zuidibu">--}}
                    {{--<span class="mydownload_photo_littlebox_zuidibu_bj"><img src="{!! Theme::asset()->url('images/头像.png') !!}" alt=""></span>--}}
                    {{--<span class="mydownload_photo_littlebox_zuidibu_sc">作者名称</span>--}}
                    {{--<span class="mydownload_photo_littlebox_zuidibu_djs">1小时前</span>--}}
                {{--</p>--}}
            {{--</div>--}}
        {{--</div>  --}}
        <div class="no_works">
            <img src="{{Theme::asset()->url('images/meishimeitu/personal/no_works.png')}}" alt="">
        </div>
    </li>
    <!-- 作品下载 结束 -->

    <!-- 辅助工具 -->

{{--<ul class="mydownload">--}}
    {{--<li class="mydownload_fenlei">--}}
        {{--<p class="mydownload_biaoti">--}}
            {{--<span><img src="{!! Theme::asset()->url('images/Download.png') !!}" alt="" class="mydownload_biaoti_photo"></span>--}}
            {{--<span class="mydownload_biaoti_text">我的下载</span>--}}
        {{--</p>--}}
        {{--<div class="mydownload_xifen_leixing">--}}
            {{--<a href="/user/download" class="clickys">作品下载</a>--}}
            {{--<a href="/user/DownloadBrainpower">辅助工具</a>--}}
        {{--</div>--}}
        {{--<p class="mydownload_xifen_zhuangtai">--}}
            {{--<span>类型</span>--}}
            {{--<a href="#">全部</a>--}}
            {{--<a href="#">简单套餐</a>--}}
            {{--<a href="#">普通套餐</a>--}}
            {{--<a href="#">专业套餐</a>--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li class="mydownload_photo">--}}
        {{--<div class="mydownload_photo_biaoti">共22个下载</div>--}}
        {{--<div class="mydownload_photo_box">--}}
            {{--<div class="mydownload_photo_littlebox_fuzhu" data-toggle="modal" data-target="#mydownload_id"> --}}
                {{--<img src="" alt="" class="mydownload_photo_littlebox_fuzhu_pnoto">--}}
            {{--</div>--}}
            {{--<div id="mydownload_id" tabindex="-1" role="dialog" class="fade xz_model">--}}
                {{--<div class="xz_model_photo">--}}
                    {{--<img src="" alt="" class="">--}}
                {{--</div>--}}
                {{--<div class="xz_model_photo">--}}
                    {{--<img src="" alt="" class="">--}}
                {{--</div>--}}
                {{--<div class="xz_model_photo">--}}
                    {{--<img src="" alt="" class="">--}}
                {{--</div>--}}
                {{--<div class="xz_model_photo_big">--}}
                    {{--<img src="" alt="" class="">--}}
                {{--</div>--}}
                {{--<div class="xz_model_lbbox">--}}
                    {{--<div class="jpgxz">--}}
                        {{--<a href="javascript:;" class="jpgxz_lj onloadJpg">JPG下载</a>--}}
                        {{--<span>尺寸为800*800px的高清LOGO，不可编辑</span>--}}
                    {{--</div>--}}
                    {{--<div class="pngxz">--}}
                        {{--<a href="javascript:;" class="pngxz_lj onloadPng">PNG下载</a>--}}
                        {{--<span>尺寸为800*800px的高清无背景LOGO</span>--}}
                    {{--</div>--}}
                    {{--<div class="epsxz">--}}
                        {{--<a href="javascript:;" class="epsxz_lj onloadEps">EPS下载</a>--}}
                        {{--<span>可编辑的矢量图源文件</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="xz_model_qxxz" data-dismiss="modal">--}}
                    {{--<img src="{!! Theme::asset()->url('images/type/关闭icon.png') !!}" alt="" class="">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>  --}}
    {{--</li>--}}

    {{--<!-- 辅助工具 结束 -->--}}


    {{--<div class="paging_bootstrap text-center">--}}
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
    {{--</div>--}}
{{--</ul>--}}



<!-- 当没有下载作品 -->
<!-- <div class="download_content">
    <img src="{{Theme::asset()->url('images/meishimeitu/personal/collect_img.png')}}" alt="">
</div> -->
<!-- 当没有下载作品 结束 -->

{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('myfocus','css/meishimeitu/download.css') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('download','js/meishimeitu/download.js') !!}


<!-- 个人中心 我的项目 导航栏点击效果 -->
{!! Theme::asset()->container('custom-js')->usepath()->add('usermenu','js/doc/usermenu.js') !!}


