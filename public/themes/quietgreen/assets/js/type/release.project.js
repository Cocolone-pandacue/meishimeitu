/*
* @Author: Marte
* @Date:   2018-07-10 16:34:28
* @Last Modified by:   Marte
* @Last Modified time: 2019-01-25 17:31:33
*/

'use strict';
$(function(){
  getBar();
  computingTime();


  // 控制上传文字显示与隐藏
  if($('.fbxm_shanchu').length>0||$(".hdjstp p").length>0){
    $(".yishangchuan").show();
  }else{
    $(".yishangchuan").hide();
  };

  $("form").submit(function () {
    if($(".xy").is(':checked')){
      return true;
    } else {
      layer.msg("请同意并遵守《美视美图平台项目发布协议》！");
      return false;/*阻止表单提交*/
    }
  })
  
  
  // 其他展开收起2
  $('#other_type').click(function(){
      if($('.other_type').is('.hide')){
        $('.other_type').removeClass("hide");
        /*$("#other_type").css("background-color","#eee");*/
        $("#other_type").css("outline","none");
        $("#other_type").css("border","2px solid #1197ec");
  
      }else{
        /*$('.other_type').hide();*/
        $('.other_type').addClass("hide");
        $("#other_type").css("background-color","#fff");
        $("#other_type").css("outline","none");
        $("#other_type").css("border","1px solid #ccc");
      }
      /*$("#other_type").focus();*/
  });
  
  $(".select_plan_content li").click(function() {
  
      $(this).siblings('li').removeClass('selected');
  
      $(this).addClass('selected');
  
      if($(".greet").hasClass("selected")){
        $(".great_plan").show();
        $(".great_plan").removeClass("hide");
      }else{
        $(".great_plan").hide();
        $(".great_plan").addClass("hide");
      }
  
    });
  
  // 跳过客服
  $(".kefu").click(function() {
        if($(".project_content").hide()){
              $(".project_content").show();
              $(".logo_info").hide();
              $('body,html').animate({scrollTop:0},100);
         }
         if($('#thread').is(':hidden')){
            $('#thread').show();
            $('#second').hide();
            $('#first').hide();
            $('#fourth').hide();
          }else{
          }
  });
  
  $("input.material_input").blur(function(){
    if($("input.material_input").val()==""){
        $('body,html').animate({scrollTop:0},100);
    }
  });
  
  $("#miaoshu").blur(function(){
    if($("#miaoshu").val()==""){
      $('body,html').animate({scrollTop:240},100);
    }
  });
  
  
  $("#industry").blur(function(){
    if($("#industry option:selected").val()=="请选择行业"){
      $('body,html').animate({scrollTop:700},100);
      $("#industry").css('color', 'red');
    }
  });
  
  $("#industry").focus(function() {
      $("#industry").css('color', '#1c1d25');
  });
  
  
  /*下一步1*/
  $(".next").click(function() {
    // var txt=$(".select_m option:selected").text();
    // if(txt=='自定义金额'){
    //   yu_suan=$(".pre_money").val();
    // }else{
    //   yu_suan=$(".select_m  option:selected").val();
    // }
    // $(".pre_yu").html(yu_suan);
    // ProjectTotal();
    if($("input.material_input").val()==""){
          layer.msg("项目名称不能为空！");
          $('body,html').animate({scrollTop:0},100);
          return false;
    }else if($("#miaoshu").val()==""){
          layer.msg("请输入项目描述！");
          $('body,html').animate({scrollTop:240},100);
          return false;
    }else if($("#industry option:selected").val()=="请选择行业"){
          layer.msg("请选择行业！");
          $("#industry").css('color', 'red');
          $('body,html').animate({scrollTop:700},100);
          return false;
    }else if(!$(".select_color li").hasClass("yep_li")){
          layer.msg("请选择色调！");
          $(".select_color ").css('border-color', 'red');
          $('body,html').animate({scrollTop:1440},100);
          return false;
    }else if($("#phone").val()==""){
          layer.msg("请输入手机号码！");
          return false;
    }else if(isPhoneNo($.trim($("#phone").val())) == false){
          layer.msg("手机号码输入错误！请重新输入！");
          return false;
    }else{
        createTask()
        // if($(".select_plan").hasClass('hide')){
        //   $(".select_plan").removeClass("hide");
        //   $(".logo_info").addClass('hide');
        //   $(".project_content").addClass('hide');
          // $('body,html').animate({scrollTop:0},100);
          // threestep();
          // $(".three>span").css("background-color","#647c85");
          // $(".three>span").css("color","#fff");
        // }else{
          // $(".select_plan").addClass("hide");
          // $(".logo_info").removeClass('hide');
          // $(".project_content").removeClass('hide');
      }
    }
  
    // if($('#thread').is(':hidden')){
    //   $('#thread').show();
    //   $('#second').hide();
    //   $('#first').hide();
    //   $('#fourth').hide();
    // }
  
  );



    // 添加1
  $('.add_card').click(function(){
    if($('#card').is(':hidden')){
      $('#card').show();
      $(".add_card").css('background', '#777');
      $(".add_card").html("已添加");
    }else{
      $('#card').hide();
      $(".add_card").css('background', '#fff');
      $(".add_card").html("添加");
      }
  });

  // 添加2
  $('.add_stamp').click(function(){
    if($('.add_btn_content').is(':hidden')){
      $('.add_btn_content').show();
      $(".add_stamp").css('background', '#777');
      $(".add_stamp").html("已添加");
      $(".extre_stamp").css('background-color', '#eee');
    }else{
      $('.add_btn_content').hide();
      $(".add_stamp").css('background', '#fff');
      $(".add_stamp").html("添加");
      $(".extre_stamp").css('background-color', '#fff');
      }
  });

  // 上一步1
  $('.return').click(function(){
    // if($('.logo_info').hasClass('hide')){
    //   $('.logo_info').removeClass('hide');
    //   $('.select_plan').addClass('hide');
    //   $(".project_content").addClass('hide');
      $('body,html').animate({scrollTop:0},100);
      returntwotep();
      $(".three>span").css("background-color","#f4f4f4");
      $(".three>span").css("color","#273438");
    // }else{
    //   $('.logo_info').addClass('hide');
    //   $('.select_plan').removeClass('hide');
    //   $(".project_content").addClass('hide');
    // }

    // if($('#second').is(':hidden')){
    //   $('#second').show();
    //   $('#thread').hide();
    //   $('#first').hide();
    //   $('#thread').hide();
    //   $('#fourth').hide();
    // }else{
    //   $('#thread').hide();
    // }

  });

  // 附件上传
  // $('.file_upload').click(function () {
  //   $('.upload').click();
  // });

  // $(".upload_box").hide();
  // var file = $('#upload'),
  // fileName = $('#fileName');
  // file.on('change', function( e ){
  //     if($(".upload_box").hide()){
  //       $(".upload_box").show();
  //       var name = e.currentTarget.files[0].name;
  //       fileName.val( name );
  //       uploaddiv(".upload_box1");
  //       setTimeout(changecolor, 6650);
  //     }
  // });


  // $(".upload_close").on("click",function(){
  //   if($(".upload_box").show()){
  //     $(".upload_box").hide();
  //     $(".upload_box1").css('width', '0%');
  //     $(".upload_title").removeClass('up_bg2');
  //     $(".upload_title").addClass('up_bg1');
  //   }else{
  //     $(".upload_box").show();
  //   }
  // })

  //色调选择                      

  $(".estop_img").hide();

  $(".select_color li").on("click",function(){

    $(this).children('.color_selected').toggleClass("selected_bg");     // 通过.toggleclass（），切换是否添加selected_bg标签

    if($(this).children('.color_selected').hasClass('selected_bg')){     // 通过判定是否拥有selected_bg标签，给所选颜色加上被选上之后的特殊样式
      $(".select_color ").css('border-color', '#ccc');
      $(this).addClass("yep_li");
      $(this).children('.color_class').css('border-color', '#1197ec');
      $(this).children('.color_class').css('border-style', 'solid');
    }else{
      $(this).removeClass("yep_li");
      $(this).children('.color_class').css('border-color', 'transparent');
    }

    if($(".selected_bg").length==3){                              // 通过判定selected_bg标签的数量，控制黑色遮罩层的显示/隐藏
        $(".yep_li").siblings().children('.estop_img').show();
        $(".yep_li").children('.estop_img').hide();
    }else{
      $(".estop_img").hide();
    }
                

    if($(".selected_bg").length>3){                  // 通过判定selected_bg标签的数量，
      layer.msg("最多选3项");
      $(this).children('.color_selected').removeClass("selected_bg");
      $(this).children('.color_input').removeAttr("name","tonality[]");
      $(this).removeClass("yep_li");
      $(this).children('.color_class').css('border-color', 'transparent');
      $(".yep_li").siblings().children('.estop_img').show();
      $(".yep_li").children('.estop_img').hide();
      return false;
    }
    //蓝色调
    if($(".blue_cast").hasClass('selected_bg')){
      $(".blue_cast").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".blue_cast").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //绿色调
    if($(".Green").hasClass('selected_bg')){
      $(".Green").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".Green").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //紫色调
    if($(".purple_tone").hasClass('selected_bg')){
      $(".purple_tone").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".purple_tone").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //红色调
    if($(".red_tone").hasClass('selected_bg')){
      $(".red_tone").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".red_tone").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //橙色调
    if($(".orange_tone").hasClass('selected_bg')){
      $(".orange_tone").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".orange_tone").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //黄色调
    if($(".yellow_tone").hasClass('selected_bg')){
      $(".yellow_tone").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".yellow_tone").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //灰白调 咖啡色调
    if($(".gray_white").hasClass('selected_bg')){
      $(".gray_white").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".gray_white").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //灰黑调
    if($(".gray_black").hasClass('selected_bg')){
      $(".gray_black").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".gray_black").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //自定义
    if($(".user_defined").hasClass('selected_bg')){
      $(".user_defined").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".user_defined").siblings('.color_input').removeAttr("name","tonality[]");
    }

  });

  /*项目发布方式*/
  $(".sm").addClass('hide');
  $(".zd").addClass('hide');
  $(".sever_ul_box").addClass('hide');

  // $(".release_wrap_content div").on('click',function(event) {
  //   event.preventDefault();
  //   /* Act on the event */
  //   $(this).toggleClass("div_selected");
  //   $(this).siblings('div').removeClass("div_selected");
  //   if($(".private_release").hasClass('div_selected')){
  //     $(".sm").removeClass("hide");
  //     $(".zd").addClass('hide');
  //     $(".sever_ul_box").addClass('hide');
  //     $(".gk").addClass('hide');
  //   }else if($(".appoint_release").hasClass('div_selected')){
  //     $(".sm").addClass("hide");
  //     $(".zd").removeClass('hide');
  //     $(".sever_ul_box").removeClass('hide');
  //     $(".gk").addClass('hide');
  //   }else if($(".public_release").hasClass('div_selected')){
  //     $(".sm").addClass("hide");
  //     $(".zd").addClass('hide');
  //     $(".sever_ul_box").addClass('hide');
  //     $(".gk").removeClass('hide');
  //   }
  //   ProjectTotal();
  // });

  //  费用计算
  $(".cls_input_span1,.dan").hide();
  // var yu_suan;
  $(".select_m").on('change',function(){
  var txt=$(".select_m option:selected").text();

  if(txt=='自定义金额'){
    $(".cls_input_span1,.dan").show();     //  自定义输入金额
    // yu_suan=$(".pre_money").val();
  }else{
    $(".cls_input_span1,.dan").hide();
    // yu_suan=$(".select_m  option:selected").val();
  }
  // $(".pre_yu").html(yu_suan);
  /*alert(yu_suan)*/
  // ProjectTotal();
  });

  // 项目时间选择
  $(".cls_input_span_t").hide();
  $(".logo_info_time").on('change',function(){
    var txt=$(".logo_info_time option:selected").text();
    if(txt=='自定义'){
      $(".cls_input_span_t").show();
      $(".cls_input_span_t").val("");
    }else{
      $(".cls_input_span_t").hide();
      computingTime();
    }
    computingTime();
  });

  // 华丽简约
  $(".hlright").click(function(event) {
    setTimeout(function(){movespanright(".centerspanbg");}, 300);
    setTimeout(function(){movespancenter(".centerspanbg");}, 10);
    setTimeout(function(){fulldiv(".hldiv");}, 300);
    fulldiv(".jydiv1");
    $(".hlright").attr("name","style[]");
    // $(".centerspan").removeAttr("name","moren");
    $(".jyleft").removeAttr("name","style[]");
  });

  $(".centerspan").click(function(event) {
    blankdiv(".hldiv");
    fulldiv(".jydiv1");
    movespancenter(".centerspanbg");
    // $(".centerspan").attr("name","moren");
    $(".hlright").removeAttr("name","style[]");
    $(".jyleft").removeAttr("name","style[]");
  });

  $(".jyleft").click(function(event) {
    blankdiv(".hldiv");
    setTimeout(function(){movespanleft(".centerspanbg");}, 300);
    setTimeout(function(){movespancenter(".centerspanbg");}, 10);
    setTimeout(function(){blankdiv(".jydiv1")}, 300);
    $(".jyleft").attr("name","style[]");
    $(".hlright").removeAttr("name","style[]");
    // $(".centerspan").removeAttr("name","moren");
  });

  // 现代古典
  $(".xdright").click(function(event) {
    setTimeout(function(){movespanright(".centerspanbg1");}, 300);
    setTimeout(function(){movespancenter(".centerspanbg1");}, 10);
    setTimeout(function(){fulldiv(".xddiv")}, 300);
    fulldiv(".gddiv1");
    $(".xdright").attr("name","style[]");
    // $(".centerspan1").removeAttr("name","moren");
    $(".gdleft").removeAttr("name","style[]");
  });

  $(".centerspan1").click(function(event) {
    blankdiv(".xddiv");
    fulldiv(".gddiv1");
    movespancenter(".centerspanbg1");
    // $(".centerspan1").attr("name","moren");
    $(".xdright").removeAttr("name","style[]");
    $(".gdleft").removeAttr("name","style[]");
  });

  $(".gdleft").click(function(event) {
    setTimeout(function(){movespanleft(".centerspanbg1");}, 300);
    setTimeout(function(){movespancenter(".centerspanbg1");}, 10);
    setTimeout(function(){blankdiv(".gddiv1")}, 300);
    blankdiv(".xddiv");
    $(".gdleft").attr("name","style[]");
    $(".xdright").removeAttr("name","style[]");
    // $(".centerspan1").removeAttr("name","moren");
  });


  // 女性男性
  $(".nxright").click(function(event) {
    setTimeout(function(){movespanright(".centerspanbg2");}, 300);
    setTimeout(function(){movespancenter(".centerspanbg2");}, 10);
    setTimeout(function(){fulldiv(".nxdiv")}, 300);
    fulldiv(".nvxdiv1");
    $(".nxright").attr("name","style[]");
    // $(".centerspan2").removeAttr("name","moren");
    $(".nvxleft").removeAttr("name","style[]");
  });

  $(".centerspan2").click(function(event) {
    blankdiv(".nxdiv");
    fulldiv(".nvxdiv1");
    movespancenter(".centerspanbg2");
    // $(".centerspan2").attr("name","moren");
    $(".nxright").removeAttr("name","style[]");
    $(".nvxleft").removeAttr("name","style[]");
  });

  $(".nvxleft").click(function(event) {
    setTimeout(function(){movespanleft(".centerspanbg2");}, 300);
    setTimeout(function(){movespancenter(".centerspanbg2");}, 10);
    setTimeout(function(){blankdiv(".nvxdiv1")}, 300);
    blankdiv(".nxdiv");
    $(".nvxleft").attr("name","style[]");
    $(".nxright").removeAttr("name","style[]");
    // $(".centerspan2").removeAttr("name","moren");
  });

  // 抽象文字
  $(".wzright").click(function(event) {
    setTimeout(function(){movespanright(".centerspanbg3");}, 300);
    setTimeout(function(){movespancenter(".centerspanbg3");}, 10);
    setTimeout(function(){fulldiv(".wzdiv")}, 300);
    fulldiv(".cxdiv1");
    $(".wzright").attr("name","style[]");
    // $(".centerspan3").removeAttr("name","moren");
    $(".cxleft").removeAttr("name","style[]");
  });

  $(".centerspan3").click(function(event) {
    blankdiv(".wzdiv");
    fulldiv(".cxdiv1");
    movespancenter(".centerspanbg3");
    // $(".centerspan3").attr("name","moren");
    $(".wzright").removeAttr("name","style[]");
    $(".cxleft").removeAttr("name","style[]");
  });

  $(".cxleft").click(function(event) {
    blankdiv(".wzdiv");
    setTimeout(function(){movespanleft(".centerspanbg3");}, 300);
    setTimeout(function(){movespancenter(".centerspanbg3");}, 10);
    setTimeout(function(){blankdiv(".cxdiv1")}, 300);
    $(".cxleft").attr("name","style[]");
    $(".wzright").removeAttr("name","style[]");
    // $(".centerspan3").removeAttr("name","moren");
  });


  //微信、支付宝、银联切换
  $(".weixin").hide();
  $(".zaixian").hide();

  $(".zhi_title").on("click",function(){
    if($('.zhifubao').is(':hidden')){
      $('.zhifubao').show();
      $('.weixin').hide();
      $(".zaixian").hide();
      $(".zhi_div").addClass('select_img_wrap');
      $(".wei_div").removeClass('select_img_wrap');
      $(".zai_div").removeClass('select_img_wrap');
      }
  });

  $(".wei_title").on("click",function(){
    if($('.weixin').is(':hidden')){
      $('.weixin').show();
      $('.zhifubao').hide();
      $(".zaixian").hide();
      $(".wei_div").addClass('select_img_wrap');
      $(".zhi_div").removeClass('select_img_wrap');
      $(".zai_div").removeClass('select_img_wrap');
      }
  });

  $(".zai_title").on("click",function(){
    if($('.zaixian').is(':hidden')){
      $('.zaixian').show();
      $('.zhifubao').hide();
      $(".weixin").hide();
      $(".zai_div").addClass('select_img_wrap');
      $(".zhi_div").removeClass('select_img_wrap');
      $(".wei_div").removeClass('select_img_wrap');
      }
  });


  




  // 发布项目 点击删除已上传的文件

  $(".hdjstp .fbxm_shanchu").click(function(){
    $(this).parent().remove();
    if($('.fbxm_shanchu').length>0){
      $(".yishangchuan").show();
    }else{
      $(".yishangchuan").hide();
    }
    var yxid = $(this).attr("tonality_id");
    $.ajax({
      type: 'get',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/task/taskFileDelet',
      data: {id:yxid},
      dataType:'json',
      success: function(data){
        console.log('删除成功');
      },
      error: function(data) {
        console.log('删除失败');
        }
    });
  })

  $('input[name="sele_input"]').on('input propertychange', function() {
    computingTime();
  })


  // 为什么需要先托资金弹框
  $(".whyMoney").on("click", function(){
    layer.open({
        type: 1,
        closeBtn: 1,
        btnAlign: 'c',
        skin: 'demo-class',
        title:'',
        shadeClose:true,
        fix: false,
        scrollbar: false,
        area: ['800px','700px'],
        content: $('.whyMoney_tip'),
        success: function (layero, index) {
            
        },
    });
});

// 发布项目协议弹框
$(".Pubagreement").on("click", function(){
  layer.open({
      type: 1,
      closeBtn: 1,
      btnAlign: 'c',
      skin: 'demo-class',
      title:'',
      shadeClose:true,
      fix: false,
      scrollbar: false,
      area: ['800px','700px'],
      content: $('.agreement_tip'),
      success: function (layero, index) {
          
      },
  });
});

// 发布项目中保存状态  获取设计风格  与项目详情区分
var formStyle = $(".jshdsj_fengge").html();
console.log(formStyle,"风格");
if (formStyle==null) {
}else{
    var formStyle_number = formStyle.match(/\d+/g);        // 获取数组中的数字，放入新的数组中
    formedStyle(formStyle_number);
};
// 发布项目中保存状态  获取颜色   与项目详情区分
var formColor = $(".jshdsj_color").html();
console.log(formColor,"颜色");
if(formColor==null){
}else{
    var formColor_number = formColor.match(/\d+/g);     // 将字符串中的数字通过正则数字筛选放入fgysxz_number数组中
    formedColor(formColor_number);
};




})

