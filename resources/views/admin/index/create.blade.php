@extends('layouts.admin')

@section('content')
    <div class="" style="padding: 15px;">

        <div id="LAY_preview">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
              <legend>表单集合演示</legend>
            </fieldset>

            <form class="layui-form" action="{{ url('admin') }}" method="POST">
                {{ csrf_field() }}
              <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                  <input type="text" name="username" lay-verify="username" autocomplete="off" placeholder="请输入标题" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item" pane="">
                    <label class="layui-form-label">性别</label>
                    <div class="layui-input-block">
                      <input type="radio" name="sex" value="1" title="男" checked="">
                      <input type="radio" name="sex" value="0" title="女">
                      <input type="radio" name="sex" value="禁" title="禁用" disabled="">
                    </div>
                  </div>
              <div class="layui-form-item">
                  <label class="layui-form-label">城市</label>
                  <div class="layui-input-block">
                    <input type="text" name="city" lay-verify="city" autocomplete="off" placeholder="请输入标题" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">签名</label>
                  <div class="layui-input-block">
                    <input type="text" name="sign" lay-verify="sign" autocomplete="off" placeholder="请输入标题" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">积分</label>
                  <div class="layui-input-block">
                    <input type="number" name="score" lay-verify="score" autocomplete="off" placeholder="请输入标题" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">评分</label>
                  <div class="layui-input-block">
                    <input type="number" name="mark" lay-verify="mark" autocomplete="off" placeholder="请输入标题" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">职业</label>
                  <div class="layui-input-block">
                    <input type="text" name="duty" lay-verify="duty" autocomplete="off" placeholder="请输入标题" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">财富</label>
                  <div class="layui-input-block">
                    <input type="number" name="wealth" lay-verify="wealth" autocomplete="off" placeholder="请输入标题" class="layui-input">
                  </div>
                </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                  <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
              </div>
            </form>
        </div>
    </div>
@endsection
