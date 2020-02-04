/*
 * @Author: Marte
 * @Date:   2018-12-17 15:18:47
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-12-26 17:44:53
 */

'use strict';

$(function () {
    //上传作品中删除所选文件
    $("#dd").on("click", ".closebtn", function () {
        $(this).parent().remove();
        return false; //  防止冒泡
    });

    //上传作品中删除所选封面
    $(".cover_img_wrap").on("click", ".closebtn_", function () {
        $("#cover").css('z-index', '2');
        $(this).parent().remove();
        $(".cwcr_img img").attr("src", "");
        $(".cover_img_wrap").css('z-index', '1');
        return false; //  防止冒泡
    });

    $(document).on('change', ".shang", function () {
        var uploadingNum = $(".shang")[0].files.length;
        var uploadNum = $(".imgbox").length;
        var addNUM = uploadingNum + uploadNum ;
        if (addNUM>10) {
            layer.msg("最多上传10张照片！");
            return;
        }else{
            var files = $(".shang")[0].files;
            for (var i = 0; i < this.files.length; i++) {
                var file = files[i];
                var objUrl = getObjectURL(this.files[i]);
                //$(this).removeAttr("id");
                if (objUrl) {
                    var str = $('<div class="imgbox">' +
                        '<span class="closebtn"></span>' +
                        '<img class="img" src= "' + objUrl + '"/>' +
                        '<span class="successphoto loading"></span>' +
                        '</div>');
                    $("#dd").append(str);
                    uploadFile(file, str);
                }
            }
            repeat(); //   防止上传相同照片
        }
    });




    /*弹出封面上传*/
    $(".cover_box,.cxsc").on('click', function (event) {
        $(".cover_wrap").removeClass('hide');
        var classify = $("#firstCate  option:selected").text();
        var classify_child = $("#secondCate  option:selected").text();
        //console.log(classify);
        //console.log(classify_child);
        if ($("#firstCate option:selected").val() == "请选择作品类型" || $("#firstCate option:selected").val() == "") {
            $(".classify").html("分类");
        } else {
            $(".classify").html(classify);
        }

        if ($("#secondCate option:selected").val() == "-作品子类-" || $("#secondCate option:selected").val() == "") {
            $(".classify_child").html("子分类");
        } else {
            $(".classify_child").html(classify_child);
        }
    });

    // $(".close_div").on('click', function(event) {
    //     $(this).parent().parent().addClass('hide');
    //     $(".show_img_word").removeClass("hide");
    //     var objUrl=$(".face_img").css("backgroundImage").replace('url(\"','').replace('\")','');
    //     $(".cover_img").attr("src", objUrl);
    //     var src=$('.cover_img').attr('src');
    //     //console.log(objUrl);
    //     if (src=="none"){
    //         $(".cover_img").css('opacity', '0');
    //         $(".show_img_word").addClass("hide");
    //     }else{
    //         $(".cover_img").css('opacity', '1');
    //     }
    //     if (typeof(objUrl) == "undefined"||typeof(objUrl) == ""||typeof(objUrl) == "none") {
    //         $(".cwcr_img img").removeClass("cwcr_img_auto");
    //         $(".cwcr_img img").attr("src", "/themes/quietgreen/assets/images/meishimeitu/personal/s_robot.png");
    //         $(".cover_img").css('opacity', '0');
    //         $(".show_img_word").addClass("hide");
    //         $(".cover_img_wrap").css('z-index', '1');
    //     }else{
    //         $(".cwcr_img img").attr("src", objUrl);
    //         $(".cwcr_img img").addClass("cwcr_img_auto");
    //     }
    // });

    // $(".cover_cancel").on('click', function(event) {
    //     $(this).parent().parent().addClass('hide');
    //     $(".show_img_word").removeClass("hide");
    //     var objUrl=$(".face_img").css("backgroundImage").replace('url(\"','').replace('\")','');
    //     $(".cover_img").attr("src", objUrl);
    //     var src=$('.cover_img').attr('src');
    //     //console.log(objUrl);
    //     if (src=="none"){
    //         $(".cover_img").css('opacity', '0');
    //         $(".show_img_word").addClass("hide");
    //     }else{
    //         $(".cover_img").css('opacity', '1');
    //     }
    //     if (typeof(objUrl) == "undefined"||typeof(objUrl) == ""||typeof(objUrl) == "none") {
    //         $(".cwcr_img img").removeClass("cwcr_img_auto");
    //         $(".cwcr_img img").attr("src", "/themes/quietgreen/assets/images/meishimeitu/personal/s_robot.png");
    //         $(".cover_img").css('opacity', '0');
    //         $(".show_img_word").addClass("hide");
    //         $(".cover_img_wrap").css('z-index', '1');
    //     }else{
    //         $(".cwcr_img img").attr("src", objUrl);
    //         $(".cwcr_img img").addClass("cwcr_img_auto");
    //     }
    // });


    $("#cover").on('change', function () {
        var files = $("#cover")[0].files;
        for (var i = 0; i < this.files.length; i++) {
            var file = files[i];
            var objUrl = getObjectURL(this.files[i]);
            if (objUrl) {
                $(".cover_img").attr("src", objUrl);
                $(".cover_img").css('opacity', '1');
                $(".cover_img_wrap").css('z-index', '3');
                $(".cwcr_img img").attr('src', objUrl);
                $(".cwcr_img img").addClass("cwcr_img_auto");
                var str = $('<div class="imgbox_">' +
                    '<span class="closebtn_"></span>' +
                    '<img class="cover_img" src= "' + objUrl + '"/>' +
                    '<span class="successphoto loading"></span>' +
                    '</div>');
                $(".cover_img_wrap").append(str);
                uploadFile_(file, str);
            }
        }
        repeatImg();
        $(".show_img_word").removeClass('hide');
    });



    $(".again_upload").on('click', function (event) {
        $("#cover").css('z-index', '2');
        var isLoading = !!$(".cover_img_wrap").find('.loading').length;
        if (isLoading) {
            layer.msg("请等待文件上传完成");
            return;
        } else {
            $(".cover_img_wrap").empty();
            $(".cover_img_wrap").css('z-index', '1');
            $(".show_img_word").addClass('hide');
            $(".cwcr_img img").removeClass("cwcr_img_auto");
            $(".cwcr_img img").attr("src", "");
            $(".cover_img").css('opacity', '0');
            $(".cover_img_wrap").css('z-index', '1');
            $(".face_img").css("background-image", "url('ssdsd')");
        }
    });

    $(".cover_sure,.close_div").on('click', function (event) {
        var objUrl = $('.cover_img').attr('src');
        var isLoading = !!$(".cover_img_wrap").find('.loading').length;
        if (isLoading) {
            layer.msg("请等待文件上传完成");
            return;
        } else if (!isLoading && objUrl) {
            $(".face_img").css("background-image", "url(" + objUrl + ")");
            // $(".face_img").css('background-size', '100% 100%');
            $(".cover_wrap").addClass('hide');
            $(".show_img_word").removeClass("hide");
            $(".cwcr_img img").removeClass("cwcr_img_auto");
            $(".cwcr_img img").attr("src", "");
            $(".cover_img_wrap").css('z-index', '1');
            $("#cover").css('z-index', '1');
        } else {
            $(".cover_wrap").addClass('hide');
            $(".show_img_word").removeClass("hide");
            $(".cwcr_img img").removeClass("cwcr_img_auto");
            $(".cwcr_img img").attr("src", "");
            $(".cover_img_wrap").css('z-index', '1');
        }
    });

    $(".work_name").blur(function (event) {
        var cwcr_synopsis_title = $(".work_name").val();
        console.log(cwcr_synopsis_title);
        $(".cwcr_synopsis_title").html(cwcr_synopsis_title);
    });


    $("#firstCate").change(function () {
        var classify = $("#firstCate  option:selected").text();
        console.log(classify);
        $(".classify").html(classify);
        var classify_child = $("#secondCate  option:selected").text();
        console.log(classify_child);
        $(".classify_child").html(classify_child);
    });

    $("#secondCate").change(function () {
        var classify_child = $("#secondCate  option:selected").text();
        console.log(classify_child);
        $(".classify_child").html(classify_child);
    });



    $("form").submit(function () {
        var objUrl = $(".face_img").css("backgroundImage").replace('url(\"', '').replace('\")', '');
        if ($(".work_name").val() == "") {
            layer.msg("请输入作品名称！");
            return false;
        } else if ($("#firstCate option:selected").val() == "请选择作品类型" || $("#firstCate option:selected").val() == "") {
            layer.msg("请选择作品类型！");
            return false;
        } else if ($(".zpjs").val() == "") {
            layer.msg("请输入作品介绍！");
            return false;
        } else if ($(".bqxzbox .bqlbbox").length <= 0) {
            layer.msg("请选择标签！");
            return false;
        } else if ($("#dd .imgbox").length <= 0) {
            layer.msg("请上传作品！");
            return false;
        } else if (objUrl == "undefined" || objUrl == "" || objUrl == "none" || objUrl == "http://www.meishimeitu.com/user/ssdsd" || objUrl == "ssdsd") {
            layer.msg("请上传封面！");
            return false;
        } else {
            return true;
        }
    })

    //  进入页面时判断已选择标签的个数
    if ($(".bqxzbox .bqlbbox").length > 0) {
        $(".bqxzbox").show();
    } else {
        $(".bqxzbox").hide();
    }

    // 点击添加标签

    $(".bqlb .bqlbbox").click(function () {
        var yixuanze = $(this).attr("yixuan");
        if (yixuanze != "ok") {
            var yxbqnum = $(".bqxzbox>.bqlbbox").length;
            if (yxbqnum < 3) {
                $(this).attr("yixuan", "ok");
                $(this).clone().appendTo(".bqxzbox");
                $(".bqxzbox>.bqlbbox").append("<img src='/themes/quietgreen/assets/images/type/关闭icon.png' alt='' class=''/>");
                $(".bqxzbox>.bqlbbox").children(".zpbq").attr("name", "tags[]");
                $(this).addClass("bqlb_click");
                $(".bqxzbox").show();
            } else {
                $(".bqbox_warning").show();
                setTimeout("$('.bqbox_warning').hide()", 2000);
            }
        } else {
            return false
        }
    })

    // 点击删除已选标签
    $(".bqxzbox").on("click", ".bqlbbox>img", function () {
        let yxid = $(this).siblings("input").attr("value");
        $(":input[value=" + yxid + "]").parent().removeClass("bqlb_click");
        $(":input[value=" + yxid + "]").parent().attr("yixuan", "no");
        $(this).parent().remove();
        if ($(".bqxzbox .bqlbbox").length == 0) {
            $(".bqxzbox").hide();
        };
    });

    // 获取当前文本实际宽度
    var textWidth = function (text) {
        var sensor = $('<pre>' + text + '</pre>').css({
            display: 'none'
        });
        $('body').append(sensor);
        var width = sensor.width();
        sensor.remove();
        return width;
    };

    // 遍历input，更改每个input的宽度
    var array = $(".bqname");
    array.each(function () {
        var changewidth = textWidth($(this).html()) + 30;
        $(this).parent().width(changewidth + "px");
    })


    // 单选框的样式

    $(".zscs .zscs_radio:checked").parent().addClass("zscs_click").siblings().removeClass("zscs_click");
    $(".zscs").click(function () {
        $(".zscs_radio:checked").parent().addClass("zscs_click");
        $(".zscs_radio:checked").parent().siblings().removeClass("zscs_click");
    });

    $(".bqxzbox").children(".bqlbbox").children(".zpbq").attr("value");


})