//   根据url地址改变序号过度状态

function getBar(){

  var url=window.location.href;
  var index=url.indexOf("a");
  var str;
  if(index!=-1){
    str=url.substring(url.lastIndexOf("=")+1, url.length);
  }
  /*alert(str);*/
  switch(str){
    case "02":
      twostep();
      $(".two>span").css("background-color","#647c85");
      $(".two>span").css("color","#fff");
    break;
    case "03":
      $(".two>span").css("background-color","#647c85");
      $(".two>span").css("color","#fff");
      $(".one>div").css("width","100%");
      threestep();
      $(".three>span").css("background-color","#647c85");
      $(".three>span").css("color","#fff");
    break;
    case "04":
      $(".one>div").css("width","100%");
      $(".two>span").css("background-color","#647c85");
      $(".two>span").css("color","#fff");
      $(".twodiv").css("width","100%");
      $(".three>span").css("background-color","#647c85");
      $(".three>span").css("color","#fff");
      fourstep()
      $(".four>span").css("background-color","#647c85");
      $(".four>span").css("color","#fff");
    break;
  }
}

function twostep(){
    $(".onediv").animate({
        width:"100%"
    },500);
}

function threestep(){
    $(".twodiv").animate({
        width:"100%"
    },500);
}

function fourstep(){
    $(".threediv").animate({
        width:"100%"
    },500);
}

