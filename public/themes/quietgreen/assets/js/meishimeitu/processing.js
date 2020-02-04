/*
* @Author: Marte
* @Date:   2019-01-02 15:33:24
 * @Last Modified by: sunlingxing
 * @Last Modified time: 2019-08-11 02:06:42

*/

'use strict';
$(function () {
    /**
     * base64 to file
     * @param dataurl   base64 content
     * @param filename  set up a meaningful suffix, or you can set mime type in options
     * @returns {File|*}
     */
    const dataURLtoFile = function dataURLtoFile(dataurl) {
        const arr = dataurl.split(',');
        //console.log(arr);
        const mime = arr[0].match(/:(.*?);/)[1];
        //console.log(mime);
        const bstr = atob(arr[1]);
        //console.log(bstr);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new Blob([u8arr], {
            type: mime
        });
    };

    var brainpower_num = $('#brainpower_num').val();

    function uploadImgs(imgs, callback) {
        $.ajax({
            // url: 'https://www.meishimeitu.com/api/sts',      //  线上路由
            url: 'http://api.meishimeitu.com/sts',              //  本地测试路由
            type: 'get',
            dataType: 'json',
            success: function (data) {
                let client = new OSS({
                    accessKeyId: data.AccessKeyId,
                    accessKeySecret: data.AccessKeySecret,
                    stsToken: data.SecurityToken,
                    endpoint: 'oss-cn-beijing.aliyuncs.com',
                    bucket: 'imagearr'
                });

                let deferreds = imgs.map(item => {
                    let d = $.Deferred();
                    client.multipartUpload("studio_course/" + item.key, item.imgfile).then(d.resolve);
                    return d;
                });

                $.when.apply(null, deferreds).then(function success() {
                    callback(null, Array.prototype.splice.call(arguments, 0, imgs.length));
                }, callback);
            }
        })
    }

    /*提交图片路径*/
    function saveImgUrl(imgUrl) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/task/brainpower/processingget',
            type: 'post',
            dataType: 'json',
            data: {
                'brainpower_num': brainpower_num,
                'imgUrl': imgUrl
            },
            success: function (data) {
                console.log(data);
                URL();
            },
            error: function (data) {
                console.log('写入图片错误');
            }
        })
    }

    function URL(){
        var URL=window.location.href;
        var returl="/task/brainpower/result/"+brainpower_num;
        console.log(returl);
        var urlParam = window.location.search.substr(1);   //页面参数
        var beforeUrl = URL.substr(0, URL.indexOf(""));   //页面主地址（参数之前地址）
        var nextUrl = "";
        var arr = new Array();
        if (urlParam != "") {
            var urlParamArr = urlParam.split("&"); //将参数按照&符分成数组
            for (var i = 0; i < urlParamArr.length; i++) {
                var paramArr = urlParamArr[i].split("="); //将参数键，值拆开
                //如果键雨要删除的不一致，则加入到参数中
                if (paramArr[0] != paramKey) {
                    arr.push(urlParamArr[i]);
                }
            }
        }
        if (arr.length > 0) {
            nextUrl = "?" + arr.join("&");
        }
        var url = beforeUrl + nextUrl;
        //console.log(url);
        URL=url+returl;
        //console.log(URL);
        window.location.href= URL;
    }

    /**
     * 生成文件名
     * @returns
     */
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

    var COLORS = {
        1: "#000",
        2: "#ffff00",
        3: "#800080",
        4: "#ff4500",
        5: "#f5deb3",
        6: "#008000",
        7: "#0000ff",
        8: "#ff0000"
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/task/brainpower/processingajax',
        type: 'post',
        dataType: 'json',
        data: {
            brainpower_num: brainpower_num
        },
        success: function (data) {
            //console.log(data);
            //console.log(data.classify);
            //var color_arr = data.color;
            var fColor = COLORS[1];
            //console.log(fColor);
           /* if (color_arr.length) {
                var index = Math.floor(Math.random() * (color_arr.length - 1));
                var color_id = color_arr[index].color_id;
                fColor = COLORS[color_id] || COLORS[1];
            }*/
            $(function(){
                var modol=data.classify;
                console.log(modol);
                for(var i=0;i<modol.length;i++){
                    var model_data=modol[i];
                    var slogo_url=model_data.url;
                }
                console.log(slogo_url);
                const canvasConf=[
                    //上下
                    {
                        canvasWidth: 310,
                        canvasHeight: 186,
                        fillStyle: fColor,
                        textAlign: 'center',
                        nameFont: '35px Arial',
                        nameX: 150,
                        nameY: 163,
                        titleFont: '16px Arial',
                        titleX: 150,
                        titleY: 183,
                        imgX: 89,
                        imgY: 0,
                        imgWidth: 132,
                        imgHeight: 132,
                        slogo: 'http://meishimeitu.oss-cn-shanghai.aliyuncs.com/'+slogo_url
                        // 'http://meishimeitu.oss-cn-shanghai.aliyuncs.com/'+data.classify[0].url
                    },
                    // 左右
                    {
                        canvasWidth: 400,
                        canvasHeight: 120,
                        fillStyle: fColor,
                        textAlign: '',
                        nameFont: '35px Arial',
                        nameX: 142,
                        nameY: 80,
                        titleFont: '16px Arial',
                        titleX: 142,
                        titleY: 110,
                        imgX: 0,
                        imgY: 0,
                        imgWidth: 120,
                        imgHeight: 120,
                        slogo: 'http://meishimeitu.oss-cn-shanghai.aliyuncs.com/'+slogo_url
                        // 'http://meishimeitu.oss-cn-shanghai.aliyuncs.com/'+data.classify[1].url
                    },
                    // 前后
                    {
                        canvasWidth: 186,
                        canvasHeight: 186,
                        fillStyle: fColor,
                        textAlign: 'center',
                        nameFont: '24px Arial',
                        nameX: 93,
                        nameY: 93,
                        titleFont: '14px Arial',
                        titleX: 93,
                        titleY: 110,
                        imgX: 0,
                        imgY: 0,
                        imgWidth: 186,
                        imgHeight: 186,
                        slogo: 'http://meishimeitu.oss-cn-shanghai.aliyuncs.com/'+slogo_url
                        // 'http://meishimeitu.oss-cn-shanghai.aliyuncs.com/'+data.classify[1].url
                    }
                ];

                for(var i=0;i<modol.length;i++){
                    var slogo_url;
                    var config = canvasConf[i];
                    var modol_data=modol[i];
                    var color_arr=modol_data.classify_color_id;
                    var logo_arr=modol_data.classify_logo_id;
                    var slogoUrl=modol_data.url;
                    var coArr=color_arr.split(',').join('');
                    var index = Math.floor(Math.random() * (coArr.length));
                    //console.log("index"+index);
                    var color_id = coArr[index];
                    //console.log(color_id);
                    fColor = COLORS[color_id] || COLORS[1];
                    console.log(fColor);
                    console.log(slogoUrl);
                    config.fillStyle = fColor;

                    var logoArr=logo_arr.split(',').join('');

                    var logoId=logoArr[0];
                    //console.log(logoId);
                    if(logoId=='1'){
                        slogo_url=slogoUrl;
                        config.slogo = 'http://meishimeitu.oss-cn-shanghai.aliyuncs.com/'+slogo_url;
                    }else if(logoId=='2'){
                        slogo_url=slogoUrl;
                        config.slogo = 'http://meishimeitu.oss-cn-shanghai.aliyuncs.com/'+slogo_url;
                    }else if(logoId=='3'){
                        slogo_url=slogoUrl;
                        config.slogo = 'http://meishimeitu.oss-cn-shanghai.aliyuncs.com/'+slogo_url;
                    }
                    //console.log(color_arr);
                }
                //debugger

                const canvasContent= $("#canvac-content");
                const canvasGens=[];
                canvasConf.forEach(function(conf){
                    let d=$.Deferred();
                    canvasGens.push(d);
                    //debugger
                    let canvas=document.createElement("canvas");
                    let ctx=canvas.getContext("2d");
                    canvas.width=conf.canvasWidth;
                    canvas.height=conf.canvasHeight;
                    let img=new Image();
                    img.src=conf.slogo;
                    img.crossOrigin="anonymous";
                    img.onload=function(){
                        ctx.drawImage(img,conf.imgX,conf.imgY,conf.imgWidth,conf.imgHeight);
                        ctx.fillStyle=conf.fillStyle;
                        ctx.textAlign=conf.textAlign;
                        ctx.font=conf.nameFont;
                        ctx.fillText(data.brand_name, conf.nameX, conf.nameY);
                        ctx.font=conf.titleFont;
                        ctx.fillText(data.brand_title, conf.titleX, conf.titleY);
                        let baseimg=canvas.toDataURL();
                        d.resolve(dataURLtoFile(baseimg));
                    }
                })
                $.when.apply(null, canvasGens).done(function () {
                    // blob格式图片数组
                    const imgs = Array.prototype.slice.call(arguments, 0, canvasConf.length);
                    // 待上传oss图片数组
                    const toOssImgs = imgs.map(function (img, index) {
                    return {
                      key: timestamp() + index + '.png',
                      imgfile: img
                    }
                    })

                    // 上传之阿里云
                    uploadImgs(toOssImgs, function (err, result) {
                        if (!err) {
                            result.map(function(item,index){
                            saveImgUrl(item.name);
                            })
                            //saveImgUrl(result.map(item => item.name));
                        }else{
                            console.log("写入错误");
                        }
                    })

                })
            })
        },
        error: function (data) {
            console.log('错误');
        }
    })
});

