<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('images/yzyx.ico') }}"/>

    <title>{{ config('app.name', '安徽艺朝艺夕教育咨询有限公司管理后台') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('libs/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('libs/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <style type="text/css">
        /* 后台新闻分页 */
        .pagination{display: inline-block;vertical-align: middle;margin: 10px 0;font-size: 0; }
        .pagination li{float: left;margin: 0 2px;}
        .pagination li span{display: inline-block;vertical-align: middle;padding: 0 15px;height: 28px;line-height: 28px;margin: 0 -1px 5px 0;background-color: #fff;color: #000;font-size: 14px;font-weight: bold;}
        .pagination li a{display: inline-block;vertical-align: middle;padding: 0 15px;height: 28px;line-height: 28px;margin: 0 -1px 5px 0;background-color: #fff;font-size: 12px;}
        .pagination li a:hover{color: #009688;}
        .layui-table td{max-width: 260px; max-height: 80px;overflow: hidden;}
        .layui-nav-child a{text-indent: 2em;}
        .layui-table td.digest{max-width: 250px;}
    </style>
    <script type="text/javascript" src="{{ asset('js/jquery2.1.1.min.js') }}"></script>
    
</head>
<body>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">
                
                <img src="{{ asset('images/admin/logo.png') }}" alt="{{ config('app.name', '安徽艺朝艺夕教育咨询有限公司管理后台') }}" />

            </div>
            <!-- 头部区域（可配合layui已有的水平导航） -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item"><a href="{{ url('/admin') }}">控制台</a></li>
                <li class="layui-nav-item"><a href="{{ url('/wenti') }}">添加问题</a></li>
                <li class="layui-nav-item"><a href="{{ url('/options') }}">添加问题选项</a></li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                        {{ request()->user()->name }}
                        <span class="layui-nav-more"></span>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" id="basicShow">基本资料</a></dd>
                        <dd><a href="javascript:;" id="changeShow">修改密码</a></dd>
                        <dd>
                            <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">退出</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        </dd>
                    </dl>
                </li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul id="adminNav" class="layui-nav layui-nav-tree" lay-filter="test">
                    @yield('nav')
                </ul>
            </div>
        </div>

        <div class="layui-body" style="padding: 10px;">
            <!-- 内容主体区域 -->
            @yield('content')
        </div>
        
        {{-- 基本资料 --}}
        <div class="basic-document">          
            <p>资料信息</p>
            <p>姓名：{{ request()->user()->name }}</p>
            <p>邮箱：{{ request()->user()->email }}</p>
            <p>创建时间：{{ request()->user()->created_at->toDateString() }}</p>
            <span id="basicClose">X</span>
        </div>

        {{--<div class="change-password">--}}
            {{--<h3>修改密码</h3>--}}
            {{--{!! Form::open([ 'url' => 'admin/changePassword', 'id' => 'ChangPas', 'class' => 'layui-form' ]) !!}--}}
                {{--<div class="layui-form-item">--}}
                    {{--{!! Form::label('oldpassword', '原始密码', ['class' => 'layui-form-label']) !!}--}}
                    {{--<div class="layui-input-block">--}}
                        {{--{!! Form::password('oldpassword', ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入原始密码', 'class' => 'layui-input']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="layui-form-item">--}}
                    {{--{!! Form::label('password', '新密码', ['class' => 'layui-form-label']) !!}--}}
                    {{--<div class="layui-input-block">--}}
                        {{--{!! Form::password('password', ['lay-verify' => 'pass', 'autocomplete' => 'off', 'placeholder' => '请输入新密码', 'class' => 'layui-input']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="layui-form-item">--}}
                    {{--{!! Form::label('password_confirmation', '确认密码', ['class' => 'layui-form-label']) !!}--}}
                    {{--<div class="layui-input-block">--}}
                        {{--{!! Form::password('password_confirmation', ['lay-verify' => 'pass', 'autocomplete' => 'off', 'placeholder' => '请输入确认密码', 'class' => 'layui-input']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="layui-form-item">--}}
                    {{--<div class="layui-input-block">--}}
                        {{--{!! Form::button('提交', ['class' => 'layui-btn', 'lay-submit' => '', 'lay-filter' => 'save']) !!}--}}
                        {{--{!! Form::button('重置', ['class' => 'layui-btn layui-btn-primary', 'type' => 'reset']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--{!! Form::close() !!}--}}
            {{--<span id="changeClose">X</span>--}}
            {{--<div style="color: red;">注意：若密码修改成功，系统会重回登录页面，请使用新密码进行登录；</div>--}}
        {{--</div>--}}
        <div class="layui-footer">
        <!-- 底部固定区域 -->
        Copyright © 2012-{{ date('Y') }} {{ config('app.name', '安徽艺朝艺夕教育咨询有限公司管理后台') }}
        </div>
    </div>

<!-- Scripts -->
    <script src="{{asset('libs/layui/layui.js')}}"></script>
    <script src="{{asset('libs/select2/js/select2.min.js')}}"></script>
<script>
layui.use(['element', 'form'], function(){
    var element = layui.element,
        form = layui.form,
        $ = layui.$;

        form.verify({
                pass: function(value){
                    if(value.length < 6){
                        return '密码至少是6位数';
                    }
                }
            });    

    //监听提交
    form.on('submit(save)', function(data){
        $url = $('#ChangPas').attr('action');
        $.post($('#ChangPas').attr('action'), data.field, function(data, textStatus, xhr) {
            layer.msg(data.info);
        });
        return false;
    });

    // javascript   控制链接不做跳转动作;
        var $item = $('.layui-nav-item');
        $item.each(function(index,cont){
            if($(cont).children().length >= 2){
                $(cont).children('a').click(function(){
                    return false;
                });
            }
        });
        $('#basicShow').click(function(){
            $('.basic-document').show();
            $('.change-password').hide();
        })
        $('#basicClose').click(function(){
            $(this).parent().hide();
        });
        $('#changeClose').click(function(){
            $(this).parent().hide();
        });
        $('#changeShow').click(function(){
            $('.change-password').show();
            $('.basic-document').hide();
        });    
});
</script>
@yield('js')
</body>
</html>
