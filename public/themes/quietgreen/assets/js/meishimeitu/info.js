/*
* @Author: Marte
* @Date:   2018-12-13 13:10:31
* @Last Modified by:   Marte
* @Last Modified time: 2018-12-25 19:47:56
*/

'use strict';

$(function(){
    $(".mymessage").removeClass('hide');
    $(".tzzl").addClass('hide');
    $(".security").addClass('hide');
    $(".info_head span").on('click', function(event) {
        $(this).addClass('sele_info_head');
        $(this).siblings().removeClass('sele_info_head');
        if($(".main_info").hasClass('sele_info_head')){
            $(".mymessage").removeClass('hide');
            $(".tzzl").addClass('hide');
            $(".security").addClass('hide');
        }

        if($(".set_up").hasClass('sele_info_head')){
            $(".tzzl").removeClass('hide');
            $(".mymessage").addClass('hide');
            $(".security").addClass('hide');
        }

        if($(".account_security").hasClass('sele_info_head')){
            $(".security").removeClass('hide');
            $(".mymessage").addClass('hide');
            $(".tzzl").addClass('hide');
        }
    });

// $(".revise_lo").on('click',  function(event) {
//     $(".revise_lo_wrap").removeClass('hide');
//     $(".accu_main").addClass('hide');
//     $(".info_head").addClass('hide');
//     $(".accu_head").removeClass('hide');
// });


// $(".revise_pay").on('click',  function(event) {
//     $(".revise_pay_wrap").removeClass('hide');
//     $(".accu_main").addClass('hide');
//     $(".info_head").addClass('hide');
//     $(".accu_head").removeClass('hide');
// });


// $(".go_auth").on('click',  function(event) {
//     $(".auth_wrap").removeClass('hide');
//     $(".accu_main").addClass('hide');
//     $(".info_head").addClass('hide');
//     $(".accu_head").removeClass('hide');
// });



$(".go_back_lo").on('click',  function(event) {
    $(".accu_main").removeClass('hide');
    $(".revise_lo_wrap").addClass('hide');
    $(".info_head").removeClass('hide');
    $(".accu_head").addClass('hide');
});

$(".go_back_pay").on('click',  function(event) {
    $(".accu_main").removeClass('hide');
    $(".revise_pay_wrap").addClass('hide');
    $(".info_head").removeClass('hide');
    $(".accu_head").addClass('hide');
});

$(".go_back_auth").on('click',  function(event) {
    $(".accu_main").removeClass('hide');
    $(".auth_wrap").addClass('hide');
    $(".info_head").removeClass('hide');
    $(".accu_head").addClass('hide');
});




$('#zheng').on('change', function() {
    var filePath = $(this).val(),
    fileFormat = filePath.substring(filePath.lastIndexOf(".")).toLowerCase(),
    src = window.URL.createObjectURL(this.files[0]);
    if(!fileFormat.match(/.png|.jpg|.jpeg/)) {
        error_prompt_alert('上传错误,文件格式必须为：png/jpg/jpeg');
    return;
    }else{
        $('#cropedBigImg').css('display','block');
        $('#cropedBigImg').attr('src', src);
    }
});


$(".see_paw").on('click', function(event) {
    if($(this).hasClass('no_see')){
        $(this).removeClass("no_see");
        $(this).addClass('see');
        $(this).siblings('input').attr('type','text');
    }else{
        $(this).addClass("no_see");
        $(this).removeClass('see');
        $(this).siblings('input').attr('type','password');
    }
});

//  进入页面时判断已选择标签的个数
if($(".bqxzbox .bqlbbox").length>0){
    $(".bqxzbox").show();
}else{
    $(".bqxzbox").hide();
}

  // 点击添加标签
$(".bqlb .bqlbbox").click(function(){
    var yixuanze = $(this).attr("yixuan");
    if(yixuanze!="ok"){
        var yxbqnum = $(".bqxzbox>.bqlbbox").length;
        if(yxbqnum<3){
            $(this).attr("yixuan","ok");
            $(this).clone().appendTo(".bqxzbox");
            $(".bqxzbox>.bqlbbox").append("<img src='/themes/quietgreen/assets/images/type/关闭icon.png' alt='' class=''/>");
            $(".bqxzbox>.bqlbbox").children(".zpbq").attr("name","tags[]");
            $(this).addClass("bqlb_click");
            $(".bqxzbox").show();
        }else{
            $(".bqbox_warning").show();
            setTimeout("$('.bqbox_warning').hide()",2000); 
        }
    }
    else{
        return false
    }
})
    
    // 点击删除已选标签
$(".bqxzbox").on("click",".bqlbbox>img",function(){ 
    let yxid = $(this).siblings("input").attr("value");
    $(":input[value="+yxid+"]").parent().removeClass("bqlb_click");
    $(":input[value="+yxid+"]").parent().attr("yixuan","no");
    $(this).parent().remove(); 
    if($(".bqxzbox .bqlbbox").length==0){
        console.log(1);
        $(".bqxzbox").hide();
    };
});
    
// 获取当前文本实际宽度
        var textWidth = function(text){ 
            var sensor = $('<pre>'+ text +'</pre>').css({display: 'none'}); 
            $('body').append(sensor); 
            var width = sensor.width();
            sensor.remove(); 
            return width;
        };

// 遍历input，更改每个input的宽度
        var array = $(".bqname");
        array.each(function () {
            var changewidth = textWidth($(this).html())+30;
            $(this).parent().width(changewidth+"px");
        })

// 单选框的样式

$(".dpxzxz .dpxzxz_radio:checked").parent().addClass("dpxzxz_click").siblings().removeClass("dpxzxz_click");
$(".dpxzxz").click(function(){
    $(".dpxzxz_radio:checked").parent().addClass("dpxzxz_click");
    $(".dpxzxz_radio:checked").parent().siblings().removeClass("dpxzxz_click");
});       

})

$("form").submit(function () {
    var objUrl=$(".face_img").css("backgroundImage").replace('url(\"','').replace('\")','');
    console.log(objUrl);
    if($(".work_name").val()==""){
        alert("请输入作品名称！");
        return false;
    }else if($("#firstCate option:selected").val()=="请选择作品类型"||$("#firstCate option:selected").val()==""){
        alert("请选择作品类型！");
        return false;
    }else if(objUrl == "undefined"||objUrl == ""||objUrl == "none"){
        alert("请上传封面！");
        return false;
    }else{
        return true;
    }
})