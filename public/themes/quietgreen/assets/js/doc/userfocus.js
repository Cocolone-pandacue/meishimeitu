

// function removeFocus(id)
// {
    
//     $.get('/user/userFocusDelete/'+id,function(data){
//         if(data.errCode==1){
//             $('#focus-remove-'+data.id).remove();
//             $('.gz_qx').hide();
//         }
//     });
// }

// function notFocus(obj)
// {
//     var id = obj.attr('uid');
//     $.get('/user/userNotFocus/'+id,function(data){
//         if(data.errCode==1){
//             obj.html('关注他');
//         }else if(data.errCode==0)
//         {
//             $.gritter.add({
//                 text: '<div><span class="text-center"><h5>' + '操作失败' + '</h5></span></div>',
//                 class_name: 'gritter-info gritter-center'
//             });
//         }
//     });
// }
// function doFocus(obj)
// {
//     var id = obj.attr('uid');
//     var type = obj.attr('type');
//     if(type==1){
//         $.get('/bre/ajaxAdd',{'focus_uid': id},function(data){
//             if(data.code==1){
//                 obj.html('取消关注');
//                 obj.attr('type',2);
//             }
//         });
//     }else if(type==2)
//     {
//         $.get('/user/userNotFocus/'+id,function(data){
//             if(data.errCode==1){
//                 obj.html('关注他');
//                 obj.attr('type',1);
//             }else if(data.errCode==0)
//             {
//                 $.gritter.add({
//                     text: '<div><span class="text-center"><h5>' + '操作失败' + '</h5></span></div>',
//                     class_name: 'gritter-info gritter-center'
//                 });
//             }
//         });
//     }
// }



// $(".myfocu_zr a").click(function(){
//     $(this).addClass("myfocu_zr_border");
//     $(this).siblings().removeClass("myfocu_zr_border");
// })



$(function(){
    //取消关注模态框

    $(".gz").on("click", function(){
        var kjid = $(this).attr("kjid");
        console.log(kjid);
        layer.open({
            type: 1,
            closeBtn: 1,
            btnAlign: 'c',
            title:'',
            skin: 'demo-class',
            shadeClose:true,
            fix: false,
            scrollbar: false,
            area: ['500px', '300px'],
            btn: ['确定', '取消'],
            content: '是否取消关注？',
            yes: function (layero, index) {
                layer.close(layer.index);
                $.ajax({
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/bre/ajaxDel',
                    data: {focus_uid:kjid},
                    dataType:'json',
                    success: function(data){
                        $("#focus_remove_"+kjid).remove();
                        layer.msg("取消关注成功！");
                        //关注数减一
                        var focusNum=$('.foucusman_photo_biaoti').children('span').text();
                        // console.log(focusNum);
                        $('.foucusman_photo_biaoti').children('span').text(parseInt(focusNum) - parseInt(1));
                    },
                    error: function(data){
                        alert(2);
                    }
                });
            },
            btn2: function(index, layero){
            },
            cancel: function (index) {
            },
        });
    });
});


