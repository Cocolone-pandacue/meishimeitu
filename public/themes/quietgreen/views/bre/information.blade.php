<div class="location">
    <div class="container">
        <i class="home_icon"></i>&nbsp;&nbsp;&nbsp;<a href="{!! CommonClass::homePage() !!}">首页</a> <span class="ri_horn"></span><span>{{$NavName}}</span>
    </div>
</div>
<section class="shop consult ">
    <div class="container">
        <div class="nav">
            @if(!empty($category->toArray()))
                @foreach($category as $v)
                    <a @if($catID == $v->id  )class="active" @endif href="{!! URL('article?catID='.$v->id) !!}">
                        {{ $v['cate_name'] }}
                    </a>
                @endforeach
            @endif
        </div>
        @if(!empty($list['data']))
        <ul class="clearfix list">

            @foreach($list['data'] as $v)
                <li class="clearfix">
                    <div class="col-lg-2 text-center">
                        <p class="number">{{ date('d',strtotime($v['created_at'])) }}</p>
                        <p class="timer">{{ date('Y-m',strtotime($v['created_at'])) }}</p>
                    </div>
                    <div class="col-lg-10 list-r">
                        <h4 class="tit"><a href="{!! URL('article/'.$v['id']) !!}"> {{  $v['title'] }}</a></h4>
                        <p class="content">
                            {{ $v['summary'] }}
                        </p>
                    </div>
                </li>
            @endforeach

        </ul>
        @endif
        <div class="clearfix">
            <div class=" paging_bootstrap text-center">
                <ul class="pagination case-page-list">
                    {!! $list_obj->appends($_GET)->render() !!}
                </ul>
            </div>
        </div>
    </div>
</section>