/*上下*/
            /*var canvas = $("#canvas")[0];
            var ctx = canvas.getContext("2d");
            ctx.fillStyle = fColor;
            ctx.textAlign='center';
            ctx.font = '35px Arial';
            ctx.fillText(data.brand_name, 150, 160);
            ctx.font = '16px Arial';
            ctx.fillText(data.brand_title, 155, 183);

            ctx.drawImage($("#brand")[0], 89, 0);
            let baseimg = canvas.toDataURL();

            let conversions = dataURLtoFile(baseimg); // 调用base64转图片方法
*/


            /*左右*/
            /*var lrcanvas = $("#lrcanvas")[0];
            var lrctx = lrcanvas.getContext("2d");
            lrctx.fillStyle = fColor;
            lrctx.font = '35px Arial';
            lrctx.fillText(data.brand_name, 142, 80);
            lrctx.font = '16px Arial';
            lrctx.fillText(data.brand_title, 142, 110);

            lrctx.drawImage($("#brand")[0], 0, 0);
            let  lrbaseimg= lrcanvas.toDataURL();

            let lrconversions = dataURLtoFile(lrbaseimg); // 调用base64转图片方法
*/
 /*前后*/
            /*var qhcanvas = $("#qhcanvas")[0];
            var qhctx = qhcanvas.getContext("2d");
            qhctx.drawImage($("#brand")[0], 0, 0);
            qhctx.fillStyle = fColor;
            qhctx.textAlign='center';
            qhctx.font = '24px Arial';
            qhctx.fillText(data.brand_name, 93, 93);
            qhctx.font = '14px Arial';
            qhctx.fillText(data.brand_title, 93, 110);


            let  qhbaseimg= qhcanvas.toDataURL();

            let qhconversions = dataURLtoFile(qhbaseimg); // 调用base64转图片方法
*/

 /*uploadImgs([{
                    key: timestamp()+ '.png',
                    imgfile: conversions
                }, {
                    key: timestamp()+'lr'+ '.png',
                    imgfile: lrconversions
                }, {
                    key: timestamp()+'qh'+ '.png',
                    imgfile: qhconversions
                }], (err, result) => {
                    if (err) {
                        alert('图片上传错误:', err.message);
                    } else {
                        //console.log(result);
                        result.map(function(item,index){
                            console.log(item);
                            console.log(index);
                            console.log(item.name);
                            saveImgUrl(item.name);
                        });

                    }
            })*/
/*上传图片*/
/*function uploadImg(key, imgfile, callback) {
    $.ajax({
        url: 'http://api.meishimeitu.com/sts',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            let client = new OSS({
                accessKeyId: data.AccessKeyId,
                accessKeySecret: data.AccessKeySecret,
                stsToken: data.SecurityToken,
                endpoint: 'oss-cn-beijing.aliyuncs.com',
                bucket: 'imagearr'
            });

            client.multipartUpload("studio_course/" + key, imgfile).then((res) => {
                callback(null, res);
            }).catch((err) => {
                callback(err);
            });
        }
    })
}*/