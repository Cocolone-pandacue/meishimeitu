<!-- 菜单栏设置 -->

<!-- 店铺信息菜单栏 -->

<div class="mystore_top">
    <div class="mystore_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Shop.png') !!}" alt="" class="mystore_biaoti_photo"></span>
        <span class="mystore_biaoti_text">我的店铺</span>
    </div>
    <div class="mystore_dpzp qxboder">
        <span class="mystore_dpzp_zuopinxinxi clicked">店铺信息</span>
        <span class="mystore_dpzp_zuopinguanli">作品管理</span>
    </div>
</div>

<!-- 店铺信息菜单栏 结束 -->


<!-- 作品管理菜单栏 -->

<!-- <div class="mystore_top">
    <div class="mystore_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Shop.png') !!}" alt="" class="mystore_biaoti_photo"></span>
        <span class="mystore_biaoti_text">我的店铺</span>
    </div>
    <div class="mystore_dpzp">
        <span class="mystore_dpzp_zuopinxinxi">店铺信息</span>
        <span class="mystore_dpzp_zuopinguanli">作品管理</span>
    </div>
    <div class="mystore_zt">
        <span class="mystore_zt_text">状态</span>
        <span class="mystore_zt_text">全部</span>
        <span class="mystore_zt_text">已上架</span>
        <span class="mystore_zt_text">未上架</span>
    </div>
</div> -->

<!-- 作品管理菜单栏 结束 -->


<!-- 菜单栏设置 结束 -->



<!-- 当没有作品时 -->

<!-- <div class="myshop_head_content ">
    <img src="{{Theme::asset()->url('images/meishimeitu/personal/noopen.png')}}" alt="">
</div> -->

<!-- 当没有作品时 -->



<!-- 店铺信息 -->

<div class="g-main g-usershop relative">
    <h4 class="text-size16 cor-blue2f u-title">店铺信息</h4>
    <!-- <div class="g-usershoptype clearfix">
        @if($is_company_auth == true)
        {{--企业--}}
            <div class="g-usershopico1">企</div>
            <div class="pull-left">
                <h5 class="text-size16 cor-gray51">店铺类型</h5>
                {{--企业--}}
                <p>恭喜，您当前为企业店铺！</p>
            </div>
        @else
            <div class="g-usershopico">个</div>
            <div class="pull-left">
                <h5 class="text-size16 cor-gray51">店铺类型</h5>
                <p>你当前为个体店铺，进行<a href="/user/enterpriseAuth">企业认证</a>可升级为企业店铺</p>
            </div>
        @endif

    </div> -->
    <form method="post" action="/user/shop" onkeypress="return event.keyCode != 13;" id="shop_info">
        {!! csrf_field() !!}
        <input type="hidden" name="id" @if(isset($shop_info->id) && !empty($shop_info->id))value="{!! $shop_info->id !!}"@endif>
        <input type="hidden" name="type" @if($is_company_auth==true) value="2" @else value="1" @endif>
        <div class="g-userimgup profile-users g-usershopform ">
            <!-- <div class="clearfix g-userimgupbor" data-placement="right" href="#">
                <p class="pull-left h5 cor-gray51"><span>上传封面</span></p>
                <div class="memberdiv pull-left">
                    <div class="position-relative">
                        <input name="shop_pic" type="file" id="id-input-file-6"/>
                    </div>
                </div>
                @if(isset($shop_info->shop_pic) && !empty($shop_info->shop_pic))
                <div class="pull-left" style="width: 158px;height: 120px">
                    <img src=" {!!  ossUrl($shop_info->shop_pic) !!}" class="img-responsive"/>
                </div>
                @endif
                <div class="pull-right cor-gray87 visible-lg-block">
                    <p>1. 封面是店铺展示方式的重要入口</p>

                    <p>2. 优秀的作品封面更能吸引客户关注</p>

                    <p>3. 尺寸必须为450*450像素,大小不超过3M，请保持图片清晰，<br>　能够体现卖点</p>

                </div>
            </div> -->
            <div class="scbox hight">
                <div class="tpbox marginTop">
                    <!-- <div class="cxsc">重新上传</div> -->
                    <div class="inputbox cover_box margin-left-20">
                        <div class="jia face_img">
                            <span class="dian">
                                <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                            </span>
                            <p class="dian_word">上传封面</p>
                        </div>
                    </div>
                </div>
            </div>
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
                <div class="underLine"></div>
                <div class="cover_wrap_foot ">
                    <a href="javascript:;" class="cover_sure">确认</a>
                    <!-- <a href="javascript:;" class="cover_cancel">取消</a> -->
                </div>
            </div>
        </div>
        <div class="upload_div_box">
            <p class="left">店铺名称<span class="red_word">*</span></p>
            <p class="right">
                <input type="text" id="" class="" name="shop_name" value="" @if(isset($shop_info->shop_name) && !empty($shop_info->shop_name))value="{!! $shop_info->shop_name !!}" @endif
                datatype="*2-10" nullmsg="请填写店铺名称！" errormsg="店铺名称字数超过限制">
                <span class="" id=""></span>
            </p>
        </div>
        <div class="upload_div_box">
            <p class="left">店铺性质<span class="red_word">*</span></p>
            <p class="right zybj">
                <span class="dpxzxz dpxzxz_click"><label for="grqy_one">个人</label><input checked type="radio" class="dpxzxz_radio" name="dpxzxz" id="grqy_one"><span class="dpxzxz_style"></span></span>
                <span class="dpxzxz noclick"><label for="grqy_two">企业</label><input type="radio" class="dpxzxz_radio" name="dpxzxz" id="grqy_two"><span class="dpxzxz_style"></span></span>
            </p>
        </div>
        <div class="upload_div_box jsbox">
            <p class="left">店铺介绍<span class="red_word">*</span></p>
            <p class="righ">
                <textarea class="dpjs" name="shop_desc" datatype="*" nullmsg="请填写店铺介绍！">@if(isset($shop_info->shop_desc) && !empty($shop_info->shop_desc)){!! htmlspecialchars_decode($shop_info->shop_desc) !!}@endif</textarea>
            </p>
        </div>
        <button class="btn btn-primary btn-imp g-usershopbtn bccc">确定</button>
    </form>
