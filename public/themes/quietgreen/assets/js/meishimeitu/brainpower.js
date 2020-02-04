/*
* @Author: Marte
* @Date:   2018-12-21 10:04:30
* @Last Modified by:   Marte
* @Last Modified time: 2019-02-15 16:29:48
*/

'use strict';
$(function(){
    //禁用Enter键表单自动提交
    document.onkeydown = function(event) {
        var target, code, tag;
        if (!event) {
            event = window.event; //针对ie浏览器
            target = event.srcElement;
            code = event.keyCode;
            if (code == 13) {
                tag = target.tagName;
                if (tag == "TEXTAREA") { return true; }
                else { return false; }
            }
        }
        else {
            target = event.target; //针对遵循w3c标准的浏览器，如Firefox
            code = event.keyCode;
            if (code == 13) {
                tag = target.tagName;
                if (tag == "INPUT") { return false; }
                else { return true; }
            }
        }
    };

    /*弹跳*/
    $(".logo_box li").on('click',function(event) {
        $(this).children('span.check').toggleClass('check_bg');

        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },700);

        if($(this).children(".check").hasClass('check_bg')){
            $(this).addClass('sele_li');
            $(this).children('.logo_img').addClass('hide');
            $(this).children('.logo_img_sele').removeClass('hide');
            $(this).children("input").attr("name","logo[]");
        }else{
            $(this).children('.logo_img').removeClass('hide');
            $(this).children('.logo_img_sele').addClass('hide');
            $(this).removeClass('sele_li');
            $(this).children("input").removeAttr("name","logo[]");
        }

        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
        console.log(spannum);
        if(spannum>=5){
           $(this).parent().siblings('.btn_a_box').children(".btn_a_p").children(".next_step").addClass("mu_next");
           $(this).parent().siblings('.btn_a_box').children(".btn_a_p").children(".next_step").addClass("waves");
           $(this).parent().siblings('.btn_a_box').children(".btn_a_p").children(".next_step").addClass("border_btn");
        }else{
            $(this).parent().siblings('.btn_a_box').children(".btn_a_p").children(".next_step").removeClass("mu_next");
            $(this).parent().siblings('.btn_a_box').children(".btn_a_p").children(".next_step").removeClass("waves");
            $(this).parent().siblings('.btn_a_box').children(".btn_a_p").children(".next_step").removeClass("border_btn");
        }

    });

    $(".logo_box li").hover(function() {
        $(this).children('.logo_img').addClass('hide');
        $(this).children('.logo_img_sele').removeClass('hide');
        $(this).css('border-color', '#e2823a');
    }, function() {
        $(this).css('border-color', '#cacaca');
        var spannum=$(".check_bg").length;
        if($(this).children(".check").hasClass('check_bg')){
            $(this).children('.logo_img').addClass('hide');
            $(this).children('.logo_img_sele').removeClass('hide');
        }else{
            $(this).children('.logo_img').removeClass('hide');
            $(this).children('.logo_img_sele').addClass('hide');
        }
    });

    $(".color_sele_wrap li").on('click',function(event) {
        $(this).children('span.check_color').toggleClass('check_bg_c');
        $(this).children('img').toggleClass('sele_border');
        if($(this).children('span.check_color').hasClass('check_bg_c')){
            $(this).children('input').attr("name","color[]");
        }else{
            $(this).children('input').removeAttr("name","color[]");
        }
    });

     $(".color_sele_wrap li").hover(function() {
        $(this).children(".colorImg_hovr").animate({opacity: 1}, 500);
        $(this).addClass("img_shadow");
        $(this).children(".float_word").animate({bottom: 10}, 500);
    }, function() {
        $(this).children(".colorImg_hovr").animate({opacity: 0}, 500);
        $(this).removeClass("img_shadow");
        $(this).children(".float_word").animate({bottom: -30}, 500);
    });




    /*填入品牌名称 下一步*/
    $(".ai_oneNext").on('click', function(event) {
        var Pname=$(".pname").val();
        var len=0;
        var regC=/^[\u4e00-\u9fa5]|[a-zA-Z]$/g;
        if(regC.test(Pname)){
            //layer.msg("通过");
            for(var i=0;i<=Pname.length;i++){
                var a=Pname.charAt(i);
                if(a.match(/[^\x00-\xff]/ig)!=null){
                    len+=2;
                }else{
                    len+=1;
                }
            }

            if(len>20){
                console.log(len);
                layer.msg("标題不超过10个汉字，20个字符");
            }else{
                console.log("111");
                $(".ai_two_step").removeClass("hide");
                $(".ai_one_step").addClass('hide');
            }
        }else if(Pname==""){
            layer.msg("品牌名称不能為空！");
        }

    });

    /*验证*/
    $(".pname").blur(function(event) {
        var Pname=$(".pname").val();
        var len=0;
        var regC=/^[\u4e00-\u9fa5]|[a-zA-Z]$/g;
        if(regC.test(Pname)){
            //layer.msg("通过");
            for(var i=0;i<=Pname.length;i++){
                var a=Pname.charAt(i);
                if(a.match(/[^\x00-\xff]/ig)!=null){
                    len+=2;
                }else{
                    len+=1;
                }
            }

            if(len>20){
                console.log(len);
                layer.msg("标題不超过10个汉字，20个字符");
            }else{
                console.log("111");
            }
        }else if(Pname==""){
            layer.msg("不能為空！");
        }
    });

    $(".ptip").blur(function(event) {
        var Ptip=$(".ptip").val();
        var len=0;
        var regC=/^[\u4e00-\u9fa5]|[A-Za-z_]{0,28}$/g;
        if(regC.test(Ptip)){
            //layer.msg("通过");
            for(var i=0;i<=Ptip.length;i++){
                var a=Ptip.charAt(i);
                if(a.match(/[^\x00-\xff]/ig)!=null){
                    len+=2;
                }else{
                    len+=1;
                }
            }

            if(len>28){
                console.log(len);
                layer.msg("标題不超过14个汉字，28个字符");
            }else{
                console.log("222");
            }
        }else if(Ptip==""){
            console.log("000");
        }
    });


    /*行业*/
    $(".industry_box  li").hover(function() {
        $(this).children().children('.industry_img').addClass('hide');
        $(this).children().children('.industry_img_hover').removeClass('hide');
        $(this).css('border-color', '#e2823a');
        $(this).children().children('.industry_word').css('color', '#e2823a');
    }, function() {
        $(this).css('border-color', '#cacaca');
        $(this).children().children('.industry_word').css('color', '#cacaca');
        $(this).children().children('.industry_img').removeClass('hide');
        $(this).children().children('.industry_img_hover').addClass('hide');
    });

    /*选择行业*/
    /*互联网*/
    $(".internet_head1").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".internet_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".internet_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".internet_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".internet_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".internet_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".internet_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".internet_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*电子商务*/
    $(".internet_head2").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".E_commerce_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".E_commerce_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".E_commerce_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".E_commerce_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".E_commerce_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".E_commerce_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".E_commerce_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*餐饮*/
    $(".internet_head3").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".restaurant_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".restaurant_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".restaurant_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".restaurant_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".restaurant_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".restaurant_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".restaurant_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*服饰*/
    $(".internet_head4").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".dress_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".dress_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".dress_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".dress_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".dress_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".dress_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".dress_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*金融*/
    $(".internet_head5").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".finance_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".finance_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".finance_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".finance_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".finance_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".finance_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".finance_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*电子*/
    $(".internet_head6").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".Mechanics_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".Mechanics_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".Mechanics_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".Mechanics_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".Mechanics_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".Mechanics_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".Mechanics_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*房地产*/
    $(".internet_head7").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".realty_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".realty_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".realty_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".realty_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".realty_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".realty_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".realty_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*医药*/
    $(".medicine_head8").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".medicine_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".medicine_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".medicine_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".medicine_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".medicine_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".medicine_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".medicine_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*教育培训*/
    $(".internet_head9").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".education_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".education_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".education_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".education_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".education_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".education_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".education_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*政府*/
    $(".internet_head10").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".government_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".government_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".government_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".government_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".government_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".government_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".government_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*文化*/
    $(".internet_head11").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".culture_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".culture_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".culture_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".culture_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".culture_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".culture_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".culture_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });

    /*其他*/
    $(".internet_head12").on('click', function(event) {
        $(this).addClass('add_transform');
        var _this=this;
        setTimeout(function(){
            $(_this).removeClass('add_transform');
        },400);
        $(".other_box").removeClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".other_box").siblings('.artificial_intelligence_box').addClass('hide');
        $(this).children('a').children('input').attr("name","industry");
        $(this).siblings().children('a').children('input').removeAttr("name","industry");
        $(this).parent().parent().siblings('.artificial_intelligence_box').removeClass("seldiv");

        $(this).parent().parent().siblings(".other_box").siblings('.artificial_intelligence_box').children().children().children('li').removeClass("sele_li");
        $(this).parent().parent().siblings(".other_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img').removeClass("hide");
        $(this).parent().parent().siblings(".other_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.logo_img_sele').addClass("hide");
        $(this).parent().parent().siblings(".other_box").siblings('.artificial_intelligence_box').children().children().children('li').children('.check').removeClass("check_bg");
        $(this).parent().parent().siblings(".other_box").siblings('.artificial_intelligence_box').children().children().children('li').children('input').removeAttr("name","logo[]");

        $(".color_sele_wrap").children('li').children('img').removeClass("sele_border");
        $(".color_sele_wrap").children('li').children('.check_color').removeClass("check_bg_c");
        $(".color_sele_wrap").children('li').children('input').removeAttr("name","color[]");
        var spannum=$(".check_bg").length;
        $(".spannum").text(spannum);
    });


    /*模块上一步*/
    $(".previous_step").on('click', function(event) {
        $(".ai_two_step").siblings('.artificial_intelligence_box').addClass('hide');
        $(".ai_two_step").removeClass('hide');
        $(".ai_color_sele").addClass('hide');
    });

    /*模块下一步*/
    $(".next_step").on('click', function(event) {
        var spannum=$(".check_bg").length;
        if($(".next_step").hasClass('mu_next')&&spannum>=5){
            $(".ai_color_sele").siblings('.artificial_intelligence_box').addClass('hide');
            $(".ai_two_step").addClass('hide');
            $(".ai_color_sele").removeClass('hide');
            $(this).parent().parent().parent().parent(".artificial_intelligence_box ").addClass("seldiv");
        }else{
            $(".seldiv").removeClass("hide");
            $(".ai_two_step").addClass('hide');
            $(".ai_color_sele").addClass('hide');
        }
    });


    /*颜色上一步*/
    $(".color_previous_step").on('click',function(event) {
        $(".ai_color_sele").addClass("hide");
        $(".ai_two_step").addClass('hide');
        $(".seldiv").removeClass("hide");
    });

    /*验证*/





})