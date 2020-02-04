/**
 * Created by kuke on 2016/4/27.
 */
/*$(function(){
    var passwordform = $(".passwordform").Validform({
        tiptype:4,
        label:".label",
        showAllError:true,
        datatype:{
            "e":/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
        },
    });

    passwordform.eq(0).config({
        ajaxurl:{
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }
    });
    passwordform.eq(1).config({
        ajaxurl:{
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }
    });
});*/

var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数
function sendPhoneCode(){
    curCount = count;
    var mobile = $("input[name='mobile']").val();
    if (mobile){
        InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
        var token = $('#btnSendCode').attr('token');
        $.post('/password/mobilePasswordCode',{'_token':token,'mobile':mobile}, function(msg){
            if (msg.success){
                $("#btnSendCode").attr('disabled', true);
            }
        }, 'json');
    }

}

//timer处理函数
function SetRemainTime() {
    if (curCount == 0) {
        window.clearInterval(InterValObj);//停止计时器
        $("#btnSendCode").removeAttr("disabled");//启用按钮
        $("#btnSendCode").val("重新获取");
    }
    else {
        curCount--;
        console.log(curCount);
        $("#btnSendCode").val("重新获取(" + curCount + ")");
    }
}

 $(function(){
               //获取短信验证码
    var validCode=true;
    $(".get_code").click (function  () {
        var time=60;
        var $code=$(this);
        if (validCode) {
            validCode=false;
            var t=setInterval(function  () {
                time--;
                $code.html(time+"秒");
                if (time==0) {
                    clearInterval(t);
                $code.html("重新获取");
                    validCode=true;
                }
            },1000)
        }
    })
})



//验证手机号
    function vailPhone(){
      var phone = jQuery("#phone").val();
      var flag = false;
      var message = "";
      var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;
      if(phone == ''){
        message = "手机号码不能为空！";
      }else if(phone.length !=11){
        message = "请输入有效的手机号码！";
      }else if(!myreg.test(phone)){
        message = "请输入有效的手机号码！";
      }else if(checkPhoneIsExist()){
        message = "该手机号码已经被绑定！";
      }else{
          flag = true;
      }
      if(!flag){
     //提示错误效果
        //jQuery("#phoneDiv").removeClass().addClass("ui-form-item has-error");
        jQuery("#phoneP").html("");
        jQuery("#phoneP").html("<i class=\"icon-error ui-margin-right10\"> <\/i>"+message);
        jQuery("#phone").focus();
      }else{
           //提示正确效果
        //jQuery("#phoneDiv").removeClass().addClass("ui-form-item has-success");
        jQuery("#phoneP").html("");
        jQuery("#phoneP").html("<i class=\"icon-success ui-margin-right10\"> <\/i>该手机号码可用");
      }
      return flag;
    }
