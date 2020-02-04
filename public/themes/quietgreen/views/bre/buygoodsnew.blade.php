<div class="location">
    <div class="container">
        <i class="home_icon"></i>&nbsp;&nbsp;&nbsp;<a href="{!! CommonClass::homePage() !!}">首页</a> <span class="ri_horn"></span><span>平台店铺</span><span class="ri_horn"></span><span>{{$cate->name}}</span><span class="ri_horn"></span><span>{{$goodsinfo->title}}</span>
    </div>
</div>

<article>
    <div class="container">
        <div class="box_wrap clearfix ">
            <div class="class_left">
                <div class="title_wrap">
                    <p class="clearfix">{{$goodsinfo->title}}
                    <span class="title_wrap_span_box">
                        <span class="title_wrap_span">
                            <span class="title_wrap_s_bg see_span"></span>
                            <span>浏览：</span>
                            <span>{{$goodsinfo->view_num}}</span>
                        </span>
                        <span class="title_wrap_span">
                            <span class="title_wrap_s_bg shou_span"></span>
                            <span>收藏</span>
                            <span>{{$goodsinfo->collect}}</span>
                        </span>
                        <span class="title_wrap_span">
                            <span class="title_wrap_s_bg down_span "></span>
                            <span>下载：</span>
                            <span>{{$goodsinfo->sales_num}}</span>
                        </span>
                    </span>
                    </p>
                </div>
                <div class="class_left_content">
                </div>
                <div class="class_left_bottom">
                    <p>
                        i3job提供原创的精品素材下载，本次作品主题是{{$cate->name}}，使用场景是{{$goodsinfo->catename}}，作品编号是<span>000000000</span>，格式是<span>PSD</span>，建议使用<span>Photoshop CC</span>软件打开，该<span>LOGO设计</span>素材大小是<span>4.41M</span>，尺寸是<span>4724x2362</span>像素，i3job提供精品原创设计模板下载，内容包括UI设计模板、室内设计素材等，源文件下载后可以编辑修改文字图片，均为版权设计作品，下载原创设计素材就到i3job
                    </p>
                    <p><span>{{$goodsinfo->title}}</span>是由{{$goodsinfo->usersname}}原创设计上传</p>
                </div>

            </div>
            <div class="class_right">
                <p class="price_wrap clearfix">
                    <span class="price">价格：<span>￥</span><span>{{$goodsinfo->cash}}</span></span>
                    <a href="javascript:;" class="download">立即下载</a>
                </p>
                <div class="data_display">
                    <p class="sucai clearfix">
                    <span class="span_wrap">素材编号：<span>000000000</span></span>
                    </p>
                    <p class="sucai clearfix">
                        <span class="span_wrap">素材格式：<span>PSD</span></span>
                        <span class="span_wrap">色彩模式：<span>RPG</span></span>
                    </p>
                    <p class="sucai clearfix">
                        <span class="span_wrap">肖像版权：<span>无（人物仅参考）</span></span>
                        <span class="span_wrap">图片尺寸：<span>0000X0000</span></span>
                    </p>
                    <p class="sucai clearfix">
                        <span class="span_wrap">编辑次数：<span>0</span></span>
                        <span class="span_wrap">素材大小：<span>00MB</span></span>
                    </p>
                    <p class="sucai clearfix">
                        <span class="span_wrap">上传时间：<span>{{$goodsinfo->created_at}}</span></span>
                    </p>
                    <p class="sucai clearfix">
                        <span class="span_wrap">作者：<span>由"{{$goodsinfo->usersname}}"非独家上传分享</span></span>
                    </p>
                    <div class="clearfix">
                        <p>
                            <span class="collection">收藏</span>
                            <span class="sample_reels">作品集</span>
                        </p>
                        <p>
                            <a href="javascript:;" class="revise">申请修改</a>
                        </p>
                    </div>
                </div>
                <div class="circle_wrap clearfix">
                    <p><span class="circle">正</span><span>正版授权</span></p>
                    <p><span class="circle">质</span><span>质量保证</span></p>
                    <p><span class="circle">售</span><span>售后服务</span></p>
                </div>
                <div class="statement_wrap">
                    <p>
                        声明：末班内容仅供参考，i3job是正版商业图库，所有原创作品（含预览图）均受著作权法保护。著作权及相关权利归本网站所有，未经许可任何人不得擅自使用，否则将依法要求承担赔偿责任。
                    </p>
                </div>
                <div class="complain_wrap">
                    <a href="javascript:showWlayer()" class="complain">维权投诉</a>
                </div>
            </div>
        </div>
        </div>
</article>

<section>
    <div class="container">
        <div class="box_wrap">
            <div class="title_wrap">
                <p>相似推荐</p>
            </div>
            <ul class="class_right_content clearfix">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</section>

<div class="wpop">
    <div class="wpop_title">
        <p>举报作品</p>
        <span class="close_pop">x</span>
    </div>
    <div class="wpop_content">
        <p class="radio_box clearfix">
            <span class="s_radio"><span class="one"></span></span>
            <span class="ra_word">该作品违反相关法律法规</span>
        </p>
        <p class="radio_box clearfix">
            <span class="s_radio"><span class="piracy_title"></span></span>
            <span class="ra_word">侵权/盗版问题</span>
        </p>
        <p class="piracy hide">
            <span>请详细描述并提供原作品链接</span>
            <textarea>
            </textarea>
        </p>
        <p class="radio_box clearfix">
            <span class="s_radio"><span class="other_title"></span></span>
            <span class="ra_word">其他原因</span>
        </p>
        <p class="other hide">
            <span>请详细描述并提供原作品链接</span>
            <textarea>
            </textarea>
        </p>
        <p class="support">
            <span>我们的进步需要大家的支持</span>
        </p>
    </div>
    <div class="wpop_foot">
        <a href="javascript:;" class="submit">提交</a>
    </div>
</div>
<div class="wlayer"></div>
{!! Theme::asset()->container('custom-css')->usepath()->add('buygoodsnew','css/shop/buygoodsnew.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('js','plugins/jquery/js.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('buygoodsnew','js/shop/buygoodsnew.js') !!}