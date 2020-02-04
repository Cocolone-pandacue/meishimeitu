/*
* @Author: Marte
* @Date:   2018-10-18 14:35:18
* @Last Modified by:   Marte
* @Last Modified time: 2018-11-26 14:07:54
*/

'use strict';



// var arr = new Array();
// var nameArr=new Array();

// $(document).on('change',"input[type='file']",function(){

//     var uploadFile=$(this).val();
//     var fileName=getFileName(uploadFile);
//     var inputName= $(this).attr("name");

//     arr.push(uploadFile);

//     var addInput='<input type="file"  name="file_stylist[]" style="z-index: 999;">';
//     $(".click_upload_wrap").append(addInput);
//     $(this).css('z-index', '1');

$(function(){

//  点击基础信息表单验证

var demo=$("#form").Validform({
    tiptype:3,
    showAllError:true,
});

//  个人简介验证

intro("#jianjie","#checkJianjie");

//  项目名称验证

projectName("#projectOne","#checkProjectOne");
projectName("#projectTwo","#checkProjectTwo");
projectName("#projectThree","#checkProjectThree");


// 单选框点击样式
    $(".buju .demo--radio:checked").parent().addClass("label_click").siblings().removeClass("label_click");
    $(".buju_one .demo--radio:checked").parent().addClass("label_click").siblings().removeClass("label_click");
    $(".demo--label_one").click(function(){
        $(".demo--radio:checked").parent().addClass("label_click");
        $(".demo--radio:checked").parent().siblings().removeClass("label_click");
    });
    $(".demo--label_two").click(function(){
        $(".demo--radio:checked").parent().addClass("label_click");
        $(".demo--radio:checked").parent().siblings().removeClass("label_click")
    });



    // 从基础信息到提交方案到审核页面

    $(".nex").click(function(){
        if($('span').hasClass('cor-red')){
            layer.msg("请绑定手机号！");
            $('body,html').animate({scrollTop:240},100);
            return false;
        }else if ($.trim($("#jianjie").val()).length==0) {
            layer.msg("请输入个人简介！");
            return false;
        }
        $(".jichuxinxi").hide();
        $(".tijiaofangan").show();
        window.scrollTo(0,0);
    })

    $(".case_btn_box_shangyibu").click(function(){
        $(".tijiaofangan").hide();
        $(".jichuxinxi").show();
        window.scrollTo(0,0);
        $(".twodiv").css("width","0px");
        $(".two>span").css("background","#eee");
        $(".two>span").css("color","#424853");
    })

    $(".case_btn_box_tijiao").click(function(){
        if($.trim($("#projectOne").val()).length==0){
            layer.msg("请输入项目名称！");
            $('body,html').animate({scrollTop:100},100);
            return false;
        }
        else if
        (isBusinessname($.trim($("#projectOne").val()))==false){
            layer.msg("请输入4-20个中文字符");
            $('body,html').animate({scrollTop:100},100);
            return false;
        }
        else if
        ($("#yishangchuanliebiao_one").children().length==0){
            layer.msg("请上传文件");
            $('body,html').animate({scrollTop:100},100);
            return false;
        }
        else if
        ($.trim($("#projectTwo").val()).length==0){
            layer.msg("请输入项目名称！");
            $('body,html').animate({scrollTop:700},100);
            return false;
        }
        else if
        (isBusinessname($.trim($("#projectTwo").val()))==false){
            layer.msg("请输入4-20个中文字符");
            $('body,html').animate({scrollTop:700},100);
            return false;
        }
        else if
        ($("#yishangchuanliebiao_two").children().length==0){
            layer.msg("请上传文件");
            $('body,html').animate({scrollTop:700},100);
            return false;
        }
        else if
        ($.trim($("#projectThree").val()).length==0){
            layer.msg("请输入项目名称！");
            $('body,html').animate({scrollTop:1400},100);
            return false;
        }
        else if
        (isBusinessname($.trim($("#projectThree").val()))==false){
            layer.msg("请输入4-20个中文字符");
            $('body,html').animate({scrollTop:1400},100);
            return false;
        }
        else if
        ($("#yishangchuanliebiao_three").children().length==0){
            layer.msg("请上传文件");
            $('body,html').animate({scrollTop:1400},100);
            return false;
        }
    })

    //  设计师入驻页面翻页动画  进度条

  
    $(".onediv").animate({width:"100%"},1500);
    $(".nex,.sub_btn").click(function(){
        $(".twodiv").animate({width:"100%"},1500,xuHao);
    })
   


    // 设计师入驻模块中显示上传文件弹窗

    $(".up_btn").click(function(){
        $(".tanchuang").css("display","flex")
        $(".tanchuang_shangchuan").show();
        $(".tanchuang_shangchuan_two").hide();
        $(".tanchuang_shangchuan_three").hide();
        
    })
    $(".up_btn_two").click(function(){
        $(".tanchuang").css("display","flex")
        $(".tanchuang_shangchuan").hide();
        $(".tanchuang_shangchuan_two").show();
        $(".tanchuang_shangchuan_three").hide();
        
    })
    $(".up_btn_three").click(function(){
        $(".tanchuang").css("display","flex")
        $(".tanchuang_shangchuan").hide();
        $(".tanchuang_shangchuan_two").hide();
        $(".tanchuang_shangchuan_three").show();
     
    })

    $(".shejishiruzhu_tuichu").click(function(){
        var isLoading = !!$(this).siblings('.zhushi').find('.loading').length;
        if (isLoading) {
            layer.msg("请等待文件上传完成");
            return;
        }
        $(".tanchuang").css("display","none")
    })
    
    $(".queding").click(function () {
        var index = $(this).data('index');
        var zhushi = $(this).siblings('.zhushi');
        var isLoading = !!zhushi.find('.loading').length;
        if (isLoading) {
            layer.msg("请等待文件上传完成");
            return;
        }
        var files = zhushi.find('.wenjianname');
        var htmls = [];
        for (var i = 0; i < files.length; i++) {
            var fileName = $(files[i]).text();
            htmls.push("<div class='yishangchuanliebiao_liebiao_yishangchuan_" + index + "'>" + "<span class='successphoto'>" + "</span>" + "<span class='wenjianname'>" + fileName + "</span>" + "</div>")
        }

        $(".yishangchuanliebiao_" + index).html(htmls.join('')).parent().show();
        $(".tanchuang").css("display", "none");
    })

    //  点击遮罩层，关闭弹窗

    $(".tanchuang").on('click',function (e) {
        var zuobiao = $(e.target).closest('.tanchuang .tanchuang_shangchuan').length + $(e.target).closest('.tanchuang .tanchuang_shangchuan_two').length + $(e.target).closest('.tanchuang .tanchuang_shangchuan_three').length
        if(zuobiao > 0){        //  $(e.target) 鼠标点击的目标 ， .closest()从当前目标开始向上查找    
            return;
        }else{
            var isLoading = !!$(this).find('.loading').length;
            if (isLoading) {
                layer.msg("请等待文件上传完成");
                return;
            }
            //关闭弹框
            $(".tanchuang").hide()
        }
    });

    //设计师入驻模块中删除所选文件
    $(".zhushi").on("click", ".shanchuwenjian", function () {
        $(this).parent().remove();
        return false;
    });
});

