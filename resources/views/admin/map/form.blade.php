@extends('admin.group')

@section('content')
	<div style="padding: 15px;">
		<blockquote class="layui-elem-quote">{{ isset($model)?'修改旗下品牌信息':$title }}</blockquote>

		@if (isset($model))
		{!! Form::model($model, ['url' => ['admin/brand', $model->id], 'class'=> 'layui-form', 'method'=> 'PUT', 'id' => 'formNew']) !!}
		@else
		{!! Form::open(['url' => 'admin/brand', 'class' => 'layui-form', 'id'=>'formNew']) !!}
		@endif
		<div class="layui-form-item">
			{!! Form::label('title', '标题', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::text('title', null, ['lay-verify' => 'title', 'autocomplete' => 'off', 'placeholder' => '请输入旗下品牌标题', 'class' => 'layui-input']) !!}
			</div>
		</div>
		<div class="layui-form-item layui-form-text">
			{!! Form::label('digest', '摘要', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::textarea('digest', null, ['lay-verify' => 'digest', 'rows' => '3', 'placeholder' => '请输入旗下品牌摘要', 'class' => 'layui-textarea']) !!}
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
			{!! Form::label('url', '地图路由', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::text('url', null, ['lay-verify' => 'url', 'autocomplete' => 'off', 'placeholder' => '请输入旗下品牌地图路由', 'class' => 'layui-input']) !!}
			</div>
		</div>   
		<div class="layui-form-item">
			{!! Form::label('enterUrl', '进入官网', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				{!! Form::text('enterUrl', null, ['lay-verify' => 'url', 'autocomplete' => 'off', 'placeholder' => '请输入旗下品牌进入官网路由', 'class' => 'layui-input']) !!}
			</div>
		</div>               
		<div class="layui-form-item">
			<div class="layui-inline">
				{!! Form::label('city', '城市分类', ['class' => 'layui-form-label']) !!}
				<div class="layui-input-inline" style="z-index: 1000;">
					{!! Form::select('city', ['1'=>'合肥', '2'=>'南京', '3'=>'杭州']) !!}
				</div>
			</div>            
			<div class="layui-inline">
				{!! Form::label('status', '状态', ['class' => 'layui-form-label']) !!}
				<div class="layui-input-inline">
					{!! Form::radio('status', 1, isset($model) ? $model->status : true, ['title' => '显示']) !!}
					{!! Form::radio('status', 0, isset($model) ? $model->status : null, ['title' => '隐藏']) !!}
				</div>
			</div>
			<div class="layui-inline">
				{!! Form::label('updated_at', '发布时间', ['class' => 'layui-form-label']) !!}
				<div class="layui-input-inline">
					{!! Form::date('updated_at', isset($model) ? substr($model->updated_at , 0 ,10): \Carbon\Carbon::now(), ['lay-verify' => 'date', 'autocomplete' => 'off', 'placeholder' => '请输入发布时间', 'class' => 'layui-input']) !!}
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			{!! Form::label('content', '正文内容', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
				<script id="container" name="content" style="width:100%;height:350px; z-index: 998;" type="text/template">{!! isset($model) ? $model->content : '' !!}</script>
			</div>
		</div>
		<input type="hidden" name="channel_id" value="{{isset($model)?$model->channel_id : $mapid }}">
		<input type="hidden" name="">
		<div class="layui-form-item">
			<div class="layui-input-block">
				{!! Form::button('提交', ['id'=>'myButton', 'class'=>'layui-btn', 'lay-submit'=>'', 'lay-filter'=>'save']) !!}
				{!! Form::button('返回', ['class' => 'layui-btn layui-btn-primary', 'onclick' => 'self.location=document.referrer;']) !!}
			</div>
		</div>
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
						return '旗下品牌标题至少2个字符';
					}
					if(value.length > 170){
						return '旗下品牌标题最多170个字符';
					}					
				},
                digest: function(value){
                    if(value.length > 200){
                        return "摘要最多200个字符";
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
