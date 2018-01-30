 @extends('admin.group')

 @section('content')
 <blockquote class="layui-elem-quote">集团网站站点管理</blockquote>
  {{-- 这里做一个判断  如果已经配置好了，就取消这个提示 --}}
 <p style="color: red">开始前，请先配置好站点数据</p>
	<div class="layui-tab" style="width: 95%; background: #f2f2f2;">
		<ul class="layui-tab-title">
			<li><a href="{{ url('admin/config') }}">站点设置</a></li>
            <li><a href="{{ url('admin/logo') }}">站点logo管理</a></li>
			<li><a href="{{ url('admin/link') }}">友情链接管理</a></li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				@yield('config')
			</div>
		</div>
	</div>
@endsection
@section('js')
<script type="text/javascript">
	layui.use(['element', 'form'], function(){
		var element = layui.element,
		    form = layui.form;

		form.on('submit(save)', function(data){
		    // 获取url
		    $url = $('#formConfig').attr('action');

		    $.post($url, data.field, function(data, textStatus, xhr) {

		        layer.msg(data.message);
		    });
		    return false;
		});
	});
</script>
@endsection
