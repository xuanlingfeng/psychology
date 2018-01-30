@extends('layouts.admin')

@section('content')
<blockquote class="layui-elem-quote">投诉专区管理</blockquote>
<a href="{{ url('admin/messagesType') }}" class="layui-btn" style="float: right;">增加留言类型</a>

<form class="layui-form" style="float: left;" action="{{ url('/admin/messageBoardManagement') }}" method="GET">
    <div class="layui-form-item" style="margin: 0 0 10px 0;">
        <label class="layui-form-label">信息查询：</label>
        <div class="layui-input-inline">
            <input type="text" name="search" placeholder="支持模糊搜索.." autocomplete="off" class="layui-input">
        </div>
        <button lay-filter="search" class="layui-btn layui-btn-small" lay-submit="" style="margin-top: 4px;"><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
    </div>
</form>
 <table class="layui-table">
    <thead>
        <tr>
            <th>id</th>
            <th>姓名</th>
            <th>联系方式</th>
            <th>留言内容</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($messages)) 
            {{-- 如果存在数据 --}}
            @foreach ($messages as $message)
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->name }}</td>
                <td>{{ $message->tel }}</td>
                <td>{{ $message->content }}</td>
                <td>
                    <a href="{{ url('/admincontact?cate=messages&message='.$message->id) }}" target="_blank" class="layui-btn layui-btn-small layui-btn-primary layuiBtn">查看</a>
                    <a href="{{ url('admin/messageBoardRemove/'.$message->id) }}" class="layui-btn layui-btn layui-btn-small layui-btn-danger">删除</a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
 </table>
    @if (count($messages)==0)
        <p style="color: red; font-size: 14px;">没有搜索到数据，请重新查询</p>
    @endif
    @if (isset($messages))
    <div id="pages" style="margin: 0 auto; text-align: center;">{{ $messages->links() }}</div>
    @endif
    <div id="myInfo" style="display: none"></div>
@endsection