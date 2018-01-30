@extends('admin.group')

@section('content')
<div style="padding: 15px">
	<blockquote class="layui-elem-quote">{{ $title }}

		<div style="float:right;">
		    <a href="{{ url('/admin/channel/create') }}" class="layui-btn layui-btn-small">
				<i class="fa fa-plus" aria-hidden="true"></i> 添加
			</a>
		</div>	
	</blockquote>
	{{-- 采用POST提交数据信息 --}}
	<form class="layui-form" style="float: left;" action="{{ url('/admin/channel') }}" method="GET">
        <div class="layui-form-item" style="margin: 0 0 10px 0;">
            <label class="layui-form-label">信息查询：</label>
            <div class="layui-input-inline">
                <input id="search" type="text" name="search" placeholder="模糊查询...." autocomplete="off" class="layui-input">
            </div>
            <button lay-filter="search" class="layui-btn layui-btn-small" lay-submit="" style="margin-top: 4px;">
				<i class="fa fa-search" aria-hidden="true"></i> 查询
			</button>
        </div>
	</form>		

	<table class="layui-table" lay-skin="row" lay-even lay-filter="filter">
		<thead>
			<tr>
				<th>id</th>
				<th>上级视图</th>
				<th>菜单名称</th>
				<th>英文名称</th>
				<th>菜单地址</th>
				<th>排序</th>
				<th>新窗口</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($channels as $channel)
			<tr>
				<td>{{ $channel->id }}</td>
				<td>
					@if ($channel->pid == null && $channel->status == 1)
						|——————|
					@elseif($channel->status == 1)
					{{-- 如果子级 --}}
						------|____
					@endif
					
					
				</td>
				<td>
					<a href="{{ url($channel->url) }}" style="display: block;">{{ $channel->title }}</a>
				</td>
				<td>{{ $channel->title_en }}</td>
				<td>{{ $channel->url }}</td>
				<td>{{ $channel->sort }}</td>
				<td>{{ $channel->target == 1 ? '是' : '否' }}</td>
				<td>
					@if ($channel->status == 1)
					<span class="layui-badge-rim layui-bg-green">显示</span>
					@else
					<span class="layui-badge-rim">隐藏</span>
					@endif
				</td>
				<td>
					<a href="{{ url('/admin/channel/'. $channel->id . '/edit') }}" class="layui-btn layui-btn-primary layui-btn-mini">编辑</a>
                    <a href="javascript:;" onclick="event.preventDefault();document.getElementById('destroy-channel{{ $channel->id }}-form').submit();" class="layui-btn layui-btn-danger layui-btn-small">删除</a>               
                    {!! Form::open(['route' => ['channel.destroy', $channel->id], 'id' => 'destroy-channel'.$channel->id.'-form', 'method' => 'DELETE', 'style' => 'display: none;']) !!}
                    {!! Form::close() !!}    
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div id="pages" style="margin: 0 auto; text-align: center;">{{ $channels->links() }}</div>
</div>
@endsection

@section('js')
	<script type="text/javascript">
		$(function(){
			// 如果没有输入要搜索的字段

			if($('#search').val().length == 0){
				return false;
			}
		})
	</script>
@endsection
