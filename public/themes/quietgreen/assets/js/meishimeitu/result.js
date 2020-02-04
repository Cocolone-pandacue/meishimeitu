/*
* @Author: Marte
* @Date:   2019-02-14 15:50:44
 * @Last Modified by:   Marte
 * @Last Modified time: 2019-02-28 17:49:31
*/

'use strict';
$(function(){

    // letDivCenter(".onload_img");

    $(".user_register_div").on('click', function(event) {
        $(".user_login").addClass('hide');
        $(".user_register").removeClass("hide");
    });

    $(".user_login_div").on('click', function(event) {
        $(".user_register").addClass('hide');
        $(".user_login").removeClass("hide");
    });

    $(".go_phone").on('click', function(event) {
        $("#email").addClass('hide');
        $("#phone").removeClass("hide");
    });

    $(".go_email").on('click', function(event) {
        $("#phone").addClass('hide');
        $("#email").removeClass("hide");
    });

    $(".price_btn").not('.no_allow').on('click', function(event) {
        var type = $(this).data('type');
        var svgElement = $('.logo_container .swiper-slide-active .svg');
        var id = svgElement.data('id');
        // $(".barcode_box").removeClass("hide");

        window.open(`/task/brainpower/purchaseLogo?id=${id}&type=${type}`, '_blank');

        var interval = setInterval(()=>{
            getPayStatus(id, (err, data)=>{
                if(!err && data.status === 1){
                    //付费
                    layer.close(layer.index);
                    doPhoto();
                    clearInterval(interval);
                }
            })
        }, 2000);
    });

    $(".close_btn").on('click', function(event) {
        $(this).parent().parent().addClass('hide');
        // $(".barcode_box").addClass('hide');
    });

    letDivCenter(".user_div");


    

    $(".upload_btn").on('click', function(event) {
        unScroll();

        var name = $('#name').val();
        var slogan = $('#title').val();
        var industry = $('#industry').val();
        var logo = $('#logo').val();
        var color = $('#color').val();
        var svgElement = $('.logo_container .swiper-slide-active .svg');

        if(svgElement.data('id')){
            return showBuyLayer(svgElement.html());
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/task/brainpower/processsave',
            type: 'post',
            dataType: 'json',
            data: {
                name: name,
                slogan: slogan,
                industry: industry,
                logo: logo,
                color: color,
                svg: svgElement.html()
            },
            success: function (data) {
                svgElement.data('id', data.id);
                showBuyLayer(svgElement.html());
            },
            error: function (data) {

            }
        });
    });


    

    //png下载
    $(".onloadPng").on('click', function(event) {
        var svg=$('.swiper-slide-active').children('a').children('.div_svg').children('.svg').html();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/task/brainpower/processingajaxdown',
            type: 'post',
            dataType: 'json',
            data: {
                svg: svg
            },
            success: function (data) {
                //console.log(data);
                //console.log(data.url);
                downloadImg(data.url,timestamp(),"png");
            },
            error: function (data) {
                console.log('下载错误');
            }
        });
    });

    //jpg下载
    $(".onloadJpg").on('click', function(event) {
        var svg=$('.swiper-slide-active').children('a').children('.div_svg').children('.svg').html();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/task/brainpower/processingajaxdown',
            type: 'post',
            dataType: 'json',
            data: {
                svg: svg
            },
            success: function (data) {
                //console.log(data);
                //console.log(data.url);
                downloadImg(data.url,timestamp(),"jpg");
            },
            error: function (data){
                console.log('下载错误');
            }
        });
    });


    $(".close_parent").on('click', function(event) {
        removeUnScroll();
    });



})

    function getPayStatus(logo_id, callback){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/task/brainpower/checkPay',
            type: 'get',
            dataType: 'json',
            data: {
                logo_id: logo_id
            },
            success: function (data) {
                callback(null, data);
            },
            error: function (error) {
                callback(error);
            }
        });
    }

    function unScroll() {
        var top = $(document).scrollTop();
        $(document).on('scroll.unable',function (e) {
            $(document).scrollTop(top);
        })
    }

    function removeUnScroll() {
        $(document).unbind("scroll.unable");
    }

    function letDivCenter(divName){
    　　var top = ($(window).height() - $(divName).height())/2;
    　　var left = ($(window).width() - $(divName).width())/2;
    　　var scrollTop = $(document).scrollTop();
    　　var scrollLeft = $(document).scrollLeft();
    　　$(divName).css({
           position : 'absolute',
           top : top + scrollTop,
           left : left + scrollLeft
          }).fadeIn(500);
    }

    function showBuyLayer(svg){
        //付费
        paBounced();
        $(".img_show").text("");// 清空数据
        $(".img_show").append(svg);
    }

    /*生成图片名称*/
    function timestamp() {
        var time = new Date();
        var y = time.getFullYear();
        var m = time.getMonth() + 1;
        var d = time.getDate();
        var h = time.getHours();
        var mm = time.getMinutes();
        var s = time.getSeconds();
        return "" + y + add0(m) + add0(d) + add0(h) + add0(mm) + add0(s);
    }

    function add0(m) {
        return m < 10 ? '0' + m : m;
    }

    //给url，下载图片
    function downloadImg(imgsrc,name,imgtype){
        var image=new Image();
        image.setAttribute("crossOrigin","anonymous");
        image.onload=function(){
            var canvas=document.createElement("canvas");
            canvas.width=image.width;
            canvas.height=image.height;
            var con=canvas.getContext("2d");
            con.drawImage(image,0,0,image.width,image.height);
            if(imgtype=="png"){
                var url=canvas.toDataURL("image/png");//得到图片的base64编码数据
            }else if(imgtype=="jpg"){
                var type = 'image/jpeg';
                //将canvas元素中的图像转变为DataURL
                var dataurl = canvas.toDataURL(type);
                //抽取DataURL中的数据部分，从Base64格式转换为二进制格式
                var bin = atob(dataurl.split(',')[1]);
                //创建空的Uint8Array
                var buffer = new Uint8Array(bin.length);
                //将图像数据逐字节放入Uint8Array中
                for (var i = 0; i < bin.length; i++) {
                    buffer[i] = bin.charCodeAt(i);
                }
                //利用Uint8Array创建Blob对象
                var blob = new Blob([buffer.buffer], {type: type});
                var url = window.URL.createObjectURL(blob);
            }
            var a=document.createElement("a");//创建一个a
            var event=new MouseEvent("click");//创建一个单击事件
            a.download=name||"meishimeitu";//设置图片名称
            a.href=url;//将生成的url设置为a的href属性
            var b=a.dispatchEvent(event);//触发a的单击事件，IE下使用fireEvent 高级浏览器使用dispatchEvent
            //console.log(b); //true
        };
        image.src=imgsrc;
    };
    //  购买套餐弹框
    function paBounced(){
        layer.open({
            type: 1,
            closeBtn: 1,
            btnAlign: 'c',
            skin: 'demo-class',
            title:'',
            shadeClose:true,
            fix: false,
            scrollbar: false,
            area: ['860px','522px'],
            content: $('.buy_detail_div'),
            success: function (layero, index) {
                
            },
        });
    }

    //  下载图片弹框
    function doPhoto(){
        layer.open({
            type: 1,
            closeBtn: 1,
            btnAlign: 'c',
            skin: 'demo-class',
            title:'',
            shadeClose:true,
            fix: false,
            scrollbar: false,
            area: ['860px','522px'],
            content: $('.onload_img'),
            success: function (layero, index) {
                
            },
        });
    }