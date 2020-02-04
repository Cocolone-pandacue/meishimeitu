
<div class="location">
    <div class="container">
        <i class="home_icon"></i>&nbsp;&nbsp;&nbsp;<a href="{!! CommonClass::homePage() !!}">首页</a> <span class="ri_horn"></span><span>平台商铺</span>
    </div>
</div>
<article>
    <div class="container">

        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($goodsslideshow as $g)
                  <div class="swiper-slide"><img src="{{ossUrl($g->url)}}" ></div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
      </div>
    </div>
</article>
<section class="se_title">
    <div class="container col-10">
        <div class="row col-10">
              <ul class="type_list clearfix">
                  <li><a href="{!! URl('bre/shop').'?'.http_build_query(array_except($merge,['title','paginate','category','cate'])) !!}" class="selected_li">全部</a></li>
                  @for($j = 0; $j < count(Theme::get('task_cate')); $j++)
                  <li>
                      <a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['category'=> Theme::get('task_cate')[$j]['id']])) !!}" class="d">{!! Theme::get('task_cate')[$j]['name'] !!}</a>
                      <section class="hover_list">
                        <div class="hover_list_wrap">
                            @for($i =0 ;$i < count(Theme::get('task_cate')[$j]['child_task_cate']); $i++)
                                <a  href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['category'=> Theme::get('task_cate')[$j]['child_task_cate'][$i]['id']])) !!}"><span>{!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}</span></a>
                            @endfor
                        </div>
                      </section>
                  </li>
                  @endfor
                  <li>
                        <a href="javascript:;">自定义</a>
                        <section class="hover_list">
                            <div class="hover_list_wrap">
                                <form  role="form" method="get" action="/bre/shop">
                                    <div class="hover_list_wrap">
                                        @for($j = 0; $j < count(Theme::get('task_cate')); $j++)
                                            <label><input type="checkbox" name="cate[]" value="{!! Theme::get('task_cate')[$j]['id'] !!}"
                                                  @if(isset($merge['cate']) && in_array(Theme::get('task_cate')[$j]['id'],$merge['cate']) && !isset($merge['category']))
                                                  checked="checked"
                                                  @endif >
                                                {!! Theme::get('task_cate')[$j]['name'] !!}
                                            </label>
                                        @endfor
                                        <button class="sure_type" type="submit">确定</button>
                                    </div>
                                </form>
                          </div>
                        </section>
                  </li>
                  <li>
                    <form action="/bre/shop" id="shoplist_form" method="get" accept-charset="utf-8">
                        <input type="text" name="title" placeholder="输入你想要的作品或服务名称" @if(isset($merge['title']))value="{!! $merge['title'] !!}" @endif>
                        <span class="search_icon" onclick="upForm();"></span>
                    </form>
                </li>
              </ul>
        </div>
    </div>
</section>
<section style="background-color: #fff;">
    <div class="container col-10">
        <div class="row col-10">
        <div class="tuijian clearfix" >
          <ul class="nav_list clearfix">
              <li><a class=" home_recommend_title {!! (!isset($merge['type']) || $merge['type'] == 1) ?'select_nav':'' !!}" href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['type'=> 1]))!!}">首页推荐</a></li>
              <li><a class="high_grade_title {!! (isset($merge['type']) && $merge['type'] == 2) ?'select_nav':'' !!}" href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['type'=> 2])) !!}">优质作品</a></li>
              <li><a class="new_photos_title {!! (isset($merge['type']) && $merge['type'] == 3) ?'select_nav':'' !!}" href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['type'=> 3])) !!}">最新发布</a></li>
          </ul>
          <span class="type_select_wrap">
              <span class="type_select_title">
                  @if(!$categoryone == 0)
                        {{$categoryone->name}}
                  @endif
              </span>
              <span class="type_select">
                  @if(!$categorytow == 0)
                      - {{$categorytow->name}}
                  @endif
                  @if(!$cateone == 0)
                      @foreach($cateone as $value)
                          {{$value->name}}&nbsp;&nbsp;&nbsp;
                      @endforeach
                  @endif
              </span>
          </span>
        </div>
        </div>
    </div>
</section>
<section class="">
    <div class="container col-10">
        <div class="row col-10">
            <ul class="img_wrap  home_recommend clearfix">
              @foreach($goodsinfo as $g)
                <li class="clearfix">
                  <!-- <a href="javascript:;"> -->
                    <p><img src="{{ossUrl($g->cover)}}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"></p>
                    <p>{{$g->title}}</p>
                    <p>
                        @foreach($cateall as $c)
                            @if(in_array($g->catepid,array_flatten($c) ))
                                {{$c->name}}
                            @endif
                        @endforeach
                        - {{$g->catename}}
                    </p>
                    <p>
                      <i></i><span>{{$g->view_num}}</span>
                      <i></i><span>{{$g->collect}}</span>
                      <i></i><span>{{$g->sales_num}}</span></p>
                    <p class="user_img">
                        @if($g->avatar)
                            <img src="{{ossUrl($g->avatar)}}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                        @else
                            <img src="{{Theme::asset()->url('images/default_avatar.png')}}" alt="" >
                        @endif
                        {{$g->usersname}}
                    </p>
                    <div class="shade_div"></div>
                    <div class="shade_content clearfix">
                      <p class="one">
                          @if(Auth::check() && !in_array($g->id,$goods_focus))
                            <a class="shou" id="goods_id" href="javascript:;" goods_id="{{$g->id}}">收藏</a>
                          @elseif(Auth::check())
                              <a class="shou">已经收藏</a>
                          @else
                              <a class="shou" href="{!! URL('/login') !!}">收藏</a>
                          @endif
                          <a href="{{ URL('bre/shop/buyGoodsNew/'.$g->id) }}" class="onload">立即下载</a></p>
                      <p class="two"><a href="{{ URL('bre/shop/buyGoodsNew/'.$g->id) }}"><span  class="twotitle">{{$g->catename}}</span></a></p>
                    </div>
                  <!-- </a> -->
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>


<section class="">
  <div class="paging_div clearfix">
      {!! $goodsinfo->appends($_GET)->render() !!}
     <div class="paging_sel clearfix">
       <span>显示数量：</span>

          <div class="sel_a">

            <span class="ten"><a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['paginate'=> 10])) !!}" >10</a></span>

            <span class="fifteen"><a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['paginate'=> 15])) !!}" >15</a></span>

            <span class="twenty"><a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['paginate'=> 20])) !!}" >20</a></span>

            <span class="twenty_five"><a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['paginate'=> 25])) !!}" >25</a></span>

            <span class="thirty"><a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['paginate'=> 30])) !!}" >30</a></span>

            <span class="thirty_five"><a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['paginate'=> 35])) !!}" >35</a></span>

            <span class="forty"><a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['paginate'=> 40])) !!}" >40</a></span>

            <span class="forty_five"><a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['paginate'=> 45])) !!}" >45</a></span>

            <span class="fifty"><a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['paginate'=> 50])) !!}" >50</a></span>
            <i class="fa fa-angle-down sel"></i>
          </div>
     </div>

  </div>
</section>


{!! Theme::asset()->container('specific-css')->usepath()->add('swiper','css/swiper.min.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('platform_shop','css/shop/platform_shop.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('footer','css/footer.blade.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('swiper','/js/swiper.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('myshop','/js/shop/myshop.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('js','plugins/jquery/js.js') !!}
<script>
</script>