function onFileChange(ele, index) {
    var files = $(ele)[0].files;
    var fileamount = files.length;
    var preamount = $("div#yishangchuanliebiao_" + index + ">div.yishangchuanliebiao_liebiao").length;
    if (preamount + fileamount > 10) {
        alert("最多传10个文件");
        return;
    }
    for (var i = 0; i < fileamount; i++) {
        if (files[i].size >= 5 * 1024 * 1024) {
            alert("单个文件不超过5M");
            return;
        }
    }

    for (var i = 0; i < fileamount; i++) {
        var file = files[i];
        var fragment = $("<div class='yishangchuanliebiao_liebiao'>" +
            "<span class='successphoto loading'></span>" +
            "<span class='wenjianname'>" + file.name + "</span>" +
            "<span class='shanchuwenjian'></span></div>");
            
        $("#yishangchuanliebiao_" + index).append(fragment);
        uploadFile(file, fragment, index)
    }
}

function uploadFile(file, target, index) {
    var hiddenFile = $('<input type="hidden" name="file' + index + '[]">')
    target.append(hiddenFile)

    uploadFileToOSS('attachment/user/', [file], (err, result) => {
        if (err || !result.length) {
            return;
        } else {
            hiddenFile.addClass('success');
            var ext = file.name.substring(file.name.lastIndexOf(".") + 1)
            var content = {
                name: file.name,
                size: file.size,
                url: result[0].name,
                type: ext
            }
            hiddenFile.val(JSON.stringify(content));
            target.find('.successphoto').removeClass('loading');
        }
    })
}

 //  设计师入驻页面翻页动画

 function xuHao(){
     $(".two>span").css("background","#647c85");
     $(".two>span").css("color","white");
 }

// 基础信息点击下一步验证

// $(".next").click(function() {
//   if($("input.material_input").val()==""){
//       alert("项目名称不能为空！");
//       $('body,html').animate({scrollTop:0},100);
//   }else if($("#miaoshu").val()==""){
//         alert("请输入项目描述！");
//         $('body,html').animate({scrollTop:240},100);
//   }else if($("#industry option:selected").val()=="请选择行业"){
//         alert("请选择行业！");
//         $("#industry").css('color', 'red');
//         $('body,html').animate({scrollTop:700},100);
//   }else if(!$(".select_color li").hasClass("yep_li")){
//         alert("请选择色调！");
//         $(".select_color ").css('border-color', 'red');
//         $('body,html').animate({scrollTop:1440},100);
//   }else if($("#phone").val()==""){
//         alert("请输入手机号码！");
//   }else if(isPhoneNo($.trim($("#phone").val())) == false){
//         alert("手机号码输入错误！请重新输入！");
//   }else{
//       createTask()
//     }
//   }
// );

//   用户名验证
function isUsername(name){
    var reg=/^[\u4E00-\u9FA5]{1,6}$/;
    return reg.test(name);
}

// 项目名称验证

function isBusinessname(name){
    var reg=/^[\u4E00-\u9FA5]{4,20}$/;
    return reg.test(name);
}

//  个人简介验证
function intro(textareaid,spanid){
    $(textareaid).blur(function(){
        if($.trim($(textareaid).val()).length==0){
            $(spanid).html("请输入个人简介！");
            return false;
    }
    $(textareaid).focus(function() {
        $(spanid).html("");
    })
    });
}

//项目命名
function projectName(inputid,spanid){
    $(inputid).blur(function(){
        if($.trim($(inputid).val()).length==0){
            $(spanid).html("请输入项目名称！");
        }else if
        (isBusinessname($.trim($(inputid).val()))==false){
            $(spanid).html("请输入4-20个中文字符");
        }
})
    $(inputid).focus(function() {
        $(spanid).html("");
    });
}