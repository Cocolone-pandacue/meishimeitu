{!! Theme::widget('wrapBox_fbxm')->render() !!}
<form action="/task/createTaskNew" method="post" id="form" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
{!! csrf_field() !!}
<div class="logo_info">
    <div class="logo_info_title">
        <p>填写“{{$task['name']}}”的详细需求</p>
        <input type="hidden" name="cate_id" value="{{$task['id']}}">
        <input type="hidden" name="orderNumber" value="{{$orderNumber}}">
        <input type="hidden" name="status" value="{{$status}}">
        {{--<input type="hidden" name="brainpower_id" value="{{$brainpower_id}}">--}}
        <!-- <p>描述您LOGO的需求信息</p> -->
        <!--  <p>如果您不想写需求详情，则可付费由我们客服帮您代写</p> -->
    </div>
    <ul class="logo_info_content addpadding">
        <li class="addheight_one flexbuju">
            <p>为您的项目命名<span class="red_word">*</span></p>
            <p>
                <input type="text" id="proName" class="material_input" name="title" @if(!$tasknew == null) value="{{$tasknew->title}}"  @endif>
                {{--<input type="text" id="proName" class="material_input" name="title" @if(!$brainpower == null) value="{{$brainpower->brand_name}}" @endif>--}}
                <span class="checkRong" id="checkProject"></span>
            </p>
        </li>
        <li class="program_budget addheight_one flexbuju" >
            <p>您的项目预算<span class="red_word">*</span></p>
            <p class="tsgs">
                <select class="select_m" name="bounty1"><!--  onchange="selectChange()" -->
                    {{--<option value="200">200￥</option>--}}
                    @if( !($tasknew == null) && $tasknew->bounty !=0) <option value="{{$tasknew->bounty}}" selected = "selected">{{intval($tasknew->bounty)}}￥</option> @endif
                    <option value="500">500￥</option>
                    <option value="1000">1000￥</option>
                    <option value="2000">2000￥</option>
                    <option value="3000" >3000￥</option>
                    <option value="5000" >5000￥</option>
                    <option value="10000">10000￥</option>
                    <option value="20000">20000￥</option>
                    <option value="50000">50000￥</option>
                    <option value="100000">100000￥</option>
                    <option id="user_defined"  value="">自定义金额</option>
                </select>
                <span class="cls_input_span1 clearfix">
                    <input id="pre_money" type="text" name="bounty2" class="cls_input cls_input_m pre_money" value="" placeholder="自定义输入">
                    <span class="checkRong" id="checkJine"></span>
                    <span class="fu">￥</span>
                </span>
                <span class="dan">单位： 元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（注：最低500元）</span>
            </p>
        </li>
        <li class="addheight_two flexbuju">
            <p>项目描述<span class="red_word">*</span><span class="wen_img"></span></p>
            <p>
                <textarea name="description" id="miaoshu">@if(!$tasknew == null){{$tasknew->desc}}@endif</textarea>
                <span class="checkRong" id="checkMiaoshu"></span>
            </p>
        </li>
        <li class="addheight_one flexbuju">
            <p>项目时间<span class="red_word">*</span></p>
            <p class="addwidth">
                <select  class="logo_info_time" name="sele_input1" onchange="">
                    @if( !($tasknew == null ) && $tasknew->time_interval !=null) <option value="{{$tasknew->time_interval}}" selected = "selected">{{$tasknew->time_interval}}天</option> @endif
                    <option value="3">3天</option>
                    <option value="7">7天</option>
                    <option value="14">14天</option>
                    <option value="30">30天</option>
                    <option value="90">90天</option>
                    <option value="" class="zid">自定义</option>
                </select>
                <span>该项目需由<span class="se_year">XXXX</span>年<span class="se_month">XX</span>月<span class="se_date">XX</span>日星期<span class="se_week">X</span>之前完成交稿</span>
            </p>
            <span class="cls_input_span cls_input_span_t">
                <input type="text" id="zdytime" name="sele_input" class="cls_input cls_input_t" value="" placeholder="自定义输入">
                <span class="checkRong" id="checkTime"></span>
            </span>
        </li>
        <li class="addheight_one flexbuju">
            <div class="task-bar">
                <p class="">地域<span class="red_word">*</span></p>
                <a class="area-limit bxdq" href="javascript:void(0);">不限地区</a>
                <a class="area-limit bar-txt zddq" href="javascript:void(0);">指定地区</a>
                @if( !($tasknew == null) && (0 != $tasknew->area))<div class="xianshi"></div> @endif
                <span id="area_select" style="display: none;">
                    <select name="province" style="margin-left:20px;" onchange="checkprovince(this)">
                        @foreach($province as $v)
                            <option value={{ $v['id'] }} @if( !$tasknew == null && $v['id'] == $tasknew->province) selected="selected" @endif>{{ $v['name'] }}</option>
                        @endforeach
                    </select>
                    <select name="city" id="province_check" onchange="checkcity(this)">
                        @foreach($city as $v)
                            <option value={{ $v['id'] }} @if( !$tasknew == null && $v['id'] == $tasknew->city) selected="selected" @endif>{{ $v['name'] }}</option>
                        @endforeach
                    </select>
                    <select name="area" id="area_check" onchange="arealimit(this)">
                        @foreach($area as $v)
                            <option value={{ $v['id'] }} @if( !$tasknew == null && $v['id'] == $tasknew->area) selected="selected" @endif>{{ $v['name'] }}</option>
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

        <li class="addheight_one flexbuju">
            <p>所属行业<span class="red_word">*</span></p>
            <p>
                <select name="industry" id="industry">
                    <option>请选择行业</option>
                    @foreach($industry as $v)
                    <option value="{{$v->value_id}}" @if( !$tasknew == null && $v->value_id == $tasknew->industry) selected="selected" @endif>{{$v->name}}</option>
                    @endforeach
                </select>
            </p>
        </li>

        <li class="addheight_one flexbuju">
            <p>参考产品</p>
            <p><input type="text" name="reference" @if(!$tasknew == null) value="{{$tasknew->reference}}" @endif placeholder="请填写同行优秀的竞品或其他行业可参考的产品"></p>
        </li>
        <li class="addheight_three flexbuju fgysxz">
            <p>设计风格选择<span class="red_word"></span></p>
            <span class="jshdsj jshdsj_fengge" style=" display: none;">
            @if(!$style == null)
                @foreach($style as $s)
                    {{$s}}
                @endforeach
            @endif
            </span>
            <div class="select_style fl">
                <ul class="addheight_four">
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
                <ul class="addheight_four">
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
                <ul class="addheight_four">
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
                <ul class="addheight_four">
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
        <li class="addheight_five flexbuju">
            <p>色调选择（最多选择3种）<span class="red_word">*</span></p>
            <span class="jshdsj jshdsj_color" >
            @if(!$color == null)
                @foreach($color as $c)
                    {{$c}}
                @endforeach
            @endif
            </span>
            <ul class="select_color clearfix">
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/灰黑调.png') !!}" alt="">
                    <p>灰黑调</p>
                    <span class="gray_black color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="1">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/黄色调.png') !!}" alt="">
                    <p>黄色调</p>
                    <span class="yellow_tone color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="2">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/紫色调.png') !!}" alt="">
                    <p>紫色调</p>
                    <span class="purple_tone color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="3">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/橙色调.png') !!}" alt="">
                    <p>橙色调</p>
                    <span class="orange_tone color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="4">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/咖啡色调.png') !!}" alt="">
                    <p>咖啡色调</p>
                    <span class="gray_white color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="5">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/绿色调.png') !!}" alt="">
                    <p>绿色调</p>
                    <span class="Green color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="6">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/蓝色调.png') !!}" alt="">
                    <p>蓝色调</p>
                    <span class="blue_cast color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="7">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/红色调.png') !!}" alt="">
                    <p>红色调</p>
                    <span class="red_tone color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="8">
                </li>
                <li>
                    <img class="color_class" src="{!! Theme::asset()->url('/images/type/自定义.png') !!}" alt="">
                    <p>自定义</p>
                    <span class="user_defined color_selected"></span>
                    <div class="estop_img"></div>
                    <input type=""  class="color_input" value="9">
                </li>

            </ul>
        </li>
        <li class="flexbuju addheight_six">
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
                <p class="yishangchuan">已上传</p>
                <div class="hdjstp">
                    @if(!$file == null)
                        @foreach($file as $f)
                            {{--{{$f->tonality_id}}--}}
                            <p>{{$f->name}}
                                <img src="{!! Theme::asset()->url('/images/type/关闭icon.png') !!}" alt="" class="fbxm_shanchu" tonality_id="{{$f->id}}">
                            </p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div id="file_update"></div>
            
        </li>
        <li class="addheight_one flexbuju"">
            <p>手机号码<span class="red_word">*</span></p>
            <p><input type="text" id="phone" name="phone" placeholder="" @if(!$tasknew == null) value="{{$tasknew->phone}}" @endif></p>
            <span class="checkRong" id="checkphone"></span>
        </li>
        @if(isset($broker['bid']))
            <li class="addheight_one flexbuju">
                <p>经纪人识别ID</p>
                <p><input type="text" id="" name="brokerid" placeholder="请输入经纪人ID号" value="{{$broker['bid']}}" readonly></p>
            </li>
        @else
            <input type="hidden" name="brokerid" value="0">
        @endif
        <div class="logo_info_button clearfix">
            @if(isset($broker['bid']))
                <a href="/task/type/{{$orderNumber}}/?bid={{$broker['bid']}}&man={{$broker['man']}}&a=01" class="kefu">< 上一步</a>
            @else
                <a href="/task/type/{{$orderNumber}}/?a=01" class="kefu">< 上一步</a>
            @endif
            {{--<a  type="submit" href="/task/createnew/{{$orderNumber}}?a=03" class="next">下一步</a>--}}
            <a id="createtask"  type="submit"  class="next">下一步</a>
        </div>
    </ul>
</div>
{{--<!-- 描述您LOGO的需求信息结束 -->--}}


</form>
{!! Theme::asset()->container('old-css')->usepath()->add('release_css','css/type/release.project.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('step','css/type/step.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('step','css/type/two.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('wrapBox_fbxm','css/type/wrapBox_fbxm.css') !!}

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
{!! Theme::asset()->container('custom-js')->usepath()->add('step', 'js/type/step.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('test', 'js/type/test.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('release_js', 'js/type/release.project.js') !!}

