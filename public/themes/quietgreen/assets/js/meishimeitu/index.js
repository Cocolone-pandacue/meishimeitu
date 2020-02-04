/*
* @Author: Marte
* @Date:   2018-12-11 13:58:25
* @Last Modified by:   Marte
<<<<<<< HEAD
* @Last Modified time: 2018-12-13 10:02:55
=======
* @Last Modified time: 2018-12-11 14:09:56
>>>>>>> a8128ab06d2387830549c012659c9ec679af35bd
*/

'use strict';
$(function(){
    $(".h_more").on('click', function(event) {
        if($(".h_more_div").hasClass('hide')){
            $(".h_more_div").removeClass('hide');
            $(".h_more_div").addClass('show');
        }else{
            $(".h_more_div").addClass('hide');
            $(".h_more_div").removeClass('show');
        }
    });

    $(".reply_news").on('click', function(event) {
        if($(".reply_div").hasClass('hide')){
            $(".reply_div").removeClass('hide');
            $(".reply_div").addClass('show');
        }else{
            $(".reply_div").addClass('hide');
            $(".reply_div").removeClass('show');
        }
    });
})