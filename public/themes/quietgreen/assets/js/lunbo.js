/*
* @Author: Marte
* @Date:   2018-12-05 17:45:07
* @Last Modified by:   Marte
* @Last Modified time: 2019-01-15 21:00:59
*/

'use strict';
$(function(){
    Pimg();
    var swiper = new Swiper('.swiper-container', {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
        delay: 3500,
        disableOnInteraction: false,
        },
        pagination: {                         // 如果需要分页器
        el: '.swiper-pagination',            
        clickable: true,
        },
        navigation: {                       // 如果需要前进后退按钮
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
        },
    })

    // $('.swiper-slide').mouseenter(function () {
    //     swiper.autoplay.stop();
    // })
    // $('.swiper-slide').mouseleave(function () {
    //     swiper.autoplay.start();
    // })


    function Pimg(){
        if($(".img_start").parent().hasClass('swiper-slide-active')){
            $(".start_design").removeClass("hide");
        }else{
            $(".start_design").addClass("hide");
        }
    }




    function resizeHeight(){
        var bodyTop=$(window).height();
        $(".banner").css('height', ''+bodyTop+'px');
        if($('.banner').height()<=600){
            $(".banner").css('height', '600px');
        }
        //console.log(bodyTop);
    }

    resizeHeight();

    $(window).resize(function() {
        resizeHeight();
    });


})