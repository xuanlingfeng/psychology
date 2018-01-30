@extends('admin.group')

@section('content')
    <div style="padding: 15px;">
        {{-- 旗下品牌管理 --}}
        <blockquote class="layui-elem-quote">旗下品牌----{{ $title }}</blockquote>

        @if (isset($model))
        {!! Form::model($model, ['url' => ['admin/brandpage', $model->id], 'class'=> 'layui-form', 'method'=> 'PUT', 'id' => 'formPage']) !!}
        @else
        {!! Form::open(['url' => 'admin/brandpage', 'class' => 'layui-form', 'id'=>'formPage']) !!}
        @endif
        <div class="layui-form-item">
    		{!! Form::label('title', '页面标题', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::text('title', null, ['lay-verify' => 'title', 'autocomplete' => 'off', 'placeholder' => '请输入页面标题', 'class' => 'layui-input']) !!}
            </div>
        </div>
        <div class="layui-form-item">
            {!! Form::label('keys', '关键字', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::text('keys', null, ['autocomplete' => 'off', 'placeholder' => '关键字（请以,号隔开),可为空', 'class' => 'layui-input']) !!}
            </div>
        </div>        
        <div class="layui-form-item layui-form-text">
    		{!! Form::label('digest', '页面详情', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::textarea('digest', null, ['lay-verify' => 'digest', 'rows' => '3', 'placeholder' => '请输入页面详情', 'class' => 'layui-textarea']) !!}
            </div>
        </div>
        <div class="layui-form-item">
            {!! Form::label('seo_title', 'SEO标题', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::text('seo_title', null, ['lay-verify' => 'seo_title', 'autocomplete' => 'off', 'placeholder' => '请输入SEO标题', 'class' => 'layui-input']) !!}
            </div>
        </div>
        <div class="layui-form-item">
            {!! Form::label('seo_key', 'SEO关键字', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::text('seo_key', null, ['lay-verify' => 'seo_key', 'autocomplete' => 'off', 'placeholder' => '请输入SEO关键字', 'class' => 'layui-input']) !!}
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            {!! Form::label('seo_description', 'SEO描述', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::textarea('seo_description', null, ['lay-verify' => 'seo_description', 'rows' => '3', 'placeholder' => '请输入SEO描述', 'class' => 'layui-textarea']) !!}
            </div>
        </div>
		<div class="layui-form-item layui-form-text">
            {!! Form::label('enterUrl', '进入官网', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::text('enterUrl', null, ['lay-verify' => 'url', 'autocomplete' => 'off', 'placeholder' => '进入官网路由', 'class' => 'layui-input']) !!}
            </div>
        </div>        
        <div class="layui-form-item">
            <div class="layui-inline">
                {!! Form::label('status', '状态', ['class' => 'layui-form-label']) !!}
                <div class="layui-input-inline">
                    {!! Form::radio('status', 1, isset($model) ? $model->status : true, ['title' => '显示']) !!}
    				{!! Form::radio('status', 0, isset($model) ? $model->status : null, ['title' => '隐藏']) !!}
                </div>
            </div>
            <div class="layui-inline">
                {!! Form::label('publish_at', '发布时间', ['class' => 'layui-form-label']) !!}
                <div class="layui-input-inline">
                    {!! Form::date('publish_at', isset($model) ? substr($model->publish_at , 0 ,10): \Carbon\Carbon::now(), ['lay-verify' => 'date', 'autocomplete' => 'off', 'placeholder' => '请输入发布时间', 'class' => 'layui-input']) !!}
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            {!! Form::label('thumb', '缩略图', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" lay-data="{ accept: 'images' }" size="200" id="upload_thumb">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" name="thumb" id="thumb" src="{{ isset($model->thumb) && $model->thumb != ''?$model->thumb:'' }}" style="max-height: 160px; max-width: 200px;">
                        <input type="hidden" id="myThumb" name="thumb" value="{{ isset($model->thumb) && $model->thumb != ''?$model->thumb:'' }}">
                        <p id="demoText"></p>
                    </div>
                </div>
            </div>
        </div>        
        <div class="layui-form-item">
            {!! Form::label('content', '正文内容', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                <script id="container" name="content" style="width:100%;height:350px; z-index: 998;" type="text/template">{!! isset($model) ? $model->content : '' !!}</script>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                {!! Form::button('提交', ['id'=>'myButton', 'class'=>'layui-btn', 'lay-submit'=>'', 'lay-filter'=>'save']) !!}
                {{-- <input type="submit" name="" value="提交" class="layui-btn"> --}}
                {{-- 如果存在记录 --}}
                @if (isset($model))
                    <a href="{{ url('/admin/brandpage/remove/'.$model->id) }}" class="layui-btn layui-btn-danger">删除</a>               
                @endif
            </div>
        </div>
        {{-- 获取当前操作人员id值--}}
        <input type="hidden" name="user_id" value="{{Auth::id()}}">
        {{-- 查看次数默认初始为0 --}}
        <input type="hidden" name="view" value="{{ isset($model->view)?$model->view:0 }}">
        {{-- type 菜单后面的参数 --}}
        @if (isset($model))
            <input type="hidden" name="type" value="{{ $model->type }}">
        @else
            <input type="hidden" name="type" value="{{ $type }}">
        @endif
        
        {!! Form::close() !!}
    </div>
<script id="uploadContainer" name="content" style="width:100%;height:350px;display:none;" type="text/template"></script>
@endsection

@section('js')
@include('UEditor::head')
    <script type="text/javascript">
        $ue = UE.getEditor('container', { initialFrameWidth: '100%' ,initialFrameHeight: 400 });
        var $ueUpload = UE.getEditor('uploadContainer', {
            isShow: false,
            focus: false,
            enableAutoSave: false,
            autoSyncData:false,
            autoFloatEnabled: false,
            wordCount: false,
            sourceEditor: null,
            scaleEnabled: true,
            toolbars: [['insertimage', 'attachment']]
        });
        // 监听图片和文件上传
        $ueUpload.ready(function () {
            $ueUpload.addListener('beforeInsertImage', _beforeInsertImage);
        });

        // 自定义图片上传对话框事件
        document.getElementById('upload_thumb').onclick = function() {
            var dialog = $ueUpload.getDialog('insertimage');
            dialog.title = '上传图片';
            dialog.render();
            dialog.open();
        }
        // 上传图片
        function _beforeInsertImage(t, result) {
            var imgHtml = result[0].src;
            document.getElementById('thumb').src = imgHtml;
            // 把路由传入隐藏的input标签里面， 数据提交至数据库
            document.getElementById('myThumb').value = imgHtml;
        }

        layui.use(['form', 'laydate', 'upload', 'layedit'], function() {
            var form = layui.form,
            $ = layui.$,
            laydate = layui.laydate,
            upload = layui.upload,
            layedit = layui.layedit;

            layedit = layedit.build('content');

            //日期
            laydate.render({ elem: '#publish_at' });
            //自定义验证规则   前台验证
            form.verify({
                title: function(value){
                    if(value.length < 2){
                        return '单页面标题至少2个字符';
                    }
                    if (value.length > 170) {
                        return '单页面标题最多170个字符';
                    }
                },
                digest: function(value){
                    if(value.length > 200){
                        return "单页面最多200个字符";
                    }
                },
                seo_description: function(value){
                    if(value.length > 255){
                        return "seo详情最多255个字符";
                    }                    
                },
                seo_title: function(value){
                    if(value.length > 70){
                        return "seo标题最多70个字符";
                    }          
                },
                seo_key: function(value){
                    if(value.length > 170){
                        return "seo关键字最多170个字符";
                    }                              
                }

            });
            
        //监听提交
        form.on('submit(save)', function(data){
            // 获取url
            $url = $('#formPage').attr('action');
            $.post($url, data.field, function(data, textStatus, xhr) {

                layer.msg(data.message);
            });
            return false;
        });  
    });
        
    </script>
@endsection