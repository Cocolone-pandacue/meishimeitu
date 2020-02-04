/*
* @Author: Marte
* @Date:   2019-01-15 11:18:46
* @Last Modified by:   Marte
* @Last Modified time: 2019-02-25 18:04:25
*/

'use strict';
$(function(){
    window.onload=logoImg;
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 2.269,
      centeredSlides: true,
      spaceBetween: 30,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    hidepre();
    /*隐藏向左按钮*/
    function hidepre(){
        if($(".swiper-wrapper").children(":first").hasClass('swiper-slide-active')){
            $(".swiper-button-prev").addClass('hide');
        }else{
            $(".swiper-button-prev").removeClass('hide');
        }
    }

    /*初次传值*/
    var name = $('#name').val();
    var title = $('#title').val();
    var industry = $('#industry').val();
    var logo = $('#logo').val();
    var color = $('#color').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/task/brainpower/processingajaxshow',
        type: 'post',
        dataType: 'json',
        data: {
            name: name,
            title: title,
            industry: industry,
            logo: logo,
            color: color
        },
        success: function (data) {
            // console.log(data);
            for(var i=0;i<data.svg.length;i++){
                var svgbox=data.svg[i];
                var logosvg=svgbox.data;
                var logoid=svgbox.id;
                var str="<div class='swiper-slide'><a href='javascript:;' class='sw_a shuiy'><div class='div_svg'><div class='svg'>"+logosvg+"</div><input type='hidden' class='iconid' name='logoid' value=\""+logoid+"\"></div><span class='collect_span collect'></span></a></div>";
                swiper.appendSlide(str);
            }
            logoImg();
            watermark(".shui");
            $(".artificial_intelligence_wrap").addClass('hide');
            $(".make_logo_wrap").removeClass('hide');
            swiper.update(true);
        },
        error: function (data) {
            console.log('错误');
        }
    });




    $(".swiper-button-next").on('click', function(event) {
        event.preventDefault();
        hidepre();
        logoImg();
        watermark(".shuiy");
        if ($(".swiper-wrapper").children("div:last-child").hasClass('swiper-slide-active')){
            var name = $('#name').val();
            var title = $('#title').val();
            var industry = $('#industry').val();
            var logo = $('#logo').val();
            var color = $('#color').val();
            var logoid =[];
            $("input[name='logoid']").each(function(){
                logoid.push($(this).val());
            });
            // console.log(logoid);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/task/brainpower/processingajaxtwo',
                type: 'post',
                dataType: 'json',
                data: {
                    name: name,
                    title: title,
                    industry: industry,
                    logo: logo,
                    color: color,
                    logoid : logoid
                },
                success: function (data) {
                    // console.log(data);
                    var str="<div class='swiper-slide'><a href='javascript:;' class='sw_a shuiy'><div class='div_svg'><div class='svg'>"+data.svg+"</div><input type='hidden' class='iconid' name='logoid' value=\""+data.id+"\"></div><span class='collect_span collect'></span></a></div>";
                    swiper.appendSlide(str);
                    // console.log(data);
                },
                error: function (data) {
                    console.log('错误');
                }
            });

        }


    });

    $(".swiper-button-prev").on('click',function(event) {
        event.preventDefault();
        hidepre();
        logoImg();
    });

    /*水印*/
    function watermark(waterName) {
        //默认设置
        var defaultSettings={
            watermark_txt:"美视美图",
            watermark_x:0,//水印起始位置x轴坐标
            watermark_y:0,//水印起始位置Y轴坐标
            watermark_rows:40,//水印行数
            watermark_cols:40,//水印列数
            watermark_x_space:0,//水印x轴间隔
            watermark_y_space:10,//水印y轴间隔
            watermark_color:'#000000',//水印字体颜色
            watermark_alpha:0.1,//水印透明度
            watermark_fontsize:'14px',//水印字体大小
            watermark_font:'微软雅黑',//水印字体
            watermark_width: 58,//水印宽度
            watermark_height: 16,//水印长度
            watermark_angle:30//水印倾斜度数
        };
        //采用配置项替换默认值，作用类似jquery.extend
        if(arguments.length===1&&typeof arguments[0] ==="object" ){
            var src=arguments[0]||{};
            for(var key in src)
            {
                if(src[key]&&defaultSettings[key]&&src[key]===defaultSettings[key])
                    continue;
                else if(src[key])
                    defaultSettings[key]=src[key];
            }
        }

        var oTemp = document.createDocumentFragment();
        //获取页面最大宽度
        var page_width =504;
        //获取页面最大长度
        var page_height =302;
        //如果将水印列数设置为0，或水印列数设置过大，超过页面最大宽度，则重新计算水印列数和水印x轴间隔
        if (defaultSettings.watermark_cols == 0 ||(parseInt(defaultSettings.watermark_x+ defaultSettings.watermark_width *defaultSettings.watermark_cols+ defaultSettings.watermark_x_space * (defaultSettings.watermark_cols - 1))> page_width)) {
            defaultSettings.watermark_cols =parseInt((page_width-defaultSettings.watermark_x+defaultSettings.watermark_x_space)/ (defaultSettings.watermark_width+ defaultSettings.watermark_x_space));
            defaultSettings.watermark_x_space =parseInt((page_width- defaultSettings.watermark_x- defaultSettings.watermark_width* defaultSettings.watermark_cols)/ (defaultSettings.watermark_cols - 1));
        }
        //如果将水印行数设置为0，或水印行数设置过大，超过页面最大长度，则重新计算水印行数和水印y轴间隔
        if (defaultSettings.watermark_rows == 0 ||(parseInt(defaultSettings.watermark_y+ defaultSettings.watermark_height * defaultSettings.watermark_rows+ defaultSettings.watermark_y_space * (defaultSettings.watermark_rows - 1))> page_height)) {
            defaultSettings.watermark_rows =parseInt((defaultSettings.watermark_y_space+ page_height - defaultSettings.watermark_y)/ (defaultSettings.watermark_height + defaultSettings.watermark_y_space));
            defaultSettings.watermark_y_space =parseInt((page_height- defaultSettings.watermark_y- defaultSettings.watermark_height* defaultSettings.watermark_rows)/ (defaultSettings.watermark_rows - 1));
        }
        var x;
        var y;
        for (var i = 0; i < defaultSettings.watermark_rows; i++) {
            y = defaultSettings.watermark_y + (defaultSettings.watermark_y_space + defaultSettings.watermark_height) * i;
            for (var j = 0; j < defaultSettings.watermark_cols; j++) {
                x = defaultSettings.watermark_x + (defaultSettings.watermark_width + defaultSettings.watermark_x_space) * j;

                var mask_div = document.createElement('span');
                mask_div.id = 'mask_div' + i + j;
                mask_div.appendChild(document.createTextNode(defaultSettings.watermark_txt));
                //设置水印div倾斜显示
                mask_div.style.webkitTransform = "rotate(-" + defaultSettings.watermark_angle + "deg)";
                mask_div.style.MozTransform = "rotate(-" + defaultSettings.watermark_angle + "deg)";
                mask_div.style.msTransform = "rotate(-" + defaultSettings.watermark_angle + "deg)";
                mask_div.style.OTransform = "rotate(-" + defaultSettings.watermark_angle + "deg)";
                mask_div.style.transform = "rotate(-" + defaultSettings.watermark_angle + "deg)";
                mask_div.style.visibility = "";
                mask_div.style.position = "absolute";
                mask_div.style.left = x + 'px';
                mask_div.style.top = y + 'px';
                mask_div.style.overflow = "hidden";
                mask_div.style.zIndex = "1";
                mask_div.style.opacity = defaultSettings.watermark_alpha;
                mask_div.style.fontSize = defaultSettings.watermark_fontsize;
                mask_div.style.fontFamily = defaultSettings.watermark_font;
                mask_div.style.color = defaultSettings.watermark_color;
                mask_div.style.textAlign = "center";
                mask_div.style.width = defaultSettings.watermark_width + 'px';
                mask_div.style.height = defaultSettings.watermark_height + 'px';
                mask_div.style.display = "block";
                oTemp.appendChild(mask_div);
            };
        };
        $(".shuiy span").not(".collect_span").remove();
        $(waterName).append(oTemp);
    }

    watermark(".shui");//传入动态水印内容

    function logoImg(){

        var logo_src=$('.swiper-slide-active').children('a').children('.div_svg').html();
        $(".img_case").html("");
        $(".img_case").append(logo_src);
        var lowidth=$('.swiper-slide-active').children('a').children('div_svg').children('.svg').width();
        var loheight=$('.swiper-slide-active').children('a').children('div_svg').children('.svg').height();
        if(lowidth>70||loheight>70){
            if (lowidth<loheight){
                var one_width=lowidth*(70/lowidth);
                var one_height=loheight*(70/loheight);
            }else{
                var one_width=lowidth*(70/lowidth);
                var one_height=loheight*(70/lowidth);
            }
        }else if(lowidth<70&&loheight<70){
            if (lowidth<loheight){
                var one_width=lowidth*(70/lowidth);
                var one_height=loheight*(70/loheight);
            }else{
                var one_width=lowidth*(70/lowidth);
                var one_height=loheight*(70/lowidth);
            }
        }
        $(".lo_one_seat .svg").css('width', one_width);
        $(".lo_one_seat .svg").css('height', one_height);
        $(".lo_one_seat .svg").css('transform', 'rotate3d(-25,0,-10,30deg)');
        $(".lo_one_seat .svg").css('top', '85px');
        $(".lo_one_seat .svg").css('left', '23px');

        if(lowidth>160||loheight>160){
            if (lowidth<loheight){
                var onet_width=lowidth*(160/lowidth);
                var onet_height=loheight*(160/loheight);
            }else{
                var onet_width=lowidth*(160/lowidth);
                var onet_height=loheight*(160/lowidth);
            }
        }else if(lowidth<160&&loheight<160){
            if (lowidth<loheight){
                var onet_width=lowidth*(160/lowidth);
                var onet_height=loheight*(160/loheight);
            }else{
                var onet_width=lowidth*(160/lowidth);
                var onet_height=loheight*(160/lowidth);
            }
        }
        $(".lo_onet_seat .svg").css('width', onet_width);
        $(".lo_onet_seat .svg").css('height', onet_height);

        if(lowidth>90||loheight>90){
            if (lowidth<loheight){
                var two_width=lowidth*(90/lowidth);
                var two_height=loheight*(90/loheight);
            }else{
                var two_width=lowidth*(90/lowidth);
                var two_height=loheight*(90/lowidth);
            }
        }else if(lowidth<90&&loheight<90){
            if (lowidth<loheight){
                var two_width=lowidth*(90/lowidth);
                var two_height=loheight*(90/loheight);
            }else{
                var two_width=lowidth*(90/lowidth);
                var two_height=loheight*(90/lowidth);
            }
        }
        $(".lo_two_seat .svg").css('width', two_width);
        $(".lo_two_seat .svg").css('height', two_height);
        $(".lo_two_seat .svg").css('transform', 'rotate3d(0.8,-0.1,0.2,45deg)');
        $(".lo_two_seat .svg").css('top', '36px');
        $(".lo_two_seat .svg").css('left', '99px');


        if(lowidth>160||loheight>160){
            if (lowidth<loheight){
                var three_width=lowidth*(160/lowidth);
                var three_height=loheight*(160/loheight);
            }else{
                var three_width=lowidth*(160/lowidth);
                var three_height=loheight*(160/lowidth);
            }
        }else if(lowidth<160&&loheight<160){
            if (lowidth<loheight){
                var three_width=lowidth*(160/lowidth);
                var three_height=loheight*(160/loheight);
            }else{
                var three_width=lowidth*(160/lowidth);
                var three_height=loheight*(160/lowidth);
            }
        }
        $(".lo_three_seat .svg").css('width', three_width);
        $(".lo_three_seat .svg").css('height', three_height);


        if(lowidth>120||loheight>120){
            if (lowidth<loheight){
                var four_width=lowidth*(120/lowidth);
                var four_height=loheight*(120/loheight);
            }else{
                var four_width=lowidth*(120/lowidth);
                var four_height=loheight*(120/lowidth);
            }
        }else if(lowidth<120&&loheight<120){
            if (lowidth<loheight){
                var four_width=lowidth*(120/lowidth);
                var four_height=loheight*(120/loheight);
            }else{
                var four_width=lowidth*(120/lowidth);
                var four_height=loheight*(120/lowidth);
            }
        }
        $(".lo_four_seat .svg").css('width', four_width);
        $(".lo_four_seat .svg").css('height', four_height);

        if(lowidth>70||loheight>70){
            if (lowidth<loheight){
                var five_width=lowidth*(70/lowidth);
                var five_height=loheight*(70/loheight);
            }else{
                var five_width=lowidth*(70/lowidth);
                var five_height=loheight*(70/lowidth);
            }
        }else if(lowidth<70&&loheight<70){
            if (lowidth<loheight){
                var five_width=lowidth*(70/lowidth);
                var five_height=loheight*(70/loheight);
            }else{
                var five_width=lowidth*(70/lowidth);
                var five_height=loheight*(70/lowidth);
            }
        }
        $(".lo_five_seat .svg").css('width', five_width);
        $(".lo_five_seat .svg").css('height', five_height);
    }

    /*收藏*/
    $(document).on('click','.collect_span' ,function(event) {
        if($(this).hasClass('collect')){
            $(this).removeClass("collect");
            $(this).addClass('collected');
        }else{
            $(this).removeClass("collected");
            $(this).addClass('collect');
        }
    });

})



