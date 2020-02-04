{!! Theme::widget('wrapBox_fbxm')->render() !!}
<form action="/task/createnew" method="post" id="creatnew" class="form" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
    {!! csrf_field() !!}
    {{--<!-- 您可能还会需要的设计 -->--}}
    <div class="select_plan">
        <div class="select_plan_title">
            <p>选择项目发布方式</p>
        </div>
        <div class="project_ways">
            <div class="release_wrap">
                <div class="release_wrap_content addwith_one flexbuju">
                    <div class="fl public_release div_selected">
                        <img src="{!! Theme::asset()->url('images/type/public.png') !!}" alt="">
                        <p class="task_text1">公开发布</p>
                    </div>
                    <div class="fl private_release noclick">
                        <img src="{!! Theme::asset()->url('images/私密发布icon.png') !!}" alt="">
                        <p>私密发布</p>
                        <span class="recommend"></span>
                    </div>
                    <div class="fl appoint_release noclick">
                        <img src="{!! Theme::asset()->url('images/组 1.png') !!}" alt="">
                        <p>指定发布</p>
                        <span class="recommend"></span>
                    </div>
                </div>
            </div>
            <div class="project_details sever_ul_box">
                <ul class="sever_ul clearfix">
                    <li>
                        <p>指定服务商<span class="red_word">*</span></p>
                    </li>
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
            <div class="project_details addpadding">
                <div class="clearfix">
                    <p class="fl">订单号</p>
                    <input type="hidden" name="order_number" value="{{$task->order_number}}">
                    <input type="hidden" name="id" value="{{$task->id}}">
                    <input type="hidden" @if(isset($broker['bid'])) name="bid" value="{{$broker['bid']}}" @endif>
                    <input type="hidden" @if(isset($broker['man'])) name="man" value="{{$broker['man']}}" @endif>
                    <p class="fl">{{$task->order_number}}</p>
                    <p class="fl checkDetail" task_id="{{$task->id}}" onclick="getObjectDetail(this)">查看详情</p>
                </div>
                <div class="clearfix">
                    <p class="fl">项目名称</p>
                    <p class="fl">{{$task->title}}</p>
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
                    <p class="fl">￥<span class="pre_yu">{{$task->show_cash}}</span></p>
                </div>

                <div class="clearfix zd">
                    <p class="fl"></p>
                    <p class="fl">平台服务费（总金额3%）</p>
                    <p class="fl">￥<span class="pre_server">45</span></p>
                </div>
                <div class="all-in_cost clearfix">
                    <p class="fl"></p>
                    <p class="fl">总费用</p>
                    <p class="fl">￥<span class="total">{{$task->show_cash}}</span></p>
                </div>
                <div class="money_reason clearfix">
                    <p class="fl"></p>
                    <p class="fl">
                        <span><img src="{!! Theme::asset()->url('images/type/问号.png') !!}" alt=""></span><span class="whyMoney">为什么需要先托资金？</span>
                    </p>
                </div>
            </div>
            <p class=""><input class="xy" type="checkbox" checked="checked" name="">我同意并遵守<span class="Pubagreement">《美视美图平台项目发布协议》</span></p>
            <div class="continue_wrap clearfix">
                @if(isset($broker['bid']))
                @if($broker['man'] ==0 || $brokeruid==$uid)
                <a href="/task/createnewdetail/{{$task->cate_id}}/{{$task->order_number}}/?bid={{$broker['bid']}}&man={{$broker['man']}}&a=02" class="return fl">
                    < 上一步</a> @endif @else <a href="/task/createnewdetail/{{$task->cate_id}}/{{$task->order_number}}/?a=02" class="return fl">
                        < 上一步</a> @endif <input id="cnew" type="submit" class="continu fl" value="下一步">
                            {{--<button class="btn btn-success" >下一步</button>--}}
            </div>
        </div>
    </div>
