<!-- 我的资产 -->
<div class="mymoney_fenlei">
    <p class="mymoney_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Finances (1).png') !!}" alt="" class="mymoney_biaoti_photo"></span>
        <span class="mymoney_biaoti_text">财务管理</span>
    </p>
    <p class="mymoney_xifen_leixing">
        <a href="{!! url('finance/list') !!}" class="anniu_click">我的资产</a>
        <a href="{!! url('finance/assetDetail') !!}">收支明细</a>
        <a href="{!! url('finance/cash') !!}">我要充值</a>
        <a href="{!! url('finance/cashout') !!}">我要提现</a>
    </p>
</div>
<div class="wdzc">
    <div class="financial_management_box">
        <h4 class="financial_management_box_biaoti">我的资产</h4>
        <div class="well z-active text-size14 clearfix cashiergray-bg">
            <div class="pull-left">账户余额：<span class="cor-orange text-size20">{!! $balance !!}</span>元</div>
            <div class="pull-right">
                <a href="{!! url('finance/cash') !!}" class="f-pay" target="_blank">充值</a>
                <a href="{!! url('finance/cashout') !!}" class="f-pay" target="_blank">提现</a>
            </div>
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
            @if($list->total())
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
                        @elseif($item->action == 12)智能工具
                        {{--@elseif($item->action == 13)问答被打赏--}}
                        @elseif($item->action == 14)推广赏金
                        @elseif($item->action == 16)买vip接单凭证
                        @endif
                    </td>
                    <td class="cor-green red">@if(in_array($item->action, array(2, 3, 7, 8,9,10,11,13,14))) + @else - @endif{!! $item->cash !!}</td>
                    <td>{!! $item->created_at !!}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7" class="center">暂无数据</td>
                </tr>
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
        <div class="paging_bootstrap">
            {!! $list->appends($_GET)->render() !!}
        </div>
    </div>
</div>
<!-- 我的资产 结束  -->

<!--  收支明细 -->

<!-- <div class="szmx hide">
    <div class="mymoney_xifen_zhuangtai">
        <div class="mymoney_xifen_zhuangtai_leixing">类型</div>
        <div class="bqhz">
            <a>全部</a>
            <a>发布项目</a>
            <a>任务佣金</a>
            <a>充值</a>
            <a>提现</a>
            <a>增值服务</a>
            <a>购买作品</a>
            <a>项目退款</a>
            <a>提现退款</a>
            <a>出售作品</a>
            <a>维权退款</a>
            <a>服务退款</a>
            <a>推广赏金</a>
            <a>购买VIP</a>
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
</div> -->
<!-- 收支明细 结束 -->






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
