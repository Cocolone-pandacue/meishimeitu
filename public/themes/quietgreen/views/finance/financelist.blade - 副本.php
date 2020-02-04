<!-- 我的资产 -->

<!-- <div class="mymoney_fenlei">
    <p class="mymoney_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Finances.png') !!}" alt="" class="mymoney_biaoti_photo"></span>
        <span class="mymoney_biaoti_text">财务管理</span>
    </p>
    <p class="mymoney_xifen_leixing">
        <a class="mymoney_xifen_leixing_click">我的资产</a>
        <a href="{!! url('finance/assetDetail') !!}">收支明细</a>
        <a href="{!! url('finance/cash') !!}">我要充值</a>
        <a href="{!! url('finance/cashout') !!}">我要提现</a>
    </p>
</div>

<div class="financial_management_box">
    <h4 class="financial_management_box_biaoti">我的资产</h4>
    <div class="well z-active text-size14 clearfix cashiergray-bg">
    <div class="pull-left">账户余额：<span class="cor-orange text-size20">{!! $balance !!}</span>元</div>
    <div class="pull-right">
        <a href="{!! url('finance/cash') !!}" class="f-pay bggreen colgreen">充值</a>
        <a href="{!! url('finance/cashout') !!}" class="f-pay">提现</a>
    </div>
</div>
<div class="text-size14 cor-gray51 zjjyjl">
    最近交易记录
</div>
<div class="f-table">
    <table class="table table-hover text-size14 cor-gray51 table638">
        @if(!$type)
        <thead>
            <tr>
                <th>编号</th>
                <th>流水</th>
                <th>项目收支</th>
                <th>时间</th>
            </tr>
        </thead>
        <tbody>
        @if(!empty($list))
            @foreach($list as $item)
            <tr>
                <td class="cor-blue167">{!! $item->id !!}</td>
                <td>
                    @if($item->action == 1)发布任务
                    @elseif($item->action == 2)任务佣金
                    @elseif($item->action == 3)充值
                    @elseif($item->action == 4)提现
                    @elseif($item->action == 5)增值服务
                    @elseif($item->action == 6)购买作品
                    @elseif($item->action == 7)任务退款
                    @elseif($item->action == 8)提现退款
                    @elseif($item->action == 9)出售商品
                    @elseif($item->action == 10)维权退款
                    @elseif($item->action == 11)服务退款
                    @elseif($item->action == 12)问答打赏
                    @elseif($item->action == 13)问答被打赏
                    @elseif($item->action == 14)推广赏金
                    @endif
                </td>
                <td class="cor-green red">@if(in_array($item->action, array(2, 3, 7, 8,9,10,11,13,14))) + @else - @endif{!! $item->cash !!}</td>
                <td>{!! $item->created_at !!}</td>
            </tr>
            @endforeach
            @else
            <div class="g-nomessage g-nofinancelist">暂无消息哦 ！</div>
        @endif
        </tbody>
        @elseif($type == 'cash')
            <thead>
            <tr>
                <th class="tab-txtcenter">编号</th>
                <th>流水</th>
                <th>项目收支</th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($list))
                @foreach($list as $item)
                    <tr>
                        <td class="tab-txtcenter">{!! $item->id !!}</td>
                        <td>
                            @if($item->action == 1)发布任务
                            @elseif($item->action == 2)任务佣金
                            @elseif($item->action == 3)充值
                            @elseif($item->action == 4)提现
                            @elseif($item->action == 5)增值服务
                            @elseif($item->action == 6)购买作品
                            @elseif($item->action == 7)任务退款
                            @elseif($item->action == 8)提现退款
                            @elseif($item->action == 9)出售商品
                            @elseif($item->action == 10)维权退款
                            @elseif($item->action == 11)服务退款
                            @elseif($item->action == 12)问答打赏
                            @elseif($item->action == 13)问答被打赏
                            @elseif($item->action == 14)推广赏金
                            @endif
                        </td>
                        <td class="cor-green">@if(in_array($item->action, array(2, 3, 7, 8,9,10,11,13,14))) + @else - @endif{!! $item->cash !!}</td>
                        <td>{!! $item->created_at !!}</td>
                    </tr>
                @endforeach
                @else
                <div class="g-nomessage g-nofinancelist">暂无消息哦 ！</div>
            @endif
            </tbody>
        @elseif($type == 'cashout')
            <thead>
            <tr>
                <th class="tab-txtcenter">编号</th>
                <th>提现类型</th>
                <th>提现金额</th>
                <th>到账金额</th>
                <th>时间</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($list))
                @foreach($list as $item)
                    <tr>
                        <td class="tab-txtcenter">{!! $item->id !!}</td>
                        <td>@if($item->cashout_type == 1)支付宝@elseif($item->cashout_type == 2)银行卡@endif</td>
                        <td class="cor-green">{!! $item->cash !!}</td>
                        <td class="cor-green">{!! $item->real_cash !!}</td>
                        <td>{!! $item->created_at !!}</td>
                        <td>@if($item->status == 0)待处理@elseif($item->status == 1)已成功@else已失败@endif</td>
                    </tr>
                @endforeach
                @else
                <div class="g-nomessage g-nofinancelist">暂无消息哦 ！</div>
            @endif
            </tbody>
        @endif
    </table>
