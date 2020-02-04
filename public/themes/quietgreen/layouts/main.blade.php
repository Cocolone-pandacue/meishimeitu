<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{!! strip_tags(Theme::get('title'),'<img>') !!}</title>
    <meta name="keywords" style="display:none;" content="{!!  Theme::get('keywords') !!}">
    <meta name="description" content="{!! Theme::get('description') !!}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if(Theme::get('engine_status')==1)
    <meta name="robots" content="noindex,follow">
    @endif
    @if(isset(Theme::get('basis_config')['css_adaptive']) && Theme::get('basis_config')['css_adaptive'] == 1)
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    @else
        <meta name="viewport" content="initial-scale=0.1">
    @endif
    <meta property="qc:admins" content="232452016063535256654" />
    <meta property="wb:webmaster" content="19a842dd7cc33de3" />
    @if(!empty(Theme::get('site_config')['browser_logo']) && is_file(Theme::get('site_config')['browser_logo']))
        <link rel="shortcut icon" href="{{ url(Theme::get('site_config')['browser_logo']) }}" />
    @else
        <link rel="shortcut icon" href="{{ Theme::asset()->url('images/favicon.ico') }}" />
        @endif
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="/themes/quietgreen/assets/plugins/bootstrap/css/bootstrap.min.css">
    {!! Theme::asset()->container('specific-css')->styles() !!}
    <link rel="stylesheet" href="/themes/quietgreen/assets/plugins/ace/css/ace.min.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/index/common.css"/>
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/homehead.css"/>

    <link rel="stylesheet" href="/themes/quietgreen/assets/css/index/case.css"/>
    {!! Theme::asset()->container('old-css')->styles() !!}
    {{--<link rel="stylesheet" href="/themes/default/assets/css/main.css">--}}
    <link rel="stylesheet" href="/themes/default/assets/css/header.css">
    <!-- 翻页按钮样式 -->
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/pagelist.css"/>
    {{--<link rel="stylesheet" href="/themes/default/assets/css/footer.css">--}}

    {{--<link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css"/>--}}
    {{--<link rel="stylesheet" href="../../assets/plugins/ace/css/ace.min.css">--}}
    {{--<link rel="stylesheet" href="../../assets/css/font-awesome.min.css"/>--}}
    {{--<link rel="stylesheet" href="../../assets/css/index/common.css"/>--}}

    <link rel="stylesheet" href="/themes/quietgreen/assets/css/{!! Theme::get('color') !!}/style.css">
    {!! Theme::asset()->container('custom-css')->styles() !!}
    {{--<script src="/themes/default/assets/plugins/ace/js/ace-extra.min.js"></script>--}}
    <link rel="stylesheet" type="text/css" href="/themes/quietgreen/assets/css/footer.blade.css">
     <!-- 自定义layer样式 -->
    <link rel="stylesheet" type="text/css" href="/themes/quietgreen/assets/css/define_layer.css">
    <!-- 响应式自定义样式 -->
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/xiangyingshi.css"/>

</head>
<body>
<!-- <section class="xiangmuku">
</section> -->

<header class="oheader">
    {!! Theme::partial('homeheader') !!}
</header>

{!! Theme::content() !!}
<div class="bottom_guide">
    <a class="" href="/">
        <span class="">首页</span>
    </a>
    <a class="" href="/task/type">
        <span class="">发布项目</span>
    </a>
    <a class="" href="/task">
        <span class="">项目库</span>
    </a>
    <a class="" href="{!! url('user/goodsShop') !!}">
        <span class="">个人中心</span>
    </a>
</div>

<footer>
    {!! Theme::partial('footer') !!}
</footer>

<script src="/themes/quietgreen/assets/plugins/jquery/jquery.min.js"></script>
<script src="/themes/quietgreen/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
{{--<script src="/themes/default/assets/plugins/ace/js/ace.min.js"></script>--}}
{{--<script src="/themes/default/assets/plugins/ace/js/ace-elements.min.js"></script>--}}
<script src="/themes/quietgreen/assets/js/common.js"></script>
<script src="/themes/quietgreen/assets/js/index.js"></script>
<script src="/themes/quietgreen/assets/plugins/jquery/layer/layer/layer.js"></script>
<script src="/themes/quietgreen/assets/js/objectdetail.js"></script>



{{--<script src="/themes/default/assets/js/nav.js"></script>--}}

{!! Theme::asset()->container('specific-js')->scripts() !!}

{!! Theme::asset()->container('custom-js')->scripts() !!}
{!! Theme::asset()->container('cistom-css')->scripts() !!}
</body>

