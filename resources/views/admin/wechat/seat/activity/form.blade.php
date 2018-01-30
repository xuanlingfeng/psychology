@extends('admin.wechat.template')

@section('content')
<div style="padding: 15px;">
	<blockquote class="layui-elem-quote">{{ $title }}</blockquote>

	@if (isset($activity))
	{!! Form::model($activity, ['url' => ['/admin/wechat/seat/activity', $activity->id], 'method' => 'PUT', 'id' => 'formActivity', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/wechat/seat/activity', 'id' => 'formActivity', 'class' => 'layui-form']) !!}
	@endif
	<div class="layui-form-item">
		{!! Form::label('name', '乱动名称', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('name', null, ['lay-verify' => 'name', 'autocomplete' => 'off', 'placeholder' => '请输入活动名称', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('sort', '排序', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::number('sort', null, ['lay-verify' => 'require|number', 'autocomplete' => 'off', 'placeholder' => '请输入活动排序，排序由小到大', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('status', '状态', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::radio('status', 1, isset($activity) ? $activity->status : true, ['title' => '进行中']) !!}
			{!! Form::radio('status', 0, isset($activity) ? $activity->status : null, ['title' => '已结束']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('price', '价格', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::number('price', null, ['lay-verify' => 'require|number', 'autocomplete' => 'off', 'placeholder' => '请输入活动价格', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('max_seat', '活动座位', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::number('max_seat', null, ['lay-verify' => 'require|number', 'autocomplete' => 'off', 'placeholder' => '请输入活动可选座位数量', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('publish_at', '活动日期', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::date('publish_at', isset($activity) ? $activity->publish_at : \Carbon\Carbon::now(), ['id' => 'publish_at', 'lay-verify' => 'date', 'autocomplete' => 'off', 'placeholder' => '请输入活动日期', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('contact', '联系方式', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::textarea('contact', null, ['lay-verify' => 'require', 'autocomplete' => 'off', 'placeholder' => '请输入联系方式', 'class' => 'layui-textarea']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			{!! Form::button('提交', ['class' => 'layui-btn', 'lay-submit' => '', 'lay-filter' => 'save']) !!}
			{!! Form::button('返回', ['class' => 'layui-btn layui-btn-primary', 'onclick' => 'javascript:history.go(-1);']) !!}
		</div>
	</div>
	{!! Form::close() !!}
</div>
@endsection

@section('js')
<script type="text/javascript">
    layui.use(['form', 'laydate'], function() {
        var $ = layui.$,
		form = layui.form,
        laydate = layui.laydate;

        //日期
        laydate.render({ elem: '#publish_at' });

        //自定义验证规则
        form.verify({
            name: function(value){
                if(value.length < 5){
                    return '活动名称至少5个字符';
                }
            }
        });

        //监听提交
        form.on('submit(save)', function(data){
			$.post($('#formActivity').attr('action'), data.field, function(data, textStatus, xhr) {
				layer.msg(data.message);
			});
			return false;
	    });
	});
</script>
@endsection
