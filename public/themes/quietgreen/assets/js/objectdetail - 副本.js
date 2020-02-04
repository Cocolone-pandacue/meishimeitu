$(function(){

})

function getObjectDetail(obj){
    var task_id = $(obj).attr('task_id');               //  获取到task_id
    var download_imgurl = $(".ace-thumbnails").attr("download_imgurl");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/task/taskAjax',
        type: 'POST',
        dataType: 'json',
        data: {
            task_id: task_id
        },
        success: function (data) {
          startDetail();
          // 赋值标题
          $(".xiangmutanchuang_box_wenben_biaoti").text(data.task.title);
          // 获取项目状态
          $(".xiangmujindu_text").text(data.status);
          // 设计类型
          $(".xiangmutanchuang_box_wenben_jihua_one_text").text(data.task.catename);
          // 获取设计类型前面的图片
          var src_tb = data.pic;
          $(".xiangmutanchuang_box_wenben_jihua_one_photo").attr("src",src_tb);
          // 项目预算
          $(".xiangmutanchuang_box_wenben_jihua_two_text").text(data.task.show_cash+"元");
          // 项目计划时间
          $(".xiangmutanchuang_box_wenben_jihua_three_text").text(data.task.time_interval+"天");
          // 项目详情
          $(".xiangmutanchuang_box_wenben_xiangqing_miaoshu").text(data.desc);
          // 截止日期
          $(".xiangmutanchuang_box_wenben_fenbuxinxi_riqi_xia").text(data.delivery_deadline);
          // 获取地址 
          if(data.region_limit==1){
              $(".xiangmutanchuang_box_wenben_fenbuxinxi_diqu_xia").text(data.province.name+"/"+data.city.name+"/"+data.area.name);
          }else{
              $(".xiangmutanchuang_box_wenben_fenbuxinxi_diqu_xia").text("无");
          };
          // 获取所属行业
          $(".xiangmutanchuang_box_wenben_fenbuxinxi_hangye_xia").text(data.task.industryname);
          // 获取参考产品
          if(data.task.reference==null){
              $(".xiangmutanchuang_box_wenben_fenbuxinxi_chanping_xia").text("无");
          }else{
              $(".xiangmutanchuang_box_wenben_fenbuxinxi_chanping_xia").text(data.task.reference);
          };
          // 获取设计风格
          if (data.task.task_style==null) {
              return;
          }else{
              var task_style_number = data.task.task_style.match(/\d+/g);        // 获取数组中的数字，放入新的数组中
              choossedStyle(task_style_number);
          };
          // 获取颜色
          if(data.task.task_tonality==null){
              return;
          }else{
              var task_tonality_number = data.task.task_tonality.match(/\d+/g);     // 将字符串中的数字通过正则数字筛选放入fgysxz_number数组中
              choossedColor(task_tonality_number);
          };
          // 获取附件地址
          var arr = data.file;
          if(arr.length>0){
              $.each(arr,function(index,value_four){
              var fj_href = this.id;
              var fj_url =    '<li class="xzfjslt">'+
                                  '<a href="/task/download/'+fj_href+'">'+
                                      '<img alt="150x150" src="'+download_imgurl+'">'+
                                      '<div class="text">'+
                                          '<div class="inner"></div>'+
                                      '</div>'+
                                  '</a>'+
                                  '<div class="tools tools-bottom">'+
                                      '<a href="/task/download/'+fj_href+'">'+'下载'+'</a>'+
                                  '</div>'+
                              '</li>'
                $(".ace-thumbnails").append(fj_url);
              });
            }else{
              $(".ace-thumbnails").text("无");
            };
        
        },
        error: function (data) {
            console.log('错误');
        }
    });
    
}

// 项目详情弹框触发

function startDetail(){
  layer.open({
    type: 1,
    closeBtn: 1,
    btnAlign: 'c',
    skin: 'demo-class',
    title:'',
    shadeClose:true,
    fix: false,
    scrollbar: false,
    area: ['800px','850px'],
    content: $('#project_detail'),
    success: function (layero, index) {
        
    },
    cancel: function(){//当点击取消按钮时发生的

    },
    end: function(){//当弹框销毁时发生的 
      emptyStyle();
      $(".xiangmutanchuang_box_wenben_yanse_photobox").hide();
      $(".ace-thumbnails").empty();
    }  
});
}
  

