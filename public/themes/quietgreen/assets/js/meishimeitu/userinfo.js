/*
* @Author: Marte
* @Date:   2018-12-18 15:07:08
* @Last Modified by:   Marte
* @Last Modified time: 2018-12-18 16:35:46
*/

'use strict';

$(function(){
    getURL();
    function getURL(){
        var myfocus="/user/userfocus";
        var url=window.location.pathname;
        var mypublish="/user/acceptTasksList";
        var myaccept = "/user/myTasksList";
        var myworks="/user/goodsShop";
        var myshop="/user/shop";
        var mycoll="/user/myfocus";
        var myvip="/user/member";
        var myload="/user/download";
        var myDownloadBrainpower = "/user/DownloadBrainpower";
        var mymoney="/finance/list";
        var assetDetail = "/finance/assetDetail";
        var cash = "/finance/cash";
        var cashout = "/finance/cashout";
        var myinfo="/user/info";
        var up_works="/user/pubGoods";
        var up_edite="/user/goodsShopedit";
        var mymiddleman="/user/broker";
        if(url==myfocus){
            $(".myfocus").siblings('li').removeClass('sele_tip');
            $(".myfocus").addClass('sele_tip');
            $(".up_works").removeClass('gray_up_works');
        }else if(url==mypublish||url==myaccept){
            $(".mypro").siblings('li').removeClass('sele_tip');
            $(".mypro").addClass('sele_tip');
            $(".up_works").removeClass('gray_up_works');
        }else if(url==myworks){
            $(".myworks").siblings('li').removeClass('sele_tip');
            $(".myworks").addClass('sele_tip');
            $(".up_works").removeClass('gray_up_works');
        }else if(url==myshop){
            $(".myshop").siblings('li').removeClass('sele_tip');
            $(".myshop").addClass('sele_tip');
            $(".up_works").removeClass('gray_up_works');
        }else if(url==mycoll){
            $(".mycoll").siblings('li').removeClass('sele_tip');
            $(".mycoll").addClass('sele_tip');
            $(".up_works").removeClass('gray_up_works');
        }else if(url==myvip){
            $(".myvip").siblings('li').removeClass('sele_tip');
            $(".myvip").addClass('sele_tip');
            $(".up_works").removeClass('gray_up_works');
        }else if(url==myload||url==myDownloadBrainpower){
            $(".myload").siblings('li').removeClass('sele_tip');
            $(".myload").addClass('sele_tip');
            $(".up_works").removeClass('gray_up_works');
        }else if(url==mymoney||url==assetDetail||url==cash||url==cashout){
            $(".mymoney").siblings('li').removeClass('sele_tip');
            $(".mymoney").addClass('sele_tip');
            $(".up_works").removeClass('gray_up_works');
        }else if(url==myinfo){
            $(".myinfo").siblings('li').removeClass('sele_tip');
            $(".myinfo").addClass('sele_tip');
            $(".up_works").removeClass('gray_up_works');
        }else if(url==up_works||url==up_edite){
            $(".left_tips").children('li').removeClass('sele_tip');
            $(".up_works").addClass('gray_up_works');
        }else if(url==mymiddleman){
            $(".left_tips").children('li').removeClass('sele_tip');
            $(".mymiddleman").addClass('sele_tip');
            $(".mymiddleman").attr("href","javascript:return false");
        }
    }
})

