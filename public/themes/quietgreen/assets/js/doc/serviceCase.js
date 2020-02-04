$(function() {
//   是否关注弹框/取消关注
$(".focus").on("click", function(){
    var focus_uid = $(this).attr("focus_uid");
    if(!$(".focus").hasClass("alfocus")){
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
            content: '是否关注？',
            yes: function (layero, index) {
                layer.close(layer.index);
                $.ajax({
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/bre/ajaxAdd',
                    data: {focus_uid:focus_uid},
                    dataType:'json',
                    success: function(data){
                        if(data.code == 1){
                            $(".focus").addClass("alfocus");
                            $(".focus").text("已关注");
                            layer.msg('关注成功')
                        }else{
                            layer.msg('关注失败')
                        }
                    }
                });
            },
        });
    }
    if($(".focus").hasClass("alfocus")) {
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
                    data: {focus_uid:focus_uid},
                    dataType:'json',
                    success: function(data){
                        if(data.code == 1){
                            $(".focus").removeClass("alfocus");
                            $(".focus").text("关注");
                            layer.msg('取消关注成功');
                            
                        }else{
                            layer.msg('取消关注失败');
                        }
                    }
                });
            },
        });
    }
});


})


//评论
function ajaxComment(obj)
{
    var token = obj.attr("token");
    var suid = obj.attr("suid");
    var url = obj.attr("url");
    var delurl =obj.attr("url");
    var comment = $("#comment_id").val();
    if(comment==""){
        layer.msg("请输入评论！");
        return;
    };

    var pid = 0;
    var rid = 0;

    var warning_src = $(".warning").attr("src");
    var dialog_src = $(".dialog").attr("src");
    var like_src = $(".like").attr("src");
    var garbage_src = $(".garbage").attr("src");

    console.log(suid);
    console.log(url);
    console.log(comment);


    $.post(url,{'_token':token,'suid':suid,'comment':comment,'pid':pid,'rid':rid,processData:false,},function(data){
    if(data.errCode==1){
            var html = '';
            html +=
            '<div class="comment_box" id="'+data.id+'">'+
                '<div class="flex_buju">'+
                    '<div class="">'+
                        '<img  class="user_photo" src="'+data.avatar_md5+'">'+
                    '</div>'+
                    '<div class="width_1064 width_1064">'+
                        '<div class="inline_block">'+
                            '<span class="user_name">'+data.nickname+'</span>'+
                            '<span class="create_time">'+data.created_at+'</span>'+
                        '</div>'+
                        '<div class="block padding_bottom_20">'+
                            '<span class="comment_content">'+data.comment+'</span>'+
                        '</div>'+
                        '<div class="flex_buju">'+
                            '<div></div>'+
                            '<div class="">'+
                                '<img src="'+dialog_src+'" suid="'+suid+'" alt="" delurl="'+delurl+'" class="dialog" comment_id="'+data.id+'" onclick = "showRepeat($(this))">'+
                                '<img src="'+garbage_src+'" alt="" class="garbage" delurl="'+delurl+'"  decid="'+data.id+'" token="'+token+'"  onclick = "deleteComment($(this))">'+
                            '</div>'+
                        '</div>'+
                        '<div class="deblock dehide inputxt repeat_id" id = "comment_'+data.id+'">'+
                            '<input class="input_comment" type="text" placeholder="" name="repeat" id = "value_'+data.id+'">'+
                            '<div class="flex_buju">'+
                                '<div class=""></div>'+
                                '<button class="repeat_btn" zid = "'+data.id+'" pid="'+data.id+'" delurl="'+delurl+'" rid="'+data.rid+'" url="'+url+'" type="button" suid = "'+suid+'" token="'+token+'" onclick="rePeat($(this))">'+'回复'+'</button>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'
            ;

        $(".comment_count").after(html).removeClass("dehide");
        $(".no_comment").hide();
        $("#comment_id").val("");
        $('.comment_count').children('comment_count_num').html("1");
        //回复加一
        var replyNum=$('.comment_count').children('span').text();
        console.log(replyNum);
        $('.comment_count').children('span').text(parseInt(replyNum) + parseInt(1));
        }else if(data.errCode==0){
            layer.msg('评论失败');
        }
    });
}

// 置空value值

function emptyValue(){
    $(".input_comment").val("");
    $(".input_repeat").val("");
}


// 点击回复icon，显示回复主评论输入框

function showRepeat(obj){
    var  comment_id = obj.attr("comment_id");
    $("#comment_"+comment_id).toggle();
}

// 点击回复icon，显示回复回复输入框

function showRepeatRe(obj){
    var  comment_id = obj.attr("comment_id");
    $("#comment_"+comment_id).toggle();
}

// 点击回复按钮，上传评论回复内容    即回复主评论（一级回复）