</div>
<div class="clearfix text-right">
    {!! $list->appends($_GET)->render() !!}
</div> -->

<!-- 我的资产 结束  -->

<!--  收支明细 -->

<!-- <div class="mymoney_fenlei">
    <div class="mymoney_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Finances.png') !!}" alt="" class="mymoney_biaoti_photo"></span>
        <span class="mymoney_biaoti_text">财务管理</span>
    </div>
    <div class="mymoney_xifen_leixing addborder">
        <a class="mymoney_xifen_leixing_click">我的资产</a>
        <a href="{!! url('finance/assetDetail') !!}" >收支明细</a>
        <a href="{!! url('finance/cash') !!}">我要充值</a>
        <a href="{!! url('finance/cashout') !!}">我要提现</a>
    </div>
    <div class="mymoney_xifen_zhuangtai">
        <div class="mymoney_xifen_zhuangtai_leixing">类型</div>
        <div class="bqhz">
            <a><span>全部</span></a>
            <a><span>发布项目</span></a>
            <a><span>任务佣金</span></a>
            <a><span>充值</span></a>
            <a><span>提现</span></a>
            <a><span>增值服务</span></a>
            <a><span>购买作品</span></a>
            <a><span>项目退款</span></a>
            <a><span>提现退款</span></a>
            <a><span>出售作品</span></a>
            <a><span>维权退款</span></a>
            <a><span>服务退款</span></a>
            <a><span>推广赏金</span></a>
            <a><span>购买VIP</span></a>
        </div>
    </div>
    <div class="detailallinfo hidden-xs">
        <div class="clearfix">
            <div class="detailallinfo_time">时间</div>
            <div class="input-daterange input-group">
                <span class="ass-icore"><input type="text" class="input-sm form-control sjinputgs" name="start" value=""/><i class="fa fa-calendar ass-icoabl"></i></span>
                <span class="guodu"> - </span>
                <span class="ass-icore"><input type="text" class="input-sm form-control sjinputgs" name="end" value=""/><i class="fa fa-calendar ass-icoabl"></i></span></div>
            <div class="">
                <button type="submit" class="detailallbtn">确定</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="szmxlbhz">
    <table class="szmxlbhz_table">
        <thead class="theadgs">
            <tr class="trgs">
                <th>编号</th>
                <th>流水</th>
                <th>收入（元）</th>
                <th>支出（元）</th>
                <th>时间</th>
                <th>支付方式</th>
            </tr>
        </thead>
        <tbody class="tbodygs">
            @if($list->total())
            @foreach($list as $item)
            <tr class="trgs">
                <td class="">{!! $item->id !!}</td>
                <td>
                    @if($item->action == 1)发布任务
                    @elseif($item->action == 2)任务佣金
                    @elseif($item->action == 3)充值
                    @elseif($item->action == 4)提现
                    @elseif($item->action == 5)增值服务
                    @elseif($item->action == 6)购买作品
                    @elseif($item->action == 7)任务退款
                    @elseif($item->action == 8)提现退款
                    @endif
                </td>
                <td>@if(in_array($item->action, array(2, 3, 7, 8))) + {!! $item->cash !!}@endif</td>
                <td class="cor-green">@if(in_array($item->action, array(1, 4, 5, 6))) - {!! $item->cash !!}@endif</td>
                <td>{!! $item->created_at !!}</td>
                <td>
                    @if($item->pay_type == 1)余额
                    @elseif($item->pay_type == 2)支付宝
                    @elseif($item->pay_type == 3)微信
                    @elseif($item->pay_type == 4)银联
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7" class="center">暂无数据</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
<div class="clearfix text-right">
    {!! $list->appends($_GET)->render() !!}
