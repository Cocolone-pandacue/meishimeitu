$(function(){
    /*省级切换*/
    $('#province').on('click',function(){
        var id = $(this).val();
        if(id){
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/user/ajaxGetCity',
                data: {id:id},
                dataType:'json',
                success: function(data){
                    var html = '';
                    for(var i in data.province){
                        html+= "<option value=\""+data.province[i].id+"\">"+data.province[i].name+"<\/option>";
                    }
                    $('#city').html(html);
                }
            });
        }else{
            var html = '<option value="" >-请选择市-</option>';
            $('#city').html(html);
        }
    });

    var demo=$("#shop_info").Validform({
        tiptype:3,
        label:".label",
        showAllError:true,
        ajaxPost:false,
        dataType:{
            'positive':/^[1-9]\d*$/,
        },
    });

    $(".chosen-results").click(function(event) {
        var lengli = $(".chosen-choices li").length;
        if(lengli>=1&&lengli<=3){
            $("#ts").css('color', '#8cd232');
            $("#ts i").css('color', '#8cd232');
        }else{
            $("#ts").css('color', '#cd3333');
            $("#ts i").css('color', '#cd3333');
        }
    });

    //   弹出上传文件窗口

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
        if (src == "undefined"||src == ""||src == "none"){
            $(".cover_img").css('opacity', '0');
            $(".show_img_word").addClass("hide");
        }else{
            $(".cover_img").css('opacity', '1');
        }
        if (objUrl == "undefined"||objUrl == ""||objUrl == "none") {
            $(".cwcr_img img").removeClass("cwcr_img_auto");
            // $(".cwcr_img img").attr("src", "/themes/quietgreen/assets/images/meishimeitu/personal/s_robot.png");
            $(".cover_img").css('opacity', '0');
            $(".cwcr_img img").css('opacity', '0');
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
        if (src == "undefined"||src == ""||src == "none"){
            $(".cover_img").css('opacity', '0');
            $(".show_img_word").addClass("hide");
        }else{
            $(".cover_img").css('opacity', '1');
        }
        if (objUrl == "undefined"||objUrl == ""||objUrl == "none") {
            $(".cwcr_img img").removeClass("cwcr_img_auto");
            // $(".cwcr_img img").attr("src", "/themes/quietgreen/assets/images/meishimeitu/personal/s_robot.png");
            $(".cover_img").css('opacity', '0');
            $(".cwcr_img img").css('opacity', '0');
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
            $(".cwcr_img img").attr("src", objUrl);
            $(".cwcr_img img").addClass("cwcr_img_auto");
        }

    });

    
     
    // 单选框样式
    $(".dpxzxz .dpxzxz_radio:checked").parent().addClass("dpxzxz_click").siblings().removeClass("dpxzxz_click");
    $(".dpxzxz").click(function(){
        $(".dpxzxz_radio:checked").parent().addClass("dpxzxz_click");
        $(".dpxzxz_radio:checked").parent().siblings().removeClass("dpxzxz_click");
    });

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

