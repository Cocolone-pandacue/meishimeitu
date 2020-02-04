<div class="mymoney_fenlei">
    <p class="mymoney_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Finances (1).png') !!}" alt="" class="mymoney_biaoti_photo"></span>
        <span class="mymoney_biaoti_text">财务管理</span>
    </p>
    <p class="mymoney_xifen_leixing">
        <a href="{!! url('finance/list') !!}" >我的资产</a>
        <a href="{!! url('finance/assetDetail') !!}">收支明细</a>
        <a href="{!! url('finance/cash') !!}">我要充值</a>
        <a href="{!! url('finance/cashout') !!}" class="anniu_click">我要提现</a>
    </p>
</div>
<div class="financial_management_box">
    <h4 class="financial_management_box_biaoti addmargin">我要提现</h4>
    <form method="post" action="{!! url('finance/cashout') !!}" class="registerform">
        {!! csrf_field() !!}
        <div class="cashier cashiergray z-active text-size14 cashiergray-bg wdzch">
            <div class="cor-gray51 addmargin_wdzc">我的资产：<b class="cor-orange text-size20">{!! $balance !!}</b> 元</div>
            <div id="user-profile-2" class="profile-users">
                <div class="memberdiv">
                    <div class="memberdiv-validform" id="cashtips">
                        <label for="">提现金额：</label>
                        <input type="text" class="border_3 width_height" name="cash" datatype="number" data-recharge-min=""  nullmsg="请输入提现金额" errormsg="提现金额不小于0.01元" value="{!! old('cash') !!}"/> 元
                    </div>
                    <div class="txtips">提现手续费扣取标准 
                        <img src="{!! Theme::asset()->url('images/问号.png') !!}" alt="" class="txtips_pnoto">
                        <div class="txtipsdhk">
                            <p>根据银行提现手续费扣取标准：</p>
                            <p>A. 200元以下（含200元）单笔收费{!! $cashRule['per_low'] !!}元</p>
                            <p>B. 200元以上 单笔收费{!! $cashRule['per_charge'] !!}%, 最高收费{!! $cashRule['per_high'] !!}元</p>
                            <p>C. 单次最低提现金额{!! $cashRule['withdraw_min'] !!}元</p>
                            <p>D. 最高提现最大金额{!! $cashRule['withdraw_max'] !!}元</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- 未绑定 -->
        @if($alipayAccount->count() == 0 && $bankAccount->count() == 0)
        <div class="text-center g-bankhint addmargin_bd">
            <img src="/themes/default/assets/images/withdrawhint.png"><b class="inlineblock">您还未进行支付绑定！</b>
        </div>
        <div class="space-20"></div>
        <div class="text-center clearfix">
            <a href="{!! url('user/paylist') !!}" class="btn-big bg-blue bor-radius2">去绑定</a>
        </div>
        <!-- 未绑定 结束 -->
        @else
        @if($alipayAccount->count())
        <div>
            <div class="space-20"></div>
            <h6 class="text-size16">第三方支付：</h6>
            <div class="space-10"></div>
                @foreach($alipayAccount as $item)
            <label class="clearfix inline">
                <input type="radio" name="cashout_account" class="ace" checked="checked" value="{!! $item->alipay_account !!}"/>
                <span class="lbl ">
                    <span  class="lbl-bank">
                        <div class="u-radioali s-packbor text-center">
                            <img src="{!! Theme::asset()->url('images/radioali.jpg') !!}" alt="" width="96" height="35">
                        </div>
                        <div class="text-center clearfix">{!! CommonClass::starReplace($item->alipay_account,3,4) !!}</div>
                    </span>
                </span>
            </label>
        @endforeach
        </div>
            @endif
            @if($bankAccount->count())
        <div>
            <h6 class="text-size16">网上银行：</h6>
            <div class="space-10"></div>
                @foreach($bankAccount as $item)
            <label class="clearfix inline">
                <input type="radio" name="cashout_account" class="ace" value="{!! $item->bank_account !!}"/>
                <span class="lbl ">
                    <span  class="lbl-bank">
                        <div class="s-packbor s-bank1 text-center">
                            @if($item->bank_name == '光大银行')
                                <img src="{!! Theme::asset()->url('images/bank/gdyh.jpg') !!}" />
                            @elseif($item->bank_name == '华夏银行')
                                <img src="{!! Theme::asset()->url('images/bank/hxyh.jpg') !!}" />
                            @elseif($item->bank_name == '建设银行')
                                <img src="{!! Theme::asset()->url('images/bank/jsyh.jpg') !!}" />
                            @elseif($item->bank_name == '交通银行')
                                <img src="{!! Theme::asset()->url('images/bank/jtyh.jpg') !!}" />
                            @elseif($item->bank_name == '民生银行')
                                <img src="{!! Theme::asset()->url('images/bank/msyh.jpg') !!}" />
                            @elseif($item->bank_name == '农村信用社')
                                <img src="{!! Theme::asset()->url('images/bank/ncxys.jpg') !!}" />
                            @elseif($item->bank_name == '农业银行')
                                <img src="{!! Theme::asset()->url('images/bank/nyyh.jpg') !!}" />
                            @elseif($item->bank_name == '平安银行')
                                <img src="{!! Theme::asset()->url('images/bank/payh.jpg') !!}" />
                            @elseif($item->bank_name == '浦发银行')
                                <img src="{!! Theme::asset()->url('images/bank/pfyh.jpg') !!}" />
                            @elseif($item->bank_name == '兴业银行')
                                <img src="{!! Theme::asset()->url('images/bank/xyyh.jpg') !!}" />
                            @elseif($item->bank_name == '邮政储蓄')
                                <img src="{!! Theme::asset()->url('images/bank/yzcx.jpg') !!}" />
                            @elseif($item->bank_name == '招商银行')
                                <img src="{!! Theme::asset()->url('images/bank/zsyh.jpg') !!}" />
                            @elseif($item->bank_name == '中国银行')
                                <img src="{!! Theme::asset()->url('images/bank/zgyh.jpg') !!}" />
                            @endif
                        </div>
                        <div class="text-center clearfix">
                            {!! CommonClass::starReplace($item->bank_account, -5) !!}
                        </div>
                    </span>
                </span>
            </label>
        @endforeach
        </div>
        @endif
    <div class="space"></div>
        @if($bankAccount->count() > 8)
    <div class="s-">
        <a href="javascript:;" class="cor-blue text-size14"  data-toggle="collapse" data-target="#demo">显示更多银行</a>
    </div>
    <div class="space"></div>
    <div class="text-size16 m-radio collapse" id="demo" >
        <div>
            @foreach($bankAccount as $k=>$item)
                @if($k > 8)
            <label class="clearfix inline">
                <input type="radio" name="cashout_account" class="ace" value="{!! $item->bank_account !!}"/>
                <span class="lbl ">
                    <span  class="lbl-bank">
                        <div class="s-packbor s-bank1 text-center">
                            @if($item->bank_name == '光大银行')
                                <img src="{!! Theme::asset()->url('images/bank/gdyh.jpg') !!}" />
                            @elseif($item->bank_name == '华夏银行')
                                <img src="{!! Theme::asset()->url('images/bank/hxyh.jpg') !!}" />
                            @elseif($item->bank_name == '建设银行')
                                <img src="{!! Theme::asset()->url('images/bank/jsyh.jpg') !!}" />
                            @elseif($item->bank_name == '交通银行')
                                <img src="{!! Theme::asset()->url('images/bank/jtyh.jpg') !!}" />
                            @elseif($item->bank_name == '民生银行')
                                <img src="{!! Theme::asset()->url('images/bank/msyh.jpg') !!}" />
                            @elseif($item->bank_name == '农村信用社')
                                <img src="{!! Theme::asset()->url('images/bank/ncxys.jpg') !!}" />
                            @elseif($item->bank_name == '农业银行')
                                <img src="{!! Theme::asset()->url('images/bank/nyyh.jpg') !!}" />
                            @elseif($item->bank_name == '平安银行')
                                <img src="{!! Theme::asset()->url('images/bank/payh.jpg') !!}" />
                            @elseif($item->bank_name == '浦发银行')
                                <img src="{!! Theme::asset()->url('images/bank/pfyh.jpg') !!}" />
                            @elseif($item->bank_name == '兴业银行')
                                <img src="{!! Theme::asset()->url('images/bank/xyyh.jpg') !!}" />
                            @elseif($item->bank_name == '邮政储蓄')
                                <img src="{!! Theme::asset()->url('images/bank/yzcx.jpg') !!}" />
                            @elseif($item->bank_name == '招商银行')
                                <img src="{!! Theme::asset()->url('images/bank/zsyh.jpg') !!}" />
                            @elseif($item->bank_name == '中国银行')
                                <img src="{!! Theme::asset()->url('images/bank/zgyh.jpg') !!}" />
                            @endif
                        </div>
                        <div class="text-center clearfix">{!! $item->realname !!}
                            {!! CommonClass::starReplace($item->bank_account, -5) !!}
                        </div>
                    </span>
                </span>
            </label>
                @endif
            @endforeach
        </div>
    </div>
        @endif
        <div class="space-20"></div>
        <div class="text-center clearfix">
            <a class="nextStep" id="btn_sub">下一步</a>
            <a href="/finance/list" class="btn-big">返回</a>
        </div>
        <div class="space-20"></div>
        @endif
    </form>
</div>

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('recharge-css', 'css/usercenter/finance/finance-recharge.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('cashout-js', 'js/cashout.js') !!}

{!! Theme::asset()->container('custom-css')->usepath()->add('financial_management','css/meishimeitu/financial_management.css') !!}