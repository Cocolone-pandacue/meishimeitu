<!-- 雇佣拒绝模态框 -->
<div id="myDeSigner" tabindex="-1" role="dialog" class="modal fade sfgy">
    <div class="sfgy_one"><label for="qx"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></label></div>
    <div class="sfgy_two">是否雇佣XXXX来完成该项目？</div>
    <div class="sfgy_three">确定后不得修改，是否确定？</div>
    <div class="sfgy_four">
        <button class="sfgy_four_yes" data-dismiss="modal" onclick="removeFocus()">确定</button>
        <button id="qx" class="sfgy_four_no" data-dismiss="modal">取消</button>
    </div>
</div>
<!-- 雇佣拒绝模态框 结束 -->

<!-- 是否重新编辑模态框 -->
<div id="cxbj" tabindex="-1" role="dialog" class="modal fade rewrite">
    <div class="rewrite_one"><label for="rewrite_four_no"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></label></div>
    <div class="rewrite_two">重新编辑将会清除已申请的设计师！</div>
    <div class="rewrite_three">是否确定重新编辑？</div>
    <div class="rewrite_four">
        <button class="rewrite_four_yes" data-dismiss="modal" onclick="removeFocus()">确定</button>
        <button id="rewrite_four_no" class="rewrite_four_no" data-dismiss="modal">取消</button>
    </div>
</div>
<!-- 是否重新编辑模态框 结束 -->

<!-- 是否取消项目模态框 -->
<div id="qxxm" tabindex="-1" role="dialog" class="modal fade qxxm">
    <div class="qxxm_one"><label for="qxxm_four_no"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></label></div>
    <div class="qxxm_two">是否取消项目？</div>
    <div class="qxxm_four">
        <button class="qxxm_four_yes" data-dismiss="modal" onclick="removeFocus()">确定</button>
        <button id="qxxm_four_no" class="qxxm_four_no" data-dismiss="modal">取消</button>
    </div>
</div>
<!-- 是否取消项目模态框 结束 -->

<!-- 是否删除项目模态框 -->
<div id="scxm" tabindex="-1" role="dialog" class="modal fade scxm">
    <div class="scxm_gb"><label for="qxsc"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></label></div>
    <div class="scxm_ms">是否删除项目？</div>
    <div class="scxm_qdqx">
        <button class="scxm_qd" data-dismiss="modal" onclick="removeProject()">确定</button>
        <button id="scxm" class="scxm_qx" data-dismiss="modal">取消</button>
    </div>
</div>
<!-- 是否删除项目模态框 结束  -->

<!-- 修改意见模态框 -->
<div id="xgyj" tabindex="-1" role="dialog" class="modal fade xgyj">
    <div class="xgyj_gb"><label for="qxxg"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></label></div>
    <div class="xgyj_ms">修改意见</div>
    <textarea></textarea>
    <div class="xgyj_qdqx">
        <button class="xgyj_qd" data-dismiss="modal" onclick="removeProject()">确定</button>
        <button id="qxxg" class="xgyj_qx" data-dismiss="modal">取消</button>
    </div>
</div>
<!-- 修改意见模态框 结束 -->

<!-- 阶段结款模态框 -->
<div id="jdjk" tabindex="-1" role="dialog" class="modal fade jdjk">
    <div class="jdjk_gb"><label for="qxjk"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></label></div>
    <div class="jdjk_ms">验收完成将会支付阶段酬金给设计师！该阶段酬金为总项目金额的30%！</div>
    <div class="jdjk_qdqx">
        <button class="jdjk_qd" data-dismiss="modal" onclick="removeProject()">确定</button>
        <button id="qxjk" class="jdjk_qx" data-dismiss="modal">取消</button>
    </div>
</div>
<!-- 阶段结款模态框 结束  -->

<!-- 接受委托模态框  -->
<div id="jswt" tabindex="-1" role="dialog" class="modal fade jswt">
    <div class="jswt_gb"><label for="qxwt"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></label></div>
    <div class="jswt_ms">是否接受该项目的委托？</div>
    <div class="jswt_qdqx">
        <button class="jswt_qd" data-dismiss="modal" onclick="removeProject()">确定</button>
        <button id="qxwt" class="jswt_qx" data-dismiss="modal">取消</button>
    </div>
</div>
<!-- 接受委托模态框 结束  -->

