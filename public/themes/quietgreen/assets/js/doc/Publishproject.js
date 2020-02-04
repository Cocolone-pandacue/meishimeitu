$(function(){

// 鼠标滑入显示申请的设计师头像

hoverTip(".txlb_tx",".tx_tips_another");

function hoverTip(divname,tipname){
    $(divname).hover(function(){
        $(this).children(tipname).css("display","flex");
    },function(){
        $(this).children(tipname).css("display","none");
    });
}



// layer.js插件
// layer.config({
//     skin: 'demo-class'
//   })
// 是否删除项目
$(".myproject_photo_box_lianjie_scxm").on("click", function(){
    var xmid = $(this).attr("xmid");
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
        content: '是否删除项目？',
        yes: function (layero, index) {
            layer.close(layer.index);
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/user/myTasksListDel',
                data: {id:xmid},
                dataType:'json',
                success: function(data){
                    if(data.code == 1){
                        $("#"+xmid).remove();
                        //项目数量减一
                        var xmNum=$('.myproject_photo_biaoti').children('span').text();
                        $('.myproject_photo_biaoti').children('span').text(parseInt(xmNum) - parseInt(1));
                        layer.msg("删除项目成功");
                        // window.reload();
                    }else{
                        alert(2);
                    }
                }
            });
        },
        btn2: function(index, layero){
        },
        cancel: function (index) {
        },
    });
});
// 阶段结款模态框
$(".jk_layer").on("click", function(){
    var work_id = $(this).attr("work_id");
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
        area: ['570px', '300px'],
        btn: ['确定', '取消'],
        content: '验收完成将会支付总项目全部酬金给设计师！',
        yes: function (layero, index) {
            layer.close(layer.index);
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/task/checkAjax',
                data: {work_id:work_id},
                dataType:'json',
                success: function(data){
                    console.log(data);
                    $("#"+xmid).children(".myproject_photo_box_buzhou").children(".myproject_photo_box_lianjie").children(".jk_layer").remove();
                    layer.msg("验收成功");
                },
                error: function(data){
                        console.log(data);
                    layer.msg("参数错误");
                }
            });
        },
        btn2: function(index, layero){
        },
        cancel: function (index) {
        },
    });
});

// 是否雇佣模态框

$(".employ").on("click", function(){
    var task_uid = $(this).attr("task_uid");
    var xmid = $(this).attr("xmid");
    var designer_name = $(this).attr("designer_name");
    // console.log(task_uid);
    // console.log(xmid);
    layer.open({
        type: 1,
        closeBtn: 1,
        btnAlign: 'c',
        title:'',
        shadeClose:true,
        skin: 'demo-class',
        fix: false,
        scrollbar: false,
        area: ['570px', '300px'],
        btn: ['确定', '取消'],
        content: '是否雇佣'+designer_name+'来完成该项目？确定后不得修改，是否确定？',
        yes: function (layero, index) {
            layer.close(layer.index);
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/user/hireStylist',
                data: {id:xmid,uid:task_uid},
                dataType:'json',
                success: function(data){
                    if(data.code == 1){
                        $("#ygy_"+task_uid).siblings().remove();
                        var employed = '<div class="tips_anniu tips_anniu_employed">'+'已雇佣'+'</div>';
                        $("#ygy_"+task_uid).find(".guyong_jujue").empty();
                        $("#ygy_"+task_uid).find(".guyong_jujue").append(employed);
                        layer.msg("雇佣成功");
                    }else{
                        layer.msg("雇佣失败！")
                    }
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



// 点击拒绝雇佣设计师
function refuseDesigner(uid,id){
    // console.log(id);
    // console.log(uid);
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/user/refuseStylist',
        data: {id:id,uid:uid},
        dataType:'json',
        success: function(data){
            if(data.code == 1){
                $("#ygy_"+uid).remove();
            }else{
                alert(2);
            }
        }
    });
}

// 鼠标点击显示下载列表
function checkDownloadList(obj){
    $("#download_tbody").empty();   
    var file_name = $(obj).children(".download_name");//通过jQuery获得一组元素
    for (var i = 0; i < file_name.length; i++) {
        var trs = '';
        trs += '<tr>';
        trs += '<td>' + file_name.eq(i).attr("name") + '</td>';
        trs += '<td>' + file_name.eq(i).attr("creatime") + '</td>';file_name.eq(i).attr("href")
        trs += '<td>'+'<a href='+file_name.eq(i).attr("href")+'>'+'点击下载'+'</a>'+'</td>';
        trs += '</tr>';
        $("#download_tbody").append(trs);
    }
    layer.open({
        type: 1,
        title: '',
        skin: 'checkUploaded_class',
        shadeClose:true,
        fix: false,
        scrollbar: false,
        shadeClose: true, //点击遮罩关闭层
        area : ['520px' , '400px'],
        content: $("#download_list"),
    }); 
    }