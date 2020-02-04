@if(count($my_work)>0)
@foreach($my_work as $my => $v)
<!-- 接受委托模态框  -->
<!-- <div id="qxxm_{{$v['id']}}" tabindex="-1" role="dialog" class="modal fade jswt">
    <label for="qxwt_{{ $v['id'] }}"><div class="jswt_gb"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></div></label>
    <div class="jswt_ms">是否接受该项目的委托？</div>
    <div class="jswt_qdqx">
        <button class="jswt_qd" data-dismiss="modal" onclick="acceptProject({{$v['id']}})">确定</button>
        <button id="qxwt_{{ $v['id'] }}" class="jswt_qx" data-dismiss="modal">取消</button>
    </div>
</div> -->
<!-- 接受委托模态框 结束  -->

<!-- 拒绝委托模态框  -->
<!-- <div id="jjwt_{{$v['id']}}" tabindex="-1" role="dialog" class="modal fade jjwt">
    <label for="qxjj_{{ $v['id'] }}"><div class="jjwt_gb"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></div></label>
    <div class="jjwt_ms">确定拒绝该项目的委托？拒绝后，您将不能再次申请该项目。</div>
    <div class="jjwt_qdqx">
        <button class="jjwt_qd" data-dismiss="modal" onclick="refuseProject({{$v['id']}})">确定</button>
        <button id="qxjj_{{ $v['id'] }}" class="jjwt_qx" data-dismiss="modal">取消</button>
    </div>
</div> -->
<!-- 拒绝委托模态框 结束  -->
@endforeach
@endif

