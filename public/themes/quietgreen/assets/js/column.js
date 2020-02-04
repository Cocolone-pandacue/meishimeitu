$(function(){
// 进入页面执行函数
resizeHeight();

// 窗口尺寸变化时，触发函数
$(window).resize(function() {
    resizeHeight();
    // letDivCenter(".xiangmutanchuang_box");
});

hoverTip(".txlj",".tx_tips");
hoverTip(".zhuanlan_writer_tx_mz_tip",".tx_tips_another");


})


//  鼠标滑入显示tips框

function hoverTip(divname,tipname){
    $(divname).hover(function(){
        $(this).children(tipname).css("display","flex");
    },function(){
        $(this).children(tipname).css("display","none");
    });
}

//   获取窗口高度，100为顶部导航栏高度
function resizeHeight(){
    var bodyTop=$(window).height();
    $(".zhuanlan_lunbo").css('height', ''+bodyTop-100+'px');
    if($('.zhuanlan_lunbo').height()<=600){
        $(".zhuanlan_lunbo").css('height', '600px');
    }
}

function letDivCenter(divName){   
    var top = ($(window).height() - $(divName).height())/2-100;   
    var left = ($(window).width() - $(divName).width())/2-100;   
    var scrollTop = $(document).scrollTop();   
    var scrollLeft = $(document).scrollLeft();   
    $(divName).css( {'top' : top + scrollTop, 'left' : left + scrollLeft } );  
};