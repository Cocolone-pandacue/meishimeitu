/*
* @Author: Marte
* @Date:   2018-12-18 09:48:59
* @Last Modified by:   Marte
* @Last Modified time: 2018-12-24 17:25:49
*/

'use strict';

$(function(){
    $(".works_delete").on('click', function(event) {
        $(this).parent().siblings('div .del_wrap').removeClass('hide');
    });

    $(".del_close").on('click',  function(event) {
        $(this).parent().parent('.del_wrap').addClass('hide');
    });

    $(".del_sure").on('click',  function(event) {
        $(this).parent().parent().remove();
    });

    $(".del_back").on('click',  function(event) {
        $(this).parent().parent('.del_wrap').addClass('hide');
    });

    

    // 弹幕居中
    $(".mywork_photo_littlebox_zuidibu_sc").click(function(){
        var top = ($(window).height() - $(".mywork_photo_littlebox_zuidibu_sc").height())/2;   
        var left = ($(window).width() - $(".mywork_photo_littlebox_zuidibu_sc").width())/2;   
        var scrollTop = $(document).scrollTop();   
        var scrollLeft = $(document).scrollLeft(); 
        var addtop =  top + scrollTop;
        var addleft = left + scrollLeft;
        $(".zp_qx").css( { 'position' : "absolute", 'top' : ""+addtop+"px", 'left': ""+addleft+"px" } );  
    })

    //  点击删除作品弹框


    $(".mywork_photo_littlebox_zuidibu_sc").on("click", function(){
        var url = $(this).attr("url");
        var zpid = $(this).attr("zpid");
        // console.log(url);
        layer.open({
            type: 1,
            closeBtn: 1,
            btnAlign: 'c',
            title:'',
            shadeClose:true,
            skin: 'demo-class',
            fix: false,
            scrollbar: false,
            area: ['570px', '300px'],
            btn: ['确定', '取消'],
            content: '是否删除该作品？',
            yes: function (layero, index) {
                window.location.href = url;
                layer.msg("删除作品成功！")
            },
            btn2: function(index, layero){
            },
            cancel: function (index) {
            },
        });
    });


})

