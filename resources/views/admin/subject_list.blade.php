@extends('layouts.admin')

@section('nav')
    <li class="layui-nav-item"><a href="{{ url('/admin') }}">控制台</a></li>
@endsection
@section('content')
    <div class="" style="padding: 15px;">
        <form class="layui-form" method="POST" action="{{ url('/question') }}">
        <table class="layui-table">
            <colgroup>
                <col width="80%">
                <col width="20%">
            </colgroup>
            <thead>
            <tr>
                <th>问题列表</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($subject as $subjects)
            <tr>
                <td>问题{{$subjects->id}}:&nbsp&nbsp&nbsp&nbsp{{$subjects->subject}}</td>
                <td><a href="{{ url('question/sites/'.$subjects->id.'/edit') }}" class="layui-btn layui-btn-primary layui-btn-sm">编辑</a>
                    <a href="{{ url('question/sites/'.$subjects->id.'/del') }}" class="layui-btn layui-btn-warm layui-btn-sm">删除</a>
            </tr>

                    @foreach($option as $options)
                        @if($subjects->id==$options->subject_id)
                        <tr>
                        <td>问题{{$subjects->id}}对应选项:&nbsp&nbsp&nbsp&nbsp&nbsp{{$options->option}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp分数:{{$options->fraction}}</td>
                            <td><a href="{{ url('question/sites/'.$options->id.'/edit') }}" class="layui-btn layui-btn-primary layui-btn-sm">编辑</a>
                                <a href="{{ url('question/sites/'.$options->id.'/del') }}" class="layui-btn layui-btn-warm layui-btn-sm">删除</a></td>
                        </tr>
                        @endif
                    @endforeach
            @endforeach
            </tbody>
        </table>
        </form>
    </div>
    <script>
        //Demo
        layui.use('form', function(){
            var form = layui.form;

            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });
    </script>
@endsection