//   根据url地址改变序号过度状态  结束





// $("#form").submit(function () {
//   alert("萨达萨达撒多");
//     if($("input.material_input").val()==""||isBusinessname($.trim($(inputid).val()))==false){
//         return false;
//     }else if($("#miaoshu").val()==""){
//         return false;
//     }else if($("#industry option:selected").val()=="请选择行业"){
//         return false;
//     }else if(!$(".select_color li").hasClass("yep_li")){
//         return false;
//     }else if($("#phone").val()==""){
//         return false;
//     }else if(isPhoneNo($.trim($("#phone").val())) == false){
//         return false;
//     }else if(isEnoughMoney($.trim($(inputid).val()))==false){
//         return false;
//     }else{
//       return true;
//     }
// })

//  验证手机号
function isPhoneNo(phone) {
  var reg = /^1[34578]\d{9}$/;
  return reg.test(phone);
}



// $(".pre_money").blur(function(){
//   yu_suan=$(this).val();
//   $(".pre_yu").html(yu_suan);
//   ProjectTotal();
// });


// ProjectTotal();
/*计算项目总费用 */
// function ProjectTotal(){
  // var pre_money;
  // var yu_money;
  // var server_money=0;
  // var total_money;
  // yu_money=yu_suan;
  //   现在只有公开发布方式
  // if($(".public_release").hasClass('div_selected')){
    // pre_money=$(".gk_money").children("span").text();        //  公开发布方式时，发布费为0
  // }else if($(".private_release").hasClass('div_selected')){
    // pre_money=$(".sm_money").children("span").text();
  // }else if($(".appoint_release").hasClass('div_selected')){
    // pre_money=$(".zd_money").children("span").text();
    // server_money=$(".pre_server").text();
  // }

  // total_money=parseFloat(pre_money)+parseFloat(yu_money)+parseFloat(server_money);
  // 公开发布方式时，总费用等于项目预算
  // $(".total").html(total_money);
