/*
* @Author: Marte
* @Date:   2018-12-25 16:22:08
* @Last Modified by:   Marte
* @Last Modified time: 2019-01-22 10:20:29
*/

'use strict';

$(function(){
    $(".begin_word_box").hover(function() {
        $(this).children('.img-mask').animate({left:"160px"},300);
        //$(this).siblings('.po_ja').css('right', '5px');
        $(this).siblings('.po_ja').animate({right:"5px"},300);

    }, function() {
        $(this).children('.img-mask').animate({left:"-160px"},300);
        //$(this).siblings('.po_ja').css('right', '15px');
        $(this).siblings('.po_ja').animate({right:"15px"},300);
    });


    /* 主题 */
    $(".enter_word_a").hover(function() {
        /*alert(111);*/
        $(this).children('.enter_img').animate({bottom:"8px"},300);
        $(this).children('.enter_border').css('height', '0px');
    }, function() {
        $(this).children('.enter_img').animate({bottom:"-27px"},300);
        $(this).children('.enter_border').css('height', '30px');
    });

    $(".enter_word_a").on('click', function(event) {
        var shop_top=$(".shop").offset().top;
        console.log(shop_top);
        $('html,body').animate({scrollTop:shop_top},'slow');
    });

    /* 案例分享外层 */
    $(".type_service_wrap li").hover(function() {
        $(this).children().children('.shade_content_right').animate({top:"-70px",opacity:"1"},500);
        $(this).children().children('.ti_span').animate({top:"-70px",opacity:"1"},450);
    }, function() {
        $(this).children().children('.shade_content_right').animate({top:"-55px",opacity:"0"},500);
        $(this).children().children('.ti_span').animate({top:"61px",opacity:"0"},450);
    });

    /*鼠标跟随*/
   /* document.onmousemove = function (e) {
        e = e||window.event;
        var x = 0.3-e.clientX/document.body.offsetWidth;
        var y = 0.3-e.clientY/document.body.offsetHeight;
        //$(".imgHover").style.transform = "translate("+x*100+"px,"+y*100+"px)";
        $(".imgHover").css('transform', 'translate('+x*180+'px,'+y*180+'px)');
    };*/

     document.onmousemove = function (e) {
        e = e || window.event;
        var x = 0 - e.clientX / document.body.offsetWidth;
        var y = 0 - e.clientY / document.body.offsetHeight;
        //document.getElementById("a").style.transform = "translate(" + x * 50 + "px," + y * 50 + "px)";
        $(".imgHoverla").css('transform', 'translate('+x*30+'px,'+y*90+'px)');
        var x = 0 - e.clientX / document.body.offsetWidth;
        var y = 0 - e.clientY / document.body.offsetHeight;
        //document.getElementById("b").style.transform = "translate(" + x * 150 + "px," + y * 150 + "px)";
        $(".imgHoverlb").css('transform', 'translate('+x*50+'px,'+y*150+'px)');
        var x = 0 - e.clientX / document.body.offsetWidth;
        var y = 0 - e.clientY / document.body.offsetHeight;
        //document.getElementById("d").style.transform = "translate(" + x * 100 + "px," + y * 100 + "px)";
        $(".imgHoverlc").css('transform', 'translate('+x*40+'px,'+y*120+'px)');        
        var x = 0 + e.clientX / document.body.offsetWidth;
        var y = 0 + e.clientY / document.body.offsetHeight;
        //document.getElementById("c").style.transform = "translate(" + x * 300 + "px," + y * 300 + "px)";
        $(".imgHovera").css('transform', 'translate('+x*50+'px,'+y*150+'px)');
        var x = 0 + e.clientX / document.body.offsetWidth;
        var y = 0 + e.clientY / document.body.offsetHeight;
        //document.getElementById("d").style.transform = "translate(" + x * 80 + "px," + y * 80 + "px)";
        $(".imgHoverb").css('transform', 'translate('+x*40+'px,'+y*120+'px)');
        var x = 0 + e.clientX / document.body.offsetWidth;
        var y = 0 + e.clientY / document.body.offsetHeight;
        //document.getElementById("d").style.transform = "translate(" + x * 80 + "px," + y * 80 + "px)";
        $(".imgHoverc").css('transform', 'translate('+x*20+'px,'+y*60+'px)'); 
    };

    // 鼠标移入首页侧边菜单，显示客服内容
   
$(".customer .flex_column").click(function() {

   $(this).children(".ssss").css("z-index","-10");
   $(this).children(".sss").css("z-index","10");
   $(this).siblings(".flex_column").children(".ssss").css("z-index","10");
   $(this).siblings(".flex_column").children(".sss").css("z-index","-10");

   $(this).children("span").css("color","#fff");
   $(this).siblings(".flex_column").children("span").css("color","#333");

   $(this).css("background","#333");
   $(this).siblings().css("background","#fff");

    var index=$(this).index();
    $(".hover_show").hide();
    $(".hover_show").eq(index).show();
});

$("body").on('click',function (e) {
    if($(e.target).closest('.customer').length > 0){        //  $(e.target) 鼠标点击的目标 ， .closest()从当前目标开始向上查找    
        return;
    }else{
        //关闭侧边栏
        $(".hover_show").hide()
        if($(".customer_rights").find(".hide").length==0){
            $(".formbtn").addClass("hide");
           }
    }
});

// $("#suggest").focus(function(){
//     $(".formbtn").removeClass("hide_btn");
// })




})



