<div class="mymoney_fenlei">
    <p class="mymoney_biaoti">
        <span><img src="{!! Theme::asset()->url('images/Finances (1).png') !!}" alt="" class="mymoney_biaoti_photo"></span>
        <span class="mymoney_biaoti_text">财务管理</span>
    </p>
    <p class="mymoney_xifen_leixing">
        <a href="{!! url('finance/list') !!}" >我的资产</a>
        <a href="{!! url('finance/assetDetail') !!}">收支明细</a>
        <a href="{!! url('finance/cash') !!}" class="anniu_click">我要充值</a>
        <a href="{!! url('finance/cashout') !!}">我要提现</a>
    </p>
</div>
<div class="financial_management_box">
        <h4 class="financial_management_box_biaoti addmargin">我要充值</h4>
        <form action="{!! url('finance/cash') !!}" method="post" class="cashform">
        {!! csrf_field() !!}
            <div class="z-active text-size14 cashiergray-bg wdzch">
                <div class="cor-gray51 addmargin_wdzc">我的资产：<b class="cor-orange text-size20">{!! $balance !!}</b> 元</div>
                <div id="user-profile-2" class="profile-users">
                    <div class="memberdiv">
                        <div class="memberdiv-validform" id="cashtips">
                            <label for="">充值金额：</label>
                            <input type="text" class="border_3 width_height" name="cash" datatype="cashValid" data-recharge-min="{!! $recharge_min !!}"  nullmsg="请输入充值金额" errormsg="充值金额不小于{!! $recharge_min !!}元"/> 元
                            <span class="Validform_label">请输入充值金额</span>
                        </div>
                    </div>
                </div>
                <div class="popover-content cor-gray51" style="padding-left:71px;font-size:12px;color:#777"> *我们会在您提交后处理您的充值</div>
            </div>
            <div class="text-size16 m-radio cash-bankImg">
                <div class="czfs">充值方式：</div>
                <div class="inlineblock">
                @if($payConfig['alipay']['status'])
                    <label class="">
                        <input type="radio" name="pay_type" class="ace" checked="checked" value="alipay"/>
                        <span class="lbl">
                            <img src="{!! Theme::asset()->url('images/radioali.jpg') !!}" alt="">
                        </span>
                    </label>
                @endif
                @if($payConfig['wechatpay']['status'])
                    <label class="">
                        <input type="radio" name="pay_type" class="ace" value="wechat"/>
                        <span class="lbl">
                            <img src="{!! Theme::asset()->url('images/radiowx.jpg') !!}" alt="">
                        </span>
                    </label>
                @endif
                {{--@if($payConfig['unionpay']['status'])
                    <label class="">
                        <input type="radio" name="pay_type" class="ace" checked="checked" value="unionbank"/>
                        <span class="lbl">
                            <img src="{!! Theme::asset()->url('images/radiopay.jpg') !!}" alt="">
                        </span>
                    </label>
                @endif--}}
                </div>
            </div>
            <div class="space-20"></div>
            <div class="clearfix">
                <div class="jzbz">
                    <a  id="btn_sub"><div class="btn_cz btn-imp">充值</div></a>
                    {!! $errors->first('pay_type') !!}
                </div>
            </div>
        </form>
        <!-- 模态框（Modal） -->
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
                        <div class="u-modal-btn"><a id="verifyOrder" data-dismiss="modal" class="btn_pay">已完成付款</a> <a target="_blank" href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}">支付遇到问题</a></div>
                        <div class="space-6"></div>
                        <a class="u-modal-link" href="javascript:history.back()">返回选择其他支付方式></a>
                        <div class="space-14"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-js','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('recharge-css','css/usercenter/finance/finance-recharge.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-css','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('financial_management','css/meishimeitu/financial_management.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('usercenter-js','js/usercenter.js') !!}


