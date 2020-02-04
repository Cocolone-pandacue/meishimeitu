<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="">平台商铺轮播图查看修改</a>
            </li>
        </ul>
    </div>
</div>

<form class="form-horizontal" action="/manage/goodsSlideshowInfosave" method="post" enctype="multipart/form-data" name="seo-form">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$goods->id}}">
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 图片名字</label>

            <div class="col-sm-3">
                <input type="text" class="col-sm-5" name="name" value="{{$goods->name}}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 排序</label>
            <div class="col-sm-3">
                <input type="text" class="col-sm-4" name="sort" value="{{$goods->sort}}">填写整数
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 图片</label>
            <div class="col-sm-3">
                <input type="hidden" name="urlold" value="{{$goods->url}}">
                <img src="{{ossUrl($goods->url)}}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 替换图片</label>
            <div class="col-sm-3">
                <input type="file" class="col-sm-5" name="url" value="">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 开启状态</label>
            <div class="col-sm-9">
                <select name="status" id="status">
                    <option value="1" @if($goods->status == 1)selected="selected" @endif >开启</option>
                    <option value="2" @if($goods->status == 2)selected="selected" @endif >关闭</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-9">
                        <button class="btn btn-info btn-sm" type="submit" >
                            提交
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{!! Theme::widget('editor')->render() !!}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shoplist', 'js/doc/goodslist.js') !!}