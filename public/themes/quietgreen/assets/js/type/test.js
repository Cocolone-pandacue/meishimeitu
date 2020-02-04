/*
* @Author: Marte
* @Date:   2018-07-27 10:45:44
* @Last Modified by:   Marte
* @Last Modified time: 2019-01-25 16:42:34
*/

'use strict';
$(function(){
    //姓名
    function isUsername(name){
        var reg=/^[\u4E00-\u9FA5]{1,6}$/;
        return reg.test(name);
    }

    function isBusinessname(name){
        var reg=/^[\u4E00-\u9FA5]{4,20}$/;
        return reg.test(name);
    }

    // 验证身份证
    function isCardNo(card) {
        var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
        return reg.test(card);
    }

    // 验证手机号
    function isPhoneNo(phone) {
        var reg = /^1[34578]\d{9}$/;
        return reg.test(phone);
    }

    //验证邮箱
    function isEmail(email){
        var reg=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
        return reg.test(email);
    }

    //验证自定义金额是否大于500
    function isEnoughMoney(number) {
        var reg = /^([5-9]\d{2,}|[1-9]\d{3,})(\.\d+)?$/;
        return reg.test(number);
    }


    //金额判断
    function Pjine(inputid,spanid){
        $(inputid).blur(function(){
            if(isEnoughMoney($.trim($(inputid).val()))==false){
                $(spanid).html("请输入最少500元的金额！");
            }
        });
        $(inputid).focus(function() {
            $(spanid).html("");
        });
    }
    Pjine('#pre_money', "#checkJine");


    // 验证输入的是否大于0的时间
    function isRealTime(number) {
        var reg = /^(?!(0[0-9]{0,}$))[0-9]{1,}[.]{0,}[0-9]{0,}$/;
        return reg.test(number);
    }

    //时间判断
    function Ptime(inputid,spanid){
        $(inputid).blur(function(){
            if(isRealTime($.trim($(inputid).val()))==false){
                $(spanid).html("请输入大于0的时间");
            }
        });
        $(inputid).focus(function() {
            $(spanid).html("");
        });
    }
    Ptime('#zdytime', "#checkTime");



    //姓名判断
    function Pname(inputid,spanid){
        $(inputid).blur(function(){
            if($.trim($(inputid).val()).length==0){
                $(spanid).html("请输入姓名！");
            }else{
                if(isUsername($.trim($(inputid).val()))==false){
                    $(spanid).html("姓名只能是1-6位的中文");
                }
            }
        })
        $(inputid).focus(function() {
            $(spanid).html("");
        });
    }
    Pname('#pname', "#checkPname");
    Pname('#nickname', "#checkNickname");
    Pname('#busername', "#checkBusername");

    //项目命名
    function projectName(inputid,spanid){
        $(inputid).blur(function(){
            if($.trim($(inputid).val()).length==0){
                $(spanid).html("请输入项目名称！");
            }else{
                if(isBusinessname($.trim($(inputid).val()))==false){
                    $(spanid).html("项目名称输入错误！请重新输入！");
                }
            }
        })
        $(inputid).focus(function() {
            $(spanid).html("");
        });
    }

    projectName("#proName","#checkProject");

    //项目描述
    function miaoshuName(textareaid,spanid){
        $(textareaid).blur(function(){
            if($(textareaid).val().length==0){
                $(spanid).html("请输入项目描述！");
        }
        $(textareaid).focus(function() {
            $(spanid).html("");
        })
        });
    }
    miaoshuName("#miaoshu","#checkMiaoshu");

    //企业名称判断
    function BusinessName(inputid,spanid){
        $(inputid).blur(function(){
            if($.trim($(inputid).val()).length==0){
                $(spanid).html("请输入企业名称！");
            }else{
                if(isBusinessname($.trim($(inputid).val()))==false){
                    $(spanid).html("企业名称输入错误！请重新输入！");
                }
            }
        })
        $(inputid).focus(function() {
            $(spanid).html("");
        });
    }
    BusinessName("#Bname","#checkBname");

    //身份证判断
    function userID(inputid, spanid) {
        $(inputid).blur(function() {
            if ($.trim($(inputid).val()).length == 0) {
                $(spanid).html(" 请输入身份证号码！");
            } else {
                if (isCardNo($.trim($(inputid).val())) == false) {
                    $(spanid).html("身份证号不正确！");
                }
            }
        });
        $(inputid).focus(function() {
            $(spanid).html("");
        });
    };
    userID("#p_card","#checkPcard");

    //手机号判断
    function userTel(inputid, spanid) {
        $(inputid).blur(function() {
            if ($.trim($(inputid).val()).length == 0) {
                $(spanid).html("请输入手机号码！");
            } else {
                if (isPhoneNo($.trim($(inputid).val())) == false) {
                    $(spanid).html("手机号码输入错误！请重新输入！");
                }
            }
            $(inputid).focus(function() {
                $(spanid).html("");
            });
        });
    };
    userTel("#pphone","#checkPphone");
    userTel("#bphone","#checkBphone");
    userTel("#Bphone","#checkBBphone");
    userTel("#phone","#checkphone");

    //邮箱判断
    function userEmail(inputid, spanid) {
        $(inputid).blur(function() {
            if ($.trim($(inputid).val()).length == 0) {
                $(spanid).html("请输入邮箱！");
            } else {
                if (isEmail($.trim($(inputid).val())) == false) {
                    $(spanid).html("邮箱输入错误！请重新输入！");
                }
            }
            $(inputid).focus(function() {
                $(spanid).html("");
            });
        });
    };
    userEmail("#p_email","#checkPemail");
    userEmail("#b_email","#checkBemail");
})