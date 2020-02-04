

/*$('.usernopd-aircle').hover(function(){
	
	$('.foc-hov').toggle();
	
});*/
$(function(){
    $(".g-reletaskhd .g-releasechart").on('click',function(){

        $('.g-reletaskhd .g-releasehide').toggle();
        $('.g-reletaskhd .g-releasehidea').toggle();
    });
//onerror加载默认图片
    function onerrorImage(url,obj)
    {
        obj.attr('src',url);
    }

    $('.delete_goods').on('click',function(){
        var id = $(this).parent('p').attr('data-id');
        $('#goods_id').val(id);
    });
    $('#btn_primary').on('click',function(){
        var id = $('#goods_id').val();
        var type = 5;
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/changeGoodsStatus',
            data: {id:id,type:type},
            dataType:'json',
            success: function(data){
                if(data.code == 1){
                    location.reload();
                }else{
                    $.gritter.add({
                        text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                        class_name: 'gritter-info gritter-center'
                    });
                }
            }
        });
    });
    //切换地址
    $('.deleteService').on('click',function(){
        var url = $(this).attr('url');
        $('#btn_links').attr('url',url);
    });
    $('#btn_links').on('click',function(){
        var url = $(this).attr('url');
        window.location.href = url;
    })
})

// 模态框居中

// function divCenter(divname){
//     var top = ($(window).height() - $(divname).height())/2;   
//     var left = ($(window).width() - $(divname).width())/2;   
//     var scrollTop = $(document).scrollTop();   
//     var scrollLeft = $(document).scrollLeft(); 
//     var addtop =  top + scrollTop;
//     var addleft = left + scrollLeft;
//     $(divname).css( { 'position' : "absolute", 'top' : ""+addtop+"px", 'left': ""+addleft+"px" } );  
// };

//改变商品状态
function changeGoodsStatus(obj){
    var type = $(obj).attr('data-values');
    var id = $(obj).parent('p').attr('data-id');
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/user/changeGoodsStatus',
        data: {id:id,type:type},
        dataType:'json',
        success: function(data){
            if(data.code == 1){
                location.reload();
            }else{
                $.gritter.add({
                    text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                    class_name: 'gritter-info gritter-center'
                });
            }
        }
    });
}

// 单选框的样式

$(".yssz .yssz_radio:checked").parent().addClass("yssz_click").siblings().removeClass("yssz_click");
$(".yssz").click(function(){
    $(".yssz_radio:checked").parent().addClass("yssz_click");
    $(".yssz_radio:checked").parent().siblings().removeClass("yssz_click");
});




//  我的项目  js

//  控制鼠标滑入头像显示弹窗

// $(".txlb>div").hover(function(){
//     var txxt = '<div class="txxt">'+
//                     '<div class="txxt_one">'+
//                         '<img src="{!! Theme::asset()->url("images/头像1.png") !!}" alt="" class="tx">'+
//                     '</div>'+
//                     '<div class="txxt_two">'+
//                         '<span class="txxt_two_area">'+'上海'+'</span>'+
//                         '<span class="txxt_two_shuxian"></span>'+
//                         '<span class="txxt_two_area">'+'平面设计师'+'</span>'+
//                     '</div>'+
//                     '<div class="guyong" data-toggle="modal" data-target="#myDeSigner" onclick="divCenter()">'+'雇佣'+'</div>'+
//                     '<div class="jujue">'+'拒绝'+'</div>'+
//                 '</div>';
//     $(this).append(txxt);
// },function(){
//     $(this).children(".txxt").remove();
// });

// $(".moretx>div").hover(function(){
//     var txxt = '<div class="txxt">'+
//                     '<div class="txxt_one">'+
//                         '<img src="{!! Theme::asset()->url("images/头像1.png") !!}" alt="" class="tx">'+
//                     '</div>'+
//                     '<div class="txxt_two">'+
//                         '<span class="txxt_two_area">'+'上海'+'</span>'+
//                         '<span class="txxt_two_shuxian"></span>'+
//                         '<span class="txxt_two_area">'+'平面设计师'+'</span>'+
//                     '</div>'+
//                     '<div class="guyong" data-toggle="modal" data-target="#myDeSigner" onclick="divCenter()">'+'雇佣'+'</div>'+
//                     '<div class="jujue">'+'拒绝'+'</div>'+
//                 '</div>';
//     $(this).append(txxt);
// },function(){
//     $(this).children(".txxt").remove();
// });

//  点击更多图片显示更多头像弹窗

// $(".hdgd").click(function(){
//     $(".moretx").toggle();
//     });











