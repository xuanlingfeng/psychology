@extends('admin.adminIndex')

@section('config')
<div class="tab-content">

    @if (isset($model))
    {!! Form::model($model, ['url' => ['admin/logo', $model->id], 'method' => 'PUT', 'class' => 'layui-form', 'id' => 'formLogo']) !!}
    @endif
    {!! Form::open(['url' => 'admin/logo', 'class' => 'layui-form', 'id' =>'formLogo']) !!}
    <div class="layui-form-item">
        {!! Form::label('name', 'logo名称', ['class' => 'layui-form-label']) !!}
        <div class="layui-input-block">
            {!! Form::text('name', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => 'logo名称', 'class' => 'layui-input']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        {!! Form::label('description', 'logo描述', ['class' => 'layui-form-label']) !!}
        <div class="layui-input-block">
            {!! Form::text('description', null, ['lay-verify' => 'required', 'autocomplete' => 'off', 'placeholder' => '请输入logo描述', 'class' => 'layui-input']) !!}
        </div>
    </div>
    <div class="layui-form-item">
        建议logo图片尺寸为：210*33
        {!! Form::label('image', 'logo图片', ['class' => 'layui-form-label']) !!}
        <div class="layui-input-block">
            <div class="layui-upload">
                <button type="button" class="layui-btn" lay-data="{ accept: 'images' }" size="200" id="upload_thumb">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                </button>
                <div class="layui-upload-list">
                    <img class="layui-upload-img" name="image" id="image" src="{{ isset($model->image) && $model->image != ''?$model->image:'' }}" style="max-height: 160px; max-width: 200px;">
                    <input type="hidden" id="myImage" name="image" value="{{ isset($model->image) && $model->image != ''?$model->image:'' }}">
                    <p id="demoText"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            {!! Form::button('提交', ['id'=>'logoButton', 'class'=>'layui-btn', 'lay-submit'=>'', 'lay-filter'=>'save']) !!}
        </div>
    </div> 
    {!! Form::close() !!}
</div>
<script id="uploadContainer" name="content" style="width:100%;height:350px;display:none;" type="text/template"></script>
@endsection

@section('js')
@include('UEditor::head')
    <script type="text/javascript">
        $ue = UE.getEditor('container', { initialFrameWidth: '100%' ,initialFrameHeight: 400 });
        var $ueUpload = UE.getEditor('uploadContainer', {
            isShow: false,
            focus: false,
            enableAutoSave: false,
            autoSyncData:false,
            autoFloatEnabled: false,
            wordCount: false,
            sourceEditor: null,
            scaleEnabled: true,
            toolbars: [['insertimage', 'attachment']]
        });
        // 监听图片和文件上传
        $ueUpload.ready(function () {
            $ueUpload.addListener('beforeInsertImage', _beforeInsertImage);
        });

        // 自定义图片上传对话框事件
        document.getElementById('upload_thumb').onclick = function() {
            var dialog = $ueUpload.getDialog('insertimage');
            dialog.title = '上传图片';
            dialog.render();
            dialog.open();
        }
        // 上传图片
        function _beforeInsertImage(t, result) {
            var imgHtml = result[0].src;
            document.getElementById('image').src = imgHtml;
            // 把路由传入隐藏的input标签里面， 数据提交至数据库
            document.getElementById('myImage').value = imgHtml;
        }

        layui.use(['form', 'laydate', 'upload'], function() {
            var form = layui.form,
            $ = layui.$,
            laydate = layui.laydate,
            upload = layui.upload;
        //监听提交
        form.on('submit(save)', function(data){
            // 获取url
            $url = $('#formLogo').attr('action');
            $.post($url, data.field, function(data, textStatus, xhr) {

                layer.msg(data.info);
            });
            return false;
        });  
    });
    </script>
@endsection  