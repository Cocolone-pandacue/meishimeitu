$(function(){

$(".mydownload_xifen_leixing a").click(function(){
    $(this).addClass("clickys");
    $(this).siblings().removeClass("clickys");
})



// 下载弹框
$(".mydownload_photo_littlebox_fuzhu").on("click", function(){
    var data_target_id=$(this).attr("data-target");
    layer.open({
        type: 1,
        closeBtn: 1,
        btnAlign: 'c',
        skin: 'my_download',
        title:'',
        shadeClose:true,
        fix: false,
        scrollbar: false,
        area: ['850px','520px'],
        content: $(data_target_id),
        success: function (layero, index) {
            
        },
    });
});

//png下载
$(".onloadPng").on('click', function(event) {
    var svg=$('.mydownload_photo_littlebox_fuzhu').html();
    console.log(svg);
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
    var svg=$('.mydownload_photo_littlebox_fuzhu').html();
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

//Eps下载
$(".onloadEps").on('click', function(event) {
    var svg=$('.mydownload_photo_littlebox_fuzhu').html();
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
            downloadImg(data.url,timestamp(),"eps");
        },
        error: function (data){
            console.log('下载错误');
        }
    });
});

})


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
