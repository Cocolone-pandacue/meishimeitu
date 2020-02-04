/*
* @Author: Marte
* @Date:   2018-07-10 10:14:49
* @Last Modified by:   Marte
* @Last Modified time: 2018-11-28 15:20:45
*/

'use strict';
//私人订制收藏
$(function(){
    $("#goods_id").on('click',function () {
        var goods_id = $("#goods_id").attr('goods_id');
        $.get('/task/ajaxGoodAdd', {'goods_id': goods_id}, function (data) {
            if (data.code == 1) {
                location.reload();
            }
        });
        return false;
    });
})
/*倒计时跳转页面*/
    var t = 15;
    function jiTimes(){
        document.getElementById('time1').innerHTML= t;
        t -= 1;
        if(t==0){
            location.href='http://www.i3job.com/user/realnameAuth';
        }else if(t<0){
            t=0;
        }
        setTimeout("jiTimes()",1000);
    }

    $(".apply").on('click', function(event){
        if($(".prompt").is(":hidden")){
            $(".prompt").show();
            $(".prompt").removeClass('hide');
            jiTimes();
        }
    });

function unScroll() {
    var top = $(document).scrollTop();
    $(document).on('scroll.unable',function (e) {
        $(document).scrollTop(top);
    })
}

function removeUnScroll() {
    $(document).unbind("scroll.unable");
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

function showlayer(){
    var bh=$(document.body).height();
    var bw=$(document.body).width();
    $(".layer").css({
        height:bh,
        width:bw,
        display:"block"
    });
    letDivCenter(".pop");
    unScroll();
}
    //close layer
    $(".close_pop").click(function(){
        $(".layer,.pop").hide();
        removeUnScroll();
    })
    $(".layer").click(function(){
        $(".layer,.pop").hide();
        removeUnScroll();
    })

function showzklayer(){
    var bh=$(document.body).height();
    var bw=$(window).width();
    $(".zklayer").css({
        height:bh,
        width:bw,
        display:"block"
    });
    letDivCenter(".zk_div");
    unScroll();
}

$(".zk_div span").click(function(){
    $(".zklayer,.zk_div").hide();
        removeUnScroll();
    })
$(".zklayer").click(function(){
    $(".zklayer,.zk_div").hide();
    removeUnScroll();
})

function showWlayer(){
    var bh=$(document.body).height();
    var bw=$(document.body).width();
    $(".wlayer").css({
        height:bh,
        width:bw,
        display:"block"
    });
    letDivCenter(".wpop");
    unScroll();
}
    //close layer
    $(".close_pop").click(function(){
        $(".wlayer,.wpop").hide();
        removeUnScroll();
    })
    $(".wlayer").click(function(){
        $(".wlayer,.wpop").hide();
        removeUnScroll();
    })