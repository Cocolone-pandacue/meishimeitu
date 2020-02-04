<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ Theme::get('title') }}</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">--}}
    @if(isset(Theme::get('basis_config')['css_adaptive']) && Theme::get('basis_config')['css_adaptive'] == 1)
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    @else
        <meta name="viewport" content="initial-scale=0.1">
        @endif
    @if(!empty(Theme::get('site_config')['browser_logo']) && is_file(Theme::get('site_config')['browser_logo']))
        <link rel="shortcut icon" href="{{ url(Theme::get('site_config')['browser_logo']) }}" />
    @else
        <link rel="shortcut icon" href="{{ Theme::asset()->url('images/favicon.ico') }}" />
        @endif
    <!-- Place favicon.ico in the root directory -->.
    <!-- 自定义layer样式 -->
    <link rel="stylesheet" type="text/css" href="/themes/quietgreen/assets/css/define_layer.css">

    <link rel="stylesheet" href="/themes/quietgreen/assets/plugins/bootstrap/css/bootstrap.min.css">
    {!! Theme::asset()->container('specific-css')->styles() !!}
    {{--<link rel="stylesheet" href="/themes/quietgreen/assets/css/ace/jquery.gritter.css">--}}
    <link rel="stylesheet" href="/themes/quietgreen/assets/plugins/ace/css/ace.min.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/main.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/header.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/index/common.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/homehead.css"/>
    <!-- 翻页按钮样式 -->
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/pagelist.css"/>
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/usercenter/finance/finance-layout.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/usercenter/userslidebar.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/{!! Theme::get('color') !!}/style.css">
    <link rel="stylesheet" href="/themes/quietgreen/assets/css/{!! Theme::get('color') !!}/user.css">
    <link rel="stylesheet" type="text/css" href="/themes/quietgreen/assets/css/footer.blade.css">
    <link rel="stylesheet" type="text/css" href="/themes/quietgreen/assets/css/meishimeitu/userinfo.css">
    {!! Theme::asset()->container('custom-css')->styles() !!}
</head>
<body>
<header class="oheader">
    {!! Theme::partial('homeheader') !!}
</header>
<section>
    <div class="container">
        <div class="row">
            <div class="visible-sm-block visible-xs-block g-sdb">
                {!! Theme::partial('userinfoother') !!}
            </div>
            <div class="box_left">
                <div class="focuside">
                {!! Theme::partial('userinfosidebar') !!}</div>
            </div>
            <div class="box_right">
                {!! Theme::content() !!}
            </div>
        </div>
    </div>
</section>

<footer>
    {!! Theme::partial('footer') !!}
</footer>

@if((preg_match('/^\/user\/skill/',$_SERVER['REQUEST_URI'])))
<script src="/themes/quietgreen/assets/plugins/jquery/jquery.min.js"></script>
@else
<script src="/themes/quietgreen/assets/js/doc/jquery.min.js"></script>
@endif
<script src="/themes/quietgreen/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- layer弹窗插件 -->

<script src="/themes/quietgreen/assets/plugins/jquery/layer/layer/layer.js"></script>
<script src="/themes/quietgreen/assets/plugins/ace/js/ace.min.js"></script>
<script src="/themes/quietgreen/assets/plugins/ace/js/ace-elements.min.js"></script>
<script src="/themes/quietgreen/assets/js/common.js"></script>
<script src="/themes/quietgreen/assets/js/meishimeitu/userinfo.js"></script>
<script src="/themes/quietgreen/assets/js/objectdetail.js"></script>


{!! Theme::asset()->container('specific-js')->scripts() !!}

{!! Theme::asset()->container('custom-js')->scripts() !!}



</body>
</html>
