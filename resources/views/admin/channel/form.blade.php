@extends('admin.group')

@section('content')
<div style="padding: 15px;">
	<blockquote class="layui-elem-quote">{{ $title }}</blockquote>

	@if (isset($model))
	{!! Form::model($model, ['url' => ['/admin/channel', $model->id], 'method' => 'PUT', 'id' => 'formChannel', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/channel', 'id' => 'formChannel', 'class' => 'layui-form']) !!}
	@endif
	<div class="layui-form-item">
		{!! Form::label('title', '菜单名称', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('title', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入菜单名称', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('title_en', '英文名称', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('title_en', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入英文名称', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('url', '菜单地址', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('url', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入菜单地址', 'class' => 'layui-input']) !!}
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
		<div class="layui-inline">
			{!! Form::label('sort', '排序', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::number('sort', isset($model) ? $model->sort : $sort->sort+1, ['lay-verify' => 'require|number', 'autocomplete' => 'off', 'placeholder' => '请输入菜单排序，排序由小到大', 'class' => 'layui-input']) !!}
			</div>
		</div>
		<span style="color: #999; font-size: 12px;">排序自动递增</span>	
		<div class="layui-inline">
			{!! Form::label('pid', '上级菜单', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::select('pid', $pids, isset($model) ? $model->pid : null, ['ay-filter' => 'pid', 'placeholder' => '请选择上级菜单']) !!}
			</div>
		</div>
		<span style="color: #999; font-size: 12px;">不选，则视为一级栏目</span>	
	</div>
	<div class="layui-form-item">
		<div class="layui-inline">
			{!! Form::label('site_id', '菜单分类', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::select('site_id', $site_id, isset($model) ? $model->site_id : session('siteid'), ['ay-filter' => 'pid', 'placeholder' => '请选择菜单分类']) !!}
			</div>
		</div>
		<div class="layui-inline">
			{!! Form::label('status', '状态', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::radio('status', 1, isset($model) ? $model->status : true, ['title' => '显示']) !!}
				{!! Form::radio('status', 0, isset($model) ? $model->status : null, ['title' => '隐藏']) !!}
			</div>
		</div>
		<span style="color: #999; font-size: 12px;">选择隐藏，则不会在首页菜单栏显示</span>		
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
			{!! Form::label('single', '页面类型', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::radio('single', 1, isset($model) ? $model->single : null, ['title' => '单页面']) !!}
				{!! Form::radio('single', 0, isset($model) ? $model->single : true, ['title' => '多页面']) !!}
				{!! Form::radio('single', 2, isset($model) ? $model->single : null, ['title' => 'news']) !!}
				{!! Form::radio('single', 3, isset($model) ? $model->single : null, ['title' => '多记录']) !!}
				
				{{-- {!! Form::select('single', $single, isset($model) ? $model->single:null, ['ay-filter' => 'single', 'placeholder' => '请选择模型类别']) !!} --}}
			</div>
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			{!! Form::button('提交', ['class' => 'layui-btn', 'lay-submit' => '', 'lay-filter' => 'save']) !!}
			{!! Form::button('返回', ['class' => 'layui-btn layui-btn-primary', 'onclick' => 'self.location=document.referrer;']) !!}
		</div>
	</div>
	{!! Form::close() !!}
<script id="uploadContainer" name="content" style="width:100%;height:350px;display:none;" type="text/template"></script>
</div>
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
    layui.use(['form', 'upload'], function() {
        var $ = layui.$,
		form = layui.form,
        upload = layui.upload;

        //监听提交
        form.on('submit(save)', function(data){
			$.post($('#formChannel').attr('action'), data.field, function(data, textStatus, xhr) {
				layer.msg(data.message);
                setTimeout(() => { window.location.href = document.referrer; }, 1000);
			});
			return false;
	    });
	});
</script>
@endsection