function rePeat(obj){

    var pid = obj.attr("pid");
    var zid = obj.attr("zid");
    var rid = obj.attr("rid");
    var token = obj.attr("token");
    var suid = obj.attr("suid");
    var url = obj.attr("url");
    var delurl =obj.attr("url");
    var comment = $("#value_"+zid).val();
    if(comment==""){
        layer.msg("请输入评论！");
        return;
    };


    var warning_src = $(".warning").attr("src");
    var dialog_src = $(".dialog").attr("src");
    var like_src = $(".like").attr("src");
    var garbage_src = $(".garbage").attr("src");

    console.log(token);
    console.log(suid);
    console.log(url);
    console.log(comment);


    $.post(url,{'_token':token,'suid':suid,'comment':comment,'pid':pid,'rid':rid,processData:false,},function(data){
    if(data.errCode==1){
        console.log(data);
            var html = '';
            html +=
            '<div class="flex_buju margin_de">'+
                '<div></div>'+
                '<div class="repeatBox">'+
                    '<div class="flex_buju">'+
                        '<div class="">'+
                            '<img src="'+data.avatar_md5+'" alt="" class="user_photo margin_40">'+
                        '</div>'+
                        '<div class="width_970 height_auto">'+
                            '<div class="inline_block">'+
                                '<span class="user_name">'+data.nickname+'</span>'+
                                '<span class="create_time">'+data.created_at+'</span>'+
                            '</div>'+
                            '<div class="block padding_bottom_20">'+
                                '<span class="comment_content">'+data.comment+'</span>'+
                            '</div>'+
                            '<div class="flex_buju">'+
                                '<div></div>'+
                                '<div class="">'+
                                    '<img src="'+dialog_src+'" alt="" class="dialog" delurl="'+delurl+'" comment_id="'+data.id+'" onclick = "showRepeatRe($(this))">'+
                                    '<img src="'+garbage_src+'" alt="" class="garbage" delurl="'+delurl+'" decid="'+data.id+'" token="'+token+'"  onclick = "deleteRepeat($(this))">'+
                                '</div>'+
                            '</div>'+
                            '<div class="deblock inputxt dehide margin_10"  id = "comment_'+data.id+'">'+
                                '<input class="input_repeat"  type="text" placeholder="" name="repeat" id = "value_'+data.id+'">'+
                                '<div class="flex_buju">'+
                                    '<div class=""></div>'+
                                    '<button class="repeat_btn" pid="'+data.pid+'" rid="'+data.rid+'" delurl="'+delurl+'" zid="'+data.id+'"  url="'+url+'" type="button" suid = "'+suid+'" task_id="" token="'+token+'" onclick="rePeatRe($(this))">'+'回复'+'</button>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'
            ;
            $(".inputxt").css("display","none");
        $("#"+pid).after(html);
        emptyValue(); 
        //回复加一
        var replyNum=$('.comment_count').children('span').text();
        $('.comment_count').children('span').text(parseInt(replyNum) + parseInt(1));
    }else if(data.errCode==0){
        layer.msg('回复成功');
    }
    });
}


// 点击回复按钮，上传回复回复内容    二级回复及以上

function rePeatRe(obj){

    var pid = obj.attr("pid");
    var zid = obj.attr("zid");
    var token = obj.attr("token");
    var suid = obj.attr("suid");
    var url = obj.attr("url");
    var delurl =obj.attr("url");
    var comment = $("#value_"+zid).val();
    if(comment==""){
        layer.msg("请输入评论！");
        return;
    };

    var warning_src = $(".warning").attr("src");
    var dialog_src = $(".dialog").attr("src");
    var like_src = $(".like").attr("src");
    var garbage_src = $(".garbage").attr("src");

    console.log(token);
    console.log(suid);
    console.log(url);
    console.log(comment);


    $.post(url,{'_token':token,'suid':suid,'comment':comment,'pid':pid,'rid':zid,processData:false,},function(data){
    if(data.errCode==1){
        console.log(data);
            var html = '';
            html +=
            '<div class="flex_buju margin_de" id = "cmt'+data.id+'">'+
                '<div></div>'+
                '<div class="repeatBox">'+
                    '<div class="flex_buju">'+
                        '<div class="">'+
                            '<img src="'+data.avatar_md5+'" alt="" class="user_photo margin_40">'+
                        '</div>'+
                        '<div class="width_970 height_auto">'+
                            '<div class="inline_block">'+
                                '<span class="user_name">'+data.nickname + " 回复 " + data.parent_user +'</span>'+
                                '<span class="create_time">'+data.created_at+'</span>'+
                            '</div>'+
                            '<div class="block padding_bottom_20">'+
                                '<span class="comment_content">'+data.comment+'</span>'+
                            '</div>'+
                            '<div class="flex_buju">'+
                                '<div></div>'+
                                '<div class="">'+
                                    '<img src="'+dialog_src+'" alt="" class="dialog" delurl="'+delurl+'" comment_id="'+data.id+'" onclick = "showRepeatRe($(this))">'+
                                    '<img src="'+garbage_src+'" alt="" class="garbage" delurl="'+delurl+'" comment_id="'+data.id+'"  decid="'+data.id+'" token="'+token+'"   onclick = "deleteRepeat($(this))">'+
                                '</div>'+
                            '</div>'+
                            '<div class="deblock inputxt dehide margin_10"  id = "comment_'+data.id+'">'+
                                '<input class="input_repeat" type="text" placeholder="" name="repeat" id = "value_'+data.id+'">'+
                                '<div class="flex_buju">'+
                                    '<div class=""></div>'+
                                    '<button class="repeat_btn" pid="'+data.pid+'" delurl="'+delurl+'" rid="'+data.rid+'" zid="'+data.id+'" url="'+url+'" type="button" suid = "'+suid+'" task_id="" token="'+token+'" onclick="rePeatRe($(this))">'+'回复'+'</button>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'
            ;
            $(".inputxt").css("display","none");

        $("#"+pid).after(html);
        emptyValue(); 
        //回复加一
        var replyNum=$('.comment_count').children('span').text();
        $('.comment_count').children('span').text(parseInt(replyNum) + parseInt(1));
    }else if(data.errCode==0){
        layer.msg("回复失败");
    }
    });
}

