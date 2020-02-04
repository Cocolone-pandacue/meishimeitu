
jQuery(function($){
    var url = $('#dropzone').attr('url');
    Dropzone.autoDiscover = false;
    var attatchment_allow = 1;
    try {
        var myDropzone = new Dropzone("#dropzone" , {
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize:  uploadRule.size, // MB
            maxFiles: maxFiles,
            dictMaxFilesExceeded:'你最多能上传'+maxFiles+'个文件',
            dictFileTooBig:'你上传的文件过大',
            addRemoveLinks : true,       //在每个预览文件下面添加一个remove[删除]或者cancel[取消](如果文件已经上传)上传文件的链  接
            dictRemoveFile:'删除文件',
            dictCancelUpload:'取消上传',
            hiddenInputContainer:"<input type='hidden'  name='file_id[]' value='1'/>",
            acceptedFiles:extensions,                //   可接受的文件类型
            dictDefaultMessage :                       // 改变文件框中的文字提示
                '  <i class="upload-icon ace-icon fa fa-cloud-upload fa-3x"></i><br>\
               最多可添加'+maxFiles+'个附件，每个大小不超过'+uploadRule.size+'MB'
            ,
            dictResponseError: 'Error while uploading file!',                  // 如果服务器响应是无效的时候显示的错误消息。 {{statusCode}} 将被替换为服务器端返回的状态码。
            //change the previewTemplate to use Bootstrap progress bars
            init: function() {
                // this.emit("initimage", initimage);
                // this.on("addedfile", function(files) { 
                    
                //     var yxnumber = 0;
                //     yxnumber = $(".fbxm_shanchu").length;
                //     var allnum = this.files.length + yxnumber ;
                //     if (allnum>3){
                //         alert("超过3个了");
                //         this.disable();
                //       }
                // });
                this.on("success", function(file,data) {                    // 文件成功上传之后发生，第二个参数为服务器响应。
                    file.file_id = data.id;//赋值file_id便于删除操作
                    var html = "<input type='hidden'  name='file_id[]' id='file-"+data.id+"' value='"+data.id+"'/>"
                    $('#file_update').append(html);
                    /*$('#dropzone').children().last('div').children('a').attr('file-id',data.id);
                     $('#dropzone').children().find('div.dz-success').children('a').on('click',function(){
                     var index = $(this).parent().index();
                     });*/
                     $('.dropzone.dz-started .dz-message').css('opacity','1');
                });
                this.on("removedfile", function(file) {                           // 一个文件被移除时发生。你可以监听这个事件并手动从服务器删除这个文件。
                    var delete_url = $('#dropzone').attr('deleteurl');
                    //只有当文件上传成功之后才能发出删除请求
                    if(file.file_id!=undefined){                               //只有当文件上传成功之后才能发出删除请求
                        $.get(delete_url,{'id':file.file_id},function(data){
                        });
                    }
                });
            }
        });
        for(var i in initimage){                                               //    循环遍历回显图片
            var mockFile = {name: ""+initimage[i].name+"", accepted:true, size:initimage[i].size*1024,file_id:initimage[i].id};
            myDropzone.emit("addedfile", mockFile);                             //   将  mockFile数组放入addedfile （添加了一个文件时发生）事件中
        }
    }catch(e) {
        alert('Dropzone.js does not support older browsers!');
    }
});