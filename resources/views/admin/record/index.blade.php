@extends('admin.group')

@section('content')
    <div style="padding: 15px;">
        <blockquote class="layui-elem-quote">
            <div style="float: right;">
                <a href="{{ url('admin/record/create?cate_id='.$cate_id) }}" class="layui-btn layui-btn-small">添加文章</a>
            </div>
            {{ $title }}
        </blockquote>
        <form class="layui-form" style="float: left;" action="{{ url('/admin/record') }}" method="GET">
            <div class="layui-form-item" style="margin: 0 0 10px 0;">
                <label class="layui-form-label">信息查询：</label>
                <div class="layui-input-inline">
                    <input type="hidden" name="cate_id" value="{{$cate_id}}">
                    <input type="text" name="search" placeholder="支持模糊查询.." autocomplete="off" class="layui-input">
                </div>
                <button lay-filter="search" class="layui-btn layui-btn-small" lay-submit="" style="margin-top: 4px;">
                    <i class="fa fa-search" aria-hidden="true"></i> 查询
                </button>
            </div>
        </form>
        <table class="layui-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>标题</th>
                    <th>摘要</th>
                    <th>状态</th>
                    <th>作者</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td class="digest">{{ $article->digest }}</td>
                    <td>
                        {{ $article->status == 0?'隐藏':'显示' }}
                    </td>
                    <td>{{ $article->user->name }}</td>
                    <td>{{ substr($article->publish_at, 0, 10) }}</td>
                    <td>
                        <a href="{{ url('/admin/record/'.$article->id.'/edit') }}" class="layui-btn layui-btn-small">编辑</a>
                        @if(session('siteid') == 3)
                        <a href="{{ asset('/fuenabc/xiangqing?id='.$article->id) }}" target="_blank" class="layui-btn layui-btn-small layui-btn-primary layuiBtn">查看</a>
                        @elseif(session('siteid') == 4)
                        <a href="{{ asset('/ahyzyx/course?category=kechengfenlei&md='.$article->id) }}" target="_blank" class="layui-btn layui-btn-small layui-btn-primary layuiBtn">查看</a>
                        @elseif(session('siteid') == 5)
                        <a href="{{ asset('/ahyzyx/course?category=kechengfenlei&md='.$article->id) }}" target="_blank" class="layui-btn layui-btn-small layui-btn-primary layuiBtn">查看</a>
                        @elseif(session('siteid') == 6)
                        <a href="{{ asset('/hzyzyx/course?category=kechengfenlei&md='.$article->id) }}" target="_blank" class="layui-btn layui-btn-small layui-btn-primary layuiBtn">查看</a>
                        @elseif(session('siteid') == 7)
                        <a href="{{ asset('/njfuenabc/xiangqing?id='.$article->id) }}" target="_blank" class="layui-btn layui-btn-small layui-btn-primary layuiBtn">查看</a>
                        @elseif(session('siteid') == 8)
                        <a href="{{ asset('/hzfuenabc/xiangqing?id='.$article->id) }}" target="_blank" class="layui-btn layui-btn-small layui-btn-primary layuiBtn">查看</a>
                        @endif
                        <a href="javascript:;" onclick="event.preventDefault();document.getElementById('destroy-record{{ $article->id }}-form').submit();" class="layui-btn layui-btn-danger layui-btn-small">删除</a>               
                        {!! Form::open(['route' => ['record.destroy', $article->id], 'id' => 'destroy-record'.$article->id.'-form', 'method' => 'DELETE', 'style' => 'display: none;']) !!}
                        {!! Form::close() !!}                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pages" style="margin: 0 auto; text-align: center;">{{ $articles->appends(['cate_id' => $cate_id])->render() }}</div>
        <div id="myInfo" style="display: none"></div>        
    </div>
@endsection
