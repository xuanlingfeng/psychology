@extends('admin.group')

@section('content')
    <div style="padding: 15px;">
        <blockquote class="layui-elem-quote">{{ isset($model)?'修改新闻': $title }}</blockquote>
        @if (isset($model))
        {!! Form::model($model, ['url' => ['admin/record', $model->id], 'class'=> 'layui-form', 'method'=> 'PUT', 'id' => 'formNew']) !!}
        @else
        {!! Form::open(['url' => 'admin/record', 'class' => 'layui-form', 'id'=>'formNew']) !!}
        @endif
        <div class="layui-form-item">
    		{!! Form::label('title', '新闻标题', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::text('title', null, ['lay-verify' => 'title', 'autocomplete' => 'off', 'placeholder' => '请输入新闻标题', 'class' => 'layui-input']) !!}
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
    		{!! Form::label('digest', '新闻摘要', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::textarea('digest', null, ['lay-verify' => 'digest', 'rows' => '3', 'placeholder' => '请输入新闻摘要', 'class' => 'layui-textarea']) !!}
            </div>
        </div>
        <div class="layui-form-item">
            {!! Form::label('source', '内容来源', ['class' => 'layui-form-label']) !!}
            <div class="layui-input-block">
                {!! Form::text('source', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入内容来源---默认信息：艺朝艺夕教育集团', 'class' => 'layui-input']) !!}
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
            {!! Form::label('thumb', '封面', ['class' => 'layui-form-label']) !!}
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
            <div class="layui-upload">
              <button type="button" class="layui-btn" id="test2">多图片上传</button> 
              <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                预览图：
                <div class="layui-upload-list" id="demo2">
                    @if (isset($model)) 
                    @foreach ($model->arrnew as $element)
                    <img  class="layui-upload-img" src="{{ asset($element) }}" style="max-height: 160px; max-width: 200px;">
                    @endforeach
                    @endif
                </div>
             </blockquote>
             <input type="hidden" id="newimg" name="newimg" value="{{ isset($model->newimg) && $model->newimg != '' ? $model->newimg : '' }}">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                {!! Form::button('提交', ['id'=>'myButton', 'class'=>'layui-btn', 'lay-submit'=>'', 'lay-filter'=>'save']) !!}
                @if (isset($model))
                    {!! Form::button('还原', ['type'=>'reset','class'=>'layui-btn layui-btn-normal']) !!}
                @endif
                {!! Form::button('返回', ['class' => 'layui-btn layui-btn-primary', 'onclick' => 'self.location=document.referrer;']) !!}
            </div>
        </div>
        {{-- 获取当前操作人员id值--}}
        <input type="hidden" name="user_id" value="{{Auth::id()}}">
        {{-- 查看次数默认初始为0 --}}
        <input type="hidden" name="view" value="{{ isset($model->view) ? $model->view : 0 }}">
        {{-- 新闻类别 --}}
        <input type="hidden" name="cate_id" value="{{ isset($model->cate_id) ? $model->cate_id : $cate_id }}">
        
        {{-- 新闻站点分类 --}}
        <input type="hidden" name="site_id" value="{{ isset($model->site_id) ? $model->site_id : session('siteid') }}">
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
            //自定义验证规则
            form.verify({
                title: function(value){
                    if(value.length < 2){
                        return '新闻标题至少2个字符';
                    }
                    if(value.length > 170){
                        return '新闻标题最多170个字符';
                    }
                },
                digest: function(value){
                    if(value.length > 200){
                        return "新闻摘要最多200个字符";
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
        var url = '';
        //多图片上传
        upload.render({
            elem: '#test2'
            ,url: '/api/upload/'
            ,multiple: true
            ,accept: 'images'
            ,method: 'post'
            ,before: function(obj){
              //预读本地文件示例，不支持ie8
              obj.preview(function(index, file, result){
                $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img" style="max-height: 160px; max-width: 200px;">')
              });
            }
            ,done: function(res){
                document.getElementById('newimg').value += res.url+';';
            }
        });
        //监听提交
        // submit 提交
        form.on('submit(save)', function(data){
            // 获取url
            $url = $('#formNew').attr('action');
            $.post($url, data.field, function(data, textStatus, xhr) {

                layer.msg(data.message);
            });
            return false;
        });  
    });
        
    </script>

@endsection


