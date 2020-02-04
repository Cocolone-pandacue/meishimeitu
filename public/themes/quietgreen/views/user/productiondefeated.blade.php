<!-- <div class="g-main g-releasetask"> -->
<!-- <form class="registerform" enctype="multipart/form-data" method="post" action="{!! url('user/productionUploading') !!}"> -->
{{--{!! csrf_field() !!}--}}
   <!-- <h4 class="text-size16 cor-blue2f u-title clearfix"> -->
        <!-- <span>审核失败</span> -->
    <!-- </h4> -->
    <!-- <div class="space-12"></div> -->
    <!-- <div class="space-32"></div><div class="space-32"></div><div class="space-22"></div> -->
    <!-- 未通过 -->
    <!-- <div class="text-center g-bankhint1 g-bankhint upload_work"> -->
        <!-- <img src="{!! Theme::asset()->url('images/sign-icon3.png') !!}"> -->
        <!-- <span class="text-size24 shop-hinttxt">&nbsp;&nbsp;&nbsp;&nbsp;很遗憾，审核未能通过！</span> -->
        <!-- <p><a href="/user/productionFeatedNew">重新上传</a></p> -->
    <!-- </div> -->
    <!-- 作品展示 -->
    <!-- <div class="expositions"> -->
        <!-- <p>您的作品</p> -->
        <!-- <ul class="expositions_list clearfix"> -->
            {{--@foreach($name as $v)--}}
                <!-- {{--<li>--}} -->
                    <!-- {{--<p><img src="{!! Theme::asset()->url('images/task-xiazai/zip.png') !!}" alt=""></p>--}} -->
                    <!-- {{--<p>{{$v}}</p>--}} -->
                <!-- {{--</li>--}} -->
            {{--@endforeach--}}
        <!-- </ul> -->
    <!-- </div> -->
<!-- </form> -->
<!-- </div> -->

<div class="dengdaishenhe">
    <div class="success_box">
        <img src="{!! Theme::asset()->url('images/sign-icon3.png') !!}" class="default">
        <p class="su_til">很遗憾，审核未能通过！</p>
        <p class="bar_box">
            <img src="{!! Theme::asset()->url('/images/type/二维码.png') !!}" class="erweima">
        </p>
        <div class="words_box clearfix">
            <p>加入官方QQ群:606250521获取更多同行交流的机会</p>
            <p>关注微信公众号:"珺娱科技"绑定账号,实时查看项目进展</p>
        </div>
        <p class="sub_box"><a href="/user/productionFeatedNew" class="sub_btn">重新提交</a></p>
    </div>
</div>
<script>
 function timeChange(obj){
   var time=obj.value;
   var url = location.search; //获取url中"?"符后的字串
   var theRequest = new Object();
   if (url.indexOf("?") != -1) {
      var str = url.substr(1);
      strs = str.split("&");
      for(var i = 0; i < strs.length; i ++) {
         theRequest[strs[i].split("=")[0]]=(strs[i].split("=")[1]);
      }
      window.location.href="/user/acceptTasksList?uid="+theRequest.uid+"&time="+time+"&type="+theRequest.type+"&status="+theRequest.status;
   }else{
       window.location.href="/user/acceptTasksList?time="+time;
   }
 }
</script>
<!-- {!! Theme::asset()->container('specific-js')->usepath()->add('upload_de','/js/upload_de.js') !!} -->
{!! Theme::asset()->container('old-css')->usepath()->add('release_css','css/type/release.project.css') !!}


