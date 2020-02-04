<div class="paragraph_one">
    <img src="{!! Theme::asset()->url('images/head.png') !!}" alt="" class="parent">
    @if($introduce['avatar']=="")
    <img src="{!! Theme::asset()->url('images/meishimeitu/personal/pic.png') !!}" alt="" class="child">
    @else()
    <img src="{{ossUrl($introduce['avatar'])}}" class="child"/>
    @endif()
</div>
<div class="paragraph_two">
    <div class="middle">
        <div class="username">{{ $user->name}}</div>
        <div class="focus_im">
            <!-- <div class="focus ifocus">关注</div> -->
            @if(Auth::check())
                @if(Auth::id() != $uid)
                    @if(!empty($is_focus))
                        {{--<a class="followed-me" id="focus_uid"> <i class="glyphicon glyphicon-minus"></i>已关注 </a>--}}
                        <div class="focus alfocus" focus_uid = "{{ $uid }}">已关注</div>
                    @else
                        {{--<a class="follow-me" id="focus_uid"> <i class="glyphicon glyphicon-plus"></i>加关注 </a>--}}
                        <div class="focus" focus_uid = "{{ $uid }}">关注</div>
                    @endif
                        <div class="im" uid = "{{ $uid }}" url="/bre/contactMe" onclick="message($(this))">私信</div>
                @endif
            @else
                <a href="{!! URL('/login') !!}"><div class="focus_lo">关注</div></a>
                <a href="{!! URL('/login') !!}"><div class="im">私信</div></a>
            @endif
            <!-- <div class="im">私信</div> -->
        </div>
        <div class="guide">
            <div class="border_bottom color_black">作品</div>
            <div>店铺</div>
            <div>资料</div>
        </div>
    </div>
