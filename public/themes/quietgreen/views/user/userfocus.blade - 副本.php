<!-- <div class="userfocus_head_wrap g-releasetask clearfix">
    <p class="userfocus_head"><span>我的关注</span></p>
    <div class="space-12"></div>

    <!-- 状态 -->
    <!-- <div class="col-lg-12 clearfix title_box">
        <div class="col-lg-1 cor-gray51 text-size14 col-sm-2 col-xs-12">
            <div class="row row_title">全部</div>
        </div>
        <div class="col-lg-11 col-sm-10  col-xs-12 g-task-select">
            <a class="all_title" href="">全部</a>
        </div>
    </div>
</div> -->

<!-- <div class="userfocus_content ">
    <h4 class="text-size16 cor-blue u-title">我的关注</h4>
    <div class="space-20"></div>
    <ul class="row s-myul">
        @if($focus_data['total']>0)
            @foreach($focus_data['data'] as $v)
            <li class="col-lg-6 " id="focus-remove-{{ $v['id'] }}">
                <div class="media-left">
                    <div class="s-myimg">
                        <img class=" pull-left img-responsive" src="{{ CommonClass::getDomain().'/'.CommonClass::getAvatar($v['focus_uid']) }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))" alt="...">
                    </div>
                </div>
                <div class="media-body">
                    <div class="clearfix">
                        <a href="/bre/serviceCaseList/{{$v['focus_uid']}}" class=" pull-left text-muted text-size16 cor-blue s-myname">{{ $v['nickname'] }}</a><a class="pull-right s-mtcutbtn" data-target="#myModal-{{ $v['id'] }}" data-toggle="modal" >取消关注</a>
                    </div>
                    <div class="space-4"></div>
                    <div>
                        <p class="cor-gray97">好评率{{ CommonClass::applauseRate($v['uid']) }}%</p>
                    </div>
                    <div class="space-2"></div>
                    <div>
                        @if(count($v['tags'])<=3)
                            @foreach($v['tags'] as $value)
                                <a class="s-mybtn" href="javscript:;">{{ $value['tag_name'] }}</a>
                            @endforeach
                        @else
                            @foreach(array_slice($v['tags'],0,3) as $value)
                                <a class="s-mybtn" href="javscript:;">{{ $value['tag_name'] }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
                模态框（Modal）
                <div class="modal fade" id="myModal-{{ $v['id'] }}" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header widget-header-flat">
                                <span class="modal-title" id="myModalLabel">
                                    审核提示：
                                </span>
                            </div>
                            <div class="modal-body text-center">
                                <p class="h5">确定将“<span class="text-primary">{{ $v['nickname'] }}</span>”取消关注？</p>
                                <div class="space"></div>
                                <p><button class="btn btn-primary btn-blue bor-radius2" type="button"  id="win-bid" data-dismiss="modal" onclick="removeFocus({{ $v['id'] }})">确 定</button>　　<button class="btn bor-radius2" type="button" data-dismiss="modal">取 消</button></p>
                            </div>
                        </div>/.modal-content
                    </div>/.modal
                </div>
            </li>
            @endforeach
        @else
            <div class="g-nomessage">暂无关注哦 ！</div>
        @endif
    </ul>
    <div class="clearfix">
        <ul class="pagination pull-right">
            {{--@if(!is_null($focus_data['prev_page_url']))--}}
                {{--<li><a href="{{ $focus_data['prev_page_url'] }}">&lt;</a></li>--}}
            {{--@endif--}}
            {{--@if($focus_data['last_page']>1)--}}
                {{--@for($i=1;$i<=$focus_data['last_page'];$i++)--}}
                    {{--<li class="{{ ($i==$focus_data['current_page'])?'active':'' }}"><a href="{{ 'userfocus?page='.$i }}" class="bg-blue">{{ $i }}</a></li>--}}
                {{--@endfor--}}
            {{--@endif--}}
            {{--@if(!is_null($focus_data['next_page_url']))--}}
                {{--<li><a href="{{ $focus_data['next_page_url'] }}">&gt;</a></li>--}}
            {{--@endif--}}
            {!! $focus->appends($_GET)->render() !!}
        </ul>
    </div>
    <img src="{{Theme::asset()->url('images/meishimeitu/personal/no_works.png')}}" alt="">
</div> -->


<!-- 以上为废弃版本 -->






<!-- 有作品 -->
<ul class="myfocu">
    <li class="myfocu_fenlei">
        <p class="myfocu_biaoti">
            <span><img src="{!! Theme::asset()->url('images/分享.png') !!}" alt="" class="myfocu_biaoti_photo"></span>
            <span class="myfocu_biaoti_text">我的关注</span>
        </p>
        <p class="myfocu_zr">
            <a class="myfocu_zr_zpdt myfocu_zr_border">作品动态</a>
            <a class="myfocu_zr_gzdr">关注的人</a>
        </p>
    </li>

    <!-- 有作品 作品动态-->  

    <!-- <li class="myfocu_photo">
        <div class="myfocu_photo_biaoti">作品动态</div>
        <div class="myfocu_photo_box">
            <div class="myfocu_photo_littlebox">
                <p class="myfocu_photo_littlebox_photobox">
                    <img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="myfocu_photo_littlebox_photo">
                </p>
                <p class="myfocu_photo_littlebox_text">标题</p>
                <p class="myfocu_photo_littlebox_atext">分类</p>
                <p class="myfocu_photo_littlebox_icon">
                    <span class="myfocu_photo_littlebox_icon_liulanshu"><img src="{!! Theme::asset()->url('images/浏览图标.png') !!}" alt="">0</span>
                    <span class="myfocu_photo_litt lebox_icon_shoucangshu"><img src="{!! Theme::asset()->url('images/收藏图标.png') !!}" alt="">0</span>
                    <span class="myfocu_photo_littlebox_icon_xiazaishu"><img src="{!! Theme::asset()->url('images/下载图标.png') !!}" alt="">0</span>
                </p>
                <p class="myfocu_photo_littlebox_zuidibu">
                    <span class="myfocu_photo_littlebox_zuidibu_bj"><img src="{!! Theme::asset()->url('images/头像.png') !!}" alt=""></span>
                    <span class="myfocu_photo_littlebox_zuidibu_sc">作者名称</span>
                    <span class="myfocu_photo_littlebox_zuidibu_djs">1小时前</span>
                </p>
            </div> 
        </div>  
    </li> -->

    <!-- 有作品 作品动态 结束 -->  


    <!-- 有作品  关注的人 -->
    @foreach($focus_data['data'] as $v)
    <li class="foucusman_photo">
        <div class="foucusman_photo_biaoti">共18个关注人</div>
        <div class="foucusman_photo_box">
            <div class="foucusman_photo_littlebox">
                <div class="foucusman_photo_littlebox_photobox">
                    <a><img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="foucusman_photo_littlebox_photo"></a>
                </div>
                <div class="foucusman_photo_text">
                    <p class="sjsmc">设计师名称</p>
                    <p class="dzzc"><span class="dz">上海</span><span class="sx"></span><span class="zc">平面设计师</span></p>
                    <p class="zofs"><span class="zp">作品&nbsp;999</span><span class="sx"></span><span class="fs">粉丝&nbsp;999</span></p>
                </div>
                <div class="gz" data-toggle="modal" data-target="#mymodel_{{ $v['id'] }}">已关注</div>
                <div id="mymodel_{{ $v['id'] }}" class="modal fade gz_qx" tabindex="-1" role="dialog">
                    <div class="gz_qx_gb"><label for="gz_qx_qdqx_qx"><img src="{!! Theme::asset()->url('images/type/关闭icon.png') !!}" alt="" class="foucusman_photo_littlebox_photo"></label></div>
                    <div class="gz_qx_ms">是否取消关注？</div>
                    <div class="gz_qx_qdqx">
                        <button class="gz_qx_qdqx_qd" id="win-bid" data-dismiss="modal" onclick="removeFocus({{ $v['id'] }})">确定</button>
                        <button id="gz_qx_qdqx_qx" class="gz_qx_qdqx_qx" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
            <div class="foucusman_photo_png">
                <img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="foucusman_photo_pngone">
            </div>
            <div class="foucusman_photo_png">
                <img src="{!! Theme::asset()->url('images/mybg.png') !!}" alt="" class="foucusman_photo_pngone">
            </div>
            <div class="foucusman_photo_gd">
                <a><img src="{!! Theme::asset()->url('images/更多.png') !!}" alt="" class="foucusman_photo_gdxx"></a>
            </div>
        </div>  
    </li>
    @endforeach
    <!-- 有作品  关注的人  结束 -->


    <div class="paging_bootstrap text-center">
        <ul class="pagination case-page-list">
            <ul class="pagination">
                <li class="disabled"><span>«</span></li>
                <li class="active"><span>1</span></li>
                <li><span><a href="#">2</a></span></li>
                <li><span><a href="#">3</a></span></li>
                <li><span><a href="#">4</a></span></li>
                <li><span><a href="#">5</a></span></li>
                <li><span><a href="#" rel="next">»</a></span></li>
            </ul>
        </ul>
    </div>
</ul>

<!-- 暂无作品 -->
<!-- <div class="no_works">
    <img src="{{Theme::asset()->url('images/meishimeitu/personal/no_works.png')}}" alt="">
</div> -->



     


<!-- 店铺设计 -->
    <!-- <div class="row close-space-tip">
        <div class="col-md-12 text-center">
            <div class="space-30"></div>
            <div class="space-30"></div>
            <div class="space-30"></div>
            <img src="{!! Theme::asset()->url('images/nomessage.png') !!}" >
            <div class="space-10"></div>
            <p class="text-size16 cor-gray87">您的店铺还没设置，暂不能查看作品管理！<a href="/user/shop">店铺设置</a></p>
        </div>
    </div> -->


{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('userfocus','js/doc/userfocus.js') !!}

{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('userfocus','css/meishimeitu/userfocus.css') !!}