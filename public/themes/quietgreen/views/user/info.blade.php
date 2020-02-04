<div class="mymessage_fenlei info_main">
<p class="mymessage_biaoti">
    <span><img src="{!! Theme::asset()->url('images/User 拷贝 2.png') !!}" alt="" class="mymessage_biaoti_photo"></span>
    <span class="mymessage_biaoti_text">个人资料</span>
</p>
<p class="info_head mymessage_xifen_leixing">
    <span class="main_info sele_info_head">资料完善</span>
    <span class="set_up">扩展资料</span>
    <span class="account_security">账户安全</span>
</p>
</div>

<div class="mymessage_management_box">
    <form class="registerform row"  role="form" action="{{ URL('/user/infoUpdate') }}" method="post">
    {!! csrf_field() !!}
    <!-- 基本信息 -->
    <div class="mymessage">
        <div class="mymessage_xbiaoti">基本信息</div>
        <div class="xinxibox">
            <div class="xinxibox_left">用户名</div>
            <div class="xinxibox_right">
                <input type="text" class="form-control inputxt" disabled="disabled" name="" value="{{$user['name']}}">
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">手机号</div>
            <div class="xinxibox_right">
                {{--<input type="text">--}}
                <input type="text" class="form-control inputxt" disabled="disabled" name="mobile" id="inputNumber" value="{{ $user['mobile'] }}" placeholder="请填写手机号" datatype="m|empty"  errormsg="手机号格式错误！">
                @if(!$user['mobile'])<span class="Validform_checktip  validform-base Validform_wrong"><span class="cor-red">未绑定手机号</span><a href="{{ URL('user/phoneAuth') }}">立即绑定</a></span>@endif
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">邮箱</div>
            <div class="xinxibox_right position_relative">
                {{--<input type="text">--}}
                <input type="text" class="form-control inputxt" disabled="disabled" id="inputText"   value="{{Auth::user()['email']}}">
                @if(Auth::user()->email_status == 2)
                <span class="Validform_checktip col-sm-6 validform-base Validform_right">邮箱已认证</span>
                @else
                <span class="Validform_checktip  validform-base Validform_wrong">未绑定邮箱 <a href="{!! url('user/emailAuth') !!}">点击绑定</a></span>
                @endif
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">性别</div>
            <div class="xinxibox_right">
                <div class="dpxzxz">
                    <label for="grqy_one">男</label>
                    <input checked type="radio" class="dpxzxz_radio" name="sex" id="grqy_one" @if($uinfo->sex==0) checked="" @endif  value="0">
                    <span class="dpxzxz_style"></span>
                </div>
                <div class="dpxzxz">
                    <label for="grqy_two">女</label>
                    <input type="radio" class="dpxzxz_radio" name="sex" id="grqy_two" @if($uinfo->sex==1) checked="" @endif value="1">
                    <span class="dpxzxz_style"></span></div>
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">家乡</div>
            <div class="xinxibox_right">
                <select name="province_home" onchange="checkprovincehome(this)"class="form-control validform-select" datatype="*" nullmsg="请选择省份！" errormsg="请选择省份！">
                    @foreach($province_home as $v)
                        <option value={{ $v['id'] }} {{ ($uinfo['province_home']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                    @endforeach
                </select>
                <select class="form-control  validform-select" name="city_home" id="province_check_home" onchange="checkcityhome(this)" datatype="*" nullmsg="请选择城市！" errormsg="请选择城市！">
                    @foreach($city_home as $v)
                        <option value={{ $v['id'] }} {{ ($uinfo['city_home']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                    @endforeach
                </select>
                <select name="area_home" id="area_check_home" class="form-control  validform-select" datatype="*" nullmsg="请选择区域！" errormsg="请选择区域！">
                    @foreach($area_home as $v)
                        <option value={{ $v['id'] }} {{ ($uinfo['area_home']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">现居</div>
            <div class="xinxibox_right">
                <select name="province" onchange="checkprovince(this)"class="form-control validform-select" datatype="*" nullmsg="请选择省份！" errormsg="请选择省份！">
                    @foreach($province as $v)
                        <option value={{ $v['id'] }} {{ ($uinfo['province']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                    @endforeach
                </select>
                <select class="form-control  validform-select" name="city" id="province_check" onchange="checkcity(this)" datatype="*" nullmsg="请选择城市！" errormsg="请选择城市！">
                    @foreach($city as $v)
                        <option value={{ $v['id'] }} {{ ($uinfo['city']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                    @endforeach
                </select>
                <select name="area" id="area_check" class="form-control  validform-select" datatype="*" nullmsg="请选择区域！" errormsg="请选择区域！">
                    @foreach($area as $v)
                        <option value={{ $v['id'] }} {{ ($uinfo['area']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">职业</div>
            <div class="xinxibox_right">
                <select name="profession_id" class="xinxibox_right_zhiye" datatype="*" nullmsg="请选择职位！" errormsg="请选择职位！">
                    {{--<option>请选择职位</option>--}}
                    @foreach($profession as $p)
                        <option value={{ $p->id }} {{ ($uinfo['profession_id']==$p->id)?'selected':'' }}>{{ $p->profession }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">签名</div>
            <div class="xinxibox_right">
                <input type="text" name="autograph" value="{{$uinfo['autograph']}}">
            </div>
        </div>
        <div class="xinxibox addheight">
            <div class="xinxibox_left">简介</div>
            <div class="xinxibox_right">
                <textarea name="introduce" id="jianjie" class="jianjie" >{{ $uinfo['introduce']?$uinfo['introduce']:'' }}</textarea>
            </div>
        </div>    
        <div class="xinxibaocun">
            <button class="xinxibaocun_btn" type="submit">保存</button>
        </div>
    </div>
    </form>
    <!-- 基本信息 结束 -->

    <!-- 扩展资料 -->
    <div class="tzzl">
        <div class="mymessage_xbiaoti">扩展资料</div>
        <form class="registerform row"  role="form" action="{{ URL('/user/infoExtendUpdate') }}" method="post">
            {!! csrf_field() !!}
        <div class="xinxibox">
            <div class="xinxibox_left">学校名称</div>
            <div class="xinxibox_right">
                <input type="text" name="student" value="{{ $uinfo['student']?$uinfo['student']:'' }}">
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">QQ</div>
            <div class="xinxibox_right">
                <input type="text" name="qq"  value="{{ $uinfo['qq']?$uinfo['qq']:'' }}">
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">微信</div>
            <div class="xinxibox_right">
                <input type="text" name="wechat" value="{{ $uinfo['wechat']?$uinfo['wechat']:'' }}">
            </div>
        </div>
        <div class="xinxibox">
            <div class="xinxibox_left">微博</div>
            <div class="xinxibox_right">
                <input type="text" name="weibo"  value="{{ $uinfo['weibo']?$uinfo['weibo']:'' }}">
            </div>
        </div>
        <div class="bqbox">
            <div class="bqbox_warning">每个作品只能选择三个标签</div>
            <p class="left left_bottom">个人标签
            <div class="bqxzbox">
                @if($signvalue != null)
                @foreach($signvalue  as $s)
                    <span class="bqlbbox" style="width: 84px;" yixuan="ok">
                    <input class="zpbq" value="{{$s->id}}" name="tags[]">
                    <span class="bqname">{{$s->name}}</span>
                    <img src="/themes/quietgreen/assets/images/type/关闭icon.png" alt="" class=""></span>
                @endforeach
                @endif
            </div>
            <p class="bqlb">
                @foreach($cate as $c)
                <span class="bqlbbox">
                    <input class="zpbq" value="{{$c->id}}">
                    <span class="bqname">{{$c->name}}</span>
                </span>
                @endforeach
            </p>
        </div>
        <div class="xinxibaocun">
            <button class="xinxibaocun_btn" type="submit">保存</button>
        </div>
        </form>
    </div>
    <!-- 扩展资料 结束 -->

    <!-- 账户安全 -->
    <div class="security">
        <div class="mymessage_xbiaoti">账户安全</div>
        <div class="security_wrap">
            <div class="accu_main addpadding_30">
                <div class="space-12"></div>
                <p class="login_pwd clearfix">
                    <span>登录密码</span>
                    <span>用于账户登录的密码</span>
                    <a href="{{ URL('/user/loginPassword') }}" class="revise revise_lo" target="_blank"><span>修改</span></a>
                </p>
                <div class="space-12"></div>
                <p class="pay_pwd clearfix">
                    <span>支付密码</span>
                    <span>用于账户支付时使用的密码</span>
                    {{--链接做好了不可删除--}}
                    <a href="{{ URL('/user/payPassword') }}" class="go_auth revise_pay" target="_blank"><span>修改</span></a>
                </p>
                <div class="space-12"></div>
                <p class="go_authentication clearfix">
                    <span>实名认证</span>
                    <a href="{{ URL('/user/realnameAuth') }}" class="go_auth" target="_blank"><span>修改</span></a去认证</span></a>
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