// }

/*计算项目总费用结束 */

// 项目时间开始
function computingTime(){
  var myDate = new Date();
  var year=myDate.getFullYear();
  var month=myDate.getMonth()+1;
  var date=myDate.getDate();
  var str = "星期" + "日一二三四五六".charAt(new Date().getDay());
  var newDate= new Date(myDate);
  if($(".logo_info_time option:selected").text()=='自定义'){
    if($(".cls_input_t").val()==""){
      var selc_num=0;
    }else{
      var selc_num=$(".cls_input_t").val();
    }
  }else{
    var selc_num=$(".logo_info_time").find("option:selected").val();
  }
  selc_num= parseInt(selc_num);
    newDate.setDate(myDate.getDate()+selc_num);
    var nyear=newDate.getFullYear();
    var nmonth=newDate.getMonth()+1;
    var ndate=newDate.getDate();
    var nstr = "日一二三四五六".charAt(new Date(newDate).getDay());
    $(".se_year").text(nyear);
    $(".se_month").text(nmonth);
    $(".se_date").text(ndate);
    $(".se_week").text(nstr);
}
 
// 项目时间结束
// 风格
function fulldiv(div){
    $(div).animate({
        width:"100%"
    },300);
}

function blankdiv(div){

    $(div).animate({
        width:"0%"
    },300);
}

