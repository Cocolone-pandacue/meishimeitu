$(function(){
    // 鼠标滑入显示申请的设计师头像
    hoverTip(".txlb_tx",".tx_tips_another");
    Dropzone.autoDiscover = false; // 禁止对所有元素的自动查找，由于Dropzone会自动查找class为dropzone的元素，自动查找后再在这里进行初始化，有时候（并不是都这样）会导致重复初始化的错误，所以在此加上这段代码避免这样的错误。
    //   上传文件
    $(".zpsc").click(function(){                                   // 创建点击上传按钮事件
        var upload_id = $(this).siblings(".modal").attr("id");
        var dropzone_id = $(this).siblings(".annex").children(".dropzone").attr("id");
        var file_update_id = $(this).siblings(".file_update").attr("id");
        var project_id = $(this).attr("project_id");                         // 获取到项目ID
        var task_id = $(this).attr("task_id");                               // 获取到task_id
        var url = $("#"+dropzone_id).attr('url');
        var myDropzone = new Dropzone("#"+dropzone_id, {
            url: url,
            autoProcessQueue:false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize:  uploadRule.size, // MB
            maxFiles: "1",
            dictMaxFilesExceeded: "您最多只能上传一个压缩包！",   
            dictFileTooBig:'你上传的文件过大',
            addRemoveLinks : true,       //在每个预览文件下面添加一个remove[删除]或者cancel[取消](如果文件已经上传)上传文件的链  接
            dictRemoveFile:'删除文件',
            dictCancelUpload:'取消上传',
            hiddenInputContainer:"<input type='hidden'  name='file_id[]' value='1'/>",
            acceptedFiles:".rar,.zip",                //   可接受的文件类型
            dictDefaultMessage :                       // 改变文件框中的文字提示
                '  <i class="upload-icon ace-icon fa fa-cloud-upload fa-3x"></i><br>\
                最多可添加一个压缩包!',
            dictResponseError: 'Error while uploading file!',                  // 如果服务器响应是无效的时候显示的错误消息。 {{statusCode}} 将被替换为服务器端返回的状态码。
            init: function() {
                this.on("addedfile",function(file,data){
                    var file_num = $("#"+dropzone_id).find(".dz-preview").length;          // 获取已放入的文件的数量
                    if(file_num==1){                                                                     // 通过已放入的文件的数量控制发布按钮是否可以点击
                        $("button[project_id="+project_id+"]").removeAttr("disabled");
                        $("button[project_id="+project_id+"]").bind("click", uploadHandle );
                        $('.dropzone.dz-started .dz-message').css('opacity','0');
                        $("button[project_id="+project_id+"]").css("color","#fff");                   //  将提交作品按钮变色
                        $("button[project_id="+project_id+"]").css("background","#1F8CBE");          //  将提交作品按钮变色
                    }else{
                        $("button[project_id="+project_id+"]").attr("disabled","disabled");
                        $("button[project_id="+project_id+"]").css("color","rgba(205, 207, 209, 1)");                   //  将提交作品变回原来的颜色
                        $("button[project_id="+project_id+"]").css("background","rgba(247, 249, 250, 1)");          //  将提交作品变回原来的颜色
                    }

                }),               
                this.on("success", function(file,data) {                    // 文件成功上传之后发生，第二个参数为服务器响应。
                    file.file_id = data.id;                                      //赋值file_id便于删除操作
                    var html = "<input type='hidden'  name='file_id[]' id='file-"+data.id+"' value='"+data.id+"'/>"
                    $("#"+file_update_id).append(html);
                    $('.dropzone.dz-started .dz-message').css('opacity','0');

                    //    显示已上传文件信息
                    $(".accepttasks_photo_box_lianjie_fj[project_id="+project_id+"]").show();
                    var filesize= $("#"+dropzone_id).find(".dz-size").text();                                         
                    $(".fjdx_size[project_id="+project_id+"]").text(filesize);

                    $("label[project_id="+project_id+"]").text("重新上传");                                                              // 根据id值将上传变为重新上传

                    $.ajax({
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/user/fileAjax',
                        data: {'fileid':data.id,'workid':project_id,'task_id':task_id},
                        dataType:'json',
                        success: function(data){
                            console.log(data);
                            $(".close_btn").click();
                        },
                        error: function(data){
                            console.log(data);
                        },
                    });
                   

                });
                this.on("removedfile", function(file) {                           // 一个文件被移除时发生。你可以监听这个事件并手动从服务器删除这个文件。
                    var delete_url = $("#"+dropzone_id).attr('deleteurl');
                    //只有当文件上传成功之后才能发出删除请求
                    var file_num = $("#"+dropzone_id).find(".dz-preview").length;          // 获取已放入的文件的数量
                    if(file_num==1){                                                                  // 通过已放入的文件的数量控制发布按钮是否可点击
                        $('.dropzone.dz-started .dz-message').css('opacity','0');
                        $("button[project_id="+project_id+"]").css("color","#fff");                   //  将提交按钮作品按钮变色
                        $("button[project_id="+project_id+"]").css("background","#1F8CBE");          //  将提交按钮作品按钮变色
                        $("button[project_id="+project_id+"]").removeAttr("disabled");
                        $("button[project_id="+project_id+"]").bind("click", uploadHandle );
                    }else{
                        $('.dropzone.dz-started .dz-message').css('opacity','1');
                        $("button[project_id="+project_id+"]").css("color","rgba(205, 207, 209, 1)");                   //  将提交按钮作品变回原来的颜色
                        $("button[project_id="+project_id+"]").css("background","rgba(247, 249, 250, 1)");          //  将提交按钮作品变回原来的颜色
                        $("button[project_id="+project_id+"]").attr("disabled","disabled");
                    }

                    if(file.file_id!=undefined){                               //只有当文件上传成功之后才能发出删除请求
                        $.get(delete_url,{'id':file.file_id},function(data){
                        });
                    }
                });
            }
        });
        for(var i in initimage){                                               //    循环遍历回显图片
            var mockFile = {name: ""+initimage[i].name+"", accepted:true, size:initimage[i].size*1024,file_id:initimage[i].id};
            $("#"+dropzone_id).dropzone.emit("addedfile", mockFile);                             //   将  mockFile数组放入addedfile （添加了一个文件时发生）事件中
        }
        uploadHandle = function() {
            myDropzone.processQueue();                                                           // 开启文件上传
            $("button[project_id="+project_id+"]").unbind("click", uploadHandle );                           
        }; 
        $("#"+upload_id).on('hidden.bs.modal', function () {
            // myDropzone.destroy();                                                              //   销毁dropzone实例
        });
    });
    // layer.js插件
    // layer.config({
    //     skin: 'demo-class'
    //   })
    // 接受委托模态框
    $(".accept").on("click", function(){
        var xmid = $(this).attr("xmid");
        layer.open({
            type: 1,
            closeBtn: 1,
            skin: 'demo-class',
            btnAlign: 'c',
            title:'',
            shadeClose:true,
            fix: false,
            scrollbar: false,
            area: ['500px', '300px'],
            btn: ['确定', '取消'],
            content: '是否接受该项目的委托？',
            yes: function (layero, index) {
                layer.close(layer.index);
                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/user/hireProject',
                    data: {id:xmid},
                    dataType:'json',
                    success: function(data){
                        $("#"+xmid).children(".myproject_photo_box_lianjie").children(".myproject_photo_box_lianjie_cxfb").remove();
                        $("#"+xmid).children(".myproject_photo_box_lianjie").children(".myproject_photo_box_lianjie_scxm").remove();
                        layer.msg("承接项目成功！");
                    },
                    error: function(data){
                    }
                });
            },
            btn2: function(index, layero){
            },
            cancel: function (index) {
            },
        });
    });

    // 拒绝委托模态框
    $(".refuse").on("click", function(){
        var xmid = $(this).attr("xmid");
        layer.open({
            type: 1,
            closeBtn: 1,
            btnAlign: 'c',
            skin: 'demo-class',
            title:'',
            shadeClose:true,
            fix: false,
            scrollbar: false,
            area: ['500px', '300px'],
            btn: ['确定', '取消'],
            content: '确定拒绝该项目的委托？拒绝后，您将不能再次申请该项目。',
            yes: function (layero, index) {
                layer.close(layer.index);
                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/user/refuseProject',
                    data: {id:xmid},
                    dataType:'json',
                    success: function(data){
                        $("#"+xmid).remove();
                    }
                });
            },
            btn2: function(index, layero){
            },
            cancel: function (index) {
            },
        });
    });

    

    //   鼠标滑入显示上传tips

    var tip_index = 0;
    $(".zpsc").on('mouseover',function(){
        var that = this;
        var zpsc_tips = 
        '<div class="zpsc_tips">'+
            '<h4>'+'1.请上传rar或者zip格式的压缩文件！'+'</h4>'+
            '<h4>'+'2.最多上传一个压缩文件！'+'</h4>'+
        '</div>';
        tip_index =layer.tips(zpsc_tips,that,{tips:[1,'#fff'],time:0,area: ['310px','154px'],skin: 'demo-class',maxWidth:500});
    }).on('mouseout', function(){
        layer.close(tip_index);
    });

})