<!-- 项目详情弹框 -->
<div class="xiangmutanchuang_box" id="project_detail">
    <ul class="xiangmutanchuang_box_wenben">
        <li class="xiangmutanchuang_box_wenben_biaoti">麻辣烫店铺的外卖包装设计</li>
        <li class="xiangmutanchuang_box_wenben_xinxi">
            <span class="xiangmuxinxi">
                <span class="xiangmuxinxi_photo"></span>
                <span class="xiangmuxinxi_text">项目信息</span>
            </span>
            <span class="xiangmujindu">
                <span class="xiangmujindu_photo_one"></span>
                <span class="xiangmujindu_text">项目进行中</span>
            </span>
            <!-- <span class="shenqing">申请</span> -->
        </li>
        <li class="xiangmutanchuang_box_wenben_jihua">
            <span class="xiangmutanchuang_box_wenben_jihua_one">
                <img class="xiangmutanchuang_box_wenben_jihua_one_photo" src="" />
                <span class="xiangmutanchuang_box_wenben_jihua_one_text">包装设计</span>
            </span>
            <span class="xiangmutanchuang_box_wenben_jihua_two">
                <span class="xiangmutanchuang_box_wenben_jihua_two_photo"></span>
                <span class="xiangmutanchuang_box_wenben_jihua_two_text">5000元</span>
            </span>
            <span class="xiangmutanchuang_box_wenben_jihua_three">
                <span class="xiangmutanchuang_box_wenben_jihua_three_photo"></span>
                <span class="xiangmutanchuang_box_wenben_jihua_three_text">1周</span>
            </span>
        </li>
        <li class="xiangmutanchuang_box_wenben_xiangqing">
            <h4 class="xiangmutanchuang_box_wenben_xiangqing_biaoti">项目详情</h4>
            <p class="xiangmutanchuang_box_wenben_xiangqing_miaoshu">项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述项目描述</p>
        </li>
        <li class="xiangmutanchuang_box_wenben_fenbuxinxi">
            <span class="xiangmutanchuang_box_wenben_fenbuxinxi_riqi">
                <span class="xiangmutanchuang_box_wenben_fenbuxinxi_riqi_shang">截止日期</span>
                <span class="xiangmutanchuang_box_wenben_fenbuxinxi_riqi_xia">2019-03-23</span>
            </span>
            <span class="xiangmutanchuang_box_wenben_fenbuxinxi_diqu">
                <span class="xiangmutanchuang_box_wenben_fenbuxinxi_diqu_shang">指定地区</span>
                <span class="xiangmutanchuang_box_wenben_fenbuxinxi_diqu_xia">无</span>
            </span>
            <span class="xiangmutanchuang_box_wenben_fenbuxinxi_hangye">
                <span class="xiangmutanchuang_box_wenben_fenbuxinxi_hangye_shang">所属行业</span>
                <span class="xiangmutanchuang_box_wenben_fenbuxinxi_hangye_xia">食品/餐饮</span>
            </span>
            <span class="xiangmutanchuang_box_wenben_fenbuxinxi_chanping">
                <span class="xiangmutanchuang_box_wenben_fenbuxinxi_chanping_shang">参考产品</span>
                <span class="xiangmutanchuang_box_wenben_fenbuxinxi_chanping_xia">无</span>
            </span>
        </li>
        <li class="xiangmutanchuang_box_wenben_shejifengge">
            <span class="xiangmutanchuang_box_wenben_fengge">设计风格</span>
            <div class="select_style fl">
                <ul class="clearfix clearfix_height">
                    <li>
                        <p>简约</p>
                    </li>
                    <li class="select_bar clearfix">
                        <div class="wrapselect clearfix">
                            <div class="leftselect clearfix">
                                <input class="jyleft" type="" value="1">
                                <div class="jydiv"></div>
                                <div class="jydiv1"></div>
                            </div>
                            <div class="centerselect clearfix">
                                <input type="" name="moren" class="centerspan">
                                <span class="centerspanbg"></span>
                                <div class="hldiv"></div>
                            </div>
                            <div class="rightselect clearfix">
                                <input type="" class="hlright" value="2">
                            </div>
                        </div>
                    </li>
                    <li>
                        <p>华丽</p>
                    </li>
                </ul>
                <ul class="clearfix clearfix_height">
                    <li>
                        <p>古典</p>
                    </li>
                    <li class="select_bar clearfix">
                        <div class="wrapselect clearfix">
                            <div class="leftselect clearfix">
                                <input type="" class="gdleft" value="3">
                                <div class="gddiv"></div>
                                <div class="gddiv1"></div>
                            </div>
                            <div class="centerselect clearfix">
                                <input type="" name="moren" class="centerspan1">
                                <span class="centerspanbg1"></span>
                                <div class="xddiv"></div>
                            </div>
                            <div class="rightselect clearfix">
                                <input type="" class="xdright" value="4">
                            </div>
                        </div>
                    </li>
                    <li>
                        <p>现代</p>
                    </li>
                </ul>
                <ul class="clearfix clearfix_height">
                    <li>
                        <p>女性</p>
                    </li>
                    <li class="select_bar clearfix">
                        <div class="wrapselect clearfix">
                            <div class="leftselect clearfix">
                                <input type="" class="nvxleft" value="5">
                                <div class="nvxdiv"></div>
                                <div class="nvxdiv1"></div>
                            </div>
                            <div class="centerselect clearfix">
                                <input type="" name="moren" class="centerspan2">
                                <span class="centerspanbg2"></span>
                                <div class="nxdiv"></div>
                            </div>
                            <div class="rightselect clearfix">
                                <input type="" value="6" class="nxright">
                            </div>
                        </div>
                    </li>
                    <li>
                        <p>男性</p>
                    </li>
                </ul>
                <ul class="clearfix clearfix_height">
                    <li>
                        <p>抽象</p>
                    </li>
                    <li class="select_bar clearfix">
                        <div class="wrapselect clearfix">
                            <div class="leftselect clearfix">
                                <input type="" class="cxleft" value="7">
                                <div class="cxdiv"></div>
                                <div class="cxdiv1"></div>
                            </div>
                            <div class="centerselect clearfix">
                                <input type="" name="moren" class="centerspan3">
                                <span class="centerspanbg3"></span>
                                <div class="wzdiv"></div>
                            </div>
                            <div class="rightselect clearfix">
                                <input type="" class="wzright" value="8">
                            </div>
                        </div>
                    </li>
                    <li>
                        <p>文字</p>
                    </li>
                </ul>
            </div>
        </li>
        <li class="xiangmutanchuang_box_wenben_yanse_jingjiren">
            <div class="xiangmutanchuang_box_wenben_yanse">
                <div class="xiangmutanchuang_box_wenben_yanse_biaoti">颜色</div>
                <div class="xiangmutanchuang_box_wenben_yanse_photobox">
                    <img src="{!! Theme::asset()->url('/images/type/灰黑调.png') !!}" alt="" class="xiangmutanchuang_box_wenben_yanse_photo">
                    <div class="xiangmutanchuang_box_wenben_yanse_text">灰黑调</div>
                </div>
                <div class="xiangmutanchuang_box_wenben_yanse_photobox">
                    <img src="{!! Theme::asset()->url('/images/type/黄色调.png') !!}" alt="" class="xiangmutanchuang_box_wenben_yanse_photo">
                    <div class="xiangmutanchuang_box_wenben_yanse_text">黄色调</div>
                </div>
                <div class="xiangmutanchuang_box_wenben_yanse_photobox">
                    <img src="{!! Theme::asset()->url('/images/type/紫色调.png') !!}" alt="" class="xiangmutanchuang_box_wenben_yanse_photo">
                    <div class="xiangmutanchuang_box_wenben_yanse_text">紫色调</div>
                </div>
                <div class="xiangmutanchuang_box_wenben_yanse_photobox">
                    <img src="{!! Theme::asset()->url('/images/type/橙色调.png') !!}" alt="" class="xiangmutanchuang_box_wenben_yanse_photo">
                    <div class="xiangmutanchuang_box_wenben_yanse_text">橙色调</div>
                </div>
                <div class="xiangmutanchuang_box_wenben_yanse_photobox">
                    <img src="{!! Theme::asset()->url('/images/type/咖啡色调.png') !!}" alt="" class="xiangmutanchuang_box_wenben_yanse_photo">
                    <div class="xiangmutanchuang_box_wenben_yanse_text">咖啡色调</div>
                </div>
                <div class="xiangmutanchuang_box_wenben_yanse_photobox">
                    <img src="{!! Theme::asset()->url('/images/type/绿色调.png') !!}" alt="" class="xiangmutanchuang_box_wenben_yanse_photo">
                    <div class="xiangmutanchuang_box_wenben_yanse_text">绿色调</div>
                </div>
                <div class="xiangmutanchuang_box_wenben_yanse_photobox">
                    <img src="{!! Theme::asset()->url('/images/type/蓝色调.png') !!}" alt="" class="xiangmutanchuang_box_wenben_yanse_photo">
                    <div class="xiangmutanchuang_box_wenben_yanse_text">蓝色调</div>
                </div>
                <div class="xiangmutanchuang_box_wenben_yanse_photobox">
                    <img src="{!! Theme::asset()->url('/images/type/红色调.png') !!}" alt="" class="xiangmutanchuang_box_wenben_yanse_photo">
                    <div class="xiangmutanchuang_box_wenben_yanse_text">红色调</div>
                </div>
                <div class="xiangmutanchuang_box_wenben_yanse_photobox">
                    <img src="{!! Theme::asset()->url('/images/type/自定义.png') !!}" alt="" class="xiangmutanchuang_box_wenben_yanse_photo">
                    <div class="xiangmutanchuang_box_wenben_yanse_text">自定义</div>
                </div>
            </div>
            <div class="xiangmutanchuang_box_wenben_jingjiren">
                <div class="xiangmutanchuang_box_wenben_jingjiren_biaoti">经纪人</div>
                <div class="xiangmutanchuang_box_wenben_jingjiren_text">无</div>
            </div>
        </li>
        <li class="xiangmutanchuang_box_wenben_fujian">
            <div class="xiangmutanchuang_box_wenben_fujian_biaoti">附件</div>
            <ul class="ace-thumbnails" download_imgurl="{!! Theme::asset()->url('/images/task-xiazai/word.png') !!}">
            </ul>
        </li>
    </ul>