function choossedStyle(fgysxz_number){
    // 跳转页面后重新给已选择的风格渲染样式
    if(fgysxz_number==null||fgysxz_number==''){
      return;
    }else{
      $.each(fgysxz_number,function(index,value){
        switch(value){
          case "1":      // 简约
            blankdiv(".hldiv");
            setTimeout(function(){movespanleft(".centerspanbg");}, 300);
            setTimeout(function(){movespancenter(".centerspanbg");}, 10);
            setTimeout(function(){blankdiv(".jydiv1")}, 300);
            fulldiv(".jydiv");
            $(".jyleft").attr("name","style[]");
            $(".hlright").removeAttr("name","style[]");
            break;
          case "2":      // 华丽
            setTimeout(function(){movespanright(".centerspanbg");}, 300);
            setTimeout(function(){movespancenter(".centerspanbg");}, 10);
            setTimeout(function(){fulldiv(".hldiv");}, 300);
            fulldiv(".jydiv1");
            $(".hlright").attr("name","style[]");
            $(".jyleft").removeAttr("name","style[]");
            break;
          case "3":    // 古典
            setTimeout(function(){movespanleft(".centerspanbg1");}, 300);
            setTimeout(function(){movespancenter(".centerspanbg1");}, 10);
            setTimeout(function(){blankdiv(".gddiv1")}, 300);
            blankdiv(".xddiv");
            $(".gdleft").attr("name","style[]");
            $(".xdright").removeAttr("name","style[]");
            break;      
          case "4":    // 现代
            setTimeout(function(){movespanright(".centerspanbg1");}, 300);
            setTimeout(function(){movespancenter(".centerspanbg1");}, 10);
            setTimeout(function(){fulldiv(".xddiv")}, 300);
            fulldiv(".gddiv1");
            $(".xdright").attr("name","style[]");
            $(".gdleft").removeAttr("name","style[]");
            break;
          case "5":    // 女性
            setTimeout(function(){movespanleft(".centerspanbg2");}, 300);
            setTimeout(function(){movespancenter(".centerspanbg2");}, 10);
            setTimeout(function(){blankdiv(".nvxdiv1")}, 300);
            blankdiv(".nxdiv");
            $(".nvxleft").attr("name","style[]");
            $(".nxright").removeAttr("name","style[]");
            break;
          case "6":    // 男性
            setTimeout(function(){movespanright(".centerspanbg2");}, 300);
            setTimeout(function(){movespancenter(".centerspanbg2");}, 10);
            setTimeout(function(){fulldiv(".nxdiv")}, 300);
            fulldiv(".nvxdiv1");
            $(".nxright").attr("name","style[]");
            $(".nvxleft").removeAttr("name","style[]");
            break;
          case "7":    // 抽象
            blankdiv(".wzdiv");
            setTimeout(function(){movespanleft(".centerspanbg3");}, 300);
            setTimeout(function(){movespancenter(".centerspanbg3");}, 10);
            setTimeout(function(){blankdiv(".cxdiv1")}, 300);
            fulldiv(".cxdiv1");
            $(".cxleft").attr("name","style[]");
            $(".wzright").removeAttr("name","style[]");
            break;
          case "8":    // 文字
            setTimeout(function(){movespanright(".centerspanbg3");}, 300);
            setTimeout(function(){movespancenter(".centerspanbg3");}, 10);
            setTimeout(function(){fulldiv(".wzdiv")}, 300);
            fulldiv(".wzdiv");
            $(".wzright").attr("name","style[]");
            $(".cxleft").removeAttr("name","style[]");
            break;
        }
      });
    }
  }

  // 清空已选择风格

  function emptyStyle(){
    blankdiv(".hldiv");
    blankdiv(".jydiv1");
    movespancenter(".centerspanbg");
  
    blankdiv(".xddiv");
    blankdiv(".gddiv1");
    movespancenter(".centerspanbg1");
  
    blankdiv(".nxdiv");
    blankdiv(".nvxdiv1");
    movespancenter(".centerspanbg2");
  
    blankdiv(".wzdiv");
    blankdiv(".cxdiv1");
    movespancenter(".centerspanbg3");
  }

  function choossedColor(colorxz_number){
    // 跳转页面后重新给已选择的颜色渲染样式
    if (colorxz_number==null||colorxz_number=='') {
      return;
    }else{
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
    }
  }


  // 选择风格动画

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