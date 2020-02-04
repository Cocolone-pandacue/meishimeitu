/*
* @Author: Marte
* @Date:   2019-01-28 17:25:30
* @Last Modified by:   Marte
* @Last Modified time: 2019-02-19 17:02:00
*/

'use strict';
$(function(){
    $('.box1').slide({
        range: true,
        ratio: '1000',
        value: [0, 1000],
        clickBack: function(res){
            console.log(res)
            $(".leftnum").html(res[0]);
            $(".rightnum").html(res[1]);
        }
    })
})