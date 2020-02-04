/*
* @Author: Marte
* @Date:   2018-11-07 15:40:35
* @Last Modified by:   Marte
* @Last Modified time: 2018-11-29 14:29:26
*/
'use strict';
$(function(){
    $(".s_radio").on('click', function(event) {
        $(this).children('span').addClass('sele_radio');
        $(this).parent().siblings('.radio_box').children('.s_radio').children('span').removeClass('sele_radio');
        if($(".s_radio").children('span').hasClass('sele_radio')){
            $(".submit").css('background-color', '#1f8cbd');
        }
        if($(".one").hasClass('sele_radio')){
            $(".support").removeClass('hide');
        }
        if($(".piracy_title").hasClass('sele_radio')){
            $(".support").addClass('hide');
            $(".piracy").removeClass('hide');
        }else{
            $(".piracy").addClass('hide');
        }
        if($(".other_title").hasClass('sele_radio')){
            $(".other").removeClass('hide');
            $(".support").addClass('hide');
        }else{
            $(".other").addClass('hide');
        }
    });

})