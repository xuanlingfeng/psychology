@extends('layouts.admin')

@section('nav')
<li class="layui-nav-item {{ strpos(url()->current(), '/admin/wechat/public') > 0 ? 'layui-nav-itemed' : '' }}">
    <a class="" href="javascript:;">微信公众号<span class="layui-nav-more"></span></a>
    <dl class="layui-nav-child">
        <dd><a href="javascript:;">正在建设...</a></dd>
    </dl>
</li>
<li class="layui-nav-item {{ strpos(url()->current(), '/admin/wechat/seat') > 0 ? 'layui-nav-itemed' : '' }}">
	<a href="javascript:;" target="_blank">微信选座<span class="layui-nav-more"></span></a>
    <dl class="layui-nav-child">
        <dd class="@if(url()->current() === url('/admin/wechat/seat/activity')) layui-this @endif">
            <a href="{{ url('/admin/wechat/seat/activity') }}">选座活动</a>
        </dd>
        <dd class="@if(url()->current() === url('/admin/wechat/seat/order')) layui-this @endif">
            <a href="{{ url('/admin/wechat/seat/order') }}">选座订单</a>
        </dd>
    </dl>
</li>
@endsection
