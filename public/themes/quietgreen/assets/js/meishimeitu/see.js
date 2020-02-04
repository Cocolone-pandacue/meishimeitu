/*
* @Author: Marte
* @Date:   2018-12-25 10:20:56
* @Last Modified by:   Marte
* @Last Modified time: 2018-12-25 17:54:22
*/

'use strict';

$(function(){
    $(".paw_see").on('click',function(event) {
        if($(this).hasClass('see_ps')){
            $(this).removeClass("see_ps");
            $(this).addClass('see');
            $(this).siblings('input').attr('type','text');
        }else{
            $(this).removeClass("see");
            $(this).addClass('see_ps');
            $(this).siblings('input').attr('type','password');
        }
    });

    $(".pw").on('click',function(event) {
        if($(this).hasClass('see_ps')){
            $(this).removeClass("see_ps");
            $(this).addClass('see');
            $(this).siblings('input').attr('type','text');
        }else{
            $(this).removeClass("see");
            $(this).addClass('see_ps');
            $(this).siblings('input').attr('type','password');
        }
    });

    // $(".user_na").focus(function(event) {
    //     $(this).siblings('.border_span').animate({width: "100%"}, 300)
    // });
    // $(".user_na").blur(function(event) {
    //     $(this).siblings('.border_span').animate({width: "0px"}, 300)
    // });


    /*$(".login_btn").hover(function() {
        $(this).siblings('.button-mask').animate({width: "100%"},500);
    }, function() {
        $(this).siblings('.button-mask').animate({width: "0"},500);
    });

    $(".register_btn").hover(function() {
        $(this).siblings('.button-mask').animate({width: "100%"},500);
    }, function() {
        $(this).siblings('.button-mask').animate({width: "0"},500);
    });*/

    $(".login_btn").hover(function() {
        $(this).children('.button-mask').animate({left:"310px"},500);
    }, function() {
        $(this).children('.button-mask').animate({left:"-310px"},500);
    });

    $(".register_btn").hover(function() {
        $(this).children('.button-mask-r').animate({left:"350px"},500);
    }, function() {
        $(this).children('.button-mask-r').animate({left:"-350px"},500);
    });

    $("#release").hover(function() {
        $(this).children('.pro-mask').animate({left:"130px"},500);
    }, function() {
        $(this).children('.pro-mask').animate({left:"-130px"},500);
    });
// 鼠标划入发布项目按钮特效   原按钮样式
    // $(".release").hover(function() {
    //     $(this).children('.pro-mask').animate({left:"130px"},500);
    // }, function() {
    //     $(this).children('.pro-mask').animate({left:"-130px"},500);
    // });
    
    
    // 顶部导航栏 点击商铺弹窗

    $(".my_shop").click(function(){
        layer.open({
            type: [1,'#fff'],
            title: '',
            skin: 'my_shop_tip',
            shadeClose:true,
            fix: false,
            scrollbar: false,
            shadeClose: true, //点击遮罩关闭层
            area : ['200px' , '100px'],
            content: "暂未开放，敬请期待！",
        });
    });

    getURL();



})

// 个人中心模态框居中

function letModalCenter(divName){   
    var top = ($(window).height())/2;   
    var left = ($(window).width())/2;   
    var scrollTop = $(document).scrollTop();   
    var scrollLeft = $(document).scrollLeft(); 
    var addtop =  top + scrollTop;
    var addleft = left + scrollLeft;
    $(divName).css({ 'position' : "absolute", 'top' : ""+addtop+"px", 'left': ""+addleft+"px"});  
};

//  公用控制导航栏菜单下面的已点击样式

function getURL(){
    //alert(url);
    var myproductionUploading="/user/productionUploading";
    var mytask="/task";
    var url=window.location.pathname;
    var mycolumn="/task/column/1";
    var mycolumn2="/task/column/2";
    var mycolumn3="/task/column/3";
    var myshop="/bre/shop";
    var myvip="/vipshop";
    var myquestionnaire="/task/brainpower/questionnaire";

    //alert(myfocus);
    if(url==mytask){
        $(".mytask").siblings("li").children("a").removeClass("ck_color");
        $(".mytask").children("a").addClass("ck_color");
    }else if(url==mycolumn||url==mycolumn2||url==mycolumn3){
        $(".mycolumn").siblings('li').children("a").removeClass("ck_color");
        $(".mycolumn").children("a").addClass("ck_color");
    }else if(url==myshop){
        $(".myshop").siblings('li').children("a").removeClass("ck_color");
        $(".myshop").children("a").addClass("ck_color");
    }else if(url==myvip){
        $(".myvip").siblings('li').children("a").removeClass("ck_color");
        $(".myvip").children("a").addClass("ck_color");
    }else if(url==myquestionnaire){
        $(".myquestionnaire").siblings('li').children("a").removeClass("ck_color");
        $(".myquestionnaire").children("a").addClass("ck_color");
    }else if(url==myproductionUploading){
        $(".myproductionUploading").siblings('li').children("a").removeClass('ck_color');
        $(".myproductionUploading").children("a").addClass('ck_color');
    }
}




