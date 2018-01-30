@extends('admin.group')

@section('content')
    <div style="padding: 15px;">
        <blockquote class="layui-elem-quote">
            <div style="float: right;">
                <a href="{{ url('admin/brand/create?mapid='.$id) }}" class="layui-btn layui-btn-normal layui-btn-small">添加</a>
            </div>
            旗下品牌管理---{{ $title }}
        </blockquote>

        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>标题</th>
                    <th>分类名称</th>
                    <th>城市</th>
                    <th>状态</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maps as $map)
                <tr>
                    <td>{{ $map->id }}</td>
                    <td>{{ $map->title }}</td>
                    <td>{{ $title }}</td>
                    <td>
                        @if ($map->city == 1)
                            合肥
                        @elseif($map->city == 2)
                            南京
                        @else
                            杭州
                        @endif
                    </td>
                    <td>{{ $map->status == 0?'隐藏':'显示' }}</td>
                    <td>{{ $map->updated_at->toDateString() }}</td>
                    <td>
                        <a href="{{ url('/admin/brand/'.$map->id.'/edit') }}" class="layui-btn layui-btn-small">编辑</a>
                        <a href="javascript:;" onclick="event.preventDefault();document.getElementById('destroy-brand{{ $map->id }}-form').submit();" class="layui-btn layui-btn-danger layui-btn-small">删除</a>               
                        {!! Form::open(['route' => ['brand.destroy', $map->id], 'id' => 'destroy-brand'.$map->id.'-form', 'method' => 'DELETE', 'style' => 'display: none;']) !!}
                        {!! Form::close() !!}                          
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="pages" style="margin: 0 auto; text-align: center;"></div>
    <div id="myInfo" style="display: none"></div>
@endsection
