@extends('admin.group')

@section('content')
    <div style="padding: 15px;">
        <blockquote class="layui-elem-quote">
            <div style="float: right;">
                <a href="{{ url('admin/banner/create') }}" class="layui-btn layui-btn-normal layui-btn-small">添加文章</a>
            </div>
            {{ $title }}
        </blockquote>

        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>标题</th>
                    <th>预览图</th>
                    <th>状态</th>
                    <th>作者</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $banner->title }}</td>
                    <td> <img src="{{ $banner->thumb }}" alt="{{ $banner->title }}" style="max-width: 180px; max-height: 100px;"></td>
                    <td>
                        {{ $banner->status == 0?'隐藏':'显示' }}
                    </td>
                    <td>{{ $banner->name }}</td>
                    <td>{{ $banner->publish_at->toDateString() }}</td>
                    <td>
                        <a href="{{ url('/admin/banner/'.$banner->id.'/edit') }}" class="layui-btn layui-btn-small">编辑</a>

                        <a href="javascript:;" onclick="event.preventDefault();document.getElementById('destroy-banner{{ $banner->id }}-form').submit();" class="layui-btn layui-btn-danger layui-btn-small">删除</a>               
                        {!! Form::open(['route' => ['banner.destroy', $banner->id], 'id' => 'destroy-banner'.$banner->id.'-form', 'method' => 'DELETE', 'style' => 'display: none;']) !!}
                        {!! Form::close() !!}                              
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="pages" style="margin: 0 auto; text-align: center;">{{ $banners->links() }}</div>
    <div id="myInfo" style="display: none"></div>
@endsection

@section('js')      
@endsection
