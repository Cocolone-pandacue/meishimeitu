{!! Theme::widget('wrapBox')->render() !!}
<form action="/task/createTaskNew" method="post" id="form" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
{!! csrf_field() !!}
<div class="logo_info  ">
    <div class="logo_info_title">
        <p>填写“{{$task['name']}}”的详细需求</p>
        <input type="hidden" name="cate_id" value="{{$task['id']}}">
        {{--<input type="hidden" name="brainpower_id" value="{{$brainpower_id}}">--}}
        <!-- <p>描述您LOGO的需求信息</p> -->
        <!--  <p>如果您不想写需求详情，则可付费由我们客服帮您代写</p> -->
    </div>
    <ul class="logo_info_content">
        <li class="clearfix">
            <p>为您的项目命名<span class="red_word">*</span></p>
            <p>
                <input type="text" id="proName" class="material_input" name="title" @if(!$brainpower == null) value="{{$brainpower->brand_name}}" @endif>
                <span class="checkRong" id="checkProject"></span>
            </p>
        </li>
        <li class="clearfix program_budget" >
            <p>您的项目预算<span class="red_word">*</span></p>
            <p>
                <select class="select_m" name="bounty1"><!--  onchange="selectChange()" -->
                    <option value="200">200￥</option>
                    <option value="500">500￥</option>
                    {{--印刷设计和产品商品设计默认预算--}}
                        @if($task['id'] ==166 || $task['pid'] == 166 || $task['id'] ==264 ||$task['pid'] == 264)
                            <option value="1000" selected = "selected">1000￥</option>
                        @else
                            <option value="1000">1000￥</option>
                        @endif
                    {{--LOGO设计和平面设计默认预算--}}
                        @if($task['id'] == 170 || $task['pid'] == 170 || $task['id'] ==167 || $task['pid'] == 167)
                            <option value="2000" selected = "selected">2000￥</option>
                        @else
                            <option value="2000">2000￥</option>
                        @endif
                    <option value="3000" >3000￥</option>
                    {{--游戏设计默认预算--}}
                        @if($task['id'] ==169 || $task['pid'] == 169 || $task['id'] ==265 || $task['pid'] == 265)
                            <option value="5000" selected = "selected">5000￥</option>
                        @else
                            <option value="5000" >5000￥</option>
                        @endif
                    <option value="10000">10000￥</option>
                    {{--网站建设默认预算--}}
                        @if($task['id'] ==168 || $task['pid'] == 168)
                            <option value="20000" selected = "selected">20000￥</option>
                        @else
                        <option value="20000">20000￥</option>
                        @endif
                    <option value="50000">50000￥</option>
                    <option value="100000">100000￥</option>
                    <option id="user_defined"  value="">自定义金额</option>
                </select>
            </p>
            <span class="cls_input_span1 clearfix">
                        <input type="text" name="bounty2" class="cls_input cls_input_m pre_money" value="" placeholder="自定义输入">
                        <span class="fu">￥</span>
                    </span>
            <span class="dan">单位： 元</span>
        </li>
        <li class="clearfix">
            <p>项目描述<span class="red_word">*</span><span class="wen_img"></span></p>
            <p>
                <textarea name="description" id="miaoshu"></textarea>
                <span class="checkRong" id="checkMiaoshu"></span>
            </p>
        </li>
        <li class="clearfix">
            <p>项目时间<span class="red_word">*</span></p>
            <p>
                <select  class="logo_info_time" name="sele_input1" onchange="">
                    <option value="7" selected = "selected">7天</option>
                    <option value="3">3天</option>
                    <option value="14">14天</option>
                    <option value="30">30天</option>
                    <option value="90">90天</option>
                    <option value="" class="zid">自定义</option>
                </select>
                <span>该项目需由<span class="se_year">XXXX</span>年<span class="se_month">XX</span>月<span class="se_date">XX</span>日星期<span class="se_week">X</span>之前完成交稿</span>
            </p>
            <span class="cls_input_span cls_input_span_t">
                <input type="text" name="sele_input" class="cls_input cls_input_t" value="" placeholder="自定义输入">
            </span>
        </li>
        <li class="clearfix">
            <div class="task-bar">
                <p class="">地域<span class="red_word">*</span></p>
                <a class="area-limit" href="javascript:void(0);">不限地区</a>
                <a class="area-limit bar-txt" href="javascript:void(0);">指定地区</a>
                <span id="area_select" style="display: none;">
                    <select name="province" style="margin-left:20px;" onchange="checkprovince(this)">
                        @foreach($province as $v)
                            <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                        @endforeach
                    </select>
                    <select name="city" id="province_check" onchange="checkcity(this)">
                        @foreach($city as $v)
                            <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                        @endforeach
                    </select>
                    <select name="area" id="area_check" onchange="arealimit(this)">
                        @foreach($area as $v)
                            <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                        @endforeach
                    </select>
                </span>
                <span>
                    @foreach($area as $v)
                        <div style="display:none;" id="province-{{ $v['id'] }}">
                            @if(!empty($v['children_area']))
                                @foreach($v['children_area'] as $value)
                                    <option value={{ $v['id'] }}>
                                        {{ $value['name'] }}
                                    </option>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </span>
                <input type="hidden" name="area" id="region-limit" value="0" />
            </div>
        </li>

        <li class="clearfix">
            <p>所属行业<span class="red_word">*</span></p>
            <p>
                <select name="industry" id="industry">
                    <option>请选择行业</option>
                    @foreach($industry as $v)
                    <option value="{{$v->value_id}}" @if(!$brainpower == null && $v->value_id == $brainpower->industry_id) selected="selected" @endif>{{$v->name}}</option>
                    @endforeach
                </select>
            </p>
        </li>

        <li class="clearfix">
            <p>参考产品</p>
            <p><input type="text" name="reference" placeholder="请填写同行优秀的竞品或其他行业可参考的产品"></p>
        </li>
        <li class="clearfix">
            <p>设计风格选择<span class="red_word">*</span></p>
            <div class="select_style fl">
                <ul class="clearfix">
                    <li><p>简约</p></li>
                    <li class="select_bar clearfix">
                        <div class="wrapselect clearfix">
                            <div class="leftselect clearfix">
                                <input  class="jyleft" type="" value="1">
                                <div class="jydiv"></div>
                                <div class="jydiv1"></div>
                            </div>
                            <div class="centerselect clearfix">
                                <input type="" name="moren" class="centerspan" >
                                <span class="centerspanbg"></span>
                                <div class="hldiv"></div>
                            </div>
                            <div class="rightselect clearfix">
                                <input  type="" class="hlright" value="2">
                            </div>
                        </div>
                    </li>
                    <li><p>华丽</p></li>
                </ul>
                <ul class="clearfix">
                    <li><p>古典<!-- <span class="gd btn1"></span> --></p></li>
                    <li class="select_bar clearfix">
                        <div class="wrapselect clearfix">
                            <div class="leftselect clearfix">
                                <input type=""  class="gdleft" value="3">
                                <div class="gddiv"></div>
                                <div class="gddiv1"></div>
                            </div>
                            <div class="centerselect clearfix">
                                <input type="" name="moren" class="centerspan1">
                                <span class="centerspanbg1"></span>
                                <div class="xddiv"></div>
                            </div>
                            <div class="rightselect clearfix">
                                <input type=""  class="xdright" value="4">
                            </div>
                        </div>
                    </li>
                    <li><p><!-- <span class="xd btn2"></span> -->现代</p></li>
                </ul>
                <ul class="clearfix">
                    <li><p>女性<!-- <span class="nx btn1"></span> --></p></li>
                    <li class="select_bar clearfix">
                        <div class="wrapselect clearfix">
                            <div class="leftselect clearfix">
                                <input type=""  class="nvxleft" value="5">
                                <div class="nvxdiv"></div>
                                <div class="nvxdiv1"></div>
                            </div>
                            <div class="centerselect clearfix">
                                <input type="" name="moren" class="centerspan2" >
                                <span class="centerspanbg2"></span>
                                <div class="nxdiv"></div>
                            </div>
                            <div class="rightselect clearfix">
                                <input type=""  value="6" class="nxright">
                            </div>
                        </div>
                    </li>
                    <li><p><!-- <span class="nx btn2"></span> -->男性</p></li>
                </ul>
                <ul class="clearfix">
                    <li><p>抽象<!-- <span class="cx btn1"></span> --></p></li>
                    <li class="select_bar clearfix">
                        <div class="wrapselect clearfix">
                            <div class="leftselect clearfix">
                                <input type=""  class="cxleft" value="7">
                                <div class="cxdiv"></div>
                                <div class="cxdiv1"></div>
                            </div>
                            <div class="centerselect clearfix">
                                <input type="" name="moren" class="centerspan3" >
                                <span class="centerspanbg3"></span>
                                <div class="wzdiv"></div>
                            </div>
                            <div class="rightselect clearfix">
                                <input type=""  class="wzright" value="8">
                            </div>
                        </div>
                    </li>
                    <li><p><!-- <span class="wz btn2"></span> -->文字</p></li>
                </ul>
            </div>
        </li>
        <li class="clearfix">
            <p>色调选择（最多选择3种）<span class="red_word">*</span></p>
            @if(!$color == null)
                @foreach($color as $c)
                    {{$c->color_id}}
                @endforeach
            @endif
            <ul class="select_color clearfix fl">
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/灰黑调.png') !!}" alt="">
                    <p>灰黑调</p>
                    <span class="gray_black color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="10">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/黄色调.png') !!}" alt="">
                    <p>黄色调</p>
                    <span class="yellow_tone color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="8">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/紫色调.png') !!}" alt="">
                    <p>紫色调</p>
                    <span class="purple_tone color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="4">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/橙色调.png') !!}" alt="">
                    <p>橙色调</p>
                    <span class="orange_tone color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="7">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/咖啡色调.png') !!}" alt="">
                    <p>咖啡色调</p>
                    <span class="orange_tone color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="7">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/绿色调.png') !!}" alt="">
                    <p>绿色调</p>
                    <span class="Green color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="3">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/蓝色调.png') !!}" alt="">
                    <p>蓝色调</p>
                    <span class="blue_cast color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="1">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/红色调.png') !!}" alt="">
                    <p>红色调</p>
                    <span class="red_tone color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="6">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/自定义.png') !!}" alt="">
                    <p>自定义</p>
                    <span class="user_defined color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="11">
                </li>

            </ul>
        </li>
        <li class="clearfix">
            <p>上传附件</p>
            {{--@if(!$file_id == null)--}}
                {{--@foreach($file_id as $f)--}}
                    {{--{{$f->id}}--}}
                    {{--<input name="file_idnew[]" value="{{$f->id}}">--}}
                {{--@endforeach--}}
            {{--@endif--}}
            <div class="annex">
                <!--文件上传-->
                <div  class="dropzone clearfix" id="dropzone"
                      url="{{ URL('task/fileUpload')}}"
                      deleteurl="{{ URL('task/fileDelet') }}">
                    <div class="fallback">
                        <input name="file" type="file" multiple="" />
                    </div>
                </div>
            </div>
            <div id="file_update"></div>

        </li>
        <li class="clearfix">
            <p>手机号码<span class="red_word">*</span></p>
            <p><input type="text" id="phone" name="phone" placeholder=""></p>
            <span class="checkRong" id="checkphone"></span>
        </li>
        <li class="clearfix">
            <p>经纪人识别ID</p>
            <p><input type="text" id="" name="" placeholder="请输入经纪人ID号"></p>
        </li>
    </ul>

    <div class="logo_info_button clearfix">
        <a href="/task/type/?a=02" class="kefu" >上一步</a>
        <a href="javascript:;" class="next">下一步</a>
    </div>