</div>
<!-- 有作品 有留言 -->
 <div class="paragraph_three">
     @if(!empty($goods_list_data['data']))
        <div class="mywork_photo">
            <div class="mywork_photo_biaoti">共{{$shopGoodsnum}}个作品</div>
            <div class="mywork_photo_box">
                @foreach($goods_list_data['data'] as $item)
                    <div class="mywork_photo_littlebox">
                        <a href="{!! URL('/bre/serviceCaseDetail/'.$item['id'].'/'.$uid) !!}"><p class="mywork_photo_littlebox_photobox">
                            @if($item['cover'])
                                <img src="{{ossUrl($item['cover'])}}" alt="" class="mywork_photo_littlebox_photo">
                            @else
                                <img src="{{Theme::asset()->url('images/employ/bg2.jpg')}}" alt="" class="mywork_photo_littlebox_photo">
                            @endif
                        </p></a>
                        <p class="mywork_photo_littlebox_text">{{$item['title']}}</p>
                        <p class="mywork_photo_littlebox_atext">{{$item['catename']}}</p>
                        <p class="mywork_photo_littlebox_icon">
                            <span class="mywork_photo_littlebox_icon_liulanshu"><img src="{!! Theme::asset()->url('images/浏览图标.png') !!}" alt="">{{$item['view_num']}}</span>
                            <span class="mywork_photo_littlebox_icon_shoucangshu"><img src="{!! Theme::asset()->url('images/收藏图标.png') !!}" alt="">{{$item['collect']}}</span>
                            <span class="mywork_photo_littlebox_icon_xiazaishu"><img src="{!! Theme::asset()->url('images/下载图标.png') !!}" alt="">{{$item['sales_num']}}</span>
                        </p>
                        <div class="mywork_photo_littlebox_zuidibu">
                            <div class="mywork_photo_littlebox_zuidibu_djs">{{$item['created_at']}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
         <div class="text-center">
            {!! $goods_list->appends($merge)->render() !!}
         </div>
     @else
         <div class="no_work">
            <img src="{{Theme::asset()->url('images/no_work.png')}}" alt="" class="no_work_img">
            <span>这家伙很懒！</span>
         </div>
     @endif
</div>
<div class="paragraph_four">
    <div class="comment_bigbox">
        @if(Auth::check())
        <input class="comment_input" type="text" placeholder="留下要说的话" name="leaveworld" id="comment_id">
        <button class="comment_btn" id=""  url="/bre/ajaxComment" delurl="/bre/ajaxCommentDel" type="button" suid = "{{ $uid }}" task_id="" token="{{ csrf_token() }}" onclick="ajaxComment($(this))">留言</button>
        @else    
        <a href="{!! URL('/login') !!}"><div class="login_check">请登录后留言</div></a>
        @endif
        <div class="comment">
            @if(!empty($scommentsdata['data']))
            <div class="comment_count">全部评论<span>{{$scommentsnum}}</span></div>
            @foreach($scommentsdata['data'] as $s)
            <div class="comment_box" id="{{ $s['id']}}">
                <div class="flex_buju">
                    <div class="">
                        @if($s['avatar'])
                            <img src="{{ossUrl($s['avatar'])}}" alt="" class="user_photo">
                        @else
                            <img src="{{Theme::asset()->url('images/meishimeitu/personal/pic.png')}}" alt="" class="user_photo">
                        @endif
                    </div>
                    <div class="width_1064 height_auto">
                        <div class="inline_block">
                            <span class="user_name">{{$s['nickname']}}</span>
                            <span class="create_time">{{$s['created_at']}}</span>
                        </div>
                        <div class="block padding_bottom_20">
                            <span class="comment_content">{{$s['comment']}}</span>
                        </div>
                        <div class="flex_buju">
                            <div></div>
                            <div class="">
                            @if(Auth::check())
                                <img src="{{Theme::asset()->url('images/Dialog.png')}}" delurl="/bre/ajaxCommentDel" alt="" class="dialog" comment_id="{{ $s['id']}}" onclick = "showRepeat($(this))">
                                @if(Auth::id() == $s['uid'])
                                <img src="{{Theme::asset()->url('images/Garbage.png')}}" delurl="/bre/ajaxCommentDel" alt="" class="garbage" decid="{{ $s['id']}}" token="{{ csrf_token() }}" onclick = "deleteComment($(this))">
                                @endif
                            @else
                                <a href="{!! URL('/login') !!}"><div class="cor">请登录后回复</div></a>
                            @endif
                            </div>
                        </div>
                        <div class="inputxt deblock dehide repeat_id" id = "comment_{{ $s['id']}}">
                            <input class="input_comment" type="text" placeholder="" name="repeat" id = "value_{{ $s['id']}}">
                            <div class="flex_buju">
                                <div class=""></div>
                                <button class="repeat_btn" zid = "{{ $s['id']}}" pid="{{ $s['id']}}" rid="0" delurl="/bre/ajaxCommentDel" url="/bre/ajaxComment" type="button" suid = "{{ $uid }}" token="{{ csrf_token() }}" onclick="rePeat($(this))">回复</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 回复框架 -->
                @if($scommentspidnew != null)
                @foreach($scommentspidnew as $sco)
                @foreach($sco as $sc)
                @if($sc['pid'] == $s['id'])
                <div class="flex_buju margin_de">
                    <div></div>
                    <div class="repeatBox">
                        <div class="flex_buju">
                            <div class="">
                                @if($sc['avatar'])
                                    <img src="{{ossUrl($sc['avatar'])}}" alt="" class="user_photo margin_40">
                                @else
                                    <img src="{{Theme::asset()->url('images/meishimeitu/personal/pic.png')}}" alt="" class="user_photo margin_40">
                                @endif
                            </div>
                            <div class="width_970 height_auto">
                                <div class="inline_block">
                                    <span class="user_name">{{$sc['nickname']}}</span>
                                    <span class="create_time">{{$sc['created_at']}}</span>
                                </div>
                                <div class="block padding_bottom_20">
                                    <span class="comment_content">
                                        @if($sc['parent_comment']['nickname'])
                                        回复：{{$sc['parent_comment']['nickname']}}&nbsp;&nbsp;{{$sc['comment']}}
                                        @else
                                            {{$sc['comment']}}
                                        @endif
                                    </span>
                                </div>
                                <div class="flex_buju">
                                    <div></div>
                                    <div class="">
                                    @if(Auth::check())
                                        <img src="{{Theme::asset()->url('images/Dialog.png')}}" alt="" class="dialog"  comment_id="{{ $sc['id']}}" onclick = "showRepeatRe($(this))">
                                        @if(Auth::id() == $s['uid'])
                                        <img src="{{Theme::asset()->url('images/Garbage.png')}}" alt="" class="garbage" delurl="/bre/ajaxCommentDel" decid="{{ $sc['id']}}" token="{{ csrf_token() }}"  onclick = "deleteRepeat($(this))">
                                        @endif
                                    @else
                                        <a href="{!! URL('/login') !!}"><div class="cor">请登录后回复</div></a>
                                    @endif
                                    </div>
                                </div>
                                <div class="inputxt deblock dehide margin_10" id = "comment_{{ $sc['id']}}">
                                    <input class="input_repeat" type="text" placeholder="" name="repeat" id = "value_{{ $sc['id']}}">
                                    <div class="flex_buju">
                                        <div class=""></div>
                                        <button class="repeat_btn" pid="{{ $s['id']}}" zid="{{ $sc['id']}}" rid="{{ $sc['id']}}" url="/bre/ajaxComment" type="button" suid = "{{ $uid }}" task_id="" token="{{ csrf_token() }}" onclick="rePeatRe($(this))">回复</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 回复框架结束 -->
                @endif
                @endforeach
                @endforeach
                @endif
            </div>
            @endforeach
            <div class="text-center">
                {!! $scomments->appends($merge)->render() !!}
            </div>
            @else
            <div class="comment_count">全部评论<span class="comment_count_num"></span></div>
            <div class="no_comment">
                <img src="{{Theme::asset()->url('images/no_work.png')}}" alt="" class="no_work_img">
                <span>还没留言！</span>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- 有作品 有留言 結束  -->
<!-- 沒作品 沒留言 -->
<!-- <div class="paragraph_four">
    <div class="comment_bigbox">
        <input class="comment_input" type="text" placeholder="留下要说的话" name="leaveworld" id="comment_id">
        <button class="comment_btn bac_yellow" id=""  url="/task/ajaxComment" type="button" work_id = "comment_id" task_id="" token="{{ csrf_token() }}" onclick=''>留言</button>
        <div class="no_comment">
            <img src="{{Theme::asset()->url('images/no_work.png')}}" alt="" class="no_work_img">
            <span>还没留言！</span>
        </div>
    </div>
</div> -->
<!-- 沒作品 沒留言 結束 -->

<!-- 私信弹框 -->

<div id="message" style="display:none">
    <input name="title" id="message_input"  type="text" placeholder="请输入标题">
    <textarea name="content" id="message_textarea" type="text" placeholder="请输入内容">
        
    </textarea>
</div>





<img src="{{Theme::asset()->url('images/Warning.png')}}" alt="" class="warning hide">
<img src="{{Theme::asset()->url('images/Dialog.png')}}" alt="" class="dialog hide">
<img src="{{Theme::asset()->url('images/Like.png')}}" alt="" class="like hide">
<img src="{{Theme::asset()->url('images/Garbage.png')}}" alt="" class="garbage hide">



{!! Theme::asset()->container('custom-css')->usepath()->add('serviceEvaluateDetail','css/serivceCase.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('serviceCase','js/doc/serviceCase.js') !!}