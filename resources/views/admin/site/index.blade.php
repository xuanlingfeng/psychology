@extends('admin.sitenav')
@section('content')
    <div style="padding: 15px">
        <blockquote class="layui-elem-quote">站点管理 
            <div style="float: right;">
                <a href="{{ url('admin/sites/create') }}" class="layui-btn layui-btn-small">新增站点</a>
            </div>
        </blockquote>

        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>站点名称</th>
                    <th>站点路由</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sites as $site)
                <tr>
                    <td>{{ $site->id }}</td>
                    <td>{{ $site->name }}</td>
                    <td>{{ $site->url }}</td>
                    <td>
                        <a href="{{ url('admin/sites/'.$site->id.'/edit') }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                        @if ($site->id == 1)
                        <a href="{{ url('/') }}" class="layui-btn layui-btn-normal layui-btn-mini" target="view_window">首页</a>
                        @else
                         <a href="{{ url('/'.$site->url.'/index') }}" class="layui-btn layui-btn-normal layui-btn-mini" target="view_window">首页</a>
                        @endif
                        <a href="javascript:;" onclick="event.preventDefault();document.getElementById('destroy-role{{ $site->id }}-form').submit();" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>   
                        {!! Form::open(['route' => ['sites.destroy', $site->id], 'id' => 'destroy-role'.$site->id.'-form', 'method' => 'DELETE', 'style' => 'display: none;']) !!}
                        {!! Form::close() !!}                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pages" style="margin: 0 auto; text-align: center;">{{ $sites->links() }}</div>
        <div id="myInfo" style="display: none"></div>         
    </div>
@endsection