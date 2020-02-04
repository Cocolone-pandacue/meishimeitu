/*
* @Author: Marte
* @Date:   2019-01-25 17:47:22
* @Last Modified by:   Marte
* @Last Modified time: 2019-01-25 18:04:44
*/

'use strict';
$(function(){
    jiTime();
    $(".onediv").css('width', '100%');
    $(".twodiv").css('width', '100%');
    $(".two>span").css("background-color","#647c85");
    $(".two>span").css("color","#fff");
    $(".threediv").css('width', '100%');
    $(".three>span").css("background-color","#647c85");
    $(".three>span").css("color","#fff");
    $(".four ").css('width', '100%');
    $(".four>span").css("background-color","#647c85");
    $(".four>span").css("color","#fff");
})

/*倒计时跳转页面*/
    var t = 10;
    function jiTime(){
        document.getElementById('time').innerHTML= t;
        t -= 1;
        if(t==0){
            location.href='http://www.meishimeitu.com';
        }else if(t<0){
            t=10;
        }
        setTimeout("jiTime()",1000);
    }