function repeat() {
    //获取图片地址
    var imgs = $(".imgbox img");
    var imgarr = new Array(imgs.length);
    for (var i = 0; i < imgs.length; i++) {
        imgarr[i] = imgs[i].src;
    }
}

function getObjectURL(file) {
    var url = null;
    if (window.createObjectURL != undefined) {
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) {
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) {
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}


function repeatImg() {
    //获取图片地址
    var imgs = $(".cover_img_wrap img");
    var imgarr = new Array(imgs.length);
    for (var i = 0; i < imgs.length; i++) {
        imgarr[i] = imgs[i].src;
    }
}

// 作品上传

function uploadFile(file, target) {
    var hiddenFile = $('<input type="hidden" name="file[]">')        
    target.append(hiddenFile);

    uploadFileToOSS('attachment/user/', [file], (err, result) => {     //  通过这个[file]异步传输文件
        if (err || !result.length) {
            layer.msg("上传失败，请重新上传！")
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
            hiddenFile.val(JSON.stringify(content)); //  JSON.stringify() 方法用于将 JavaScript 值转换为 JSON 字符串
            target.find('.successphoto').removeClass('loading');
        }
    })
}

// 封面上传

function uploadFile_(file, target) {
    var hiddenFile = $('<input type="hidden"  name="cover[]">') //  通过这个input异步传输文件
    target.append(hiddenFile);

    uploadFileToOSS('attachment/user/', [file], (err, result) => {
        if (err || !result.length) {
            layer.msg("上传失败，请重新上传！")
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
            hiddenFile.val(JSON.stringify(content)); //  JSON.stringify() 方法用于将 JavaScript 值转换为 JSON 字符串
            target.find('.successphoto').removeClass('loading');
        }
    })
}