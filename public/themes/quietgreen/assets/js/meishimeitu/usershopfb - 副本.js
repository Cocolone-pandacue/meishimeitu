/*
* @Author: Marte
* @Date:   2018-12-17 15:18:47
* @Last Modified by:   Marte
* @Last Modified time: 2018-12-26 17:44:53
*/

'use strict';

$(function(){
    $("#shang").on('change',function(){
        for(var i=0;i<this.files.length;i++){
            var objUrl=getObjectURL(this.files[i]);
            //$(this).removeAttr("id");
            if(objUrl){
                var str='';
                str+='<div class="imgbox" ><span class="closebtn">×</span><img class="img" src= "'+objUrl+'" /> </div>';
                $("#dd").append(str);
                $(".closebtn").on("click", function(){
                    var index = $(this).index();
                    $(this).parent().remove();
                });
            }
        }
        repeat();
    });

    function repeat(){
        //获取图片地址
        var imgs=$(".imgbox img");
        var imgarr = new Array(imgs.length);　
        for(var i=0;i< imgs.length;i++){
            imgarr[i]=imgs[i].src;
        }
        console.log(imgarr);
    }

    function getObjectURL(file){
        var url=null;
        if(window.createObjectURL!=undefined){
            url=window.createObjectURL(file);
        }else if(window.URL!=undefined){
            url=window.URL.createObjectURL(file);
        }else if(window.webkitURL!=undefined){
            url=window.webkitURL.createObjectURL(file);
        }
        return url;
    }

    /*弹出封面上传*/
    $(".cover_box,.cxsc").on('click',  function(event) {
        $(".cover_wrap").removeClass('hide');
        var classify=$("#firstCate  option:selected").text();
        var classify_child=$("#secondCate  option:selected").text();
        //console.log(classify);
        //console.log(classify_child);
        if($("#firstCate option:selected").val()=="请选择作品类型"||$("#firstCate option:selected").val()==""){
            $(".classify").html("分类");
        }else{
            $(".classify").html(classify);
        }

        if($("#secondCate option:selected").val()=="-作品子类-"||$("#secondCate option:selected").val()==""){
            $(".classify_child").html("子分类");
        }else{
            $(".classify_child").html(classify_child);
        }
    });

    $(".close_div").on('click', function(event) {
        $(this).parent().parent().addClass('hide');
        $(".show_img_word").removeClass("hide");
        var objUrl=$(".face_img").css("backgroundImage").replace('url(\"','').replace('\")','');
        $(".cover_img").attr("src", objUrl);
        var src=$('.cover_img').attr('src');
        //console.log(objUrl);
        if (src=="none"){
            $(".cover_img").css('opacity', '0');
            $(".show_img_word").addClass("hide");
        }else{
            $(".cover_img").css('opacity', '1');
        }
        if (typeof(objUrl) == "undefined"||typeof(objUrl) == ""||typeof(objUrl) == "none") {
            $(".cwcr_img img").removeClass("cwcr_img_auto");
            $(".cwcr_img img").attr("src", "/themes/quietgreen/assets/images/meishimeitu/personal/s_robot.png");
            $(".cover_img").css('opacity', '0');
            $(".show_img_word").addClass("hide");
            $(".cover_img_wrap").css('z-index', '1');
        }else{
            $(".cwcr_img img").attr("src", objUrl);
            $(".cwcr_img img").addClass("cwcr_img_auto");
        }
    });

    $(".cover_cancel").on('click', function(event) {
        $(this).parent().parent().addClass('hide');
        $(".show_img_word").removeClass("hide");
        var objUrl=$(".face_img").css("backgroundImage").replace('url(\"','').replace('\")','');
        $(".cover_img").attr("src", objUrl);
        var src=$('.cover_img').attr('src');
        //console.log(objUrl);
        if (src==""){
            $(".cover_img").css('opacity', '0');
            $(".show_img_word").addClass("hide");
        }else{
            $(".cover_img").css('opacity', '1');
        }
        if (typeof(objUrl) == "undefined"||typeof(objUrl) == ""||typeof(objUrl) == "none") {
            $(".cwcr_img img").removeClass("cwcr_img_auto");
            $(".cwcr_img img").attr("src", "/themes/quietgreen/assets/images/meishimeitu/personal/s_robot.png");
            $(".cover_img").css('opacity', '0');
            $(".show_img_word").addClass("hide");
            $(".cover_img_wrap").css('z-index', '1');
        }else{
            $(".cwcr_img img").attr("src", objUrl);
            $(".cwcr_img img").addClass("cwcr_img_auto");
        }
    });


    $("#cover").on('change',function(){
        for(var i=0;i<this.files.length;i++){
            var objUrl=getObjectURL(this.files[i]);
            if(objUrl){
                $(".cover_img").attr("src", objUrl);
                $(".cover_img").css('opacity', '1');
                $(".cover_img_wrap").css('z-index', '3');
                $(".cwcr_img img").attr('src', objUrl);
                $(".cwcr_img img").addClass("cwcr_img_auto");
            }
        }
        repeatImg();
        $(".show_img_word").removeClass('hide');
    });

    function repeatImg(){
        //获取图片地址
        var imgs=$(".cover_img_wrap img");
        var imgarr = new Array(imgs.length);　
        for(var i=0;i< imgs.length;i++){
            imgarr[i]=imgs[i].src;
        }
        //console.log(imgarr);
    }

    $(".again_upload").on('click', function(event) {
        $(".cover_img").attr("src", "");
        $(".cover_img_wrap").css('z-index', '1');
        $(".show_img_word").addClass('hide');
        $(".cwcr_img img").removeClass("cwcr_img_auto");
        $(".cwcr_img img").attr("src", "/themes/quietgreen/assets/images/meishimeitu/personal/s_robot.png");
        $(".cover_img").css('opacity', '0');
    });

    $(".cover_sure").on('click', function(event) {
        var objUrl=$('.cover_img').attr('src');
        console.log(objUrl);
        if (objUrl=="")
        {
            $('.null_new').show().delay(2000).hide(0);
        }else{
            $(".face_img").css("background-image","url(" + objUrl + ")");
            $(".face_img").css('background-size', '100% 100%');
            $(".cover_wrap").addClass('hide');
        }
    });

    $(".work_name").blur(function(event) {
        if($(this).val()==""){
            alert("请输入作品名称！")
        }
        var cwcr_synopsis_title=$(".work_name").val();
        console.log(cwcr_synopsis_title);
        $(".cwcr_synopsis_title").html(cwcr_synopsis_title);
    });


    $("#firstCate").change(function() {
        var classify=$("#firstCate  option:selected").text();
        console.log(classify);
        $(".classify").html(classify);
        var classify_child=$("#secondCate  option:selected").text();
        console.log(classify_child);
        $(".classify_child").html(classify_child);
    });

    $("#secondCate").change(function() {
        var classify_child=$("#secondCate  option:selected").text();
        console.log(classify_child);
        $(".classify_child").html(classify_child);
    });



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

    $(".zscs .zscs_radio:checked").parent().addClass("zscs_click").siblings().removeClass("zscs_click");
    $(".zscs").click(function(){
        $(".zscs_radio:checked").parent().addClass("zscs_click");
        $(".zscs_radio:checked").parent().siblings().removeClass("zscs_click");
    });

    $(".bqxzbox").children(".bqlbbox").children(".zpbq").attr("value");



})
