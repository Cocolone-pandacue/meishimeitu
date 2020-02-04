<div class="up_works_title">
    <p>上传作品</p>
</div>

<div class="upload_div ">
    <h4 class="text-size16 work_info ">作品信息</h4>
        <form method="post" action="{!! url('user/pubGoods') !!}" enctype="multipart/form-data" >
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{$shopGoods->id}}">
            <div class="g-userimgup profile-users g-usershopform">
                <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left text_right h5 cor-gray51 red_word">*</p>
                    <p class="g-userimgupinp g-userimgupbor-validform margin-left-20">
                        <input class="inputxt Validform_error input-large" placeholder="作品名称" type="text"  name="title" value="{{$shopGoods->title}}" datatype="*" nullmsg="请填写作品名称！">
                        {!! $errors->first('title') !!}
                    </p>
                </div>
            </div>
            <div class="space-6">

            </div>

            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51 red_word">*</p>
                <p class="g-userimgupinp g-userimgupbor-validform margin-left-20">
                    <select name="first_cate" id="firstCate" onchange="getCate(this.value, 'secondCate')" datatype="*" nullmsg="请选择作品类型！">
                        <option value="">请选择作品类型</option>
                        @if(!empty($arr_cate))
                            @foreach($arr_cate as $item)
                                <option value="{!! $item->id !!}" {{ ($cateidtone->pid ==$item->id )?'selected':'' }}>{!! $item->name !!}</option>
                            @endforeach
                        @endif
                    </select>
                    <select name="cate_id" id="secondCate" datatype="*" nullmsg="请选择作品子类！">
                        <option value="{{$shopGoods->cate_id}}">{{$cateidtone->name}}</option>
                    </select>
                    <select >
                        <!-- <option value="">-作品子类-</option> -->
                        <option value="">作品只支持浏览，不提供下载出售</option>
                    </select>
                    {!! $errors->first('first_cate') !!}
                </p>
            </div>
            <div class="space-8">

            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51"></p>
                <p class="g-userimgupinp g-userimgupbor-validform margin-left-20">
                    <input class="inputxt Validform_error input-large" placeholder="作品说明" type="text"  name="desc" value="{{$shopGoods->desc}}" datatype="*" nullmsg="请填写作品名称！"><!-- datatype="*" nullmsg="请填写作品名称！" -->&nbsp;&nbsp;&nbsp;
                    {!! $errors->first('title') !!}
                </p>
            </div>

            <div class="upload_div">
                <h4 class=" work_info ">上传作品</h4>
                <div class="space-20">

                </div>
                <div class="outer clearfix">

                    <div class="inputbox fl">
                        <input type="file"  name="file" id="shang"  multiple="multiple" accept="image/*" />
                        <!-- onchange="javascript:setImagePreviews();"  -->
                        <div class="jia">
                            <span class="dian"></span>
                            <p class="dian_word">点击添加图片</p>
                            <p class="gray_word">支持jpg/gif/png模式</p>
                            <p class="gray_word">不超过10M</p>
                        </div>
                    </div>
                    <div id="dd"  class="clearfix fl">
                        <img src="{{ossUrl($shopGoods->file)}}" style="width: 300px">
                    </div>
                </div>
            </div>
            <div class="space-20">
            </div>
            <div class="upload_div">
                <h4 class=" work_info ">上传封面</h4>
                <div class="space-20">
                </div>
                <div class="clearfix g-userimgupbor" data-placement="right" href="#">
                    <p class="pull-left h5 cor-gray51 red_word">*</p>
                    <div class="inputbox cover_box margin-left-20">
                        <div class="jia face_img">
                            <span class="dian"></span>
                            <p class="dian_word">上传封面</p>
                        </div>
                    </div>
                    <img src="{{ossUrl($shopGoods->cover)}}" style="width: 300px">
                </div>
            </div>
            <div class="space-20"></div>
            <div class="cover_wrap hide">
                <div class="cover_wrap_head">
                    <p>上传封面</p>
                    <span class="close_div">X</span>
                </div>
                <div class="cover_wrap_content clearfix">
                    <div class="cover_wrap_content_left fl">
                        <input type="file"  name="cover" id="cover" value="" accept="image/*" />
                        <span class="dian"></span>
                        <p class="dian_word">添加图片</p>
                        <p class="gray_word">支持jpg/gif/png模式，gif不能动画化，大小</p>
                        <p class="gray_word">不超过5MB，建议尺寸为800X600</p>
                        <div class="cover_img_wrap">
                            <img class="cover_img" src= "">
                        </div>
                    </div>
                    <div class="cover_wrap_content_right fl">
                        <div class="cwcr_img">
                            <img class="" src="{{Theme::asset()->url('images/meishimeitu/personal/s_robot.png')}}" alt="">
                        </div>
                        <div class="cwcr_synopsis">
                            <p class="cwcr_synopsis_title">标题</p>
                            <p class="cwcr_synopsis_class">分类-子分类</p>
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
                    <a href="javascript:;" class="cover_cancel">取消</a>
                </div>
            </div>
            <div class="null_new">
                <img src="{{Theme::asset()->url('images/meishimeitu/personal/s_robot.png')}}" alt="">
                <p>请先上传封面</p>
            </div>
            <div class="upload_btn_box">
                <button type="submit" class="btn  btn-imp btn-blue  sub_btn">提交作品</button>
                <a class="text-size14  text-under" href="/user/goodsShop">返回</a>
            </div>
        </form>
</div>

<div class="space-20">

</div>


{!! Theme::asset()->container('specific-css')->usePath()->add('webui-css', 'plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('usercenter-css', 'css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-min-js', 'plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-elements-js', 'plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('realname-js', 'js/realnameauth.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('usershopfb','js/meishimeitu/usershopfb.js') !!}



{!! Theme::asset()->container('specific-css')->usepath()->add('froala_editor', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('bootstrap-datepicker','plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('assetdetail','js/assetdetail.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('pubgoods','js/pubgoods.js') !!}





