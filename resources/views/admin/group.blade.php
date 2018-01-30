@extends('layouts.admin')

@section('nav')
{{-- appserviceprovider.php 共享的数据 --}}
@foreach ($nav as $element)
	{{-- 判断是否是一级菜单  --}}
    @if ($element->pid == null || $element->pid == 0)
    <li class="layui-nav-item">
    	{{-- 判断是否是首页 --}}
    	@if ($element->url != '/')
    		@if ($element->single == 1)
    			{{-- 一级菜单是单页面的处理  --}}
    			<a href="{{ url('/admin/page?id='.$element->id) }}" @if ($element->target == 1) target="_blank" @endif>{{$element->title}}</a>
    		@elseif ($element->single == 2)
    			<a href="{{ url('/admin/news?cate_id='.$element->id) }}" @if ($element->target == 1) target="_blank" @endif>{{$element->title}}</a>
    		@else
    			<a href="{{ url('/admin'.$element->url) }}"  @if ($element->target == 1) target="_blank" @endif >{{$element->title}}</a>
    		@endif
    	@else
			<a href="{{ url($element->url) }}"  @if ($element->target == 1) target="_blank" @endif >返回{{$element->title}}</a>
    	@endif
	    @foreach ($nav as $ch)
	    	{{-- 判断存不存在二级菜单 --}}
	        @if ($ch->pid == $element->id)
			<dl class="layui-nav-child">
	    		{{-- 在这里再做一个判断,是否是单页面,选择不同的url --}}
	    		@if ($ch->single == 1)
	    			{{-- 这里专门对单页面进行操作 --}}
	    			<dd><a href="{{ url('/admin/page?id='.$ch->id) }}"  @if ($ch->target == 1) target="_blank" @endif >{{$ch->title}}</a></dd>
	    		@elseif ($ch->single == 2)
    				<a href="{{ url('/admin/news?cate_id='.$ch->id) }}" @if ($ch->target == 1) target="_blank" @endif>{{$ch->title}}</a>
	    		@elseif ($ch->single == 3)
	    			<a href="{{ url('/admin/record?cate_id='.$ch->id) }}" @if ($ch->target == 1) target="_blank" @endif>{{$ch->title}}</a>
	    		@else
	    			@if($element->title == '联系我们')
						<dd><a href="{{ url($ch->url) }}" @if ($ch->target == 1) target="_blank" @endif >{{$ch->title}}</a></dd>
	    			@else
						<dd><a href="{{ url('/admin'.$ch->url) }}" @if ($ch->target == 1) target="_blank" @endif >{{$ch->title}}</a></dd>
	    			@endif

	    		@endif
			</dl>
	        @endif
	    @endforeach
	</li>
    @endif
@endforeach
<li class="layui-nav-item"><a href="{{ url('admin/channel') }}">菜单管理</a></li>
{{-- 同理,前台页面分页左侧的菜单一样可以循环出来 --}}
@endsection

@section('content')
	@yield('content')
@endsection

@section('js')
<script type="text/javascript">
    layui.use(['element', 'form'], function(){
        var element = layui.element,
            form = layui.form;
    });

</script>
@endsection