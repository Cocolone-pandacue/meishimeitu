
<section id="model" class="model">项目申请成功，请耐心等待需求方筛选</section>
<section id="toSheJiShi" class="toSheJiShi">
    <a href="/user/productionUploading">请点击文字跳转至设计师入驻页面</a>
</section>
<section id="toVip" class="toVip">
    <a href="/vipshop">请点击文字跳转至VIP界面购买套餐</a>
</section>
<div class="container back_f3f3f3">
    <div class="xiangmuku">项目库</div>
    <div class="classify">
        <span class="dropdown">
            <label>所有项目分类:</label>
            <label class="dropdown-toggle toggle_li_style" data-toggle="dropdown">
                    <span class="classify-wrap active" >
                    @if(isset($merge['category']) && $merge['category'] >0)
                        @foreach(array_slice($category,0,8) as $v)
                            @if($merge['category']==$v['id'])
                                {{ $v['name'] }}
                                @break
                            @endif
                        @endforeach
                    @else
                        全部
                    @endif
                    </span>
                
                <i class="fa fa-chevron-down"></i>
            </label>
            <ul class="dropdown-menu">
            <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['keywords','page']),['category'=>0])) !!}"><span class="classify-wrap {!! (!isset($merge['category']) || $merge['category']==$pid)?'active':'' !!}" >全部</span></a></li>
                @foreach(array_slice($category,0,8) as $v)
                    <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}"><span class="classify-wrap {!! (isset($merge['category']) && $merge['category']==$v['id'])?'active':'' !!}" >{{ $v['name'] }}</span></a></li>
                @endforeach
            </ul>
        </span>
        <span class="dropdown">
            <label>预算范围:</label>
            <label href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="classify-wrap active" >
                @if(isset($merge['cash']) && $merge['cash']==1)
                5佰 – 1仟
                @elseif(isset($merge['cash']) && $merge['cash']==2)
                1仟 – 3仟
                @elseif(isset($merge['cash']) && $merge['cash']==3)
                3仟 – 5仟
                @elseif(isset($merge['cash']) && $merge['cash']==4)
                5仟 – 1万
                @elseif(isset($merge['cash']) && $merge['cash']==5)
                1万 – 2万
                @elseif(isset($merge['cash']) && $merge['cash']==6)
                2万以上
                @else
                全部
                @endif
            </span>
            <i class="fa fa-chevron-down"></i>
            </label>
            <ul class="dropdown-menu">
            <li><a href="{!! URL('task').'?'.http_build_query(array_except(array_except($merge,'page'), 'cash')) !!}"><span class="classify-wrap {!! (!isset($merge['cash']) )?'active':'' !!}" >全部</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['cash'=>1])) !!}"><span class="classify-wrap {!! (isset($merge['cash']) && $merge['cash']==1)?'active':'' !!}" >5佰 – 1仟</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['cash'=>2])) !!}"><span class="classify-wrap {!! (isset($merge['cash']) && $merge['cash']==2)?'active':'' !!}" >1仟 – 3仟</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['cash'=>3])) !!}"><span class="classify-wrap {!! (isset($merge['cash']) && $merge['cash']==3)?'active':'' !!}" >3仟 – 5仟</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['cash'=>4])) !!}"><span class="classify-wrap {!! (isset($merge['cash']) && $merge['cash']==4)?'active':'' !!}" >5仟 – 1万</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['cash'=>5])) !!}"><span class="classify-wrap {!! (isset($merge['cash']) && $merge['cash']==5)?'active':'' !!}" >1万 – 2万</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['cash'=>6])) !!}"><span class="classify-wrap {!! (isset($merge['cash']) && $merge['cash']==6)?'active':'' !!}" >2万以上</span></a></li>
            </ul>
        </span>
        <span class="dropdown">
            <label href="#">排序方式:</label>
            <label href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="classify-wrap active" >
                    @if(isset($merge['desc']) && $merge['desc']=='created_at')
                    项目发布时间
                    @elseif(isset($merge['desc']) && $merge['desc']=='bounty')
                    项目金额
                    @else
                    全部
                    @endif
                </span>
            <i class="fa fa-chevron-down"></i>
            </label>
            <ul class="dropdown-menu">
                <li><a href="{!! URL('task').'?'.http_build_query(array_except(array_except($merge,'page'), 'desc')) !!}"><span class="classify-wrap {!! (!isset($merge['desc']) )?'active':'' !!}" >全部</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['desc'=>'created_at'])) !!}"><span class="classify-wrap {!! (isset($merge['desc']) && $merge['desc']=='created_at')?'active':'' !!}" >项目发布时间</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['desc'=>'bounty'])) !!}"><span class="classify-wrap {!! (isset($merge['desc']) && $merge['desc']=='bounty')?'active':'' !!}" >项目金额</span></a></li>
            </ul>
        </span>
        <span class="dropdown">
            <label>项目状态</label>
            <label href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="classify-wrap active" >
                    @if(isset($merge['status']) && $merge['status']==1)
                    项目托管中
                    @elseif(isset($merge['status']) && $merge['status']==2)
                    项目进行中
                    @elseif(isset($merge['status']) && $merge['status']==3)
                    项目已完结
                    @else
                    全部
                    @endif
                </span>
            <i class="fa fa-chevron-down"></i>
            </label>
            <ul class="dropdown-menu">
                <li><a href="{!! URL('task').'?'.http_build_query(array_except(array_except($merge,'page'), 'status')) !!}"><span class="classify-wrap {!! (!isset($merge['status']) )?'active':'' !!}" >全部</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>1])) !!}"><span class="classify-wrap {!! (isset($merge['status']) && $merge['status']==1)?'active':'' !!}" >项目托管中</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>2])) !!}"><span class="classify-wrap {!! (isset($merge['status']) && $merge['status']==2)?'active':'' !!}" >项目进行中</span></a></li>
                <li><a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>3])) !!}"><span class="classify-wrap {!! (isset($merge['status']) && $merge['status']==3)?'active':'' !!}" >项目已完结</span></a></li>
            </ul>
        </span>
        <a href="{!! URL('task').'?'.http_build_query(array_except(array_except($merge,['page','status','desc','cash','category']), 'status','desc','cash','category')) !!}" class="daobudaohang_one">重置</a>
        <!-- <div class="daobudaohang_two">高级项目库</div>
        <div class="daobudaohang_three">普通项目库</div> -->
    </div>
