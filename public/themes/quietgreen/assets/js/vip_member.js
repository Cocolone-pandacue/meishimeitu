
//  单选框点击样式并且将金额与倒计时绑定
$("input[type='radio'][checked='checked']").parent().css({"background":"rgba(255,247,238,1)","border":"1px solid rgba(255, 149, 23, 1)"});
$(".package_choose").click(function(){
	$(this).css({"background":"rgba(255,247,238,1)","border":"1px solid rgba(255, 149, 23, 1)"});
	$(this).siblings().css({"background":"white","border":"1px solid rgba(202,202,202,1)"});
	var deadline = $(this).find(".deadline").text();         // 获取到所选套餐的有效期
	$(".settle_accounts_detail").find(".deadline").text(deadline);
	var past_money = $(this).find(".past_money").text();      // 获取到所选套餐的原价
	$(".settle_accounts_detail").find(".past_money").text(past_money);
	var now_money = $(this).find(".now_money").text();       // 获取到所选套餐的打折价
	$(".money_count").find(".now_money").text(now_money);
})