</div>
{{--<!-- 描述您LOGO的需求信息结束 -->--}}
{{--<!-- 您可能还会需要的设计 -->--}}
<div class="select_plan hide">
    <div class="select_plan_title">
        <p>选择项目发布方式</p>
    </div>
    <div class="project_ways">
        <div class="release_wrap">
            <div class="clearfix release_wrap_content">
                <div class="fl public_release div_selected">
                    <img src="{!! Theme::asset()->url('images/type/public.png') !!}" alt="">
                    <p>公开发布</p>
                </div>
                <div class="fl private_release">
                    <img src="{!! Theme::asset()->url('images/type/private.png') !!}" alt="">
                    <p>私密发布</p>
                    <span class="recommend"></span>
                </div>
                <div class="fl appoint_release">
                    <img src="{!! Theme::asset()->url('images/type/appoint.png') !!}" alt="">
                    <p>指定发布</p>
                    <span class="recommend"></span>
                </div>
            </div>
        </div>
        <div class="project_details sever_ul_box">
            <ul class="sever_ul clearfix">
                <li><p>指定服务商<span class="red_word">*</span></p></li>
                <li>
                    {{--<input type="text" name="" onkeyup="showResult(this.value)" placeholder="请输入服务名称或服务商ID">--}}
                    <input type="text" name="worker" placeholder="请输入服务名称或服务商ID">
                </li>
                <li>
                    {{--@foreach($users as $v)--}}
                    {{--<li>--}}
                        {{--<div id="livesearch"></div>--}}
                        {{--<p>{{$v->name}}</p>--}}
                    {{--</li>--}}
                    {{--@endforeach--}}
                </li>
            </ul>
        </div>
        <div class="project_details">
            <ul class="clearfix">
                <li><span></span>公开发布方式为一种常规发布形式，选择该方式发布项目不收取任何发布费用。</li>
                <li><span></span>公开发布方式是将您的项目发布在平台的项目库中。</li>
                <li><span></span>您发布的项目，设计师可在项目库内自行搜索、浏览、接取。</li>
                <li><span></span>设计师可对您的项目进行分析，根据其自身的兴趣与设计能力进行选择，从而为您的项目进行设计。</li>
            </ul>
        </div>
        <div class="project_details">
            <div class="clearfix">
                <p class="fl">订单号</p>
                <input type="hidden" name="order_number" value="{{$orderNumber}}">
                <p class="fl">{{$orderNumber}}</p>
            </div>
            <div class="clearfix">
                <p class="fl">项目名称</p>
                <p class="fl">{{$task['name']}}项目</p>
            </div>
            <div class="clearfix">
                <p class="fl">发布方式</p>
                <p class="fl gk">公开发布</p>
                <p class="fl sm">私密发布</p>
                <p class="fl zd">制定发布</p>
            </div>
            <div class="clearfix">
                <p class="fl">项目消费明细</p>
                <p class="fl">项目发布费</p>
                <p class="fl gk gk_money">￥<span>0</span></p>
                <p class="fl sm sm_money">￥<span>49</span></p>
                <p class="fl zd zd_money">￥<span>49</span></p>
            </div>
            <div class="clearfix ">
                <p class="fl"></p>
                <p class="fl">项目预算</p>
                <p class="fl">￥<span class="pre_yu">1500</span></p>
            </div>

            <div class="clearfix zd">
                <p class="fl"></p>
                <p class="fl">平台服务费（总金额3%）</p>
                <p class="fl">￥<span class="pre_server">45</span></p>
            </div>
            <div class="all-in_cost clearfix">
                <p class="fl"></p>
                <p class="fl">总费用</p>
                <p class="fl">￥<span class="total">1634</span></p>
            </div>
            <div class="money_reason clearfix">
                <p class="fl"></p>
                <p class="fl">
                    <span><img src="{!! Theme::asset()->url('images/type/问号.png') !!}" alt=""></span><a href="javascript:;">为什么需要先托资金？</a>
                </p>
            </div>
        </div>

        <p class=""><input class="xy" type="checkbox" checked="checked"  name="">我同意并遵守<a href="">《i3job平台项目发布协议》</a></p>
    </div>
    <div class="continue_wrap clearfix">
        <a href="javascript:;" class="return fl">上一步</a>
        <input type="submit"  class="continu fl" value="下一步">
        {{--<button class="btn btn-success" >下一步</button>--}}
    </div>
</div>
<!-- 您可能还会需要的设计结束 -->
<!-- 项目资金托管成功 -->


</form>
{!! Theme::asset()->container('old-css')->usepath()->add('release_css','css/type/release.project.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('step','css/type/step.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('step','css/type/two.css') !!}

{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::widget('ueditor')->render() !!}
{{--{!! Theme::widget('datepicker')->render() !!}--}}
{!! Theme::widget('fileUpload')->render() !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('task', 'js/doc/task.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

{{--及时查询js--}}
{{--{!! Theme::asset()->container('custom-js')->usepath()->add('publishajax', 'js/type/publishajax.js') !!}--}}
{!! Theme::asset()->container('custom-js')->usepath()->add('release_js', 'js/type/release.project.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('step', 'js/type/step.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('test', 'js/type/test.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('public_js', 'js/type/public_js.js') !!}