</div>

<!-- 项目详情弹框 结束 -->
<!-- 当没有项目时的状态 -->
<!-- <div class="my_project_content">
    <img src="{{Theme::asset()->url('images/meishimeitu/personal/noopen.png')}}" alt="">
</div> -->
<!-- 当没有项目时的状态 结束 -->


<!-- 我的项目  类型状态 -->

<ul class="myproject">
    <li class="myproject_fenlei">
        <p class="myproject_biaoti">
            <span><img src="{!! Theme::asset()->url('images/Parallel tasks.png') !!}" alt="" class="myproject_biaoti_photo"></span>
            <span class="myproject_biaoti_text">我的项目</span>
        </p>
        <p class="myproject_xifen_leixing">
            <span>类型</span>
            <a href="{{url('/user/myTasksList')}}">我发布的</a>
            <a class="daohang_dianji" href="{{url('/user/acceptTasksList')}}">我承接的</a>
        </p>
        <p class="myproject_xifen_zhuangtai">
            <span>状态</span>
            <a class="daohang_dianji" href="{!! URL('user/acceptTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']),['status'=>0])) !!}">全部</a>
            <a href="{!! URL('user/acceptTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']), ['status'=>1])) !!}">委托中</a>
            <a href="{!! URL('user/acceptTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']), ['status'=>2])) !!}">设置中</a>
            <a href="{!! URL('user/acceptTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']), ['status'=>3])) !!}">进行中</a>
            <a href="{!! URL('user/acceptTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']), ['status'=>4])) !!}">已完结</a>
        </p>
    </li>
    <li class="myproject_photo">
        <div class="myproject_photo_biaoti">共{{$count}}个作品</div>
        <!-- 我的项目  我承接的 -->
        <!--我的项目 我承接的 项目委托阶段  -->
        @if(count($my_work)>0)
        @foreach($my_work as $my => $v)
        <div class="myproject_photo_box" id="{{$v['id']}}">
            <div class="myproject_photo_box_text">
                <div class="sjlx">{{$v['cate_name']}}</div>
                <div class="projectName">{{$v['title']}}</div>
                @if(in_array($v['status'], [0,1]))
                <div class="xmwt">项目委托</div>
                @elseif(in_array($v['status'], [3]))
                <div class="xmwt">项目设置</div>
                @elseif(in_array($v['status'], [4,5]))
                <div class="xmwt">项目进行中</div>
                @elseif(in_array($v['status'], [6]))
                <div class="xmwt">项目已完结</div>
                @endif
            </div>
            <div class="myproject_photo_box_jindu">
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red">
                        <div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div>
                    </div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">委托</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    @if(in_array($v['status'], [3,4,5,6]))
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red">
                        <div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div>
                    </div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">设置</div>
                    @else
                    <div class="myproject_photo_box_jindu_dayuan">
                        <div class="myproject_photo_box_jindu_xiaoyuan"></div>
                    </div>
                    <div class="myproject_photo_box_jindu_text">设置</div>
                    @endif
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    @if(in_array($v['status'], [4,5,6]))
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red">
                        <div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div>
                    </div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">进行</div>
                    @else
                    <div class="myproject_photo_box_jindu_dayuan">
                        <div class="myproject_photo_box_jindu_xiaoyuan"></div>
                    </div>
                    <div class="myproject_photo_box_jindu_text">进行</div>
                    @endif
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    @if(in_array($v['status'], [6]))
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red">
                        <div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div>
                    </div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">完成</div>
                    @else
                    <div class="myproject_photo_box_jindu_dayuan">
                        <div class="myproject_photo_box_jindu_xiaoyuan"></div>
                    </div>
                    <div class="myproject_photo_box_jindu_text">完成</div>
                    @endif
                </div>
            </div>
            <div class="myproject_photo_box_buzhou quxiaopadding qiaoliang">
                @if(in_array($v['status'], [1,0]))
                <p class="myproject_photo_box_buzhou_xmys">
                    <span class="myproject_photo_box_buzhou_xmys_ys">项目预算</span>
                    <span class="myproject_photo_box_buzhou_xmys_sz">{{$v['bounty']}}元</span>
                    <span class="myproject_photo_box_buzhou_xmys_hb">人民币</span>
                    <!-- <span class="myproject_photo_box_buzhou_xmys_ckxq" task_id="{{$v['task_id']}}" data-toggle="modal" data-target="#xmxq" onclick="letModalCenter('.xiangmutanchuang_box')">查看详情</span> -->
                    <span class="myproject_photo_box_buzhou_xmys_ckxq" task_id="{{$v['task_id']}}" onclick="getObjectDetail(this)">查看详情</span>
                </p>
                <p class="myproject_photo_box_buzhou_sshy">
                    <span class="myproject_photo_box_buzhou_xmys_hy">所属行业</span>
                    <span class="myproject_photo_box_buzhou_xmys_eg">{{$v['industry_name']}}</span>
                </p>
                <p class="myproject_photo_box_buzhou_xmms">项目描述</p>
                <p class="myproject_photo_box_buzhou_msxj">{{ strip_tags($v['desc']) }}</p>
                @elseif(in_array($v['status'], [3]))
                <p class="myproject_photo_box_buzhou_yssz">
                    <span class="yssz"><label for="{{$v['id']}}_one">一次验收</label><input type="radio" checked class="yssz_radio" value="0" id="{{$v['id']}}_one"><span class="yssz_style"></span></span>
                    <span class="yssz"><label for="{{$v['id']}}_two">二次验收</label><input type="radio" class="yssz_radio" value="1" id="{{$v['id']}}_two"><span class="yssz_style"></span></span>
                </p>
                <p class="myproject_photo_box_buzhou_ycyssm">一次验收为项目完整完成后一次性验收付款</p>
                <p class="myproject_photo_box_buzhou_ycyssmer">二次验收为项目分两次阶段性验收付款，第一次验收支付项目款项30%，第二次验收支付项目尾款</p>
                @elseif(in_array($v['status'], [4]))
                <div class="myproject_photo_box_buzhou_box jxtz_chang">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_white backgroundcolorcg_green">1
                        <div class="xmjxzhengxian_chang"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
                </div>
                <div class="myproject_photo_box_buzhou_box">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">未验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy colorchange_black">2</div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
                </div>
                @elseif(in_array($v['status'], [6]))
                <div class="bztb">
                    <img src="{!! Theme::asset()->url('images/保障印章.png') !!}" alt="" class="tx">
                </div>
                <div class="myproject_photo_box_buzhou_box jxtz_chang">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_white backgroundcolorcg_green">1
                        <div class="xmjxzhengxian_chang backgroundcolorcg_green"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
                </div>
                <div class="myproject_photo_box_buzhou_box">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy  colorchange_white backgroundcolorcg_green">2</div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
                </div>
                @endif
            </div>
            <div class="myproject_photo_box_lianjie">
                @if($v['status'] == 1)
                <div class="myproject_photo_box_lianjie_cxfb accept" xmid="{{$v['id']}}">接受</div>
                <div class="myproject_photo_box_lianjie_scxm refuse" xmid="{{$v['id']}}">拒绝</div>
                @elseif($v['status'] == 3)
                <div class="myproject_photo_box_lianjie_cxfb" onclick="determeSet({{$v['id']}})" task_id="{{$v['task_id']}}">确定</div>
                @elseif($v['status'] == 4)
                <!-- 上传文件模态框 -->
                <div id="upload_{{$v['id']}}" tabindex="-1" role="dialog" class="modal fade annex">
                    <div class="dropzone clearfix" id="dropzone_{{$v['id']}}" url="{{ URL('task/fileUpload')}}" deleteurl="{{ URL('task/fileDelet') }}">
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </div>
                    <button class="abc" disabled="true" project_id="{{$v['id']}}">提交作品</button>
                    <button class="close_btn" data-dismiss="modal">关闭</button>
                </div>
                <!-- 上传文件模态框结束 -->
                <div class="file_update" id="file_update_{{$v['id']}}"></div>
                <div class="zpsc" data-toggle="modal" data-target="#upload_{{$v['id']}}" project_id="{{$v['id']}}" task_id="{{$v['task_id']}}" onclick="letModalCenter('.annex')">上传</div>
                <div class="accepttasks_photo_box_lianjie_fj" project_id="{{$v['id']}}">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span class="fjdx">附件1个（<span class="fjdx_size" project_id="{{$v['id']}}"></span>）</span>
                </div>
                <div class="uploaded_list" onclick="checkUploaded(this)">已上传列表
                    @foreach($workAttachment[$my][0] as $woat)
                    <div style="display:none" class="file_name" name="{{$woat['name']}}" creatime="{{date('Y年m月d日',strtotime($woat['created_at']))}}"></div>
                    @endforeach
                </div>
                @elseif(in_array($v['status'], [6]))
                <div class="myproject_photo_box_lianjie_cxfb_ywj">已完结</div>
                <!-- <div class="accepttasks_photo_box_lianjie_fj">
                    <div class="accepttasks_photo_box_lianjie_fj">
                        <i class="fa fa-link" aria-hidden="true"></i>
                        <span class="fjdx">附件2个（4MB）</span>
                        <a href="#"><span class="fjxz">打包下载</span></a>
                    </div> -->
                {{--<span class="fjdx">附件2个（4MB）</span>--}}
                <span class="fjdx">附件{{count($workAttachment[$my][0])}}个</span>
                {{--<a href="#"><span class="fjxz">打包下载</span></a>--}}
                @foreach($workAttachment[$my][0] as $t)
                <!-- <span class="fjxz">下载
                    <table>
                        <thead>
                            <tr>
                                <th>文件名称</th>
                                <th>上传时间</th>
                                <th>下载附件</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$t['name']}}</td>
                                <td>时间{{date('Y-m-d',strtotime($t['created_at']))}}</td>
                                <td><a href="/task/download/{{$t['id']}}">点击下载</a></td>
                            </tr>
                        </tbody>
                    </table>
                </span> -->
                @endforeach
            @endif
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：{{date("Y年m月d日",strtotime($v['created_at']))}}</div>
            </div>
            {{--{{$v['status']}},id:{{$v['task_id']}}--}}
        </div>
        @endforeach
        @else
        <div class="my_project_content">
            <img src="{{Theme::asset()->url('images/meishimeitu/personal/noopen.png')}}" alt="">
        </div>
        @endif
        <div class="paging_bootstrap">
            {!! $my_work->appends($_GET)->render() !!}
        </div>
        <!-- 我的项目  我承接的  结束 -->
    </li>