function movespanright(span){
    $(span).animate({
      left: "91%"
    },300);
}

function movespancenter(span){
    $(span).animate({
      left: "-10px"
    },300);
}

function movespanleft(span){
    $(span).animate({
      left: "-109%"
    },300);
}


// function jiTime(){
//     document.getElementById('time').innerHTML= t;
//     t -= 1;
//     if(t==0){
//         location.href='http://www.i3job.com/';
//     }else if(t<0){
//         t=10;
//     }
//     setTimeout("jiTime()",1000);
// }



//详情提交表单

function createTask()

{
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/task/createnewdetail',
        data: $('#form').serialize(),
        dataType:'json',
        success: function(data){
            console.log(data);
            if (data.code ==1) {
              if (data.bid ==0) {
                location.href= 'http://www.meishimeitu.com/task/createnew/'+data.orderNumber+'?a=03';
              }else{
                location.href= 'http://www.meishimeitu.com/task/createnew/'+data.orderNumber+'?bid='+data.bid+'&man='+data.man+'&a=03';
              }
            }else{
                location.href= 'http://www.meishimeitu.com/task/tasksuccess/'+data.id+'?a=04';
            }
            
        },
        error: function(data) {
            console.log('返回失败');
        }
    });
}




// function uploaddiv(div){
//   var div=$(div);
//   div.animate({
//       width:"0%"
//   },100);
//   div.animate({
//       width:"30%"
//   },3000);
//   div.animate({
//       width:"70%"
//   },500);
//   div.animate({
//       width:"100%"
//   },3000);

