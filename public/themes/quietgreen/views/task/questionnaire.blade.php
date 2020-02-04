<form action="/task/brainpower/result" method="post">
{{ csrf_field() }}
<!-- 智能工具问卷 -->
<div class="artificial_intelligence_box ">

    <!-- 智能工具第一步 -->
    <div class="ai_one_step ">
        <p class="one_step_p clearfix">
            <span class="ai_img"></span>
            <span class="ai_one_tip">
                请输入<span class="red_word">品牌名称</span>和<span class="red_word">品牌标语</span>
            </span>
        </p>

        <div class="brand_box">
            <label>
                <span class="hint_name">品牌名称</span><input name="name" class="pname" type="text">
                <span class="pp_name">请输入中文或英文</span>
            </label>
            <label>
                <span class="hint_name">品牌标语</span><input name="title" class="ptip" type="text">
                <span class="pp_tip">请输入中文或英文(选填)</span>
            </label>
        </div>

        <a href="javascript:;" class="ai_one_next ai_oneNext waves">下一步</a>
    </div>

    <!-- 智能工具第二步 行业选择 -->
    <div class="ai_two_step hide">
        <span class="ai_img"></span>
        <span class="ai_two_tip">
            请选择您公司的<span class="red_word">所属行业</span>
        </span>
        <ul class="industry_box clearfix">
            @foreach($industry as $i)
                <li class="internet_head{{$i->value_id}} border_a">
                    <a href="javascript:;">
                        <img class="industry_img " src="{!! Theme::asset()->url($i->pic) !!}" alt="">
                        <img class="industry_img_hover hide" src="{!! Theme::asset()->url($i->pic_hover) !!}" alt="">
                        <span class="industry_word">{{$i->name}}</span>
                        <input type="text" name="" value={{$i->value_id}}>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- 互联网 -->
    <div class="artificial_intelligence_box internet_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>

            </p>
        </div>
    </div>


    <!-- 电子商务 -->
    <div class="artificial_intelligence_box E_commerce_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>

    <!-- 餐饮 -->
    <div class="artificial_intelligence_box restaurant_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>

    <!--服饰 -->
    <div class="artificial_intelligence_box dress_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>

    <!-- 金融 -->
    <div class="artificial_intelligence_box finance_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>

    <!-- 电子 -->
    <div class="artificial_intelligence_box Mechanics_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>

    <!-- 教育 -->
    <div class="artificial_intelligence_box education_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
        </div>
    </div>

    <!-- 房地产 -->
    <div class="artificial_intelligence_box realty_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>

    <!-- 医药 -->
    <div class="artificial_intelligence_box medicine_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>

    <!-- 政府 -->
    <div class="artificial_intelligence_box government_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>

    <!-- 文化 -->
    <div class="artificial_intelligence_box culture_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>


    <!-- 其他 -->
    <div class="artificial_intelligence_box other_box hide">
        <!-- 智能工具第三步 模块选择-->
        <div class="ai_three_step">
            <span class="ai_img"></span>
            <span class="ai_two_tip">
                请选择<span class="red_word">5个以上</span>您喜欢的LOGO
            </span>
            <ul class="logo_box clearfix">
                @foreach($logo1 as $l)
                    <li class="border_a">
                        <img class="logo_img" src="{!! Theme::asset()->url($l->pic) !!}" alt="">
                        <img class="logo_img_sele hide" src="{!! Theme::asset()->url($l->pic_hover) !!}" alt="">
                        <span class="check"></span>
                        <input type="text" name="" value={{$l->value_id}}>
                    </li>
                @endforeach
            </ul>
            <p class="mukuai_num">请选取&nbsp;<span class="spannum">0</span>/5&nbsp;LOGO模板</p>
            <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="previous_step waves border_btn">上一步</a>
                    <a href="javascript:;" class="next_step  " >下一步</a>
                </span>
            </p>
        </div>
    </div>

    <!-- 颜色选择 -->
    <div class="ai_color_sele hide">
        <span class="ai_img"></span>
        <span class="ai_two_tip">
            请选择品牌<span class="red_word">主色调</span>
        </span>

        <ul class="color_sele_wrap clearfix">
            <li class="black">
                <img class="colorImg" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/black.png') !!}" alt="">
                <span class="check_color"></span>
                <input type="text" name="" value="1">
                <img class="colorImg_hovr" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/black.svg') !!}" alt="">
                <span class="float_word">Black</span>
            </li>
            <li class="yellow">
                <img class="colorImg" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/yellow.png') !!}" alt="">
                <span class="check_color"></span>
                <input type="text" name="" value="2">
                <img class="colorImg_hovr" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/yellow.svg') !!}" alt="">
                <span class="float_word">Yellow</span>
            </li>
            <li class="purple">
                <img class="colorImg" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/purple.png') !!}" alt="">
                <span class="check_color"></span>
                <input type="text" name="" value="3">
                <img class="colorImg_hovr" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/purple.svg') !!}" alt="">
                <span class="float_word">Purple</span>
            </li>
            <li class="orange">
                <img class="colorImg" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/orange.png') !!}" alt="">
                <span class="check_color"></span>
                <input type="text" name="" value="4">
                <img class="colorImg_hovr" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/orange.svg') !!}" alt="">
                <span class="float_word">Orange</span>
            </li>

            <li class="brown">
                <img class="colorImg" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/brown.png') !!}" alt="">
                <span class="check_color"></span>
                <input type="text" name="" value="5">
                <img class="colorImg_hovr" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/brown.svg') !!}" alt="">
                <span class="float_word">Brown</span>
            </li>
            <li class="green">
                <img class="colorImg" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/green.png') !!}" alt="">
                <span class="check_color"></span>
                <input type="text" name="" value="6">
                <img class="colorImg_hovr" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/green.svg') !!}" alt="">
                <span class="float_word">Green</span>
            </li>
            <li class="blue">
                <img class="colorImg" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/blue.png') !!}" alt="">
                <span class="check_color"></span>
                <input type="text" name="" value="7">
                <img class="colorImg_hovr" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/blue.svg') !!}" alt="">
                <span class="float_word">Blue</span>
            </li>
            <li class="red">
                <img class="colorImg" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/red.png') !!}" alt="">
                <span class="check_color"></span>
                <input type="text" name="" value="8">
                <img class="colorImg_hovr" src="{!! Theme::asset()->url('images/meishimeitu/artificial_intelligence/red.svg') !!}" alt="">
                <span class="float_word">Red</span>
            </li>
        </ul>

        <p class="btn_a_box clearfix">
                <span class="btn_a_p clearfix">
                    <a href="javascript:;" class="color_previous_step waves border_btn">上一步</a>
                    {{--<a href="{{url('task/brainpower/processing')}}" class="co_next_step" >下一步</a>--}}
                    <a href="#" class="input_a "><input type="submit"  class="co_next_step waves border_btn" value="下一步"></a>
                </span>

        </p>

    </div>

</div>


</form>

{!! Theme::asset()->container('custom-css')->usepath()->add('brainpower','css/meishimeitu/brainpower.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('reset','css/meishimeitu/reset.css') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('waves','js/meishimeitu/waves.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('brainpower','js/meishimeitu/brainpower.js') !!}