<div class="up_works_title">
    <img src="{!! Theme::asset()->url('images/作品上传.png') !!}" alt="" class="up_works_title_shangchuan">
    <p>上传作品</p>
</div>

<form method="post" action="{!! url('user/pubGoods') !!}" onkeypress="return event.keyCode != 13;">
    {!! csrf_field() !!}
    <input type="hidden" name="id" value="{{$shopGoods->id}}">
    <div class="upload_div ">
        <h4 class="text-size16 work_info ">作品信息</h4>
        <div class="upload_div_box">
            <p class="left">作品名称<span class="red_word">*</span></p>
            <p class="right">
                <input type="text" id="" class="work_name" name="title" value="{{$shopGoods->title}}">
                <span class="" id=""></span>
            </p>
        </div>
        <div class="upload_div_box">
            <p class="left">作品类型<span class="red_word">*</span></p>
            <p class="right">
                <select type="text" id="firstCate" class="" name="first_cate" value="">
                    <option value="">请选择</option>
                    @if(!empty($arr_cate))
                        @foreach($arr_cate as $item)
                            {{--<option value="{!! $item->id !!}" {{ ($arr_cate->pid ==$item->id )?'selected':'' }}>{!! $item->name !!}</option>--}}
                            <option value="{!! $item->id !!}" {{ ($shopGoods->cate_id ==$item->id )?'selected':'' }}>{!! $item->name !!}</option>
                        @endforeach
                    @endif
                    <span class="" id=""></span>
            </p>
        </div>
        <div class="upload_div_box">
            <p class="left">作品类型<span class="red_word">*</span></p>
            <p class="right">
                <select type="text" id="" class="" name="" value="">
                    <option value="你好"></option>
                    <option value="你不好"></option>
                <span class="" id=""></span>
            </p>
        </div>
        <div class="upload_div_box">
            <p class="left">作品性质<span class="red_word">*</span></p>
            <p class="right zybj">
                <span class="zscs">展示
                    <label for="zscs_one"></label>
                    <input checked type="radio" class="zscs_radio" name="nature" value="1" id="zscs_one">
                    <span class="zscs_style"></span>
                </span>
                <span class="zscs noclick zscs_noclick">出售
                    <label for="zscs_two"></label>
                    <input type="radio" class="zscs_radio" name="nature" value="2" id="zscs_two">
                    <span class="zscs_style"></span>
            </span>
            </p>
        </div>
        <div class="upload_div_box jsbox">
            <p class="left">作品介绍<span class="red_word">*</span></p>
            <p class="right jszybj">
                <textarea class="zpjs" name="desc" >{{$shopGoods->desc}}</textarea>
            </p>
        </div>
        <div class="bqbox">
            <p class="left left_bottom">作品标签<span class="red_word">*</span></p>
            <div class="bqxzbox">
                @foreach($tagsval  as $t)
                    <span class="bqlbbox" style="width: 84px;" yixuan="ok">
                    <input class="zpbq" value="{{$t->id}}" name="tags[]">
                    <span class="bqname">{{$t->tag_name}}</span>
                    <img src="/themes/quietgreen/assets/images/type/关闭icon.png" alt="" class=""></span>
                @endforeach
            </div>
            <p class="bqlb">
                @foreach($tags_production as $t)
                    <span class="bqlbbox">
                <input class="zpbq" value="{{$t->id}}">
                <span class="bqname">{{$t->tag_name}}</span>
                </span>
                @endforeach
            </p>
        </div>
        <div class="scbox">
            <div class="inline_block height_270 width_215 lineHeight_270">上传作品<span class="red_word">*</span></div>
            <div class="tpbox">
                <div class="inputbox margin_50 work_inputbox">
                <input type="file" class="shang" multiple="multiple"  accept="image/*"/>
                    <div class="jia">
                        <span class="dian">
                            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                        </span>
                        <p class="dian_word">点击添加图片</p>
                        <p class="gray_word">支持jpg/gif/png模式</p>
                        <p class="gray_word">不超过10M</p>
                    </div>
                </div>
                <div id="dd"  class="clearfix fl">
                @if(!empty($shopGoods->file) && json_decode($shopGoods->file) )
                    @foreach(json_decode($shopGoods->file) as $s)
                    @if($s)
                    <div class="imgbox">
                        <span class="closebtn"></span>
                        <img class="img" src= "{{ossUrl($s)}}"/>
                        <input type="hidden" name="file1[]" value="{{$s}}">
                        <span class="successphoto"></span>
                    </div>
                    @endif
                    @endforeach
                @endif
                </div>
            </div>
        </div>
        <div class="scbox">
        <div class="inline_block height_270 width_215 lineHeight_270">上传封面<span class="red_word">*</span></div>
            <div class="tpbox">
                <!-- <div class="cxsc">重新上传</div> -->
                <div class="inputbox cover_box margin-left-20 margin_50">
                    <div class="jia face_img" style="background-image:url({{ossUrl($shopGoods->cover)}})">
                        <span class="dian">
                            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                        </span>
                        <p class="dian_word">上传封面</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-20"></div>
        <div class="cover_wrap hide">
            <div class="close_div"></div>
            <div class="cover_wrap_head">
                <p>上传封面</p>
            </div>
            <div class="cover_wrap_content clearfix">
                <div class="cover_wrap_content_left fl">
                    <input type="file" id="cover" value="" accept="image/*" />
                    <span class="dian">
                    <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                </span>
                    <p class="dian_word">添加图片</p>
                    <p class="gray_word">支持jpg/gif/png模式，gif不能动画化，大小</p>
                    <p class="gray_word">不超过5MB，建议尺寸为800X600</p>
                    <div class="cover_img_wrap">
                    </div>
                </div>
                <div class="cover_wrap_content_right fl">
                    <div class="cwcr_img">
                        <img class="" src="" alt="">
                    </div>
                    <div class="cwcr_synopsis">
                        <p class="cwcr_synopsis_title">标题</p>
                        <p class="cwcr_synopsis_class"><span class="classify">分类</span>-<span class="classify_child">子分类</span></p>
                        <p class="cwcr_synopsis_icon">
                            <span><span class="see_sicon"></span>0</span>
                            <span><span class="college_sicon"></span>0</span>
                            <span><span class="news_sicon"></span>0</span>
                            <span><span class="upload_sicon"></span>0</span>
                        </p>
                    </div>
                    <div class="cwcr_foot">

                    </div>
                </div>
                <div class="show_img_word hide fl">
                    <span class="again_upload">重新上传</span>
                    <span class="cover_preview">封面预览</span>
                </div>
            </div>
            <div class="cover_wrap_foot">
                <a href="javascript:;" class="cover_sure">确认</a>
                <!-- <a href="javascript:;" class="cover_cancel">取消</a> -->
            </div>
        </div>
        <div class="null_new">
            <img src="{{Theme::asset()->url('images/meishimeitu/personal/s_robot.png')}}" alt="">
            <p>请先上传封面</p>
        </div>
        <div class="upload_btn_box">
            <button type="submit" class="sub_btn">提交作品</button>
            <a class="text-size14  text-under" href="/user/goodsShop">< 返回</a>
        </div>
    </div>
</form>


<!-- 店铺设计 -->
<!-- <div class="row close-space-tip">
        <div class="col-md-12 text-center">
            <div class="space-30"></div>
            <div class="space-30"></div>
            <div class="space-30"></div>
            <img src="{!! Theme::asset()->url('images/nomessage.png') !!}" >
            <div class="space-10"></div>
            <p class="text-size16 cor-gray87">您的店铺还没设置，暂不能查看作品管理！<a href="/user/shop">店铺设置</a></p>
        </div>
    </div> -->


{!! Theme::asset()->container('specific-css')->usePath()->add('webui-css', 'plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('usercenter-css', 'css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-min-js', 'plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-elements-js', 'plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('realname-js', 'js/realnameauth.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('oss-js', 'js/meishimeitu/oss.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('usershopfb','js/meishimeitu/usershopfb.js') !!}



{!! Theme::asset()->container('specific-css')->usepath()->add('froala_editor', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('bootstrap-datepicker','plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('assetdetail','js/assetdetail.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('pubgoods','js/pubgoods.js') !!}





