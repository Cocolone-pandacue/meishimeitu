/*
* @Author: Marte
* @Date:   2018-12-06 16:19:17
* @Last Modified by:   Marte
* @Last Modified time: 2018-12-06 16:21:29
*/

$(function(){
$('.go_top').click(function(){
    $('html , body').animate({scrollTop: 0},1000);
});
$(".foot_list_weixin").hover(function(){
    $(".foot_list_weixin_code").show();
},function(){
    $(".foot_list_weixin_code").hide();
});
})