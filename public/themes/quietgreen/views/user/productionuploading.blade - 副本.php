{!! Theme::widget('wrapBox')->render() !!}
<form action="/user/productionUploading" method="post" id="form" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
{!! csrf_field() !!}

<!-- 上传文件窗口 -->
    <div class="tanchuang">
        <div class="tanchuang_shangchuan">
            <img src="{!! Theme::asset()->url('/images/type/关闭icon.png') !!}" alt="" class="shejishiruzhu_tuichu">
            <div class="tanchuang_shangchuan_wenbenkuang">
                <div class="shangchuanzuoping">上传作品</div>
                <div class="hengxian"></div>
                <div class="anli">案例1</div>
                <div class="shangchuankuang_waibao">
                    <input id="shangchuankuang" type="file" multiple="multiple" onchange="getFileName(event)" name="fileone[]">
                    <i class="fa fa-skyatlas fa-5x"></i>
                    <p class="text">将文件拖到此处，或
                        <label for="shangchuankuang" class="dianjishangchuan">点击上传</label>
                </div>
            </div>
            <div class="zhushi">最多传10个文件，单个文件不超过5M
                <div id="yishangchuanliebiao">

                </div>
            </div>
            <div class="liebiaoxiahengxian"></div>
            <div class="queding">确定</div>
        </div>
        <div class="tanchuang_shangchuan_two">
            <img src="{!! Theme::asset()->url('/images/type/关闭icon.png') !!}" alt="" class="shejishiruzhu_tuichu">
            <div class="tanchuang_shangchuan_wenbenkuang">
                <div class="shangchuanzuoping">上传作品</div>
                <div class="hengxian"></div>
                <div class="anli">案例2</div>
                <div class="shangchuankuang_waibao">
                    <input id="shangchuankuang_two" type="file" multiple="multiple" onchange="getFileName_two(event)" name="filetwo[]">
                    <i class="fa fa-skyatlas fa-5x"></i>
                    <p class="text">将文件拖到此处，或
                        <label for="shangchuankuang_two" class="dianjishangchuan">点击上传</label>
                </div>
            </div>
            <div class="zhushi">最多传10个文件，单个文件不超过5M
                <div id="yishangchuanliebiao_two">

                </div>
            </div>
            <div class="liebiaoxiahengxian"></div>
            <div class="queding">确定</div>
        </div>
        <div class="tanchuang_shangchuan_three">
            <img src="{!! Theme::asset()->url('/images/type/关闭icon.png') !!}" alt="" class="shejishiruzhu_tuichu">
            <div class="tanchuang_shangchuan_wenbenkuang">
                <div class="shangchuanzuoping">上传作品</div>
                <div class="hengxian"></div>
                <div class="anli">案例3</div>
                <div class="shangchuankuang_waibao">
                    <input id="shangchuankuang_three" type="file" multiple="multiple" onchange="getFileName_three(event)" name="filethree[]">
                    <i class="fa fa-skyatlas fa-5x"></i>
                    <p class="text">将文件拖到此处，或
                        <label for="shangchuankuang_three" class="dianjishangchuan">点击上传</label>
                </div>
            </div>
            <div class="zhushi">最多传10个文件，单个文件不超过5M
                <div id="yishangchuanliebiao_three">

                </div>
            </div>
            <div class="liebiaoxiahengxian"></div>
            <div class="queding">确定</div>
        </div>
    </div>
    <div class="jichuxinxi">
        <div class="logo_info">
            <div class="logo_info_title">
                <p>填写基础信息</p>
            </div>
            <ul class="logo_info_content">
                <li class="clearfix one" >
                    <p class="left">用户名<span class="red_word">*</span></p>
                    <p class="right">
                        <input type="text" disabled="disabled" id="proName" class="material_input" name="title" value={{$user['name']}} >
                        <span class="checkRong" id="checkProject"></span>
                    </p>
                </li>
                <li class="clearfix">
                    <p class="left">手机号<span class="red_word">*</span></p>
                    @if($user['mobile'])
                        <p class="right"><input type="text" disabled="disabled" id="phone" name="phone" placeholder="" value={{$user['mobile']}}></p>
                    @else
                        <span class="cor-red">未绑定手机号</span>&nbsp;&nbsp;&nbsp;<a href="{{ URL('user/phoneAuth') }}">立即绑定</a>
                    @endif
                    <span class="checkRong" id="checkphone"></span>
                </li>
                <li class="clearfix">
                    <p class="left">邮箱<span class="red_word">*</span></p>
                    @if(Auth::user()->email_status == 2)
                        <p class="right"><input type="text" disabled="disabled"  name="email" placeholder="请输入邮箱" value={{$user['email']}}></p>
                    @else
                        <span class="Validform_checktip  validform-base Validform_wrong">未绑定邮箱 <a href="{!! url('user/emailAuth') !!}">点击绑定</a></span>
                    @endif
                    <span class="checkRong" id="checkphone"></span>
                </li>
                <li class="clearfix program_budget" >
                    <p class="left">类型<span class="red_word">*</span></p>
                    <p class="buju">
                        <label class="demo--label_one">
                            <input class="demo--radio" checked type="radio" name="stylist_type" value="1">
                            <span class="demo--radioInput"></span>自由设计师
                        </label>
                        <label class="demo--label_one">
                            <input class="demo--radio" type="radio" name="stylist_type" value="2">
                            <span class="demo--radioInput"></span>工作室
                        </label>
                        <label class="demo--label_one">
                            <input class="demo--radio" type="radio" name="stylist_type" value="3">
                            <span class="demo--radioInput"></span>公司
                        </label>
                    </p>
                </li>
                <li class="clearfix program_budget" >
                    <p class="left">性别<span class="red_word">*</span></p>
                    <p class="buju_one">
                        <label class="demo--label_two">
                            <input class="demo--radio" @if($userdetail->sex==0) checked="" @endif type="radio" name="sex" value="0">
                            <span class="demo--radioInput"></span>男
                        </label>
                        <label class="demo--label_two">
                            <input class="demo--radio" @if($userdetail->sex==1) checked="" @endif type="radio" name="sex" value="1">
                            <span class="demo--radioInput"></span>女
                        </label>
                    </p>
                </li>
                <li class="clearfix">
                    <p class="left">家乡<span class="red_word">*</span></p>
                    <p class="right" >
                        <select name="province_home" onchange="checkprovincehome(this)" onchange="">
                            @foreach($province_home as $v)
                                <option value={{ $v['id'] }} {{ ($userdetail['province_home']==$v['id'])?'selected':'' }} >{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                        <select name="city_home" id="province_check_home" onchange="checkcityhome(this)" onchange="">
                            @foreach($city_home as $v)
                                <option value={{ $v['id'] }} {{ ($userdetail['city_home']==$v['id'])?'selected':'' }} >{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                        <select name="area_home" id="area_check_home" onchange="" class="last">
                            @foreach($area_home as $v)
                                <option value={{ $v['id'] }} {{ ($userdetail['area_home']==$v['id'])?'selected':'' }} >{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                    </p>
                </li>
                <li class="clearfix">
                    <p class="left">现居<span class="red_word">*</span></p>
                    <p class="right" >
                        <select name="province" onchange="checkprovince(this)" onchange="">
                            @foreach($province as $v)
                                <option value={{ $v['id'] }} {{ ($userdetail['province']==$v['id'])?'selected':'' }} >{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                        <select name="city" id="province_check" onchange="checkcity(this)" onchange="">
                            @foreach($city as $v)
                                <option value={{ $v['id'] }} {{ ($userdetail['city']==$v['id'])?'selected':'' }} >{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                        <select name="area" id="area_check" onchange="" class="last">
                            @foreach($area as $v)
                                <option value={{ $v['id'] }} {{ ($userdetail['area']==$v['id'])?'selected':'' }} >{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                    </p>
                </li>
                <li class="clearfix">
                    <p class="left">职业<span class="red_word">*</span></p>
                    <p class="right">
                        <select  class="work" name="profession_id" onchange="">
                            @foreach($profession as $p)
                                <option value={{ $p->id }} {{ ($userdetail['profession_id']==$p->id)?'selected':'' }} >{{ $p->profession }}</option>
                            @endforeach
                        </select>
                    </p>
                </li>
                <li class="clearfix">
                    <p class="left">工作经验<span class="red_word">*</span></p>
                    <p class="right">
                        <select  class="work" name="years" onchange="">
                            @foreach($years as $y)
                                <option value={{ $y->id }} >{{ $y->years }}</option>
                            @endforeach
                        </select>
                    </p>
                </li>
                <li class="clearfix">
                    <p class="left">简介<span class="red_word">*</span><span class="wen_img"></span></p>
                    <p class="right">
                        <textarea name="introduce" id="jianjie" class="jianjie" >{{ $userdetail['introduce']?$userdetail['introduce']:'' }}</textarea>
                        <span class="checkRong" id="checkMiaoshu" ></span>
                    </p>
                </li>
            </ul>
            <div class="clearnex">
                <a class="nex">下一步</a>
            </div>
        </div>
    </div>







    <!-- 提交方案部分 -->
    <div class="tijiaofangan">
        <div class="info_title">
            <p>作品案例</p>
        </div>
        <div class="case_box">
            <div class="case_box_title">案例一</div>
            <ul class="case_list">
                <li class="clearfix_one">
                    <p>项目名称<span class="red_word">*</span></p>
                    <p>
                        <input type="text" name="case_title_one" placeholder="输入项目名称">
                    </p>
                </li>
                <li class="clearfix_one">
                    <p>设计类型<span class="red_word">*</span></p>
                    <p>
                        <select name="design_type_one"  class="all-sel">
                            @foreach($design_type as $d)
                                <option value={{$d->id}}>{{$d->design}}</option>
                            @endforeach
                        </select>
                    </p>
                </li>
                <li class="clearfix_one">
                    <p>项目所属<span class="red_word">*</span></p>
                    <p class="buju">
                        <label class="demo--label_one">
                            <input class="demo--radio" checked type="radio" name="case_type_one" value="0">
                            <span class="demo--radioInput"></span>自由设计师
                        </label>
                        <label class="demo--label_one">
                            <input class="demo--radio" type="radio" name="case_type_one" value="1">
                            <span class="demo--radioInput"></span>工作室
                        </label>
                        <label class="demo--label_one">
                            <input class="demo--radio" type="radio" name="case_type_one" value="2">
                            <span class="demo--radioInput"></span>公司
                        </label>
                    </p>
                </li>
                <li class="case_box_hengxian"></li>
                <div class="zhushitext">已上传文件
                    <div class="yishangchuanliebiao">
                       
                    </div>
                </div>
                <li class="shangchuananniu">
                    <p class="shangchuanzuoping"><a href="javascript:;" class="up_btn">上传作品</a></p>
                </li>
            </ul>
        </div>
        <div class="case_box">
            <p class="case_box_title">案例二</p>
            <ul class="case_list">
                <li class="clearfix_one">
                    <p>项目名称<span class="red_word">*</span></p>
                    <p>
                        <input type="text" name="case_title_two" placeholder="输入项目名称">
                    </p>
                </li>
                <li class="clearfix_one">
                    <p>设计类型<span class="red_word">*</span></p>
                    <p>
                        <select name="design_type_two"  class="all-sel">
                            @foreach($design_type as $d)
                                <option value={{$d->id}}>{{$d->design}}</option>
                            @endforeach
                        </select>
                    </p>
                </li>
                <li class="clearfix_one">
                    <p>项目所属<span class="red_word">*</span></p>
                    <p class="buju">
                        <label class="demo--label_one">
                            <input class="demo--radio" checked type="radio" name="case_type_two" value="0">
                            <span class="demo--radioInput"></span>自由设计师
                        </label>
                        <label class="demo--label_one">
                            <input class="demo--radio" type="radio" name="case_type_two" value="1">
                            <span class="demo--radioInput"></span>工作室
                        </label>
                        <label class="demo--label_one">
                            <input class="demo--radio" type="radio" name="case_type_two" value="2">
                            <span class="demo--radioInput"></span>公司
                        </label>
                    </p>
                </li>
                <li class="case_box_hengxian"></li>
                <div class="zhushitext_two">已上传文件
                    <div class="yishangchuanliebiao_two">
                       
                    </div>
                </div>
                <li class="shangchuananniu">
                    <p class="shangchuanzuoping"><a href="javascript:;" class="up_btn_two">上传作品</a></p>
                </li>
            </ul>
        </div>
        <div class="case_box">
            <p class="case_box_title">案例三</p>
            <ul class="case_list">
                <li class="clearfix_one">
                    <p>项目名称<span class="red_word">*</span></p>
                    <p>
                        <input type="text" name="case_title_three" placeholder="输入项目名称">
                    </p>
                </li>
                <li class="clearfix_one">
                    <p>设计类型<span class="red_word">*</span></p>
                    <p>
                        <select name="design_type_three"  class="all-sel">
                            @foreach($design_type as $d)
                                <option value={{$d->id}}>{{$d->design}}</option>
                            @endforeach
                        </select>
                    </p>
                </li>
                <li class="clearfix_one">
                    <p>项目所属<span class="red_word">*</span></p>
                    <p class="buju">
                        <label class="demo--label_one">
                            <input class="demo--radio" checked type="radio" name="case_type_three" value="0">
                            <span class="demo--radioInput"></span>自由设计师
                        </label>
                        <label class="demo--label_one">
                            <input class="demo--radio" type="radio" name="case_type_three" value="1">
                            <span class="demo--radioInput"></span>工作室
                        </label>
                        <label class="demo--label_one">
                            <input class="demo--radio" type="radio" name="case_type_three" value="2">
                            <span class="demo--radioInput"></span>公司
                        </label>
                    </p>
                </li>
                <li class="case_box_hengxian"></li>
                <div class="zhushitext_three">已上传文件
                    <div class="yishangchuanliebiao_three">
                       
                    </div>
                </div>
                <li class="shangchuananniu">
                    <p class="shangchuanzuoping"><a href="javascript:;" class="up_btn_three">上传作品</a></p>
                </li>
            </ul>
        </div>
        <div class="case_btn_box">
            <button class="case_btn_box_tijiao">提交</button>
            <div class="case_btn_box_shangyibu">< 上一步</div>
        </div>
    </div>
    <!-- <div class="dengdaishenhe">
        <div class="success_box">
            <p class="su_icon_box"><span class="su_icon"></span></p>
            <p class="su_til">您已经成功提交入驻申请</p>
            <p class="su_rel">审核结果将通过邮件或短信通知您</p>
            <p class="bar_box">
                <img src="../images/bar.png">
            </p>
            <div class="words_box clearfix">
                <p>加入官方QQ群:606250521获取更多同行交流的机会</p>
                <p>关注微信公众号:"珺娱科技"绑定账号,实时查看项目进</p>
            </div>
            <p class="sub_box"><a href="javascript:;" class="sub_btn">重新提交</a></p>
        </div>
    </div> -->

</form>

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

{!! Theme::asset()->container('specific-js')->usepath()->add('upload_de','/js/upload_de.js') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('release_css','css/type/release.project.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('infojs','js/doc/userinfo.js') !!}