</ul>
<div id="uploaded_list_layer" style="display: none">
    <table>
        <thead>
            <tr>
                <th>文件名称</th>
                <th>上传时间</th>
            </tr>
        </thead>
        <tbody id="xunhuan_tbody">
        </tbody>
    </table>
</div>





<script>
    function timeChange(obj) {
        var time = obj.value;
        var url = location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for (var i = 0; i < strs.length; i++) {
                theRequest[strs[i].split("=")[0]] = (strs[i].split("=")[1]);
            }
            window.location.href = "/user/acceptTasksList?uid=" + theRequest.uid + "&time=" + time + "&type=" + theRequest.type + "&status=" + theRequest.status;
        } else {
            window.location.href = "/user/acceptTasksList?time=" + time;
        }
    }

    var uploadRule = '{!! CommonClass::attachmentUnserialize() !!}';
    uploadRule = JSON.parse(uploadRule);
    var extensions = '';
    for (var i in uploadRule.extensions) {
        extensions += uploadRule.extensions + ',';
    }
    @if(isset($maxFiles))
    var maxFiles = {
        {
            $maxFiles
        }
    };
    @else
    var maxFiles = 3;
    @endif
    @if(isset($initimage))
    var initimage = {
        !!$initimage!!
    };
    @else
    var initimage = 3;
    @endif
</script>
{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('issuetask','plugins/ace/css/dropzone.css') !!}

{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}
<!-- 上传文件插件 -->
{!! Theme::asset()->container('custom-js')->usepath()->add('dropzone','plugins/ace/js/dropzone.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ajaxfileupload','js/ajaxfileupload.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('Undertake_project','js/doc/Undertake_project.js') !!}
@if($pie_data)
{!! Theme::widget('mypie',['pie_data'=>$pie_data])->render() !!}
@endif
{!! Theme::asset()->container('custom-css')->usepath()->add('myproject','css/meishimeitu/myproject.css') !!}

<!-- 个人中心 我的项目 导航栏点击效果 -->
{!! Theme::asset()->container('custom-js')->usepath()->add('usermenu','js/doc/usermenu.js') !!}