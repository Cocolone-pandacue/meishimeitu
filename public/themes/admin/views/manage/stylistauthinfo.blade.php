{{--<div class="space-2"></div>--}}
{{--<div class="page-header">--}}
    {{--<h1>--}}
        {{--实名认证详细信息--}}
    {{--</h1>--}}
{{--</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">设计师认证详细信息</h3>
<div class="g-backrealdetails clearfix bor-border">
@foreach($stylist_case as $s)
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">案例名称：</p>
        <p class="col-md-11">{{$s[0]->case_title}}</p>
        <p class="col-md-1 text-right">案例设计类型：</p>
        <p class="col-md-11">{{$design_type[$s[0]->design_type]->design}}</p>
        <p class="col-md-1 text-right">案例类型：</p>
        <p class="col-md-11">{{$case_type[$s[0]->case_type]}}</p>
    </div>
        <p class="col-md-2 text-right">设计师上传的文件：</p>
        @foreach($s[1] as $a)
        {{--@foreach($a as $i=>$n)--}}
        <div>
            <div class="realname-bottom clearfix col-xs-12">
                <p class="col-md-1 text-right"><img style="height: 36px;width: 50px;" src="{!! Theme::asset()->url('images/zip.png') !!}" alt=""></p>
            </div>
            <p class="col-md-1 text-right">{{$a->name}}</p>
            <p class="col-md-1 text-right" ><a href="{!! url('manage/stylistDownload/' . $a->attachment_id) !!}" target="_blank">下载</a></p>
        </div>
        {{--@endforeach--}}
        @endforeach
@endforeach
    @if($stylist->status == 0)
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <div class="col-md-10"><a href="{!! url('/manage/stylistAuthHandle/'. $stylist->id. '/pass') !!}" class="btn btn-primary btn-sm">审核通过</a></div>

                </div>
            </div>
        </div>
    @endif


</div>
</div>


{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}