@extends('admin.wechat.template')

@section('content')
<div style="padding: 15px">
	<div class="handle-box">
		<ul>
			<li class="handle-item">
				<form class="layui-form" style="float:right;">
			        <div class="layui-form-item" style="margin:0;">
			            <label class="layui-form-label">名称</label>
			            <div class="layui-input-inline">
			                <input type="text" name="name" placeholder="支持模糊查询.." autocomplete="off" class="layui-input">
			            </div>
			            <button lay-filter="search" class="layui-btn" lay-submit="">
							<i class="fa fa-search" aria-hidden="true"></i> 查询
						</button>
			        </div>
			    </form>
			</li>
		</ul>
	</div>
	<div class="layui-clear"></div>

	<table class="layui-table" lay-skin="row" lay-even lay-filter="filter">
		<thead>
			<tr>
				<th>活动名称</th>
				<th>排序</th>
				<th>活动状态</th>
				<th>价格</th>
				<th>活动座位</th>
				<th>活动日期</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($orders as $order)
			<tr>
				<td>{{ $order->name }}</td>
				<td>{{ $order->sort }}</td>
				<td>
					@if ($order->status == 1)
					<span class="layui-badge-rim layui-bg-green">进行中</span>
					@else
					<span class="layui-badge-rim">已结束</span>
					@endif
				</td>
				<td>{{ $order->price }}</td>
				<td>可选 <span class="layui-badge layui-bg-blue">{{ $order->max_seat }}</span> 个</td>
				<td>{{ $order->publish_at->toDateString() }}</td>
				<td>
					<a href="{{ url('/admin/wechat/seat/activity/'. $order->id . '/edit') }}" class="layui-btn layui-btn-primary layui-btn-mini">编辑</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection

@section('js')
<script type="text/javascript">
	layui.use('table', function() {
		var table = layui.table;

		//监听表格复选框选择
	  	table.on('checkbox(filter)', function(obj){
		    console.log(obj)
	  	});

		var $ = layui.$, active = {
			getCheckLength: function() {
				console.log('getCheckLength');
				var checkStatus = table.checkStatus('id'),
					data 		= checkStatus.data;
				layer.msg('选中了：' + data.length + ' 个');
			}
		}

		$('.layui-elem-quote .layui-btn').on('click', function(){
		    var type = $(this).data('type');
		    active[type] ? active[type].call(this) : '';
	  	});
	});
</script>
@endsection
