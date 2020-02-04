{!! Theme::widget('wrapBox_fbxm')->render() !!}
<div class="project_success">
    <div class="project_success_title">
        <p>平台审核</p>
    </div>
    <div class="project_success_content">
        <div class="clearfix">
            <div class="fl"><img src="{!! Theme::asset()->url('images/type/sign-icon1.png') !!}" alt=""></div>
            <div class="fl">
                <p>恭喜您项目发布成功，请您耐心等待美视美图后台审核！</p>
                <p>如果长时间未通过审核，请立即<a href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes">联系管理员</a></p>
                <p><a href="{{url('task/type')}}">继续发布项目</a><a href="{{ url('/user/myTasksList') }}">查看项目</a></p>
            </div>
            <p><a href="{{url()}}">点击跳转首页(<span id="down">5</span>秒)>>></a></p>
        </div>
        {{--{!! Theme::asset()->container('custom-js')->usepath()->add('task', 'js/doc/task.js') !!}--}}
    </div>
</div>

<script type="text/javascript">
    var cutDown=5;//设定跳转的时间
    setInterval("refer()",1000); //启动1秒定时
    function refer(){
        if(cutDown===0){
            location="{!! url('') !!}"; //#设定跳转的链接地址
        }
        if(cutDown>-1){
            document.getElementById('down').innerHTML=""+cutDown+""; // 显示倒计时
            cutDown--; // 计数器递减
        }

    }
</script>
<!-- 项目资金托管成功结束 -->
{!! Theme::asset()->container('old-css')->usepath()->add('release_css','css/type/release.project.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('step','css/type/step.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('step','css/type/two.css') !!}

{{--{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}--}}
{{--{!! Theme::asset()->container('custom-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}--}}
{{--{!! Theme::widget('ueditor')->render() !!}--}}
{{--{!! Theme::widget('datepicker')->render() !!}--}}
{{--{!! Theme::widget('fileUpload')->render() !!}--}}

{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

{{--及时查询js--}}
{{--{!! Theme::asset()->container('custom-js')->usepath()->add('publishajax', 'js/type/publishajax.js') !!}--}}
{!! Theme::asset()->container('custom-js')->usepath()->add('release_js', 'js/type/release.project.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('step', 'js/type/step.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('test', 'js/type/test.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('public_js', 'js/type/public_js.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('four', 'js/type/four.js') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('wrapBox_fbxm','css/type/wrapBox_fbxm.css') !!}
