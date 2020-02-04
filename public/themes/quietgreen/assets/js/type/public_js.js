/*
* @Author: Marte
* @Date:   2018-08-20 10:51:50
* @Last Modified by:   Marte
* @Last Modified time: 2018-11-14 17:48:55
*/

'use strict';
    // 退款协议弹出层
function showlayer(){
    var bh=$(document.body).height();
    var bw=$(document.body).outerWidth(true);
    $(".layer").css({
        height:bh,
        width:bw,
        display:"block"
    });
    letDivCenter(".pop");
    $('body').css({
        "overflow-x":"hidden",
        "overflow-y":"hidden"
     });
}

function letDivCenter(divName){
　　var top = ($(window).height() - $(divName).height())/2;
　　var left = ($(window).width() - $(divName).width())/2;
　　var scrollTop = $(document).scrollTop();
　　var scrollLeft = $(document).scrollLeft();
　　$(divName).css({
       position : 'absolute',
       top : top + scrollTop,
       left : left + scrollLeft
      }).fadeIn(500);
}

//close layer
$(".close_pop").click(function(){
    $(".layer,.pop").hide();
    $('body').css({
        "overflow-x":"auto",
        "overflow-y":"auto"
    });
})
$(".layer").click(function(){
    $(".layer,.pop").hide();
    $('body').css({
        "overflow-x":"auto",
        "overflow-y":"auto"
    });
})


function showlayeruser(){
    var bh=$(document.body).height();
    var bw=$(document.body).outerWidth(true);
    $(".layer_user").css({
        height:bh,
        width:bw,
        display:"block"
    });
    letDivCenter(".pop_user");
    $('body').css({
        "overflow-x":"hidden",
        "overflow-y":"hidden"
     });
}
//close layer
$(".close_pop_user").click(function(){
    $(".layer_user,.pop_user").hide();
    $('body').css({
        "overflow-x":"auto",
        "overflow-y":"auto"
    });
})
$(".layer_user").click(function(){
    $(".layer_user,.pop_user").hide();
    $('body').css({
        "overflow-x":"auto",
        "overflow-y":"auto"
    });
})

function showlayeryin(){
    var bh=$(document.body).height();
    var bw=$(document.body).outerWidth(true);
    $(".layer_yin").css({
        height:bh,
        width:bw,
        display:"block"
    });
    letDivCenter(".pop_yin");
    $('body').css({
        "overflow-x":"hidden",
        "overflow-y":"hidden"
     });
}
//close layer
$(".close_pop_yin").click(function(){
    $(".layer_yin,.pop_yin").hide();
    $('body').css({
        "overflow-x":"auto",
        "overflow-y":"auto"
    });
})
$(".layer_yin").click(function(){
    $(".layer_yin,.pop_yin").hide();
    $('body').css({
        "overflow-x":"auto",
        "overflow-y":"auto"
    });
})