</div> -->

<!-- 收支明细 结束 -->

<!-- 我要充值 -->

<div class="mymoney_fenlei">
    <div class="mymoney_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Finances.png') !!}" alt="" class="mymoney_biaoti_photo"></span>
        <span class="mymoney_biaoti_text">财务管理</span>
    </div>
    <div class="mymoney_xifen_leixing">
        <a class="mymoney_xifen_leixing_click">我的资产</a>
        <a href="{!! url('finance/assetDetail') !!}" >收支明细</a>
        <a href="{!! url('finance/cash') !!}">我要充值</a>
        <a href="{!! url('finance/cashout') !!}">我要提现</a>
    </div>
</div>
<div class="financial_management_box">
    <h4 class="financial_management_box_biaoti addmargin">我要充值</h4>
    <form action="{!! url('finance/cash') !!}" method="post" class="cashform">
    <div class="z-active text-size14 cashiergray-bg wdzch">
        <div class="cor-gray51 addmargin_wdzc">我的资产：<b class="cor-orange text-size20">{!! $balance !!}</b> 元</div>
        <div id="user-profile-2" class="profile-users">
            <div class="memberdiv">
                <div class="cor-gray51 position-relative addmargin_czje" id="cashtips">充值金额：
                    <span class="inlineblock">
                        <input type="text" class="border_3 width_height" name="cash" datatype="cashValid" data-recharge-min=""  nullmsg="请输入充值金额" errormsg="充值金额不小于元"/> 元&nbsp;&nbsp;&nbsp;</span>
                </div>
            </div>
        </div>
    </div>
    <div class="text-size16 m-radio cash-bankImg">
        <div class="czfs">充值方式：</div>
        <div class="inlineblock">
            <label class="">
                <input type="radio" name="pay_type" class="ace" checked="checked" value="alipay"/>
                <span class="lbl"> </span>
               
                        <img src="{!! Theme::asset()->url('images/radioali.jpg') !!}" alt="">
            </label>
        </div>
    <div class="space-20"></div>
    <div class="clearfix">
        <div class="jzbz">
            <a  id="btn_sub"><div class="btn_cz">充值</div></a>
            {!! $errors->first('pay_type') !!}
        </div>
    </div>
    </form>
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header widget-header-flat">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" >&times;</span></button>
                    <b class="modal-title" id="myModalLabel">
                        充值提示：
                    </b>
                </div>
                <div class="modal-body text-center">
                    <h4><i class="fa fa-exclamation-circle"></i><b>请在打开的页面上完成付款！</b></h4>
                    <p class="cor-gray97 text-size14">付款完成前请不要关闭此窗口</p>
                    <div class="space-10"></div>
                    <div class="u-modal-btn"><a id="verifyOrder" data-dismiss="modal" class="btn-big bg-blue bor-radius2">已完成付款</a> <a target="_blank" href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}">支付遇到问题</a></div>
                    <div class="space-6"></div>
                    <a class="u-modal-link" href="javascript:history.back()">返回选择其他支付方式></a>
                    <div class="space-14"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 我要充值 结束 -->

