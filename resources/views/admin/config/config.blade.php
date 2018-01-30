@extends('admin.adminIndex')

@section('config')
<div class="tab-content">
    {!! Form::model($model, ['url' => 'admin/site', 'method' => 'POST', 'class' => 'layui-form', 'id' => 'formConfig']) !!}
        <div class="box-body">
            @foreach ($model as $key => $value)
                <div class="col-md-6" style="margin-bottom: 15px;">
                    <div class="form-group">
                        {!! Form::label($value->name, $value->title, ['class' => 'layui-form-label']) !!}
                        <small style="padding: 9px 15px; display: inline-block;">({{ $value->remark }})</small>
                        {{-- 判断类型 --}}
                        @if ($value->type == 0)
                            {!! Form::text($value->name, $value->value, ['class' => 'layui-input']) !!}
                        @elseif ($value->type == 1)
                            {!! Form::text($value->name, $value->value, ['class' => 'layui-input']) !!}
                        @elseif ($value->type == 2)
                            {!! Form::textarea($value->name, $value->value, ['class' => 'layui-textarea']) !!}
                        @elseif ($value->type == 3)
                            {!! Form::textarea($value->name, $value->value, ['class' => 'layui-textarea']) !!}
                        @elseif ($value->type == 4)
                            {!! Form::select($value->name, ['1' => '开启', '2' => '关闭'], $value->value) !!}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="box-footer">
            <button type="button" id="configButton" class="layui-btn" target-form="form-horizontal">提交</button>
        </div>
    {!! Form::close() !!}
</div>
@endsection
@section('js')
<script type="text/javascript">
layui.use(['form'], function(){
    var form = layui.form,
        $ = layui.$;
    var $btn = $('#configButton'),
        $form = $('#formConfig'),
        $url = $form.attr('action');  // 获取表单路由

    $btn.click(function(){
        var $data = $form.serialize();
        $.post($url, $data, function(data){  // post 传递和接收数据信息
            alert(data.info);
        });
        return;
    });
});    
</script>
@endsection          
