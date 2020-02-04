<div class="middleman">
    <div class="middleman_headline">
        <img src="{!! Theme::asset()->url('images/Social_normal.png') !!}" alt="" class="">
        <span>我是经纪人</span>
        @if(!empty($broker))
            <div class="">我的经纪人ID：<span>{{$broker['id']}}</span></div>
        @endif
    </div>
    <div class="standard">
        <div class="standard_head">经纪人规范</div>
        <div class="attention">
            <h4>注意事项：</h4>
            <h4>1、必须进行经纪人实名认证。</h4>
            <h4>2、必须进行经纪人入驻后，才可以进行项目的代发布。</h4>
            <h4>3、必须对后续产生的交易纠纷进行协调。</h4>
            <h4>4、必须对项目进度进行动态追踪和项目状态更新及时反馈。</h4>
            <h4>5、经纪人需要缴纳1000元的项目保证金（保证金可全额退回），才可以进行项目代发布赚取佣金。</h4>
        </div>
        @if(!empty($broker))
            <a href="/task/type?bid={{$broker['id']}}&man=0" target="_blank"><div class="demand">发布需求</div></a>
        @else
            <a href=""><div class="demand">暂未开放</div></a>
        @endif
    </div>
</div>


























{!! Theme::asset()->container('custom-css')->usepath()->add('middleman','css/meishimeitu/middleman.css') !!}

