<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<div class="clearfix bgd_red">
    <!-- 上半红色部分 -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="winner_list">
                    <p class="winnerNameList">中奖用户名单 :</p>
                    <div class="the_winners">
                        <ul style="margin-top:0!important">
                            @foreach($rewardlist as $r)
                            <li>
                                <span class="">恭喜</span><span class="">{{$r->usname}}</span><span class="">抽中</span><span class="">{{$r->rdname}}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <p class="residueDegree">剩余抽奖次数<span class="count">{{$num}}</span>次</p>
                <div class="draw" id="lottery">
                    <table>
                        <tbody class="">
                            <tr>
                                <td class="item lottery-unit lottery-unit-1">
                                    <div class="img">
                                        <!-- 奖品图片 -->
                                        <img src="{!! Theme::asset()->url('images/littlepig.png') !!}" alt="">
                                    </div>
                                    <span class="name">10积分</span>
                                </td>
                                <td class="gap"></td>
                                <td class="item lottery-unit lottery-unit-2">
                                    <div class="img">
                                        <img src="{!! Theme::asset()->url('images/thanks.png') !!}" alt="">
                                    </div>
                                    <span class="name">50积分</span>
                                </td>
                                <td class="gap"></td>
                                <td class="item lottery-unit lottery-unit-3">
                                    <div class="img">
                                        <img src="{!! Theme::asset()->url('images/littlepig.png') !!}" alt="">
                                    </div>
                                    <span class="name">100积分</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="gap-2" colspan="5"></td>
                            </tr>
                            <tr>
                                <td class="item lottery-unit lottery-unit-8">
                                    <div class="img">
                                        <img src="{!! Theme::asset()->url('images/thanks.png') !!}" alt="">
                                    </div>
                                    <span class="name">谢谢参与</span>
                                </td>
                                <td class="gap"></td>
                                <td class="">
                                    <a class="draw-btn" href="javascript:"></a>
                                </td>
                                <td class="gap"></td>
                                <td class="item lottery-unit lottery-unit-4">
                                    <div class="img">
                                        <img src="{!! Theme::asset()->url('images/littlepig.png') !!}" alt="">
                                    </div>
                                    <span class="name">500积分</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="gap-2" colspan="5"></td>
                            </tr>
                            <tr>
                                <td class="item lottery-unit lottery-unit-7">
                                    <div class="img">
                                        <img src="{!! Theme::asset()->url('images/thanks.png') !!}" alt="">
                                    </div>
                                    <span class="name">免费项目</span>
                                </td>
                                <td class="gap"></td>
                                <td class="item lottery-unit lottery-unit-6">
                                    <div class="img">
                                        <img src="{!! Theme::asset()->url('images/littlepig.png') !!}" alt="">
                                    </div>
                                    <span class="name">公仔</span>
                                </td>
                                <td class="gap"></td>
                                <td class="item lottery-unit lottery-unit-5">
                                    <div class="img">
                                        <img src="{!! Theme::asset()->url('images/thanks.png') !!}" alt="">
                                    </div>
                                    <span class="name">手机</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix bgd_green">
    <!-- 下半蓝色部分 -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <p class="lotteryRule">抽奖规则 :</p>
            </div>
            <div class="col-md-9">
                <p class="space_90"></p>
                <p class="lotteryRuleDetail">1.完成1次项目验收后，将会获得1次抽奖机会，获取抽奖的次数没有上限；</p>
                <p class="lotteryRuleDetail">2.所有虚拟奖品，中奖后将会会即时到账；</p>
                <p class="lotteryRuleDetail">3.所有实体奖品，在中奖后工作人员将会在15个工作日内与您联系确认领奖事宜，并且询问邮寄的相关信息资料，到时候请提供正确的信息资料，否则所获奖品将被视作为弃奖处理；</p>
                <p class="lotteryRuleDetail">4.积分为本网站的一种兑换交易单位，您可以在平台店铺、辅助工具内兑换设计作品；</p>
            </div>
        </div>
    </div>
</div>







<!-- 奖品弹窗 -->

<!-- 第一个奖项 -->
<div id='integral' class="integral" style = "display: none">
    <div class="lottery_title">恭喜你！</div>
    <div class="lottery_content">抽中了10积分</div>
    <div class="">
        <img src="{!! Theme::asset()->url('images/lottery_empty.png') !!}" alt="">
    </div>
    <div class="warning_text">工作人员将会在15个工作日内与您联系确认领奖事宜；</div>
    <div class="next_chance">验收项目获取下一次抽奖机会！</div>
    <button class="btn_sure">确认领奖</button>
</div>



<!-- 实体奖项 暂时废弃，不需要记录联系方式-->

<!-- <div id='entity_1' class="entity" style = "display: none">
    <form action="" class="">
        <div class="">
            <img src="{!! Theme::asset()->url('images/intity.png') !!}" alt="">
        </div>
        <input type="text" class="entity_input" name="name" placeholder="输入姓名">
        <input type="text" class="entity_input" name="phone" placeholder="输入手机号码">
        <div class="warning_text">工作人员将会在15个工作日内与您联系确认领奖事宜；</div>
        <button class="entity_btn">确定</button>
    </form>
</div> -->
		
		
	


	