// 鼠标滑入显示tips

function hoverTip(divname,tipname){
    $(divname).hover(function(){
        $(this).children(tipname).css("display","flex");
    },function(){
        $(this).children(tipname).css("display","none");
    });
}

//  取小数点后两位
function f(num,n){ 
    return parseInt(num*Math.pow(10,n)+0.5,10)/Math.pow(10,n); 
  } 

// 鼠标点击显示已上传列表
function checkUploaded(obj){
$("#xunhuan_tbody").empty();   
var file_name = $(obj).children(".file_name");//通过jQuery获得一组元素
for (var i = 0; i < file_name.length; i++) {
    var trs = '';
    trs += '<tr>';
    trs += '<td>' + file_name.eq(i).attr("name") + '</td>';
    trs += '<td>' + file_name.eq(i).attr("creatime") + '</td>';
    trs += '</tr>';
    $("#xunhuan_tbody").append(trs);
}
layer.open({
    type: 1,
    title: '',
    skin: 'checkUploaded_class',
    shadeClose:true,
    fix: false,
    scrollbar: false,
    shadeClose: true, //点击遮罩关闭层
    area : ['420px' , '400px'],
    content: $("#uploaded_list_layer"),
}); 
}




// 点击确定设置一次/二次结款
function determeSet(id){
    var task_id = $(this).attr("task_id");
    var value = $("input[type='radio']:checked").attr("value");
    // console.log(id);
    // console.log(name);
    // console.log(value);
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/user/wayProject',
        data: {id:id,way:value},
        dataType:'json',
        success: function(data){
            $("#"+id).find(".myproject_photo_box_jindu_miaoshu").eq(2).empty();                //清空第三个描述中的节点
            var miaoshu =   '<div class="myproject_photo_box_jindu_dayuan bodercolorcg_red">'+
                                '<div class="myproject_photo_box_jindu_xiaoyuan backgroundcolorcg_red"></div>'+
                            '</div>'+
                            '<div class="myproject_photo_box_jindu_text colorchange_red">'+'进行'+'</div>';
            $("#"+id).find(".myproject_photo_box_jindu_miaoshu").eq(2).append(miaoshu);          // 将更改的节点插入进第三个描述            
            $("#"+id).children(".myproject_photo_box_buzhou").empty();                           // 清空步骤中的节点
            var buzhou ='<div class="myproject_photo_box_buzhou_box jxtz_chang">'+
                            '<div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">'+'开始'+'</div>'+
                            '<div class="myproject_photo_box_buzhou_box_xhy qiaoliang colorchange_white backgroundcolorcg_green">'+'1'+
                                '<div class="xmjxzhengxian_chang"></div>'+
                            '</div>'+
                            '<div class="myproject_photo_box_buzhou_box_bzms colorchange_black">'+'项目准备'+'</div>'+
                        '</div>'+
                        '<div class="myproject_photo_box_buzhou_box">'+
                            '<div class="myproject_photo_box_buzhou_box_bzxh colorchange_black">'+'未验收'+'</div>'+
                            '<div class="myproject_photo_box_buzhou_box_xhy colorchange_black">'+'2'+'</div>'+
                            '<div class="myproject_photo_box_buzhou_box_bzms colorchange_black">'+'第一阶段'+'</div>'+
                        '</div>';
            $("#"+id).children(".myproject_photo_box_buzhou").append(buzhou);                  // 将更改的节点插入进步骤中
            var upload_id = "upload_"+id;
            var dropzone_id = "dropzone_"+id;
            var url="www.meishimeitu.com/task/fileUpload";
            var deleteurl ="www.meishimeitu.com/task/fileDelet";
            var project_id = id;
            var file_update_id = "file_update_"+id;
            var lianjie =   '<div id="'+upload_id+'" tabindex="-1" role="dialog"  class="modal fade annex">'+
                                '<div  class="dropzone clearfix" id="'+dropzone_id+'" url="'+url+'" deleteurl="'+deleteurl+'">'+
                                    '<div class="fallback">'+
                                        '<input name="file" type="file"/>'+
                                    '</div>'+
                                '</div>'+
                                '<button  class="abc" disabled="true" project_id="'+project_id+'">提交作品</button>'+
                                '<button  class="shutdown" data-dismiss="modal">关闭</button>'+
                            '</div>'+
                            '<div class="file_update" id="'+file_update_id+'"></div>'+
                            '<label class="zpsc"  data-toggle="modal" data-target="#'+upload_id+'" project_id="'+project_id+'" task_id="'+task_id+'">上传</label>'+
                            '<div class="accepttasks_photo_box_lianjie_fj" project_id="'+project_id+'">'+
                                    '<i class="fa fa-link" aria-hidden="true"></i>'+
                                    '<span class="fjdx">'+'附件1个（'+
                                    '<span class="fjdx_size" project_id="'+id+'"></span>'+
                                        +'）'+
                                    '</span>'+
                            '</div>';
            $("#"+id).children(".myproject_photo_box_lianjie").children(".myproject_photo_box_lianjie_cxfb").remove(); 
            $("#"+id).children(".myproject_photo_box_lianjie").prepend(lianjie);
            layer.msg("设置成功！");
        }
    });
}






