@extends('layouts.admin')

@section('nav')
    <li class="layui-nav-item"><a href="{{ url('/admin') }}">控制台</a></li>
@endsection
@section('content')
    <div class="" style="padding: 15px;">
        <blockquote class="layui-elem-quote">
           添加问题选项
        </blockquote>
        <form class="layui-form" method="POST" action="{{ url('/question/edits/'.$id) }}">
            <div class="layui-form-item">
                <label class="layui-form-label" >请修改要提交的问题选项</label>
                <div class="layui-input-block">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="text" name="option" required  lay-verify="required" placeholder="请输入问题选项" autocomplete="off" class="layui-input" value="{{$model['option']}}">
                </div>
                <label class="layui-form-label" >请修改选项对应分数</label>
                <div class="layui-input-block">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="text" name="fraction" required  lay-verify="required" placeholder="请输入问题选项" autocomplete="off" class="layui-input" value="{{$model['fraction']}}">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
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