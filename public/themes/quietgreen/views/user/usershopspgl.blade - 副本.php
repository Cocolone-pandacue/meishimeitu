<div class="mymessage_fenlei info_main">
<p class="mymessage_biaoti">
    <span><img src="{!! Theme::asset()->url('images/Finances.png') !!}" alt="" class="mymessage_biaoti_photo"></span>
    <span class="mymessage_biaoti_text">个人资料</span>
</p>
<p class="info_head mymessage_xifen_leixing">
    <span class=" main_info sele_info_head">资料完善</span>
    <span class="set_up">偏好设置</span>
    <span class="account_security">账户安全</span>
</p>
</div>

<div class="mymessage_management_box">
    <form class="registerform form-horizontal row"  role="form" action="{{ URL('/user/infoUpdate') }}" method="post">
    {!! csrf_field() !!}

    <!-- 资料完善 -->
    <div class="main_info_wrap clearfix">
        <p class="main_data">基本信息</p>
        <div class="">
                <div class="form-group  task-casehid">
                    <label for="inputNumber" class="control-label">手机号</label>
                    {{--未绑定状态--}}
                    {{--<div class="col-sm-5">
                        <span class="cor-red">未绑定手机号</span><a href="javascript:;">立即绑定</a>
                    </div>--}}
                    <div class="col-sm-5">
                        <input type="text" class="form-control inputxt" disabled="disabled" name="mobile" id="inputNumber" value="{{ $user['mobile'] }}" placeholder="请填写手机号" datatype="m|empty"  errormsg="手机号格式错误！">
                        @if(!$user['mobile'])<span class="cor-red">未绑定手机号</span><a href="{{ URL('user/phoneAuth') }}">立即绑定</a>@endif
                        {{--<span class="Validform_checktip col-sm-6 validform-base Validform_right">手机已认证</span>--}}
                    </div>
                </div>
                <div class="form-group ">
                    <label for="inputText" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">邮箱</label>
                    <div class="space-6 visible-xs-block"></div>
                    {{--未绑定状态--}}
                    {{--<div class="col-sm-5">
                        <span class="cor-red">未绑定邮箱</span>&nbsp;&nbsp;&nbsp;<a href="javascript:;">立即绑定</a>
                    </div>--}}
                    <div class="col-sm-5">
                        <input type="text" class="form-control inputxt" disabled id="inputText"   value="{{Auth::user()['email']}}">
                        @if(Auth::user()->email_status == 2)
                        <!-- <span class="Validform_checktip col-sm-6 validform-base Validform_right">邮箱已认证</span> -->
                        @else
                        <span class="Validform_checktip  validform-base Validform_wrong">未绑定邮箱 <a href="{!! url('user/emailAuth') !!}">点击绑定</a></span>
                        @endif
                    </div>
                    <div class="space-8 visible-xs-block"></div>
                </div>
                <div class="form-group ">
                    <label for="inputPassword3" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">性别&nbsp;&nbsp;</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-5 sex_box">
                        <label><input type="radio" name="sex" @if($uinfo->sex==0) checked="" @endif  value="0">男</label>
                        <label><input type="radio" name="sex" @if($uinfo->sex==1) checked="" @endif value="1">女</label>
                    </div>
                    <div class=" visible-xs-block"></div>
                    <div class=" col-sm-12"></div>
                </div>
                <div class="form-group  task-casehid">
                    <label for="inputPassword3" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">现居&nbsp;&nbsp;</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <select name="province" onchange="checkprovince(this)"class="form-control validform-select" datatype="*" nullmsg="请选择省份！" errormsg="请选择省份！">
                                    @foreach($province as $v)
                                        <option value={{ $v['id'] }} {{ ($uinfo['province']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control  validform-select" name="city" id="province_check" onchange="checkcity(this)" datatype="*" nullmsg="请选择城市！" errormsg="请选择城市！">
                                    @foreach($city as $v)
                                        <option value={{ $v['id'] }} {{ ($uinfo['city']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <select name="area" id="area_check" class="form-control  validform-select" datatype="*" nullmsg="请选择区域！" errormsg="请选择区域！">
                            @foreach($area as $v)
                                <option value={{ $v['id'] }} {{ ($uinfo['area']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-sm-12"></div>
                </div>
                <div class="form-group  task-casehid">
                    <label for="inputPassword3" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">家乡&nbsp;&nbsp;</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <select name="province_home" onchange="checkprovincehome(this)"class="form-control validform-select" datatype="*" nullmsg="请选择省份！" errormsg="请选择省份！">
                                    @foreach($province_home as $v)
                                        <option value={{ $v['id'] }} {{ ($uinfo['province_home']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control  validform-select" name="city_home" id="province_check_home" onchange="checkcityhome(this)" datatype="*" nullmsg="请选择城市！" errormsg="请选择城市！">
                                    @foreach($city_home as $v)
                                        <option value={{ $v['id'] }} {{ ($uinfo['city_home']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <select name="area_home" id="area_check_home" class="form-control  validform-select" datatype="*" nullmsg="请选择区域！" errormsg="请选择区域！">
                            @foreach($area_home as $v)
                                <option value={{ $v['id'] }} {{ ($uinfo['area_home']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-sm-12"></div>
                </div>
                <div class="form-group  task-casehid">
                    <label for="inputPassword3" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">职业&nbsp;&nbsp;</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <select name="profession_id" class="form-control validform-select" datatype="*" nullmsg="请选择职位！" errormsg="请选择职位！">
                                    {{--<option>请选择职位</option>--}}
                                    @foreach($profession as $p)
                                        <option value={{ $p->id }} {{ ($uinfo['profession_id']==$p->id)?'selected':'' }}>{{ $p->profession }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="inputEmail" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">签名&nbsp;&nbsp;</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-7 autograph">
                        <textarea class="form-control" rows="2" placeholder="不超过20个汉字或四十个字符"  name="autograph">{{ $uinfo['autograph']?$uinfo['autograph']:'' }}</textarea>
                        <span class="autograph_hint">40</span>
                    </div>
                    <div class=" visible-xs-block"></div>
                </div>
                <div class="form-group ">
                    <label for="inputEmail" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">简介&nbsp;&nbsp;</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-7 abstract">
                        <textarea class="form-control" rows="5" placeholder=""  name="introduce">{{ $uinfo['introduce']?$uinfo['introduce']:'' }}</textarea>
                        <span class="abstract_hint">2000</span>
                    </div>
                    <div class=" visible-xs-block"></div>
                </div>
        </div>
    </div>
    <div class="main_info_wrap clearfix">
        <div class="space-20"></div>
        <p class="main_data">教育背景</p>
        <div class="space-20"></div>
        <div class="col-xs-12 nopd768">
                <div class="form-group  task-casehid">
                    <label for="inputEmail" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">学校名称</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control inputxt" id="inputEmail" name="student" value="{{ $uinfo['student']?$uinfo['student']:'' }}" placeholder="请填写学校" >
                    </div>
                    <div class="space-12 visible-xs-block"></div>
                    <div class=" col-sm-12"></div>
                </div>
        </div>
    </div>
    <div class="main_info_wrap clearfix">
        <div class="space-20"></div>
        <p class="main_data">联系方式</p>
        <div class="space-20"></div>
        <div class="col-xs-12 nopd768">
                <div class="form-group  task-casehid">
                    <label for="inputEmail" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">微信</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control inputxt" id="inputEmail" name="wechat" value="{{ $uinfo['wechat']?$uinfo['wechat']:'' }}" placeholder="微信号" >
                    </div>
                    <div class="space-12 visible-xs-block"></div>
                    <div class=" col-sm-12"></div>
                </div>
                <div class="form-group  task-casehid">
                    <label for="QQ" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">QQ</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-5 ">
                        <input type="text" class="form-control inputxt"  name="qq"  value="{{ $uinfo['qq']?$uinfo['qq']:'' }}" >
                    </div>
                    <div class=" col-sm-12"></div>
                </div>
        </div>
    </div>
    <div class="main_info_wrap clearfix">
        <div class="space-20"></div>
        <p class="main_data">个人链接</p>
        <div class="space-20"></div>
        <div class="col-xs-12 nopd768">
                <div class="form-group  task-casehid">
                    <label for="weibo" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">微博</label>
                    <div class="space-6 visible-xs-block"></div>
                    <div class="col-sm-5 ">
                        <input type="text" class="form-control inputxt"  name="weibo"  value="{{ $uinfo['weibo']?$uinfo['weibo']:'' }}" >
                    </div>
                    <div class=" col-sm-12"></div>
                </div>
        </div>
    </div>
    <div class="main_info_wrap clearfix">
        <div class="space-20"></div>
        <p class="main_data">个人标签</p>
        <div class="space-20"></div>
        <label for="inputPassword3" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">标签</label>
        <div class="space-6 visible-xs-block"></div>
        <div class="col-sm-5">
            <div class="row">
                <div class="col-sm-6">
                    <select name="sign" class="form-control validform-select" datatype="*" nullmsg="请选择标签！" errormsg="请选择标签！">
                        {{--<option>请选择个人标签！</option>--}}
                        @foreach($hotTag as $h)
                        <option value={{$h->id}} {{($uinfo['sign']==$h['id'])?'selected':''}}>{{$h->tag_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group btn_wrap">
        <div class="space-20"></div>
        <button class="btn  btn-big  bor-radius2 btn-sm btn-imp" type="submit">保存</button>

    </div>



    </form>


    <!-- 偏好设置 -->
    <div class="set_up_wrap hide">
        <img src="{{Theme::asset()->url('images/meishimeitu/personal/noopen.png')}}" alt="">
    </div>
    <!-- 账户安全 -->

    <div class="account_security_wrap ">
        <div class="accu_main hide">

            <div class="space-12"></div>
            <p class="login_pwd clearfix">
                <span>登录密码</span>
                <span>用于账户登录的密码</span>
                <span class="revise revise_lo"><a href="{{ URL('/user/loginPassword') }}">修改</a></span>
            </p>
            <div class="space-12"></div>
            <p class="pay_pwd clearfix">
                <span>支付密码</span>
                <span>用于账户支付时使用的密码</span>
                {{--链接做好了不可删除--}}
                {{--<span class="go_auth revise_pay"><a href="{{ URL('/user/payPassword') }}">修改</a></span>--}}
                <span class="go_auth revise_pay"><a href="#">修改</a></span>
            </p>
            <div class="space-12"></div>
            <p class="go_authentication clearfix ">
                <span>实名认证</span>
                <span></span>
                <span class="go_auth"><a href="{{ URL('/user/realnameAuth') }}">去认证</a></span>
            </p>
        </div>
        <div class="revise_lo_wrap hide">
            <p class="accu_title">修改密码</p>
            <div class="space-12"></div>
            <p class="int_box"><input type="password" placeholder="原始登录密码" name=""></p>
            <div class="space-12"></div>
            <p class="int_box">
                <input type="password" placeholder="新密码" name="">
                <span class="no_see see_paw"></span>
            </p>

            <div class="space-12"></div>
            <p class="int_box">
                <input type="password" placeholder="确认密码" name="">
                <span class="no_see see_paw"></span>
            </p>

            <div class="space-12"></div>
            <p class="btn_box">
                <span class="sure sure_lo">确定</span>
                <span class="go_back go_back_lo">返回</span>
            </p>
        </div>
        <div class="revise_pay_wrap hide">
            <p class="accu_title">修改密码</p>
            <div class="space-12"></div>
            <input type="password" placeholder="原始支付密码" name="">
            <div class="space-12"></div>
            <input type="password" placeholder="新密码" name="">
            <span class="no_see see_paw"></span>
            <div class="space-12"></div>
            <p class="btn_box">
                <span class="sure sure_pay">确定</span>
                <span class="go_back go_back_pay">返回</span>
            </p>
        </div>
        <div class="auth_wrap hide">
            <p class="accu_title">实名认证</p>
            <div class="space-12"></div>
            <input type="text" placeholder="身份证号码" name="">
            <div class="space-12"></div>
            <input type="text" placeholder="真实姓名" name="">
            <div class="space-12"></div>
            <div class="up_pic clearfix">
                <div class="zheng fl">
                    <p>身份证正面</p>
                    <div class="pic_box">
                        <img id="cropedBigImg" src="{{Theme::asset()->url('images/meishimeitu/personal/zheng.png')}}" alt="">
                    </div>
                    <span class="in_box">点击上传<input id="zheng" type="file" name=""></span>
                </div>
                <div class="fan fl">
                    <p>身份证反面面</p>
                    <div class="pic_box">
                        <img src="{{Theme::asset()->url('images/meishimeitu/personal/fan.png')}}" alt="">
                    </div>
                    <span class="in_box">点击上传<input type="file" name=""></span>
                </div>
            </div>
            <div class="space-20"></div>
            <p class="btn_box">
                <span class="sure sure_auth">确定</span>
                <span class="go_back go_back_auth">返回</span>
            </p>
        </div>
    </div>
</div>
{!! Theme::asset()->container('specific-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('safety','css/usercenter/safety/safety-layout.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-style','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('info','css/meishimeitu/info.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('infojs','js/meishimeitu/info.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('paypassword','js/doc/userinfo.js') !!}
{!! Theme::widget('popup')->render() !!}
{!! Theme::widget('avatar')->render() !!}

