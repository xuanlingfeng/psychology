@extends('admin.group')

@section('content')
<blockquote class="layui-elem-quote">增加留言类型 <a href="/admin/messageBoardManagement" class="layui-btn layui-btn-small" style="float: right; margin-right: 10px;">返回</a></blockquote>
<table class="layui-table" style="width: 60%; margin: 0 auto;">
    <thead>
        <tr>
            <th>id</th>
            <th>留言类型</th>
            <th>操作 <a href="javascript:;" id="aBtn" class="layui-btn layui-btn-mini" style="float: right; margin-right: 5px;"><i class="layui-icon">&#xe608;</i> 添加</a></th>
        </tr>
    </thead>
    <tbody>
    @if(isset($messages))	
        @foreach ($messages as $message)
        <tr>
            <td>{{ $message->id }}</td>
            <td>{{ $message->type }}</td>
            <td>
 				<a href="javascript:;" onclick="event.preventDefault();document.getElementById('destroy-message{{ $message->id }}-form').submit();" class="layui-btn layui-btn-danger layui-btn-small">删除</a>               
                {!! Form::open(['route' => ['messagesType.destroy', $message->id], 'id' => 'destroy-message'.$message->id.'-form', 'method' => 'DELETE', 'style' => 'display: none;']) !!}
                {!! Form::close() !!}                   
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
<div class="messagesBox">
	<div class="messagesType">
		{{-- 创建POST提交表单 --}}
		{!! Form::open(['url' => 'admin/messagesType', 'class' => 'layui-form', 'id' => 'formMessages']) !!}
		<div class="layui-form-item">
			{!! Form::label('type', '留言类型', ['class' => 'layui-form-label']) !!}
			<div class="layui-input-block">
		 	{!! Form::text('type', null, ['lay-verify' => 'required', 'id' => 'myInput', 'autocomplete' => 'off', 'placeholder' => '请输入留言板类型', 'class' => 'layui-input']) !!}			
	        </div>
	    </div>
	 	<div class="layui-form-item">
	        <div class="layui-input-block">
	            {!! Form::button('提交', ['id'=>'typeBtn', 'class'=>'layui-btn', 'lay-submit'=>'', 'lay-filter'=>'save']) !!}
	            <a href="javascript:;" id="close" class="layui-btn layui-btn-primary" style="margin-left: 20px;">关闭</a>
	        </div>
	    </div>    
		{!! Form::close() !!}
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	$(function(){
		var $btn = $('#aBtn'),
		$form = $('#formMessages');
		$typeBtn = $('#typeBtn'),
		$box = $('.messagesBox'),
		$close = $('#close'),
		$type = $('.messagesType');
		$btn.click(function(){
			$box.show();
			$type.show();
		});

		$close.click(function(){
			$box.hide();
			$type.hide();
			$('#myInput').val('');   // 重新设为空
		});
		
		$typeBtn.click(function(){  // 鼠标点击提交
			var $data = $form.serialize(),  // 获取表单提交数据
				$url = $form.attr('action');
			$.post($url, $data, function(data){
				alert(data.info);
				window.location.reload(); // 刷新当前页面		
			});
			return;
		});

 		$(document).keypress(function (e) { // 键盘回车事件
	        if (e.keyCode == 13){
	        	return false;
	        }
        });
	})
</script>
@endsection