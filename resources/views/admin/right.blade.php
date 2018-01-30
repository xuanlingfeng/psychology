@extends('layouts.admin')

@section('nav')
<li class="layui-nav-item layui-nav-itemed">
    <a class="" href="javascript:;">权限管理<span class="layui-nav-more"></span></a>
    <dl class="layui-nav-child">
        <dd><a href="{{ url('/admin/role') }}">角色管理</a></dd>
        <dd><a href="{{ url('/admin/user') }}">用户管理</a></dd>
        <dd><a href="{{ url('/admin/permission') }}">权限管理</a></dd>
    </dl>
</li>
<li class="layui-nav-item"><a href="{{ url('/log-viewer') }}" target="_blank">系统日志</a></li>
@endsection

@section('content')
    <!-- @yield('content') -->
    <div style="padding: 15px;">权限管理</div>
@endsection