<!-- 我要提现 -->

<!-- <div class="mymoney_fenlei">
    <div class="mymoney_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Finances.png') !!}" alt="" class="mymoney_biaoti_photo"></span>
        <span class="mymoney_biaoti_text">财务管理</span>
    </div>
    <div class="mymoney_xifen_leixing">
        <a class="mymoney_xifen_leixing_click">我的资产</a>
        <a href="{!! url('finance/assetDetail') !!}" >收支明细</a>
        <a href="{!! url('finance/cash') !!}">我要充值</a>
        <a href="{!! url('finance/cashout') !!}">我要提现</a>
    </div>
</div>
<div class="financial_management_box">
    <h4 class="financial_management_box_biaoti addmargin">我要提现</h4>
    <form action="{!! url('finance/cash') !!}" method="post" class="cashform">
        <div class="z-active text-size14 cashiergray-bg wdzch">
            <div class="cor-gray51 addmargin_wdzc">我的资产：<b class="cor-orange text-size20">{!! $balance !!}</b> 元</div>
            <div id="user-profile-2" class="profile-users">
                <div class="memberdiv">
                    <div class="cor-gray51 position-relative addmargin_czje" id="cashtips">充值金额：
                    <span class="inlineblock">
                        <input type="text" class="border_3 width_height" name="cash" datatype="cashValid" data-recharge-min=""  nullmsg="请输入充值金额" errormsg="充值金额不小于元"/> 元
                    </span>
                    <div class="txtips">
                        提现手续费扣取标准 <img src="{!! Theme::asset()->url('images/问号.png') !!}" alt="" class="txtips_pnoto">
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 未绑定 -->
        <!-- <div class="text-center g-bankhint">
            <img src="/themes/default/assets/images/withdrawhint.png"><b class="inlineblock">您还未进行支付绑定！</b>
        </div>
        <div class="space-20"></div>
        <div class="text-center clearfix">
            <a href="{!! url('user/paylist') !!}" class="btn-big bg-blue bor-radius2">去绑定</a>
        </div>
        <!-- 未绑定 结束 -->
        <!-- 已绑定 -->
        <!-- <div class="text-size16 m-radio cash-bankImg">
            <div class="czfs">充值方式：</div>
            <div class="inlineblock">
                <label class="">
                    <input type="radio" name="pay_type" class="ace" checked="checked" value="alipay"/>
                    <span class="lbl"> </span>
                        <img src="{!! Theme::asset()->url('images/radioali.jpg') !!}" alt="">
                </label>
            </div>
            <div class="space-20"></div>
            <div class="clearfix">
                <div class="jzbz">
                    <a  id="btn_sub"><div class="btn_cz">充值</div></a>
                    {!! $errors->first('pay_type') !!}
                </div>
            </div>
        </div> -->
        <!-- 已绑定 结束  -->
    <!-- </form>
</div> -->

<!-- 我要提现  结束 -->



<!-- <div>
<img src="{{Theme::asset()->url('images/meishimeitu/personal/noopen.png')}}" alt="">
</div> -->
{!! Theme::asset()->container('specific-css')->usepath()->add('froala_editor', 'plugins/ace/css/datepicker.css') !!} 
{!! Theme::asset()->container('specific-js')->usepath()->add('bootstrap-datepicker','plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('finacelist', 'css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('financial_management','css/meishimeitu/financial_management.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('assetdetail','js/assetdetail.js') !!}

<!-- 我要充值部分 -->

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-js','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('recharge-css','css/usercenter/finance/finance-recharge.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('usercenter-js','js/usercenter.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-css','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}



<!-- 我要提现部分  -->

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('recharge-css', 'css/usercenter/finance/finance-recharge.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('cashout-js', 'js/cashout.js') !!}