//   点击删除icon，删除评论或回复

function deleteRepeat(obj){
    var decid = obj.attr("decid");
    var token = obj.attr("token");
    var delurl = obj.attr("delurl");
    console.log(decid);
    console.log(token);
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: delurl,
        data: {id:decid},
        dataType:'json',
        success: function(data){
            if(data.code==1){
                console.log(data);
                obj.parents(".flex_buju").remove();
                layer.msg('删除回复成功');
                //回复减一
                var replyNum=$('.comment_count').children('span').text();
                $('.comment_count').children('span').text(parseInt(replyNum) - parseInt(1));
            }else if(data.code==0){
                layer.msg('删除回复失败');
            }
        }
    });
}


//   点击删除icon，删除评论或回复
function deleteComment(obj){
    var decid = obj.attr("decid");
    var token = obj.attr("token");
    var delurl = obj.attr("delurl");
    console.log(decid);
    console.log(token);
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: delurl,
        data: {id:decid},
        dataType:'json',
        success: function(data){
            if(data.code==1){
                console.log(data);
                obj.parents(".comment_box").remove();
                layer.msg('删除评论成功');
                //回复减一
                var replyNum=$('.comment_count').children('span').text();
                $('.comment_count').children('span').text(parseInt(replyNum) - parseInt(1));
            }else if(data.code==0){
                layer.msg('删除评论成功');
            }
        }
    });
}


// 鼠标点击显示私信弹框
function message(obj){
    var uid =obj.attr("uid");
    var url =obj.attr("url");
    
    console.log(uid);
    layer.open({
        type: 1,
        title: '',
        shadeClose:true,
        fix: false,
        scrollbar: false,
        shadeClose: true, //点击遮罩关闭层
        area : ['570px' , '458px'],
        content: $("#message"),
        btn: ['发送'],
        yes: function (layero, index) {
            layer.close(layer.index);
            var message_input_value =$("#message_input").val();
            var message_textarea_value =$("#message_textarea").val();
            console.log(message_input_value);
            console.log(message_textarea_value);
            if (message_input_value!=""&&message_textarea_value!="") {
                $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                data: {title:message_input_value,content:message_textarea_value,js_id:uid},
                dataType:'json',
                success: function(data){
                    if(data.code == 1){
                        layer.msg('发送成功');
                        $("#message_input").val("");
                        $("#message_textarea").val("");
                    }
                },
                error: function(data){
                    if(data.code == 0){
                        layer.msg('发送失败');
                    }
                }
            });
            }else{
                layer.msg('发送失败，请输入文本！');
            }
        },
    }); 
    }



    // 鼠标点击收藏/取消收藏
function enshrine(obj){
    var goods_id =obj.attr("goods_id");
    console.log(goods_id);
    if(obj.hasClass("shou_yes")){
        $.get('/task/ajaxGoodDel', {'goods_id': goods_id}, function (data) {
            if (data.code == 1) {
                obj.text("收藏");
                obj.removeClass("shou_yes");
                layer.msg('取消收藏成功');
            }else{
                layer.msg('取消收藏失败');
            }
        });
        //回复减一
        var replyNum=$('.mywork_photo_littlebox_icon_shoucangshu').children("span").text();
        console.log(replyNum);
        $('.mywork_photo_littlebox_icon_shoucangshu').children("span").text(parseInt(replyNum) - parseInt(1));
    }
    if(!obj.hasClass("shou_yes")){
        $.get('/task/ajaxGoodAdd', {'goods_id': goods_id}, function (data) {
            if (data.code == 1) {
                obj.text("已收藏");
                obj.addClass("shou_yes");
                layer.msg('收藏成功');
            }else{
                layer.msg('收藏失败');
            }
        });
        //回复加一
        var replyNum=$('.mywork_photo_littlebox_icon_shoucangshu').children("span").text();
        console.log(replyNum);
        $('.mywork_photo_littlebox_icon_shoucangshu').children("span").text(parseInt(replyNum) + parseInt(1));
    }
    }