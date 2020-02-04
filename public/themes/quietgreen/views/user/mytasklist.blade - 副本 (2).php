<!-- 我的项目  类型状态 -->
<ul class="myproject">
    <li class="myproject_fenlei">
        <p class="myproject_biaoti">
            <span><img src="{!! Theme::asset()->url('images/Parallel tasks.png') !!}" alt="" class="myproject_biaoti_photo"></span>
            <span class="myproject_biaoti_text">我的项目</span>
        </p>
        <p class="myproject_xifen_leixing">
            <span>类型</span>
            <a class="daohang_dianji" href="{{url('/user/myTasksList')}}">我发布的</a>
            <a href="{{url('/user/acceptTasksList')}}">我承接的</a>
        </p>
        <p class="myproject_xifen_zhuangtai">
            <span>状态</span>
            <a  href="{!! URL('user/myTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']),['status'=>0])) !!}">全部</a>
            <a class="" href="{!! URL('user/myTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']), ['status'=>1])) !!}">还未发布</a>
            <a class="" href="{!! URL('user/myTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']), ['status'=>2])) !!}">托管中</a>
            <a class="" href="{!! URL('user/myTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']), ['status'=>3])) !!}">进行中</a>
            <a class="" href="{!! URL('user/myTasksList').'?'.http_build_query(array_merge(array_except($merge,['uid','page']), ['status'=>4])) !!}">已完结</a>
        </p>
    </li>

    <li class="myproject_photo">
        <div class="myproject_photo_biaoti">共{{$count}}个作品</div>
        <!-- 我的项目  我发布的 -->
        <!-- 还未发布 -->
        @if(count($my_tasks)>0)
            @foreach($my_tasks as $my => $v)
            <div class="myproject_photo_box" id="{{ $v['id'] }}">
            <div class="myproject_photo_box_text">
                <div class="sjlx">{{$v['cate_name']}}</div>
                @if(in_array($v['status'], [3]) && $taskid[$my][0] !=null)
                    @if(!isset($taskid[$my][0]['status']))
                    <div class="txlb">
                    @foreach($taskid[$my][0] as $task)
                        <a href="{!! URL('/bre/serviceEvaluateDetail/'.$task['uid']) !!}" class="txlb_tx" id="ygy_{{ $task['uid'] }}">
                            @if($task['avatar'])
                                <img src="{!! ossUrl($task['avatar']) !!}" alt="" class="tx" onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                                <div class="tx_tips_another">
                                    <img src="{!! ossUrl($task['avatar']) !!}" alt="" class="tx_tips_tx" onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                                    <div class="tx_tips_jianjie">
                                        <div class="tx_tips_jianjie_dizhi">{{$task['province']}}</div>
                                        <div class="shuxian"></div>
                                        <div class="tx_tips_jianjie_leixing">{{$task['profession']}}</div>
                                    </div>
                                    <div class="guyong_jujue">
                                        <div class="tips_anniu employ" designer_name = "{{$task['name']}}" task_uid = "{{ $task['uid']}}" xmid = "{{$v['id']}}">雇佣</div>
                                        <div class="tips_anniu" onclick="refuseDesigner({{ $task['uid']}},{{$v['id']}})">拒绝</div>
                                    </div>
                                </div>
                            @else
                                <img src="{!! Theme::asset()->url('images/default_avatar.png') !!}" alt="" class="tx">
                                <div class="tx_tips_another">
                                    <img src="{!!Theme::asset()->url('images/default_avatar.png')!!}" alt="" class="tx_tips_tx">
                                    <div class="tx_tips_jianjie">
                                        <div class="tx_tips_jianjie_dizhi">{{$task['province']}}</div>
                                        <div class="shuxian"></div>
                                        <div class="tx_tips_jianjie_leixing">{{$task['profession']}}</div>
                                    </div>
                                    <div class="guyong_jujue">
                                        <div class="tips_anniu employ" designer_name = "{{$task['name']}}" task_uid = "{{ $task['uid']}}" xmid = "{{$v['id']}}">雇佣</div>
                                        <div class="tips_anniu" onclick="refuseDesigner({{ $task['uid']}},{{$v['id']}})">拒绝</div>
                                    </div>
                                </div>
                            @endif
                        </a>
                    @endforeach
                    </div>
                    @else
                        {{--已经完成雇佣头像--}}
                    @if($taskid[$my][0]['avatar'])
                        <div class="txlb">
                            <a href="{!! URL('/bre/serviceEvaluateDetail/'.$taskid[$my][0]['uid']) !!}" class="txlb_tx">
                                <img src="{{ossUrl($taskid[$my][0]['avatar'])}}" alt="" class="tx" onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                                <div class="tx_tips_another">
                                    <img src="{{ossUrl($taskid[$my][0]['avatar'])}}" alt="" class="tx_tips_tx" onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                                    <div class="tx_tips_jianjie">
                                        <div class="tx_tips_jianjie_dizhi">{{$taskid[$my][0]['province']}}</div>
                                        <div class="shuxian"></div>
                                        <div class="tx_tips_jianjie_leixing">{{$taskid[$my][0]['profession']}}</div>
                                    </div>
                                    <div class="guyong_jujue">
                                        <div class="tips_anniu  tips_anniu_employed">已雇佣</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="txlb">
                            <a href="{!! URL('/bre/serviceEvaluateDetail/'.$taskid[$my][0]['uid']) !!}" class="txlb_tx">
                                <img src="{!!Theme::asset()->url('images/default_avatar.png')!!}" alt="" class="tx">
                                <div class="tx_tips_another">
                                    <img src="{!!Theme::asset()->url('images/default_avatar.png')!!}" alt="" class="tx_tips_tx" onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                                    <div class="tx_tips_jianjie">
                                        <div class="tx_tips_jianjie_dizhi">{{$taskid[$my][0]['province']}}</div>
                                        <div class="shuxian"></div>
                                        <div class="tx_tips_jianjie_leixing">{{$taskid[$my][0]['profession']}}</div>
                                    </div>
                                    <div class="guyong_jujue">
                                        <div class="tips_anniu  tips_anniu_employed">已雇佣</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                    @endif
                @endif
            @if(in_array($v['status'], [-1,-2,1]))
                <div class="hwfb">还未发布</div>
            @elseif(in_array($v['status'], [2]))
                <div class="xmsz">项目审核中</div>
            @elseif(in_array($v['status'], [3]))
                <div class="xmtg">项目托管中</div>
            @elseif(in_array($v['status'], [4,5]))
                <div class="xmjxz">进行中</div>
            @elseif(in_array($v['status'], [6,7,8,9,10]))
                <div class="xmywj">已完结</div>
            @endif
            </div>
            <div class="myproject_photo_box_jindu">
                <div class="myproject_photo_box_jindu_miaoshu">
                    <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                    <div class="myproject_photo_box_jindu_text colorchange_red">草案</div>
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    @if(in_array($v['status'], [2,3,4,5,6,7,8,9,10]))
                        <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                        <div class="myproject_photo_box_jindu_text colorchange_red">托管</div>
                    @else
                        <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                        <div class="myproject_photo_box_jindu_text">托管</div>
                    @endif
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    @if(in_array($v['status'], [4,5,6,7,8,9,10]))
                        <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                        <div class="myproject_photo_box_jindu_text colorchange_red">进行</div>
                    @else
                        <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                        <div class="myproject_photo_box_jindu_text">进行</div>
                    @endif
                </div>
                <div class="myproject_photo_box_jindu_shuxian"></div>
                <div class="myproject_photo_box_jindu_miaoshu">
                    @if(in_array($v['status'], [6,7,8,9,10]))
                        <div class="myproject_photo_box_jindu_dayuan bodercolorcg_red"><div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div></div>
                        <div class="myproject_photo_box_jindu_text colorchange_red">完成</div>
                    @else
                        <div class="myproject_photo_box_jindu_dayuan"><div class="myproject_photo_box_jindu_xiaoyuan"></div></div>
                        <div class="myproject_photo_box_jindu_text">完成</div>
                    @endif
                </div>
            </div>

        <!-- 未发布 项目类型阶段 -->
                {{--状态{{$v['status']}}，名字{{$v['title']}}，id{{$v['id']}}--}}
            <div class="myproject_photo_box_buzhou qiaoliang">
                @if(in_array($v['status'], [-2,-1,1,2,3]))
                    <div class="myproject_photo_box_buzhou_box">
                        <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤1</p>
                        <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目类型icon@2x.png') !!}" alt="" class=""></p>
                        <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目类型</p>
                    </div>
                    @if(in_array($v['status'], [-2]))
                    <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                    <div class="myproject_photo_box_buzhou_box">
                        <p class="myproject_photo_box_buzhou_box_bzxh ">步骤2</p>
                        <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/需求明细icon@2x.png') !!}" alt="" class=""></p>
                        <p class="myproject_photo_box_buzhou_box_bzms">项目需求</p>
                    </div>
                    @else
                    <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                    <div class="myproject_photo_box_buzhou_box">
                        <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤2</p>
                        <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目需求蓝色icon.png') !!}" alt="" class=""></p>
                        <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目需求</p>
                    </div>
                    @endif
                    @if(in_array($v['status'], [-2,-1]))
                    <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i></div>
                    <div class="myproject_photo_box_buzhou_box">
                        <p class="myproject_photo_box_buzhou_box_bzxh">步骤3</p>
                        <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/发布方式icon@2x.png') !!}" alt="" class=""></p>
                        <p class="myproject_photo_box_buzhou_box_bzms">发布方式</p>
                    </div>
                    @else
                    <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                    <div class="myproject_photo_box_buzhou_box">
                        <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤3</p>
                        <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/发布方式蓝色icon.png') !!}" alt="" class=""></p>
                        <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">发布方式</p>
                    </div>
                    @endif
                    @if(in_array($v['status'], [-2,-1,1]))
                    <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i></div>
                    <div class="myproject_photo_box_buzhou_box">
                        <p class="myproject_photo_box_buzhou_box_bzxh">步骤4</p>
                        <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/资金托管icon@2x.png') !!}" alt="" class=""></p>
                        <p class="myproject_photo_box_buzhou_box_bzms">资金托管</p>
                    </div>
                    @else
                        <div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>
                    <div class="myproject_photo_box_buzhou_box">
                        <p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤4</p>
                        <p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/资金托管蓝色icon.png') !!}" alt="" class=""></p>
                        <p class="myproject_photo_box_buzhou_box_bzms colorchange_green">资金托管</p>
                    </div>
                    @endif
                @elseif(in_array($v['status'], [4,5,6]))
                    <div class="myproject_photo_box_buzhou_box jxtz_chang">
                        <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">开始</div>
                        <div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_white backgroundcolorcg_green">1
                            <div class="xmjxzhengxian_chang backgroundcolorcg_green"></div>
                        </div>
                        <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">项目准备</div>
                    </div>
                    <div class="myproject_photo_box_buzhou_box">
                        <div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">进行中</div>
                        <div class="myproject_photo_box_buzhou_box_xhy  colorchange_white backgroundcolorcg_green">2</div>
                        <div class="myproject_photo_box_buzhou_box_bzms colorchange_black">第一阶段</div>
                    </div>
                @elseif(in_array($v['status'], [7,8,9,10]))
                    <!-- <div class="myproject_photo_box_buzhou qiaoliang"> -->
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
                    <!-- </div> -->
                @endif
                <div class="myproject_photo_box_lianjie">
                    @if(in_array($v['status'], [-2]))
                        <a href="/task/type/{{$v['order_number']}}?a=01"><div class="myproject_photo_box_lianjie_cxfb">重新发布</div></a>
                    @elseif(in_array($v['status'], [-1]))
                        <a href="/task/createnewdetail/{{$v['cate_id']}}/{{$v['order_number']}}?a=02"><div class="myproject_photo_box_lianjie_cxfb">重新发布</div></a>
                    @elseif(in_array($v['status'], [1]))
                        <a href="/task/createnew/{{$v['order_number']}}?a=03"><div class="myproject_photo_box_lianjie_cxfb">重新发布</div></a>
                    @endif
                    @if(in_array($v['status'], [-2,-1,1]))
                        <div class="myproject_photo_box_lianjie_scxm" xmid="{{ $v['id']}}">删除项目</div>
                    @endif
                    @if(in_array($v['status'], [2,3]))
                        {{--<a href="#"><div class="myproject_photo_box_lianjie_scxm" data-toggle="modal" data-target="#qxxm_{{ $v['id'] }}" onclick="letModalCenter('.qxxm')">取消项目</div></a>--}}
                    @endif
                    @if(in_array($v['status'], [4,5,6]) && $taskid[$my][1] !=null) 
                        <div class="myproject_photo_box_lianjie_cxfb jk_layer" work_id="{{$taskid[$my][1][0]['work_id']}}" xmid="{{ $v['id']}}">阶段结款</div>
                        <!-- <a href="#"><div class="myproject_photo_box_lianjie_scxm">申请修改</div></a> -->
                        <div class="myproject_photo_box_lianjie_fj">
                            <i class="fa fa-link" aria-hidden="true"></i>
                            <span class="fjdx">附件{{count($taskid[$my][1])}}个</span>
                            <span class="fjxz"  onclick="checkDownloadList(this)">下载
                                @foreach($taskid[$my][1] as $t)
                                    <div style="display:none" class="download_name" name="{{$t['name']}}" creatime="时间{{date('Y-m-d',strtotime($t['created_at']))}}" href="/task/download/{{$t['id']}}"></div>
                                @endforeach
                            </span>
                        </div>
                    {{--@elseif(in_array($v['status'], [6]))--}}
                        {{--<a href="#"><div class="myproject_photo_box_lianjie_cxfb">阶段结款</div></a>--}}
                            {{--<a href="#"><div class="myproject_photo_box_lianjie_scxm">申请修改</div></a>--}}
                            {{--<div class="myproject_photo_box_lianjie_fj">--}}
                                {{--<i class="fa fa-link" aria-hidden="true"></i>--}}
                                {{--<span class="fjdx">附件2个（4MB）</span>--}}
                                {{--<a href="#"><span class="fjxz">打包下载</span></a>--}}
                            {{--</div>--}}
                    @elseif(in_array($v['status'], [7,8,9,10]))
                        <div class="myproject_photo_box_lianjie_cxfb_ywj">已完结</div>
                        <div class="myproject_photo_box_lianjie_fj">
                            <i class="fa fa-link" aria-hidden="true"></i>
                            <span class="fjdx">附件{{count($taskid[$my][1])}}个</span>
                            <span class="fjxz"  onclick="checkDownloadList(this)">下载
                                @foreach($taskid[$my][1] as $t)
                                    <div style="display:none" class="download_name" name="{{$t['name']}}" creatime="时间{{date('Y-m-d',strtotime($t['created_at']))}}" href="/task/download/{{$t['id']}}"></div>
                                @endforeach
                            </span>
                        </div>
                    @endif
                    <div class="myproject_photo_box_lianjie_cjrq">创建日期：{{date("Y年m月d日",strtotime($v['created_at']))}}</div>
                </div>
            </div>
        </div>
            @endforeach
        @else
         <div class="my_project_content">
            <img src="{{Theme::asset()->url('images/meishimeitu/personal/noopen.png')}}" alt="">
        </div>
        @endif
        <div class="dataTables_paginate paging_bootstrap">
            <ul class="pagination">
                {!! $my_tasks->appends($_GET)->render() !!}
            </ul>
        </div>
        <!-- 未发布 项目类型阶段结束 -->

        <!-- 未发布 需求明细阶段 -->
     {{--<div class="myproject_photo_box_buzhou">--}}
                {{--<div class="myproject_photo_box_buzhou_box">--}}
                    {{--<p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤1</p>--}}
                    {{--<p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目类型icon@2x.png') !!}" alt="" class=""></p>--}}
                    {{--<p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目类型</p>--}}
                {{--</div>--}}
                {{--<div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>--}}
                {{--<div class="myproject_photo_box_buzhou_box">--}}
                    {{--<p class="myproject_photo_box_buzhou_box_bzxh colorchange_green">步骤2</p>--}}
                    {{--<p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/项目需求蓝色icon.png') !!}" alt="" class=""></p>--}}
                    {{--<p class="myproject_photo_box_buzhou_box_bzms colorchange_green">项目需求</p>--}}
                {{--</div>--}}
                {{--<div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x iconchange_green" aria-hidden="true"></i></div>--}}
                {{--<div class="myproject_photo_box_buzhou_box">--}}
                    {{--<p class="myproject_photo_box_buzhou_box_bzxh">步骤3</p>--}}
                    {{--<p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/发布方式icon@2x.png') !!}" alt="" class=""></p>--}}
                    {{--<p class="myproject_photo_box_buzhou_box_bzms">发布方式</p>--}}
                {{--</div>--}}
                {{--<div class="myproject_photo_box_buzhou_icon"><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i></div>--}}
                {{--<div class="myproject_photo_box_buzhou_box">--}}
                    {{--<p class="myproject_photo_box_buzhou_box_bzxh">步骤4</p>--}}
                    {{--<p class="myproject_photo_box_buzhou_box_photo"><img src="{!! Theme::asset()->url('images/资金托管icon@2x.png') !!}" alt="" class=""></p>--}}
                    {{--<p class="myproject_photo_box_buzhou_box_bzms">资金托管</p>--}}
                {{--</div>--}}
                {{--<div class="myproject_photo_box_lianjie">--}}
                    {{--<a href="#"><div class="myproject_photo_box_lianjie_cxfb">重新发布</div></a>--}}
                    {{--<a href="#"><div class="myproject_photo_box_lianjie_scxm" data-toggle="modal" data-target="#scxm" onclick="letModalCenter('.jswt')">删除项目</div></a>--}}
                    {{--<div class="myproject_photo_box_lianjie_cjrq">创建日期：2018年4月27日</div>--}}
                {{--</div>--}}
            {{--</div>--}}
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
    <!--<div class="myproject_photo_box_text">
            <div class="sjlx">LOGO设计</div>
            <div class="txlb">
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
        <!--  <div class="myproject_photo_box_buzhou">
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
        <!--  <div class="myproject_photo_box_buzhou">
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
    <!--<div class="myproject_photo_box_buzhou qiaoliang">
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
        </div>
        <!-- 当有三个阶段  -->
        <!-- 项目已完结阶段 结束 -->
        <!-- 我的项目  我发布的结束 -->
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
<div id="download_list" style="display:none">
    <table>
        <thead>
            <tr>
                <th>文件名称</th>
                <th>上传时间</th>
                <th>下载附件</th>
            </tr>
        </thead>
        <tbody id="download_tbody">
           
        </tbody>
    </table>
</div>





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
{!! Theme::asset()->container('custom-js')->usepath()->add('Publishproject','js/doc/Publishproject.js') !!}
@if($pie_data)
    {!! Theme::widget('mypie',['pie_data'=>$pie_data])->render() !!}
@endif
{!! Theme::asset()->container('custom-css')->usepath()->add('myproject','css/meishimeitu/myproject.css') !!}
<!-- 个人中心 我的项目 导航栏点击效果 -->
{!! Theme::asset()->container('custom-js')->usepath()->add('usermenu','js/doc/usermenu.js') !!}
