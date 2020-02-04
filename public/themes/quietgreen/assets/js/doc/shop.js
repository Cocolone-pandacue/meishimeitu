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