// }

// function changecolor(){
// if($(".upload_box1").width()>535){
//       $(".upload_title").removeClass('up_bg1');
//       $(".upload_title").addClass('up_bg2');
//   }else{
//       $(".upload_title").removeClass('up_bg2');
//       $(".upload_title").addClass('up_bg1');
//   }
// }







function formedColor(colorxz_number){
  // 跳转页面后重新给已选择的颜色渲染样式
  if (colorxz_number==null||colorxz_number=='') {
    return;
  }else{
    $(".color_input").removeAttr("name","tonality[]");
    $.each(colorxz_number,function(index,value){
        $(".select_color li").eq(value-1).children('.color_selected').addClass("selected_bg");
        $(".select_color li").eq(value-1).addClass("yep_li");
        $(".select_color li").eq(value-1).children('.color_class').css('border-color', '#1197ec');
        $(".select_color li").eq(value-1).children('.color_class').css('border-style', 'solid');
      if($(".selected_bg").length==3){
        $(".yep_li").siblings().children('.estop_img').show();
        $(".yep_li").children('.estop_img').hide();
      }else{
        $(".estop_img").hide();
      }
    });
     //蓝色调
    if($(".blue_cast").hasClass('selected_bg')){
      $(".blue_cast").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".blue_cast").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //绿色调
    if($(".Green").hasClass('selected_bg')){
      $(".Green").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".Green").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //紫色调
    if($(".purple_tone").hasClass('selected_bg')){
      $(".purple_tone").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".purple_tone").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //红色调
    if($(".red_tone").hasClass('selected_bg')){
      $(".red_tone").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".red_tone").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //橙色调
    if($(".orange_tone").hasClass('selected_bg')){
      $(".orange_tone").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".orange_tone").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //黄色调
    if($(".yellow_tone").hasClass('selected_bg')){
      $(".yellow_tone").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".yellow_tone").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //灰白调 咖啡色调
    if($(".gray_white").hasClass('selected_bg')){
      $(".gray_white").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".gray_white").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //灰黑调
    if($(".gray_black").hasClass('selected_bg')){
      $(".gray_black").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".gray_black").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //自定义
    if($(".user_defined").hasClass('selected_bg')){
      $(".user_defined").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".user_defined").siblings('.color_input').removeAttr("name","tonality[]");
    }
    //自定义
    if($(".user_defined").hasClass('selected_bg')){
      $(".user_defined").siblings('.color_input').attr("name","tonality[]");
    }else{
      $(".user_defined").siblings('.color_input').removeAttr("name","tonality[]");
    }
    
  }
}


