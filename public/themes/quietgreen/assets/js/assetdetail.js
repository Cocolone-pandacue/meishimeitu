/**
 * Created by R on 2016/6/14.
 */
jQuery(function($) {
    $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    $(document).on('click', 'th input:checkbox' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
    });


    $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('table')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }
    $('#allcheck').on('click',function(){
        if($(this).is(':checked')){
            $('[type="checkbox"]').prop('checked','true');
        }else{
            $('[type="checkbox"]').prop('checked','');
        }
    });

});
$('.input-daterange').datepicker({autoclose:true});
$("#bootbox-confirm").on(ace.click_event, function() {
    bootbox.confirm("Are you sure?", function(result) {
        if(result) {
            //
        }
    });
});

// 财务管理导航栏切换

$(".mymoney_xifen_leixing a").click(function(){
    $(this).addClass("mymoney_xifen_leixing_click");
    $(this).siblings().removeClass("mymoney_xifen_leixing_click");
    var mymoney_index = $(".mymoney_xifen_leixing a").index(this);
    if(mymoney_index==0){
        $(".wdzc").removeClass("hide").addClass("show");
        $(".szmx").removeClass("show").addClass("hide");
        $(".wycz").removeClass("show").addClass("hide");
        $(".wytx").removeClass("show").addClass("hide");
    }else if(mymoney_index==1){
        $(".szmx").removeClass("hide").addClass("show");
        $(".wdzc").removeClass("show").addClass("hide");
        $(".wycz").removeClass("show").addClass("hide");
        $(".wytx").removeClass("show").addClass("hide");
    }else if(mymoney_index==2){
        $(".wycz").removeClass("hide").addClass("show");
        $(".wdzc").removeClass("show").addClass("hide");
        $(".szmx").removeClass("show").addClass("hide");
        $(".wytx").removeClass("show").addClass("hide");
    }else if(mymoney_index==3){
        $(".wytx").removeClass("hide").addClass("show");
        $(".wdzc").removeClass("show").addClass("hide");
        $(".szmx").removeClass("show").addClass("hide");
        $(".wycz").removeClass("show").addClass("hide");
    }
})


/**
 * 充值表单验证
 */
var cashVal = $("input[name='cash']").val();
$(".cashform").Validform({
    btnSubmit:"#btn_sub",
    tiptype:4,
    showAllError:true,
    ajaxPost:true,
    datatype:{
        'cashValid':function(gets,obj,curform,regxp){
            var decimal = parseInt($("input[name='cash']").attr("data-recharge-min"));
                parseInt(gets);
            if(gets<decimal) {
                return false;
            }else{
                return  true;
            }
        },

    },
    beforeSubmit: function(curform){
        this.payWindow = window.open('about:blank', '_blank');
    },
    callback:function(data){
        if (data.code == 200){
            this.payWindow.location.href = data.data.url;
            $('#myModal').modal({
                keyboard: true
            });
            $("#verifyOrder").attr('data-url', '/finance/verifyOrder/' + data.data.orderCode);
        } else if (data.code == 201){
            this.payWindow.close();
            $("#cashtips").find(".Validform_checktip").replaceWith("<span class='Validform_checktip Validform_wrong'>" + data.message + "</span>");
        }
    }
});
/**
 * 验证订单状态
 */
$("#verifyOrder").on('click',function(){
    var url = $(this).attr('data-url');
    $.get(url, function(data){
        if (data.message == 'success'){
            window.location.href = data.data.url;
        }
    }, 'json');
});

function copyUrl(){
    if($('.extendbtn input').val() != ''){
        $('.extendbtn input').select();
        document.execCommand('Copy');
        $.gritter.add({
            text: '<span class="text-size14">复制成功！</span>',
            class_name: 'gritter-info gritter-center'
        });
    }else{
        $.gritter.add({
            text: '<span class="text-size14">复制失败！复制的内容不能为空！</span>',
            class_name: 'gritter-info gritter-center'
        });
    }
}

