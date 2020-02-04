/*
* @Author: Marte
* @Date:   2018-10-19 11:53:40
* @Last Modified by:   Marte
* @Last Modified time: 2018-11-23 10:12:11
*/

'use strict';
$(function(){
    getSpan();
    function getSpan(){
        var url=window.location.href;
        var index=url.indexOf("paginate");
        var str;
        if(index!=-1){
            var str_after = url.split("paginate=")[1];
            str=str_after.substr(0,2);
        }
        /*alert(str);*/
        var one_span=$(".sel_a span:eq(0)");
        switch(str){
            case "10":
                $(".ten").insertBefore(one_span);
            break;
            case "15":0
                $(".fifteen").insertBefore(one_span);
            break;
            case "20":
                $(".twenty").insertBefore(one_span);
            break;
            case "25":
                $(".twenty_five").insertBefore(one_span);
            break;
            case "30":
                $(".thirty").insertBefore(one_span);
            break;
            case "35":0
                $(".thirty_five").insertBefore(one_span);
            break;
            case "40":
                $(".forty").insertBefore(one_span);
            break;
            case "45":
                $(".forty_five").insertBefore(one_span);
            break;
            case "50":
                $(".fifty").insertBefore(one_span);
            break;
            default:
                $(".twenty_five").insertBefore(one_span);
        }
    }

    var swiper = new Swiper('.swiper-container', {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    $(" .img_wrap li").hover(function(){
        /*.children('a')*/
        $(this).children('.shade_div ').stop(false,false).animate({ opacity: "0.7" }, 900);
        $(this).children('.shade_content ').stop(false,false).animate({ opacity: "1" }, 1500);
        },function(){
        $(this).children('.shade_div ').stop(false,false).animate({ opacity: "0" }, 1500);
        $(this).children('.shade_content ').stop(false,false).animate({ opacity: "0" }, 900);
    });

    $(".type_list  li").on("click",function(){
        $(this).children('a').addClass('selected_li');
        $(this).siblings().children('a').removeClass('selected_li');
    })

    $(".hover_list_wrap a span").on("click",function(){
        var val=$(this).text();
        $(".type_select_title").html($(this).parent().parent().parent().parent().children('a').text()+"-");
        $(".type_select").html(val);
        $(this).css('color', '#1197ec');
        $(this).siblings().css('color', '#273438');
        $(this).parent().parent().parent().siblings().children('.hover_list').children('.hover_list_wrap').children('span').css('color', '#273438');
        if($(this).parent().parent().parent().children('a').text()=="自定义"){
            $('input[type=radio][name="type"]:checked').prop("checked", false);
            $(this).parent().parent().parent().siblings().children('.hover_list').children('.hover_list_wrap').children('label').css('color', '#273438');
        }else{
            $("input:checkbox").removeAttr("checked");
        }
    })

    $(".sure_type").on("click",function(){
        var  val = $(this).siblings('label').children('input:checked').parent().text();
        $(".type_select_title").html($(this).parent().parent().parent().parent().children('a').text()+"-");
        $(".type_select").html(val);
    })

    $(".sel").on("click",function(){
        if($(this).hasClass('fa-angle-down')){
            $(this).removeClass('fa-angle-down');
            $(this).addClass('fa-angle-up');
            $(".sel_a").css('height', '270px');
        }
        else{
            $(this).removeClass('fa-angle-up');
            $(this).addClass('fa-angle-down');
            $(".sel_a").css('height', '30px');
            $(".sel_a").css('overflow', 'hidden');
        }
    })

    $(".sel_a span").on("click",function(){
        var one_span=$(".sel_a span:eq(0)");
        $(this).insertBefore(one_span);
        $(".sel_a").css('height', '30px');
        $(".sel_a").css('overflow', 'hidden');
        $(".sel").removeClass('fa-angle-up');
        $(".sel").addClass('fa-angle-down');
    })
})

function upForm(){
    $("#shoplist_form").submit();
}