</form>
<div class="whyMoney_tip">
    <div class="whyMoney_tip_box">
        <div class="headline">为什么需要先托资金？</div>
            <h3>
                托管资金的目的
            </h3>
            <h2>
                1、项目资金托管是需求方为自身所发布项目所承担的一种保证金。<br />
                2、项目资金托管不仅保证自身项目更好的实现，也是为需求方、设计师与美视美图平台三者之间构建一座良好的合作桥梁。
            </h2>
            <h3>
                托管资金的好处
            </h3>        
            <h2>
                1、对项目而言，能够更好的估量项目自身的价值，匹配相应的设计师。<br />
                2、对需求方而言，明确项目达成报酬，更易于形成更高效、便捷的合作。<br />
                3、对平台而言，使发布项目处于公开透明状态，便于平台进行监管。
            </h2>
            <h3>
                托管资金的必要性
            </h3>        
            <h2>
                1、体现项目本身真实性，保证合作的真诚度。<br />
                2、维护设计师的基本权益，保障合作的安全性。<br />
                3、便于需求方与设计师更好的进行双向选择，确保合作的顺利性。
            </h2>       
            <h3>
                退款保障
            </h3>        
            <h2>
                1、项目发布后，需求没有通过美视美图网站的审核，项目费用全额退款。<br />
                2、项目在托管资金后开始计时，如果在2周内没有设计师申请该项目，则可以进行申请全额退款。<br />
                3、在项目进行过程中需求方不能进行退款操作。
            </h2>  
    </div>
