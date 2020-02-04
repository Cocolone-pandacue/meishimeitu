<div class="middleman_success">
    <div class="publish_success">
        <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="" class="">
        <div class="textStyle">
            <p>恭喜你发布项目成功，请复制链接发送给你的雇主！</p>
            <p>如果长时间未托管资金，系统将会视为无效项目。</p>
            <a href="/task/type?bid={{$id}}&man=0">继续发布项目</a>
        </div>
    </div>
    <div class="link">{{$link}}
    </div>
    <div class="linkBtn">复制链接</div>
</div>

























{!! Theme::asset()->container('custom-css')->usepath()->add('middleman_success','css/meishimeitu/middleman_success.css') !!}