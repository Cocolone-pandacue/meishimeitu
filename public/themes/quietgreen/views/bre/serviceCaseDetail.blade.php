<div class="top">
    <div class="top_mid">
        <div class="left">
            <div class="headline">{{$goods['title']}}</div>
            <div class="created_at">{{$goods['created_at']}}发布</div>
            <div class="flexbuju">
                <div class="form">{{$goods['caname']}}</div>
                <div class="count">
                    <div class="mywork_photo_littlebox_icon_liulanshu"><img src="{!! Theme::asset()->url('images/browse.png') !!}" alt="">{{$goods['view_num']}}</div>
                    <div class="mywork_photo_littlebox_icon_shoucangshu"><img src="{!! Theme::asset()->url('images/collect_icon.png') !!}" alt=""><span>{{$goods['collect']}}</span></div>
                    <div class="mywork_photo_littlebox_icon_xiazaishu"><img src="{!! Theme::asset()->url('images/down.png') !!}" alt="">{{$goods['sales_num']}}</div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="float_left">
                <a href="/bre/serviceEvaluateDetail/{{$uid}}">
                @if($goods['avatar'] == '')
                    <img src="{!! Theme::asset()->url('images/meishimeitu/personal/pic.png') !!}" alt="" class="portrait">
                @else
                    <img src="{{ossUrl($goods['avatar'])}}" alt="" class="portrait">
                @endif
                </a>
            </div>
            <div class="space_10"></div>
            <div class="float_left">
                <p class="usename">{{$goods['usname']}}</p>
                <p><span class="address">{{$goods['dtname']}}</span><span class="type">{{$goods['profession']}}</span></p>
                <p class="margin_12">
                @if(Auth::check())
                    @if(Auth::id() != $uid)
                        @if(!empty($is_focus))
                            <p class="focus alfocus" focus_uid = "{{ $uid }}">已关注</p><p class="space_20"></p>
                        @else
                            <p class="focus" focus_uid = "{{ $uid }}">关注</p><p class="space_20"></p>
                        @endif
                            <p class="im" uid = "{{ $uid }}" url="/bre/contactMe" onclick="message($(this))">私信</p>
                    @endif
                @else
                <a href="{!! URL('/login') !!}"><div class="focus_lo patient" style="">关注</div><p class="space_20"></p></a>
                <a href="{!! URL('/login') !!}"><div class="im">私信</div></a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="photo_box">
    @if($goods['file'] != "" && json_decode($goods['file']))
    @foreach(json_decode($goods['file']) as $g)
        <div class="photo_littlebox">
            <img src="{{ossUrl($g)}}" alt="" class="">
        </div>
    @endforeach
    @endif
</div>
<div class="database">
    <div class="tag">作品标签 ：
        @if($tagsval != "")
            @foreach($tagsval as $t)
                <div class="design_box">{{$t->tag_name}}</div>
            @endforeach
        @endif
    </div>
        @if(Auth::check())
            @if($goodfocus != null)
            <div class="collect shou_yes"  goods_id="{{$goods['id']}}"  onclick="enshrine($(this))">
                <!-- <img src="{!! Theme::asset()->url('images/collect_icon.png') !!}" alt="" class=""> -->
                已收藏
            @else
            <div class="collect"  goods_id="{{$goods['id']}}"  onclick="enshrine($(this))">
                <!-- <img src="{!! Theme::asset()->url('images/collect_icon.png') !!}" alt="" class=""> -->
                收藏
            @endif
        @else
            <div class="collect"  goods_id="{{$goods['id']}}">
                <!-- <img src="{!! Theme::asset()->url('images/collect_icon.png') !!}" alt="" class=""> -->
                收藏
        @endif
    </div>
</div>
<!-- 有作品 有留言 -->
<div class="paragraph_four">
    <div class="comment_bigbox">
        @if(Auth::check())
        <input class="comment_input" type="text" placeholder="留下要说的话" name="leaveworld" id="comment_id">
        <button class="comment_btn" id="" delurl="/bre/ajaxCommentGoodsDel"  url="/bre/ajaxCommentGoods" type="button" suid = "{{ $id }}" task_id="" token="{{ csrf_token() }}" onclick="ajaxComment($(this))">留言</button>
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
                                <img src="{{Theme::asset()->url('images/Dialog.png')}}" delurl="/bre/ajaxCommentGoodsDel" alt="" class="dialog" comment_id="{{ $s['id']}}" onclick = "showRepeat($(this))">
                                @if(Auth::id() == $s['uid'])
                                <img src="{{Theme::asset()->url('images/Garbage.png')}}" delurl="/bre/ajaxCommentGoodsDel" alt="" class="garbage" decid="{{ $s['id']}}" token="{{ csrf_token() }}" onclick = "deleteComment($(this))">
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
                                <button class="repeat_btn" zid = "{{ $s['id']}}" pid="{{ $s['id']}}" rid="0" delurl="/bre/ajaxCommentGoodsDel" url="/bre/ajaxCommentGoods" type="button" suid = "{{ $id }}" token="{{ csrf_token() }}" onclick="rePeat($(this))">回复</button>
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
                                        <img src="{{Theme::asset()->url('images/Dialog.png')}}"  delurl="/bre/ajaxCommentGoodsDel" alt="" class="dialog"  comment_id="{{ $sc['id']}}" onclick = "showRepeatRe($(this))">
                                        @if(Auth::id() == $s['uid'])
                                        <img src="{{Theme::asset()->url('images/Garbage.png')}}"  delurl="/bre/ajaxCommentGoodsDel" alt="" class="garbage" decid="{{ $sc['id']}}" token="{{ csrf_token() }}"  onclick = "deleteRepeat($(this))">
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
                                        <button class="repeat_btn" pid="{{ $s['id']}}"  delurl="/bre/ajaxCommentGoodsDel" zid="{{ $sc['id']}}" rid="{{ $sc['id']}}" url="/bre/ajaxCommentGoods" type="button" suid = "{{ $id }}" task_id="" token="{{ csrf_token() }}" onclick="rePeatRe($(this))">回复</button>
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



{!! Theme::asset()->container('custom-css')->usepath()->add('serviceCaseDetail','css/serviceCaseDetail.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('serviceEvaluateDetail','css/serivceCase.css') !!}


{!! Theme::asset()->container('old-css')->usepath()->add('main','css/main.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('header','css/header.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('footer','css/index/common.css') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('serviceCase','js/doc/serviceCase.js') !!}