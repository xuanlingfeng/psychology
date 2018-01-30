@extends('admin.group')

@section('content')
<blockquote class="layui-elem-quote">友情链接管理</blockquote>
<a href="{{ url('admin/link/create') }}" class="layui-btn" style="float: right; margin-bottom: 10px;">增加友情链接</a>
 <table class="layui-table">
    <thead>
        <tr>
            <th>id</th>
            <th>链接名称</th>
            <th>链接路由</th>
            <th>链接封面</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    {{-- 如果存在友情链接数据 --}}
    @if (isset($links))
    @foreach ($links as $link)
        <tr>
            <td>{{ $link->id }}</td>
            <td><a href="{{ $link->url }}" target="_blank">{{ $link->name }}</a></td>
            <td>{{ $link->url }}</td>
            <td><img src="{{ $link->image }}" alt="{{ $link->name }}" style="max-width: 180px; max-height: 100px;"></td>            
            <td>
                <a href="{{ url('/admin/link/'.$link->id.'/edit') }}" class="layui-btn layui-btn-small layui-btn-primary layuiBtn">编辑</a>
                <a href="javascript:;" onclick="event.preventDefault();document.getElementById('destroy-link{{ $link->id }}-form').submit();" class="layui-btn layui-btn-danger layui-btn-small">删除</a>               
                {!! Form::open(['route' => ['link.destroy', $link->id], 'id' => 'destroy-link'.$link->id.'-form', 'method' => 'DELETE', 'style' => 'display: none;']) !!}
                {!! Form::close() !!}                
            </td>
        </tr>
    @endforeach
    @endif
    </tbody>
    </table>
@endsection