</div>

<!-- 店铺信息 结束 -->

<!-- 作品管理 -->

<!-- <div class="mystore_zpgl">
    <div class="mystore_zpgl_title">
        <span class="mystore_zpgl_title_text">作品管理</span>
    </div>
    <div class="mystore_photo">
        <div class="mystore_photo_biaoti">共188个作品</div>
        <div class="mystore_photo_box">
            <div class="mystore_photo_littlebox">
                <p class="mystore_photo_littlebox_photobox">
                    <img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="mystore_photo_littlebox_photo">
                    <span class="mystore_photo_littlebox_photobox_text">正在售卖</span>
                </p>
                <p class="mystore_photo_littlebox_text">标题</p>
                <p class="mystore_photo_littlebox_atext">分类</p>
                <p class="mystore_photo_littlebox_icon">
                    <span class="mystore_photo_littlebox_icon_liulanshu"><img src="{!! Theme::asset()->url('images/浏览图标.png') !!}" alt="">0</span>
                    <span class="mystore_photo_littlebox_icon_shoucangshu"><img src="{!! Theme::asset()->url('images/收藏图标.png') !!}" alt="">0</span>
                    <span class="mystore_photo_littlebox_icon_xiazaishu"><img src="{!! Theme::asset()->url('images/下载图标.png') !!}" alt="">0</span>
                </p>
                <p class="mystore_photo_littlebox_zuidibu">
                    <span class="mystore_photo_littlebox_zuidibu_bj">编辑</span>
                    <span class="mystore_photo_littlebox_zuidibu_sc">下架</span>
                    <span class="mystore_photo_littlebox_zuidibu_djs">1小时前</span>
                </p>
            </div>
            <div class="mystore_photo_littlebox">
                <p class="mystore_photo_littlebox_photobox">
                    <img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="mystore_photo_littlebox_photo">
                    <span class="mystore_photo_littlebox_photobox_text">未上架</span>
                </p>
                <p class="mystore_photo_littlebox_text">标题</p>
                <p class="mystore_photo_littlebox_atext">分类</p>
                <p class="mystore_photo_littlebox_icon">
                    <span class="mystore_photo_littlebox_icon_liulanshu"><img src="{!! Theme::asset()->url('images/浏览图标.png') !!}" alt="">0</span>
                    <span class="mystore_photo_littlebox_icon_shoucangshu"><img src="{!! Theme::asset()->url('images/收藏图标.png') !!}" alt="">0</span>
                    <span class="mystore_photo_littlebox_icon_xiazaishu"><img src="{!! Theme::asset()->url('images/下载图标.png') !!}" alt="">0</span>
                </p>
                <p class="mystore_photo_littlebox_zuidibu">
                    <span class="mystore_photo_littlebox_zuidibu_bj">编辑</span>
                    <span class="mystore_photo_littlebox_zuidibu_sc">上架</span>
                    <span class="mystore_photo_littlebox_zuidibu_djs">1小时前</span>
                </p>
            </div>
            
        </div>  
    </div>
</div> -->

<!-- 作品管理 结束 -->










{!! Theme::asset()->container('specific-css')->usePath()->add('webui-css', 'plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('usercenter-css', 'css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('chosen','plugins/ace/css/chosen.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('chosen','plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-min-js', 'plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-elements-js', 'plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('realname-js', 'js/realnameauth.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('skill','js/doc/skill.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shop','js/doc/shop.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('oss-js', 'js/meishimeitu/oss.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('usershopfb','js/meishimeitu/usershopfb.js') !!}
{!! Theme::widget('avatar')->render() !!}


{!! Theme::asset()->container('custom-css')->usepath()->add('myshop','css/meishimeitu/myshop.css') !!}