<!-- 拒绝委托模态框  -->
<div id="jjwt" tabindex="-1" role="dialog" class="modal fade jjwt">
    <div class="jjwt_gb"><label for="qxjj"><img src="{!!Theme::asset()->url('images/type/关闭icon.png') !!}" alt=""  class="foucusman_photo_littlebox_photo"></label></div>
    <div class="jjwt_ms">确定拒绝该项目的委托？拒绝后，您将不能再次申请该项目。</div>
    <div class="jjwt_qdqx">
        <button class="jjwt_qd" data-dismiss="modal" onclick="removeProject()">确定</button>
        <button id="qxjj" class="jjwt_qx" data-dismiss="modal">取消</button>
    </div>
</div>
<!-- 拒绝委托模态框 结束  -->

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
            <a href="{{url('/user/acceptTasksList')}}">我承接的</a>
        </p>
        <p class="myproject_xifen_zhuangtai">
            <span>状态</span>
            <a href="#">全部</a>
            <a href="#">还未发布</a>
            <a href="#">托管中</a>
            <a href="#">委托中</a>
            <a href="#">设置中</a>
            <a href="#">进行中</a>
            <a href="#">已完结</a>
        </p>
    </li>

    <li class="myproject_photo">
        <div class="myproject_photo_biaoti">共4个作品</div>

    <!-- 我的项目  我发布的 -->


    <!-- 还未发布 -->

        <!-- <div class="myproject_photo_box">
            <p class="myproject_photo_box_text">
                <span class="sjlx">LOGO设计</span>
                <span class="hwfb">还未发布</span>
            </p>
            <div class="myproject_photo_box_jindu">
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">草案</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                    <div class="myproject_photo_box_jindu_text">托管</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                    <div class="myproject_photo_box_jindu_text">进行</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                    <div class="myproject_photo_box_jindu_text">完成</div>
                </div>
            </div> -->

            <!-- 未发布 项目类型阶段 -->
            <!-- <div class="myproject_photo_box_buzhou">
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤1</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目类型icon@2x.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目类型</p>
                </div>
                <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh">步骤2</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/需求明细icon@2x.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms">项目需求</p>
                </div>
                <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i></div>
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh">步骤3</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/发布方式icon@2x.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms">发布方式</p>
                </div>
                <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i></div>
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh">步骤4</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/资金托管icon@2x.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms">资金托管</p>
                </div>
                <div class="myproject_photo_box_lianjie">
                    <a href="#"><div class="myproject_photo_box_lianjie_cxfb">重新发布</div></a>
                    <a href="#"><div class="myproject_photo_box_lianjie_scxm" data-toggle="modal" data-target="#scxm"  onclick="divCenter('.scxm')">删除项目</div></a>
                    <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
                </div>
            </div> -->
            <!-- 未发布 项目类型阶段结束 -->

            <!-- 未发布 需求明细阶段 -->
            <!-- <div class="myproject_photo_box_buzhou">
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤1</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目类型icon@2x.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目类型</p>
                </div>
                <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤2</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目需求蓝色icon.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目需求</p>
                </div>
                <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh">步骤3</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/发布方式icon@2x.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms">发布方式</p>
                </div>
                <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i></div>
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh">步骤4</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/资金托管icon@2x.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms">资金托管</p>
                </div>
                <div class="myproject_photo_box_lianjie">
                    <a href="#"><div class="myproject_photo_box_lianjie_cxfb">重新发布</div></a>
                    <a href="#"><div class="myproject_photo_box_lianjie_scxm" data-toggle="modal" data-target="#scxm"  onclick="divCenter('.scxm')">删除项目</div></a>
                    <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
                </div>
            </div> -->
            <!-- 未发布 需求明细阶段结束 -->

            <!-- 未发布 发布方式阶段 -->
            <!-- <div class="myproject_photo_box_buzhou">
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤1</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目类型icon@2x.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目类型</p>
                </div>
                <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤2</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目需求蓝色icon.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目需求</p>
                </div>
                <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤3</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/发布方式蓝色icon.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">发布方式</p>
                </div>
                <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                <div class="myproject_photo_box_buzhou_box">
                    <p class="myproject_photo_box_buzhou_box_bzxh">步骤4</p>
                    <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/资金托管icon@2x.png') !!}" alt="" class=""></p>
                    <p class="myproject_photo_box_buzhou_box_bzms">资金托管</p>
                </div>
                <div class="myproject_photo_box_lianjie">
                    <a href="#"><div class="myproject_photo_box_lianjie_cxfb">重新发布</div></a>
                    <a href="#"><div class="myproject_photo_box_lianjie_scxm" data-toggle="modal" data-target="#scxm"  onclick="divCenter('.scxm')">删除项目</div></a>
                    <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
                </div>
            </div> -->
            <!-- 未发布 发布方式阶段结束 -->
        <!-- </div> -->


    <!-- 还未发布 结束  -->

    <!-- 项目托管中 -->

    <!-- <div class="myproject_photo_box"> -->

    <!-- 项目托管中 当没有设计师申请时 -->
            <!-- <div class="myproject_photo_box_text">
                <div class="sjlx">LOGO设计</div>
                <div class="xmtg">项目托管中</div>
            </div> -->
    <!-- 项目托管中 当没有设计师申请时结束 -->

    <!-- 项目托管中 当有但不超过7位设计师申请时 -->
        <!-- <div class="myproject_photo_box_text">
            <div class="sjlx">LOGO设计</div>
            <div class="txlb">
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
            </div>
            <div class="xmtg">项目托管中</div>
        </div> -->
    <!-- 项目托管中 当有但不超过7位设计师申请时结束 -->

    <!-- 项目托管中 当有超过7位设计师申请时 -->
        <!-- <div class="myproject_photo_box_text">
            <div class="sjlx">LOGO设计</div>
            <div class="txlb">
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                    <div class='txxt'>
                        <div class="txxt_one">
                            <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                        </div>
                        <div class="txxt_two">
                            <span class="txxt_two_area">上海</span>
                            <span class="txxt_two_shuxian"></span>
                            <span class="txxt_two_area">平面设计师</span>
                        </div>
                        <div class='guyong' data-toggle='modal' data-target='#myDeSigner' onclick='divCenter('.sfgy')'>雇佣</div>
                        <div class='jujue'>拒绝</div>
                    </div>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                    </a>
                </div>
            </div>
            <div class="txgd">
                <div>
                    <a href="#">
                        <img src="{!! Theme::asset()->url('images/我的项目中-更多.png') !!}" alt="" class="tx hdgd">
                    </a>
                    <div class="moretx">
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('images/头像1.png') !!}" alt="" class="tx">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="xmtg">项目托管中</div>
        </div> -->
    <!-- 项目托管中 当有超过7位设计师申请时 结束 -->

        <!-- <div class="myproject_photo_box_jindu">
            <div class="myproject_photo_box_jindu_miaoshu">
                <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                <div class="myproject_photo_box_jindu_text colorchange_red">草案</div>
            </div>
            <div class="myproject_photo_box_jindu_shuxian"></div>
            <div class="myproject_photo_box_jindu_miaoshu">
                <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                <div class="myproject_photo_box_jindu_text colorchange_red">托管</div>
            </div>
            <div class="myproject_photo_box_jindu_shuxian"></div>
            <div class="myproject_photo_box_jindu_miaoshu">
                <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                <div class="myproject_photo_box_jindu_text">进行</div>
            </div>
            <div class="myproject_photo_box_jindu_shuxian"></div>
            <div class="myproject_photo_box_jindu_miaoshu">
                <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                <div class="myproject_photo_box_jindu_text">完成</div>
            </div>
        </div>
        <div class="myproject_photo_box_buzhou">
            <div class="myproject_photo_box_buzhou_box">
                <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤1</p>
                <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目类型icon@2x.png') !!}" alt="" class=""></p>
                <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目类型</p>
            </div>
            <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
            <div class="myproject_photo_box_buzhou_box">
                <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤2</p>
                <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目需求蓝色icon.png') !!}" alt="" class=""></p>
                <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目需求</p>
            </div>
            <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
            <div class="myproject_photo_box_buzhou_box">
                <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤3</p>
                <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/发布方式蓝色icon.png') !!}" alt="" class=""></p>
                <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">发布方式</p>
            </div>
            <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
            <div class="myproject_photo_box_buzhou_box">
                <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤4</p>
                <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/资金托管蓝色icon.png') !!}" alt="" class=""></p>
                <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">资金托管</p>
            </div>
        </div>
        <div class="myproject_photo_box_lianjie">
            <a href="#"><div class="myproject_photo_box_lianjie_cxfb"  data-target="#cxbj" data-toggle="modal" onclick="divCenter('.rewrite')">重新编辑</div></a>
            <a href="#"><div class="myproject_photo_box_lianjie_scxm" data-toggle="modal" data-target="#qxxm" onclick="divCenter('.qxxm')">取消项目</div></a>
            <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
        </div>
    </div>   -->


    <!-- 项目托管中 结束  -->


      <!-- 项目进行中 -->

    <!-- <div class="myproject_photo_box">
            <div class="myproject_photo_box_text">
                <div class="sjlx">LOGO设计</div>
                <div class="xmjxz">项目进行中</div>
            </div>
        <div class="myproject_photo_box_jindu">
            <div class="myproject_photo_box_jindu_miaoshu">
                <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                <div class="myproject_photo_box_jindu_text colorchange_red">草案</div>
            </div>
            <div class="myproject_photo_box_jindu_shuxian"></div>
            <div class="myproject_photo_box_jindu_miaoshu">
                <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                <div class="myproject_photo_box_jindu_text colorchange_red">托管</div>
            </div>
            <div class="myproject_photo_box_jindu_shuxian"></div>
            <div class="myproject_photo_box_jindu_miaoshu">
                <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                <div class="myproject_photo_box_jindu_text colorchange_red">进行</div>
            </div>
            <div class="myproject_photo_box_jindu_shuxian"></div>
            <div class="myproject_photo_box_jindu_miaoshu">
                <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                <div class="myproject_photo_box_jindu_text">完成</div>
            </div>
        </div> -->

        <!-- 当只有两个阶段 -->

            <!--  项目准备阶段   -->
        <!-- <div class="myproject_photo_box_buzhou">
            <div class="myproject_photo_box_buzhou_box jxtz_chang">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                <div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_white backgroundcolorcg_green">1
                    <div class="xmjxzhengxian_chang backgroundcolorcg_green"></div>
                </div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
            </div>
            <div class="myproject_photo_box_buzhou_box">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">未验收</div>
                <div class="myproject_photo_box_buzhou_box_xhy colorchange_black">2</div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
            </div>
        </div>
        <div class="myproject_photo_box_lianjie">
            <a href="#"><div class="myproject_photo_box_lianjie_cxfb">阶段结款</div></a>
            <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
        </div>  -->
            <!-- 项目准备阶段 结束 -->
            <!--  第一阶段阶段   -->
        <!-- <div class="myproject_photo_box_buzhou">
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
        </div>
        <div class="myproject_photo_box_lianjie">
            <a href="#"><div class="myproject_photo_box_lianjie_cxfb backgroundcolorcg_green colorchange_white">阶段结款</div></a>
            <a href="#"><div class="myproject_photo_box_lianjie_scxm">申请修改</div></a>
            <div class="myproject_photo_box_lianjie_fj">
                <i class="fa fa-link" aria-hidden="true"></i>
                <span class="fjdx">附件2个（4MB）</span>
                <a href="#"><span class="fjxz">打包下载</span></a>
            </div>
            <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
        </div> -->
            <!-- 第一阶段阶段 结束 -->

        <!-- 当只有两个阶段 结束 -->





        <!-- 当有三个阶段 -->


           <!--  项目准备阶段   -->
        <!-- <div class="myproject_photo_box_buzhou">
            <div class="myproject_photo_box_buzhou_box jxtz">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                <div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_white backgroundcolorcg_green">1
                    <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                </div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
            </div>
            <div class="myproject_photo_box_buzhou_box jxtz">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">未验收</div>
                <div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_black">2
                    <div class="xmjxzhengxian"></div>
                </div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
            </div>
            <div class="myproject_photo_box_buzhou_box">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">未验收</div>
                <div class="myproject_photo_box_buzhou_box_xhy colorchange_black">3</div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第二阶段</div>
            </div>
        </div>
        <div class="myproject_photo_box_lianjie">
            <a href="#"><div class="myproject_photo_box_lianjie_cxfb">阶段结款</div></a>
            <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
        </div>  -->
           <!-- 项目准备阶段 结束 -->
           <!--  验收第一阶段   -->
        <!-- <div class="myproject_photo_box_buzhou">
            <div class="myproject_photo_box_buzhou_box jxtz">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                <div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_white backgroundcolorcg_green">1
                    <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                </div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
            </div>
            <div class="myproject_photo_box_buzhou_box jxtz">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                <div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_white backgroundcolorcg_green">2
                    <div class="xmjxzhengxian"></div>
                </div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
            </div>
            <div class="myproject_photo_box_buzhou_box">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">未验收</div>
                <div class="myproject_photo_box_buzhou_box_xhy">3</div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第二阶段</div>
            </div>
        </div>
        <div class="myproject_photo_box_lianjie">
            <a href="#"><div class="myproject_photo_box_lianjie_cxfb backgroundcolorcg_green colorchange_white"  data-toggle="modal" data-target="#jdjk">阶段结款</div></a>
            <a href="#"><div class="myproject_photo_box_lianjie_scxm" data-toggle="modal" data-target="#xgyj">申请修改</div></a>
            <div class="myproject_photo_box_lianjie_fj">
                <i class="fa fa-link" aria-hidden="true"></i>
                <span class="fjdx">附件2个（4MB）</span>
                <a href="#"><span class="fjxz">打包下载</span></a>
            </div>
            <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
        </div> -->
            <!-- 验收第一阶段 结束 -->
   
            <!--  验收第二阶段   -->
     <!-- <div class="myproject_photo_box_buzhou">
            <div class="myproject_photo_box_buzhou_box jxtz">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">1
                    <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                </div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
            </div>
            <div class="myproject_photo_box_buzhou_box jxtz">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">2
                    <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                </div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
            </div>
            <div class="myproject_photo_box_buzhou_box">
                <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                <div class="myproject_photo_box_buzhou_box_xhy  colorchange_white backgroundcolorcg_green">3</div>
                <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第二阶段</div>
            </div>
        </div>
        <div class="myproject_photo_box_lianjie">
            <a href="#"><div class="myproject_photo_box_lianjie_cxfb backgroundcolorcg_green colorchange_white">阶段结款</div></a>
            <a href="#"><div class="myproject_photo_box_lianjie_scxm">申请修改</div></a>
            <div class="myproject_photo_box_lianjie_fj">
                <i class="fa fa-link" aria-hidden="true"></i>
                <span class="fjdx">附件2个（4MB）</span>
                <a href="#"><span class="fjxz">打包下载</span></a>
            </div>
            <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
        </div> -->
            <!-- 验收第二阶段 结束 -->
    <!-- </div>   -->
        <!-- 当有三个阶段  -->
    <!-- 项目进行中 结束  -->
 
    



    


    <!-- 项目已完结阶段 -->


        <!-- <div class="myproject_photo_box">
            <div class="myproject_photo_box_text">
                <div class="sjlx">LOGO设计</div>
                <div class="xmywj">项目已完结</div>
            </div>
            <div class="myproject_photo_box_jindu">
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">草案</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">托管</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">进行</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">完成</div>
                </div>
            </div> -->

        <!-- 当只有两个阶段 -->
        <!-- <div class="myproject_photo_box_buzhou qiaoliang">
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
        </div>
        <div class="myproject_photo_box_lianjie">
            <a href="#"><div class="myproject_photo_box_lianjie_cxfb">已完结</div></a>
            <div class="myproject_photo_box_lianjie_fj">
                <i class="fa fa-link" aria-hidden="true"></i>
                <span class="fjdx">附件2个（4MB）</span>
                <a href="#"><span class="fjxz">打包下载</span></a>
            </div>
            <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
        </div> -->
        <!-- 当只有两个阶段 结束 -->





        <!-- 当有三个阶段 -->
            <!-- <div class="myproject_photo_box_buzhou qiaoliang">
                <div class="bztb">
                    <img src="{!! Theme::asset()->url('images/保障印章.png') !!}" alt="" class="tx">
                </div>
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">1
                        <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
                </div>
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">2
                        <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
                </div>
                <div class="myproject_photo_box_buzhou_box">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy  colorchange_white backgroundcolorcg_green">3</div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第二阶段</div>
                </div>
            </div>
            <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb">已完结</div></a>
                <div class="myproject_photo_box_lianjie_fj">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span class="fjdx">附件2个（4MB）</span>
                    <a href="#"><span class="fjxz">打包下载</span></a>
                </div>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div>
        </div>   -->
        <!-- 当有三个阶段  -->


        <!-- 项目已完结阶段 结束 -->



    <!-- 我的项目  我发布的结束 -->


    <!-- 我的项目  我承接的 -->

        <!--我的项目 我承接的 项目委托阶段  -->
        

        <div class="myproject_photo_box">
            <div class="myproject_photo_box_text">
                <div class="sjlx">LOGO设计</div>
                <div class="xmwt">项目委托</div>
            </div>
            <div class="myproject_photo_box_jindu">
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">委托</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                    <div class="myproject_photo_box_jindu_text">设置</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                    <div class="myproject_photo_box_jindu_text">进行</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                    <div class="myproject_photo_box_jindu_text">完成</div>
                </div>
            </div>
            <div class="myproject_photo_box_buzhou quxiaopadding">
                <p class="myproject_photo_box_buzhou_xmys">
                    <span class="myproject_photo_box_buzhou_xmys_ys">项目预算</span>
                    <span class="myproject_photo_box_buzhou_xmys_sz">5000元</span>
                    <span class="myproject_photo_box_buzhou_xmys_hb">人民币</span>
                    <a><span class="myproject_photo_box_buzhou_xmys_ckxq">查看详情</span></a>
                </p>
                <p class="myproject_photo_box_buzhou_sshy">
                    <span class="myproject_photo_box_buzhou_xmys_hy">所属行业</span>
                    <span class="myproject_photo_box_buzhou_xmys_eg">广告传媒</span>
                </p>
                <p class="myproject_photo_box_buzhou_xmms">项目描述</p>
                <p class="myproject_photo_box_buzhou_msxj">北京去来品牌管理有限公司是一家以专业体育，娱乐资源为核心，为企业及品牌提供体育、娱乐资源分享、资源合作、资源开发及数据服务的专业品牌管理服务机构。LOGO和Vi引展，引展时尚新潮流</p>
            </div>
            <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb backgroundcolorcg_green colorchange_white" data-toggle="modal" data-target="#jswt">接受</div></a>
                <a href="#"><div class="myproject_photo_box_lianjie_scxm" data-toggle="modal" data-target="#jjwt">拒绝</div></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div>
    <!--我的项目 我承接的 项目委托阶段  结束-->
    
    <!-- 我的项目 我承接的 项目设置阶段 -->
        <!-- <div class="myproject_photo_box">
            <div class="myproject_photo_box_text">
                <div class="sjlx">LOGO设计</div>
                <div class="xmsz">项目设置</div>
            </div>
            <div class="myproject_photo_box_jindu">
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">委托</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">设置</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                    <div class="myproject_photo_box_jindu_text ">进行</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                    <div class="myproject_photo_box_jindu_text">完成</div>
                </div>
            </div>

            <div class="myproject_photo_box_buzhou quxiaopadding">
                <p class="myproject_photo_box_buzhou_yssz">
                    <span class="yssz"><label for="yssz_one">一次验收</label><input type="radio" class="yssz_radio" name="yssz" id="yssz_one"><span class="yssz_style"></span></span>
                    <span class="yssz"><label for="yssz_two">二次验收</label><input checked type="radio" class="yssz_radio" name="yssz" id="yssz_two"><span class="yssz_style"></span></span>
                </p>
                <p class="myproject_photo_box_buzhou_ycyssm">一次验收为项目完整完成后一次性验收付款</p>
                <p class="myproject_photo_box_buzhou_ycyssmer">二次验收为项目分两次阶段性验收付款，第一次验收支付项目款项30%，第二次验收支付项目尾款</p>
            </div>
            <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb backgroundcolorcg_green colorchange_white">接受</div></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div> -->

    <!-- 我的项目 我承接的 项目设置阶段 结束 -->

    <!-- 我的项目 我承接的 项目进行中 -->
    <!-- <div class="myproject_photo_box">
            <div class="myproject_photo_box_text">
                <div class="sjlx">LOGO设计</div>
                <div class="xmjxz">项目进行中</div>
            </div>
            <div class="myproject_photo_box_jindu">
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">委托</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">设置</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">进行</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                    <div class="myproject_photo_box_jindu_text">完成</div>
                </div>
            </div> -->

        <!-- 当仅有两个阶段收款 -->
            <!-- 项目准备阶段 -->
            <!-- <div class="myproject_photo_box_buzhou">
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
            </div> -->
                <!-- 当未上传作品 -->
            <!-- <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb">提交作品</div></a>
                <a href="#"><span class="zpsc">作品上传</span></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div>  -->
                <!-- 当未上传作品 结束-->
                <!-- 当上传作品后 -->
            <!-- <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb colorchange_white backgroundcolorcg_green">提交作品</div></a>
                <div class="myproject_photo_box_lianjie_fj">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span class="fjdx">附件2个（4MB）</span>
                </div>
                <a href="#"><span class="zpsc">重新上传</span></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div> -->
                <!-- 当上传作品后 结束 -->
            <!-- 项目准备阶段 结束 -->
        <!-- 当仅有两个阶段收款 结束-->
        <!-- 当有3个阶段收款 -->
            <!-- 准备阶段 -->
            <!-- <div class="myproject_photo_box_buzhou">
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">1
                        <div class="xmjxzhengxian"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
                </div>
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">未验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang">2
                        <div class="xmjxzhengxian"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
                </div>
                <div class="myproject_photo_box_buzhou_box">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">未验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy">3</div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第二阶段</div>
                </div>
            </div> -->
                <!-- 当未上传作品 -->
            <!-- <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb">提交作品</div></a>
                <a href="#"><span class="zpsc">作品上传</span></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div> -->
                <!-- 当未上传作品 结束-->
                <!-- 当上传作品后 -->
            <!-- <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb colorchange_white backgroundcolorcg_green">提交作品</div></a>
                <div class="myproject_photo_box_lianjie_fj">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span class="fjdx">附件2个（4MB）</span>
                </div>
                <a href="#"><span class="zpsc">重新上传</span></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div> -->
                <!-- 当上传作品后 结束 -->
            <!-- 准备阶段结束 -->
            <!-- 第一阶段验收后 -->
            <!-- <div class="myproject_photo_box_buzhou">
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">1
                        <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
                </div>
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">2
                        <div class="xmjxzhengxian"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
                </div>
                <div class="myproject_photo_box_buzhou_box">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">未验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy">3</div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第二阶段</div>
                </div>
            </div> -->
            <!-- 当未上传作品 -->
            <!-- <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb">提交作品</div></a>
                <a href="#"><span class="zpsc">作品上传</span></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div> -->
                <!-- 当未上传作品 结束-->
                <!-- 当上传作品后 -->
            <!-- <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb colorchange_white backgroundcolorcg_green">提交作品</div></a>
                <div class="myproject_photo_box_lianjie_fj">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span class="fjdx">附件2个（4MB）</span>
                </div>
                <a href="#"><span class="zpsc">重新上传</span></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div> -->
                <!-- 当上传作品后 结束 -->
            <!-- 第一阶段验收后 结束  -->
            <!-- 第二阶段验收 -->
            <!-- <div class="myproject_photo_box_buzhou">
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">1
                        <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
                </div>
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">2
                        <div class="xmjxzhengxian"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
                </div>
                <div class="myproject_photo_box_buzhou_box">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">未验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy">3</div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第二阶段</div>
                </div>
            </div> -->
            <!-- 当未上传作品 -->
            <!-- <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb">提交作品</div></a>
                <a href="#"><span class="zpsc">作品上传</span></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div> -->
                <!-- 当未上传作品 结束-->
                <!-- 当上传作品后 -->
            <!-- <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb colorchange_white backgroundcolorcg_green">提交作品</div></a>
                <div class="myproject_photo_box_lianjie_fj">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span class="fjdx">附件2个（4MB）</span>
                </div>
                <a href="#"><span class="zpsc">重新上传</span></a>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div> -->
                <!-- 当上传作品后 结束 -->
            <!-- 第二阶段验收 结束  -->
        <!-- 当有3个阶段收款 结束 -->    
    <!-- 我的项目 我承接的 项目进行中 结束 -->
    <!-- 我的项目 我承接的 完成  -->
    <!-- <div class="myproject_photo_box">
            <div class="myproject_photo_box_text">
                <div class="sjlx">LOGO设计</div>
                <div class="xmywj">项目已完结</div>
            </div>
            <div class="myproject_photo_box_jindu">
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">委托</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">设置</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">进行</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">完成</div>
                </div>
            </div> -->
        <!-- 当仅有2个阶段 -->
        {{--<div class="myproject_photo_box_buzhou qiaoliang">--}}
            {{--<div class="bztb">--}}
                {{--<img src="{!! Theme::asset()->url('images/保障印章.png') !!}" alt="" class="tx">--}}
            {{--</div>--}}
            {{--<div class="myproject_photo_box_buzhou_box jxtz_chang">--}}
                {{--<div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>--}}
                {{--<div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_white backgroundcolorcg_green">1--}}
                    {{--<div class="xmjxzhengxian_chang backgroundcolorcg_green"></div>--}}
                {{--</div>--}}
                {{--<div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>--}}
            {{--</div>--}}
            {{--<div class="myproject_photo_box_buzhou_box">--}}
                {{--<div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>--}}
                {{--<div class="myproject_photo_box_buzhou_box_xhy  colorchange_white backgroundcolorcg_green">2</div>--}}
                {{--<div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="myproject_photo_box_lianjie">--}}
            {{--<a href="#"><div class="myproject_photo_box_lianjie_cxfb">已完结</div></a>--}}
            {{--<div class="myproject_photo_box_lianjie_fj">--}}
                {{--<i class="fa fa-link" aria-hidden="true"></i>--}}
                {{--<span class="fjdx">附件2个（4MB）</span>--}}
                {{--<a href="#"><span class="fjxz">打包下载</span></a>--}}
            {{--</div>--}}
            {{--<div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>--}}
        {{--</div>--}}
        <!-- 当仅有2个阶段结束 -->
        <!-- 当有3个阶段 -->
        <!-- <div class="myproject_photo_box_buzhou qiaoliang">
                <div class="bztb">
                    <img src="{!! Theme::asset()->url('images/保障印章.png') !!}" alt="" class="tx">
                </div>
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">1
                        <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
                </div>
                <div class="myproject_photo_box_buzhou_box jxtz">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy qiaoliang  colorchange_white backgroundcolorcg_green">2
                        <div class="xmjxzhengxian backgroundcolorcg_green"></div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
                </div>
                <div class="myproject_photo_box_buzhou_box">
                    <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">已验收</div>
                    <div class="myproject_photo_box_buzhou_box_xhy  colorchange_white backgroundcolorcg_green">3</div>
                    <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第二阶段</div>
                </div>
            </div>
            <div class="myproject_photo_box_lianjie">
                <a href="#"><div class="myproject_photo_box_lianjie_cxfb">已完结</div></a>
                <div class="myproject_photo_box_lianjie_fj">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span class="fjdx">附件2个（4MB）</span>
                    <a href="#"><span class="fjxz">打包下载</span></a>
                </div>
                <div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>
            </div>
        </div>   -->
        <!-- 当有3个阶段 结束 -->
    <!-- 我的项目 我承接的 完成  结束-->


    </div>  


    <!-- 我的项目  我承接的  结束 -->


    </li>


    <!-- <div class="paging_bootstrap text-center">
        <ul class="pagination case-page-list">
            <ul class="pagination">
                <li class="disabled"><span>«</span></li>
                <li class="active"><span>1</span></li>
                <li><span><a href="#">2</a></span></li>
                <li><span><a href="#">3</a></span></li>
                <li><span><a href="#">4</a></span></li>
                <li><span><a href="#">5</a></span></li>
                <li><span><a href="#" rel="next">»</a></span></li>
            </ul>
        </ul>
    </div> -->
</ul>





<script>
 function timeChange(obj){
   var time=obj.value;
   var url = location.search; //获取url中"?"符后的字串
   var theRequest = new Object();
   if (url.indexOf("?") != -1) {
      var str = url.substr(1);
      strs = str.split("&");
      for(var i = 0; i < strs.length; i ++) {
         theRequest[strs[i].split("=")[0]]=(strs[i].split("=")[1]);
      }
      window.location.href="/user/acceptTasksList?uid="+theRequest.uid+"&time="+time+"&type="+theRequest.type+"&status="+theRequest.status;
   }else{
	   window.location.href="/user/acceptTasksList?time="+time;
   }
}
</script>
{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('geren_myproject','js/doc/geren_myproject.js') !!}
@if($pie_data)
    {!! Theme::widget('mypie',['pie_data'=>$pie_data])->render() !!}
@endif
{!! Theme::asset()->container('custom-css')->usepath()->add('myproject','css/meishimeitu/myproject.css') !!}