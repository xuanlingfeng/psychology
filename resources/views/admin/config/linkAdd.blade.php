@extends('admin.group')

@section('content')
<blockquote class="layui-elem-quote">增加友情链接</blockquote>
	@if (isset($model))
    {!! Form::model($model, ['url' => ['admin/link', $model->id], 'class'=> 'layui-form', 'method'=> 'PUT', 'id' => 'formLink']) !!}
    @else
    {!! Form::open(['url' => '/admin/link', 'class' => 'layui-form', 'id'=>'formLink']) !!}
    @endif
	<div class="layui-form-item">
		{!! Form::label('name', '链接名称', ['class' => 'layui-form-label']) !!}
	    <div class="layui-input-block">
	        {!! Form::text('name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入友情链接名称', 'class' => 'layui-input']) !!}
	    </div>
	</div>
	<div class="layui-form-item">
	    {!! Form::label('url', '链接路由', ['class' => 'layui-form-label']) !!}
	    <div class="layui-input-block">
	        {!! Form::text('url', null, ['lay-verify' => 'url', 'autocomplete' => 'off', 'placeholder' => '请输入友情链接的路由信息', 'class' => 'layui-input']) !!}
	    </div>
	</div>	
	<div class="layui-inline">
		{!! Form::label('sort', '排序', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::number('sort', null, ['lay-verify' => 'require|number', 'autocomplete' => 'off', 'placeholder' => '请输入链接排序，排序由小到大', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-inline">
			{!! Form::label('target', '新窗口打开', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::radio('target', 1, isset($model) ? $model->target : null, ['title' => '是']) !!}
				{!! Form::radio('target', 0, isset($model) ? $model->target : true, ['title' => '否']) !!}
			</div>
		</div>
		<div class="layui-inline">
	        {!! Form::label('status', '链接状态', ['class' => 'layui-form-label']) !!}
	        <div class="layui-input-inline">
	            {!! Form::radio('status', 1, isset($model) ? $model->status : true, ['title' => '显示']) !!}
				{!! Form::radio('status', 0, isset($model) ? $model->status : null, ['title' => '隐藏']) !!}
	        </div>
    	</div>
		<div class="layui-inline">
			{!! Form::label('classification', '链接类型', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::radio('classification', 1, isset($model) ? $model->classification : null, ['title' => '图片链接']) !!}
				{!! Form::radio('classification', 0, isset($model) ? $model->classification : true, ['title' => '文字链接']) !!}
			</div>
		</div>    	
	</div>    
 	<div class="layui-form-item">
        {!! Form::label('image', '链接图片', ['class' => 'layui-form-label']) !!}
        <div class="layui-input-block">
            <div class="layui-upload">
                <button type="button" class="layui-btn" lay-data="{ accept: 'images' }" size="200" id="upload_image">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                </button>
                <div class="layui-upload-list">
                    <img class="layui-upload-img" name="image" id="image" src="{{ isset($model->image) && $model->image != ''?$model->image:'' }}" style="max-height: 160px; max-width: 200px;">
                    <input type="hidden" id="myImage" name="image" value="{{ isset($model->image) && $model->image != ''?$model->image:'' }}">
                    <p id="demoText"></p>
                </div>
            </div>
        </div>
    </div>	
	<div class="layui-form-item">
        <div class="layui-input-block">
            {!! Form::button('提交', ['id'=>'myButton', 'class'=>'layui-btn', 'lay-submit'=>'', 'lay-filter'=>'save']) !!}
            {!! Form::button('返回', ['class' => 'layui-btn layui-btn-primary', 'onclick' => 'self.location=document.referrer;']) !!}
        </div>
    </div>	
    {!! Form::close() !!}
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
		document.getElementById('upload_image').onclick = function() {
			var dialog = $ueUpload.getDialog('insertimage');
			dialog.title = '上传图片';
			dialog.render();
			dialog.open();
		}
		// 上传图片
		function _beforeInsertImage(t, result) {
			var imgHtml = result[0].src;
			document.getElementById('image').src = imgHtml;
            // 把路由传入隐藏的input标签里面， 数据提交至数据库
            document.getElementById('myImage').value = imgHtml;
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
        //监听提交
        // submit 提交
        form.on('submit(save)', function(data){
            // 获取url
            $url = $('#formLink').attr('action');
            $.post($url, data.field, function(data, textStatus, xhr) {

                layer.msg(data.info);
            });
            return false;
        });  
    });
        
    </script>
@endsection