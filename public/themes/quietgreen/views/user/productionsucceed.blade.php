<div class="dengdaishenhe">
    <div class="success_box">
        <img src="{!! Theme::asset()->url('/images/type/icon1.png') !!}" alt="" class="success">
        <p class="su_til">您已经成功入驻美视美图</p>
        <p class="bar_box">
            <img src="{!! Theme::asset()->url('/images/type/二维码.png') !!}" class="erweima">
        </p>
        <div class="words_box clearfix">
            <p>加入官方QQ群:606250521获取更多同行交流的机会</p>
            <p>关注微信公众号:"珺娱科技"绑定账号,实时查看项目进展</p>
        </div>
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
{!! Theme::asset()->container('old-css')->usepath()->add('release_css','css/type/release.project.css') !!}


