/*
* @Author: Marte
* @Date:   2018-12-14 11:29:58
* @Last Modified by:   Marte
* @Last Modified time: 2018-12-14 11:33:16
*/

'use strict';
$(function(){

    // $(".email_title a").on('click', function(event) {
    //     $(".email_title").addClass('hide');
    //     $(".phone_title").removeClass('hide');
    //     $("#email").addClass('hide');
    //     $("#phone").removeClass('hide');
    // });

    // $(".phone_title a").on('click', function(event) {
    //     $(".phone_title").addClass('hide');
    //     $(".email_title").removeClass('hide');
    //     $("#phone").addClass('hide');
    //     $("#email").removeClass('hide');
    // });


    // 美视美图条款弹框
    $(".agreement_click").on("click", function(){
        layer.open({
            type: 1,
            closeBtn: 1,
            btnAlign: 'c',
            skin: 'demo-class',
            title:'',
            shadeClose:true,
            fix: false,
            scrollbar: false,
            area: ['800px','700px'],
            content: $('.agreement_tip'),
            success: function (layero, index) {
                
            },
        });
    });

})