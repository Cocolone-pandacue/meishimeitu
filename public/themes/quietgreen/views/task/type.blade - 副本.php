{!! Theme::widget('wrapBox')->render() !!}
<!-- 选择您项目的设计类型 -->
<div class="project_content ">
    <!-- 中间 -->
    <p>选择您项目的设计类型</p>
    <ul class="project_type clearfix ">
        @foreach($catenew as $c)
        <li id="logo_info">
            <a class="logo_info_a"  href="/task/createnew/{{$c['id']}}/?a=01">
                {{--<div style="display: none">{{$a = Theme::get('task_cate')[$j]['pic']}}</div>--}}
                <img src="{!! ossUrl($c['pic']) !!}" alt="">
                <p class="type_name">{{$c['name']}}</p>
            </a>
        </li>
        @endforeach
        <li id="other_type" tabindex = "0">
            <a href="javascript:;">
                <img src="{!! Theme::asset()->url('images/type/logo设计.png') !!}">
                <p class="type_name">其他</p>
            </a>
        </li>
    </ul>

</div>
<!-- 选择您项目的设计类型结束 -->
<div class="other_type clearfix hide">
    <div class="other_type_wrap clearfix">
        <ul class="other_type_title_box clearfix">
            @for($j = 0; $j < count(Theme::get('task_cate')); $j++)
            <li class="other_type_title"><a href="javascript:;">{!! Theme::get('task_cate')[$j]['name'] !!}</a><!-- /task/createnew/{{$a = Theme::get('task_cate')[$j]['id']}} -->
                {{--@for($j = 0; $j < count(Theme::get('task_cate')); $j++)--}}
                <ul class="other_type_content">
                    @for($i =0 ;$i < count(Theme::get('task_cate')[$j]['child_task_cate']); $i++)
                    <li><a href="/task/createnew/{!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['id'] !!}">{!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}</a></li>
                    @endfor
                </ul>
                {{--@endfor--}}
            </li>
            @endfor
        </ul>
    </div>
</div>



<!-- 描述您LOGO的需求信息 -->

{!! Theme::asset()->container('old-css')->usepath()->add('release_css','css/type/release.project.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('step','css/type/step.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('step', 'js/type/onestep.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('release_js', 'js/type/release.project.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('test', 'js/type/test.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('public_js', 'js/type/public_js.js') !!}