</div>
<section class="shop task">
    <div class="container">
        <ul class="box list">
            @foreach($list as $v)
            <li class="box_yangben" href="javascript:;" task_id="{{$v['id']}}">
                <div class="box_yangben_yangshi_shang" task_id="{{$v['id']}}" onclick="getObjectDetail(this)">
                    <!-- <img src="" alt="" class="xiangmuleixing">
                    <img src="{{Theme::asset()->url('images/私密项目.jpg')}}" alt="" class="xiangmuleixing">
                    <img src="{{Theme::asset()->url('images/指定项目.jpg')}}" alt="" class="xiangmuleixing"> -->
                    <p class="box_yangben_yangshi_shang_fenlei">
                            @foreach($cate as $c)
                                @if($v['cate_id']==$c['id'])
                                    @if($c['pic'])
                                        {{--<img src="{{Theme::asset()->url('images/xiangmuleixing.png')}}" alt="">--}}
                                        <img src="{{ossUrl($c['pic'])}}" alt="">
                                    @else
                                        <img src="{{Theme::asset()->url('images/xiangmuleixing.png')}}" alt="">
                                    @endif
                                    <span>{{$c['name']}}</span>
                                @break
                                @endif
                             @endforeach
                    </p>
                    <p class="box_yangben_yangshi_shang_name">{{$v['title']}}</p>
                    <p class="box_yangben_yangshi_shang_zuidibu">
                        <span class="box_yangben_yangshi_shang_zuidibu_zuobian">
                            <span class="box_yangben_yangshi_shang_zuidibu_zuobian_photo"></span>
                            <span class="box_yangben_yangshi_shang_zuidibu_zuobian_money">{{$v['show_cash']}}元</span>
                        </span>
                        <span class="box_yangben_yangshi_shang_zuidibu_youbian">
                            <span class="box_yangben_yangshi_shang_zuidibu_youbian_photo"></span>
                            <span class="box_yangben_yangshi_shang_zuidibu_youbian_time">{{$v['time_interval']}}天</span>
                        </span>
                    </p>
                </div>
                <div class="box_yangben_yangshi_xia">
                    @if(in_array($v['status'],[3]))
                        <span class="box_yangben_yangshi_xia_text">项目托管中</span>
                    @elseif(in_array($v['status'],[4,5,6,7]))
                        <span class="box_yangben_yangshi_xia_text xmjxz">项目进行中</span>
                    @elseif(in_array($v['status'],[8,9]))
                        <span class="box_yangben_yangshi_xia_text xmywj">项目已完结</span>
                    @endif
                    @if(Auth::user())       {{--是否登陆 跳转--}}
                        {{--$stylistid看是否设计师入住$taskid自己的项目$workid已经申请的项目3没确定设计的项目 $stylistpackage是否购买套餐--}}
                        @if(!$stylistid == null)        {{--是否设计师入驻 跳转--}}
                            @if(!$stylistpackage == null)       {{--是否设购买套餐 跳转--}}
                                @if(!in_array($v['id'],$workid))      {{--是否已经申请 已经申请--}}
                                    @if(!in_array($v['id'],$taskid) )       {{--是否是本人 不可申请--}}
                                        @if(in_array($v['status'],[3]))         {{--是否项目结束--}}
                                        <span class="box_yangben_yangshi_xia_shenqing" onclick="getProject({{ $v['id'] }},this)">申请</span>
                                        @else
                                        <span class="box_yangben_yangshi_xia_yishenqing">不可申请</span>
                                        @endif
                                    @else
                                    <span class="box_yangben_yangshi_xia_yishenqing">不可申请</span>
                                    @endif
                                @else
                                <span class="box_yangben_yangshi_xia_yishenqing">已经申请</span>
                                @endif
                            @else
                                <span class="toVIPmenber" onclick="toVipMenber()">申请</span>
                            @endif
                        @else
                            <span class="toshejishi" onclick="toSheJiShi()">申请</span>
                        @endif
                    @else
                        <a href="{!! URL('/login') !!}"><span class="box_yangben_yangshi_xia_shenqing">申请</span></a>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
        <div class="paging_bootstrap text-center">
            <ul class="pagination case-page-list">
                {!! $list->appends($_GET)->render() !!}
            </ul>
        </div>
    </div>
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
                <img class="xiangmutanchuang_box_wenben_jihua_one_photo" src=""/>
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
                <ul class="clearfix clearfix_height">
                    <li><p>古典</p></li>
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
                    <li><p>现代</p></li>
                </ul>
                <ul class="clearfix clearfix_height">
                    <li><p>女性</p></li>
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
                    <li><p>男性</p></li>
                </ul>
                <ul class="clearfix clearfix_height">
                    <li><p>抽象</p></li>
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
                    <li><p>文字</p></li>
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
            <ul class="ace-thumbnails" download_imgurl = "{!! Theme::asset()->url('/images/task-xiazai/word.png') !!}">
            </ul>
        </li>
    </ul>
</div>

<!-- 项目详情弹框 结束 -->
</section>


{!! Theme::asset()->container('specific-js')->usepath()->add('elements','plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ace','plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('dialogs','js/dialogs.js') !!}

{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

{!! Theme::asset()->container('custom-css')->usePath()->add('station-css', 'css/station.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('case','js/doc/taskindex.js') !!}


{{--{!! Theme::asset()->container('custom-js')->usepath()->add('jqueryjs','js/meishimeitu/slider/jquery-1.10.2.min.js') !!}--}}
{!! Theme::asset()->container('specific-css')->usepath()->add('indexcss','css/meishimeitu/slider/index.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('index','js/meishimeitu/slider/index.js') !!}

{{--{!! Theme::asset()->container('custom-js')->usepath()->add('slide','js/meishimeitu/slider/slide.js') !!}--}}



