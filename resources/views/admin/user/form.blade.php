@extends('admin.right')

@section('content')
<blockquote class="layui-elem-quote">新增用户</blockquote>
<div style="padding: 15px; width: 50%;">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@if (isset($model))
	{!! Form::model($model, ['url' => ['/admin/user', $model->id], 'method' => 'PUT', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@else
	{!! Form::open(['url' => '/admin/user', 'id' => 'formUser', 'class' => 'layui-form']) !!}
	@endif
	<div class="layui-form-item">
		{!! Form::label('name', '用户名', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入用户名', 'class' => 'layui-input']) !!}
		</div>
	</div>
	<div class="layui-form-item">
		{!! Form::label('email', '邮箱', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::text('email', null, ['lay-verify' => 'email', 'autocomplete' => 'off', 'placeholder' => '请输入邮箱', 'class' => 'layui-input']) !!}
		</div>
	</div>
	@if (!isset($model))
	<div class="layui-form-item">
		{!! Form::label('password', '密码', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::password('password', ['lay-verify' => 'pass', 'autocomplete' => 'off', 'placeholder' => '请输入密码,至少是6位数', 'class' => 'layui-input']) !!}
		</div>
	</div>
	@endif
	<div class="layui-form-item">
		{!! Form::label('roles', '请选择角色', ['class' => 'layui-form-label']) !!}
		<div class="layui-input-block">
			{!! Form::select('roles', $roles,  null) !!}
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			{!! Form::button('提交', ['class' => 'layui-btn', 'lay-submit' => '', 'lay-filter' => 'save']) !!}
			{!! Form::button('返回', ['class' => 'layui-btn layui-btn-primary', 'onclick' => 'self.location=document.referrer;']) !!}
		</div>
	</div>
	{!! Form::close() !!}
</div>
@endsection

@section('js')
<script type="text/javascript">
    layui.use(['form'], function() {
        var $ = layui.$,
		form = layui.form;
  		form.verify({
                pass: function(value){
                    if(value.length < 6){
                        return '密码至少是6位数';
                    }
                }
            }); 
        //监听提交
        form.on('submit(save)', function(data){
			$.post($('#formUser').attr('action'), data.field, function(data, textStatus, xhr) {
				layer.msg(data.info);
			});
			return false;
	    });
	});
</script>
@endsection