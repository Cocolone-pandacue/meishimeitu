$(function(){

    $('.g-taskmaintime').on('click',function(){
        if($(this).find('.fa').prop('class') == 'fa fa-long-arrow-down'){
            $(this).find('.fa').prop('class','fa fa-long-arrow-up');
            return;
        }else{
            $(this).find('.fa').prop('class','fa fa-long-arrow-down');
            return;
        }
    });

// var allow = 0;
// $('.u-collect').on('click',function(){
//     var collect = $(this);
//     var task_id = $(this).attr('data-id');
//     var type = $(this).attr('data-values');
//     if(task_id && type && allow==0){
//         allow=1;
//         $.ajax({
//             type: 'post',
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             url: '/task/collectionTask',
//             data: {task_id:task_id,type:type},
//             dataType:'json',
//             success: function(data){
//                 if(data.code == 1){
//                     if(type == 1){
//                         $.gritter.add({
//                             //            title: '消息提示：',
//                             text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
//                             class_name: 'gritter-info gritter-center'
//                         });
//                         collect.attr('data-values',2);
//                         collect.attr('style','color: rgb(255, 168, 30);');
//                     }else{
//                         $.gritter.add({
//                             //            title: '消息提示：',
//                             text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
//                             class_name: 'gritter-info gritter-center'
//                         });
//                         collect.attr('data-values',1);
//                         collect.attr('style','');
//                     }
//                 }else{
//                     $.gritter.add({
//                         //            title: '消息提示：',
//                         text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
//                         class_name: 'gritter-info gritter-center'
//                     });
//                 }
//                 allow=0;
//             }
//         });
//     }
// });


    // 下拉菜单控制
    $(".dropdown").mouseover(function () {
        $(this).children(".dropdown-menu").show();
    });

    $(".dropdown").mouseleave(function(){
        $(this).children(".dropdown-menu").hide();
    });


});



// 项目库 点击申请 AJAX
function getProject(id,obj){
    // alert(id);
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/task/myTasksAsk ',
        data: {id:id},
        dataType:'json',
        success: function(data){
            // console.log(data);
            if(data.code == 1){
                letDivCenter('#model');
                setTimeout('test()',2000); 
                $(obj).removeClass("box_yangben_yangshi_xia_shenqing");
                $(obj).addClass("box_yangben_yangshi_xia_yishenqing");
                $(obj).html("已经申请");
            }else{
                layer.msg('重复请求');
            }
        }
    });
}

function toSheJiShi(){
    layer.open({
        type: 1,
        closeBtn: 1,
        btnAlign: 'c',
        skin: 'demo-class',
        title:'',
        shadeClose:true,
        fix: false,
        scrollbar: false,
        area: ['325px','115px'],
        content: $('.toSheJiShi'),
        success: function (layero, index) {
            
        },
    });
}

function toVipMenber(){
    layer.open({
        type: 1,
        closeBtn: 1,
        btnAlign: 'c',
        skin: 'demo-class',
        title:'',
        shadeClose:true,
        fix: false,
        scrollbar: false,
        area: ['325px','115px'],
        content: $('.toVip'),
        success: function (layero, index) {
            
        },
    });
}




function test(){
    $("#model").hide();      // 等待审核提示隐藏
}; 













    


 