</div>
<div class="agreement_tip">
    <div class="agreement_tip_box">
        <div class="headline">美视美图网需求发布与处理规则</div>
        <h4>
            为了维护美视美图网正常运营秩序，推动非实物交易的繁荣，保障需求顺利进行，根据《美视美图网服务协议》及《美视美图网服务规则》，制定本规则。
        </h4>
        <h3>
            第一条 需求方发布需求需要符合国家法律法规以及美视美图网关于需求的相关规定。
        </h3>
        <h4>
            工程设计咨询类需求应严格遵守《建设工程质量管理条例》、《建设工程勘察设计管理条例》、《建设项目环境保护管理条例》等相关法律法规规定，购买工程设计咨询服务。本网站提供相关服务平台，其交易成果仅供参考。
        </h4>
        <h3>第二条 凡是违反宪法精神和中华人民共和国相关法律法规、带有民族歧视性、夸大宣传并带有欺骗性、有损于社会主义道德风尚或者有其他不良影响的需求，美视美图网将拒绝提供服务，包含但不限于以下情形：</h3>
        <h2>
            一、泄露个人隐私或企业内部数据的需求（含个人联系方式、个人手机定位、电话清单查询、银行账户查询等内容）；<br />
            二、涉黄、赌博、暴力等需求；<br />
            三、论文代写类需求；<br />
            四、通过刷单、炒作等形式，进行数据作假或作弊的需求，包括但不限于刷单、刷信用、刷评价、刷钻、删帖、盗图申诉、粉丝数量、阅读数量、下载数量、推广效果数据等；<br />
            五、用于监听、窃取隐私或机密的软件的需求；<br />
            六、比特币、莱特币等互联网虚拟币以及相关商品的需求；<br />
            七、任何有损网络安全的服务：木马、黑客程序、破网、翻墙软件等；<br />
            八、非法传销类需求；<br />
            九、侵犯第三方权利的需求：软件/程序破解类服务、游戏/程序外挂类服务、盗取网银/游戏账号、抄袭/盗用他人图片等； <br />
            十、国家领导人及其家属信息的相关需求；<br />
            十一、政治敏感信息、出现或映射种族歧视、宗教歧视的相关需求；<br />
            十二、其他不良影响的需求，包含但不限于以下情形：
        </h2>
        <h1>
            （一）需要手机验证注册或需要银行账号验证或者付费才能参与的需求；<br />
            （二）可能套取需求参与方身份证、邮箱、手机号、银行账号等个人或者机构隐私信息的需求；<br />
            （三）需求描述通过链接等方式逃避美视美图网审核的需求；<br />
            （四）以招兼职为名进行的欺骗型需求；<br />
            （五）需要线下转账、充值、使用资金的需求；<br />
            （六）账号买卖等需求（允许交易的游戏账号除外）<br />
            （七）可能给他人或者其他机构带来损害的需求；
        </h1>

        <h2>
            十三、其他违反法律、法规、行政规章等相关规定的需求。
        </h2>

        <h3>
            第三条 需求描述
        </h3>
        <h2>
            一、需求描述需要准确、完整；<br />
            二、一个需求只能进行一件事务的处理；<br />
            三、不同需求类型禁止合并发布，一个需求只能有一项具体事务；<br />
            四、内容涉及“站外注册相应账号”类型的需求，必须同时满足以下条件方可发布：
        </h2>
        <h1>
            （一）计件需求单价不能低于1元；<br />
            （二）投标期结束后不能延期。
        </h1>
        <h2>
            五、内容涉及“招聘”、“兼职”的需求，凡是涉嫌诈骗、欺骗、虚假承诺、需要设计师先承担成本以及跳转站外有交易风险的，美视美图网有权关闭该需求。<br />
            六、比稿模式“多人中标”模式，若需求方需要除一等奖外其他奖项中标设计师也提供稿件源文件，必须在需求描述中进行明确说明， 否则无权要求除一等奖外其他奖项中标设计师提供源文件。
        </h2>
        <h3>
            第四条 需求发布

        </h3>
        <h2>
            一、需求方自助选择是发布免费需求还是付费需求；<br />
            二、需求方自主确定需求、自主定价、自主确定完成需求的期限（个别需求类型为统一征集期限）；<br />
            三、需求一经发布且托管资金，不能取消或修改；补充说明不得增加原有工作量或与原需求相冲突；<br />
            四、需求应发布在相应的类目当中，如类目选取错误，美视美图网有权修改类目或关闭需求；<br />
            五、需求标题应为需求内容的简述，并与需求内容一致，否则美视美图网有权修改需求标题；<br />
            六、付费需求成功发布且托管资金之日起，单个需求交稿期限最长不得超过三十日。<br />
            七、需求内容中不得含有联系方式(包含但不限于QQ，电话，网址，二维码，条形码，邮箱等)；<br />
            八、同一需求禁止重复发布，若用户重复发布，网站将关闭重复的需求，将已托管的赏金全额退回，如需求下已有交稿，网站将按交稿先后顺序，默认中标，将已托管的赏金支付给设计师；<br />
            九、禁止通过发布需求来推广自己或别人的其他需求，一旦发现，网站将按“垃圾广告”的违规行为进行处理；<br />
            十、禁止违规发布需求：指发布违背公序良俗的需求或利用非常规手段大批量发布需求。若用户被认定为违规发布需求，一经查实，本网站将直接删除或关闭该需求，并有权对用户处以警告的处理；情节严重者将直接进行清退处理，并扣除全部保证金。
        </h2>
        <h3>
            第五条 制度保障
        </h3>
        <h4>
            需求方发布违规需求的，按照《美视美图网举报和争议纠纷处理规则》 和《美视美图网服务规则》的相关规则进行处理。
        </h4>
        <h3>
            第六条 资金支付
        </h3>
        <h4>
            当符合下列条件时，美视美图网将根据需求方同意支付的指令，将资金支付给设计师：
        </h4>
        <h1>
            （一）服务约定的工作内容（比如源文件、最终稿件等）交付完毕；<br />
            （二）无设计师对该需求表示异议，或者虽有异议但已经处理完毕；<br />
            （三）美视美图网无相关证据资料显示需求有违规行为。
        </h1>
        <h3>
            第七条 需求退款
        </h3>
        <h4>
            出现以下情形之一，需求方可以申请退还已托管的赏金：
        </h4>
        <h1>
            （一）项目发布期间内，没有设计师参与，需求方可以申请退款；<br />
            （二）设计师所提交稿件质量未达到要求，需求方可提供相应的设计作品作为举证，进行维权，并向美视美图网进行申请退款；
        </h1>
        <h3>
            第八条 违约责任
        </h3>
        <h2>
            一、需求方责任：
        </h2>
        <h4>
            若由于需求方原因，导致交易无法完成的，设计师不承担任何责任。若由于需求方原因致使设计师产生损失的，网站有权动用需求方已托管的资金对设计师进行赔付。
        </h4>
        <h2>
            二、设计师责任：
        </h2>
        <h4>
            若设计师不能按要求完成需求，美视美图网将按照美视美图网规则进行相应处理。
        </h4>
        <h3>
            第九条 本规则自发布之日起实行。
        </h3>
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
{!! Theme::asset()->container('old-css')->usepath()->add('release_css','css/type/release.project.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('step','css/type/step.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('step','css/type/two.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('wrapBox_fbxm','css/type/wrapBox_fbxm.css') !!}

{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::widget('ueditor')->render() !!}
{{--{!! Theme::widget('datepicker')->render() !!}--}}
{!! Theme::asset()->container('custom-js')->usepath()->add('task', 'js/doc/task.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css')
!!}
{!!
Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js')
!!}

{{--及时查询js--}}
{{--{!! Theme::asset()->container('custom-js')->usepath()->add('publishajax', 'js/type/publishajax.js') !!}--}}
{!! Theme::asset()->container('custom-js')->usepath()->add('release_js', 'js/type/release.project.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('step', 'js/type/step.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('test', 'js/type/test.js') !!}