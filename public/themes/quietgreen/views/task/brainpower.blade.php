<div class="artificial_intelligence_wrap ">
    <!-- 智能工具首页 -->
    <div class="ai_home ">
        <span class="word_tip">点我,点我！</span>
        <a href="{{url('task/brainpower/questionnaire')}}" class="art_int_img"></a>
        <span class="ailogo"></span>
        <span class="aiposter"></span>
        <span class="aitypesetting"></span>
    </div>
</div>




{!! Theme::asset()->container('custom-css')->usepath()->add('brainpower','css/meishimeitu/brainpower.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('reset','css/meishimeitu/reset.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('robot','css/meishimeitu/robot.css') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('brainpower','js/meishimeitu/brainpower.js') !!}