function formedStyle(fgysxz_number){
  // 跳转页面后重新给已选择的风格渲染样式
  if(fgysxz_number==null||fgysxz_number==''){
    return;
  }else{
    $.each(fgysxz_number,function(index,value){
      switch(value){
        case "1":      // 简约
          blankdiv(".hldiv");
          setTimeout(function(){movespanleft(".centerspanbg");}, 300);
          setTimeout(function(){blankdiv(".jydiv1")}, 300);
          $(".jyleft").attr("name","style[]");
          $(".hlright").removeAttr("name","style[]");
          break;
        case "2":      // 华丽
          setTimeout(function(){movespanright(".centerspanbg");}, 300);
          setTimeout(function(){fulldiv(".hldiv");}, 300);
          fulldiv(".jydiv1");
          $(".hlright").attr("name","style[]");
          $(".jyleft").removeAttr("name","style[]");
          break;
        case "3":    // 古典
          setTimeout(function(){movespanleft(".centerspanbg1");}, 300);
          setTimeout(function(){blankdiv(".gddiv1")}, 300);
          blankdiv(".xddiv");
          $(".gdleft").attr("name","style[]");
          $(".xdright").removeAttr("name","style[]");
          break;      
        case "4":    // 现代
          setTimeout(function(){movespanright(".centerspanbg1");}, 300);
          setTimeout(function(){fulldiv(".xddiv")}, 300);
          fulldiv(".gddiv1");
          $(".xdright").attr("name","style[]");
          $(".gdleft").removeAttr("name","style[]");
          break;
        case "5":    // 女性
          setTimeout(function(){movespanleft(".centerspanbg2");}, 300);
          setTimeout(function(){blankdiv(".nvxdiv1")}, 300);
          blankdiv(".nxdiv");
          $(".nvxleft").attr("name","style[]");
          $(".nxright").removeAttr("name","style[]");
          break;
        case "6":    // 男性
          setTimeout(function(){movespanright(".centerspanbg2");}, 300);
          setTimeout(function(){fulldiv(".nxdiv")}, 300);
          fulldiv(".nvxdiv1");
          $(".nxright").attr("name","style[]");
          $(".nvxleft").removeAttr("name","style[]");
          break;
        case "7":    // 抽象
          blankdiv(".wzdiv");
          setTimeout(function(){movespanleft(".centerspanbg3");}, 300);
          setTimeout(function(){blankdiv(".cxdiv1")}, 300);
          $(".cxleft").attr("name","style[]");
          $(".wzright").removeAttr("name","style[]");
          break;
        case "8":    // 文字
          setTimeout(function(){movespanright(".centerspanbg3");}, 300);
          setTimeout(function(){fulldiv(".wzdiv")}, 300);
          fulldiv(".cxdiv1");
          $(".wzright").attr("name","style[]");
          $(".cxleft").removeAttr("name","style[]");
          break;
      }
    });
  }
}











