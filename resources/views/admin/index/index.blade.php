@extends('layouts.admin')

@section('content')
    <div class="" style="padding: 15px;">
        <div>
            <a class="layui-btn layui-btn-small" href="{{ url('/admin/create') }}">添加</a>
        </div>

        <table class="layui-table">
              <thead>
                    <tr>
                        <th>用户名</th>
                        <th>性别</th>
                        <th>城市</th>
                        <th>签名</th>
                        <th>积分</th>
                        <th>评分</th>
                        <th>职业</th>
                        <th>财富</th>
                        <th></th>
                    </tr>
              </thead>
              <tbody>
                  @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->username }}</td>
                        <td>{{ $customer->sex == 1 ? '男' : '女' }}</td>
                        <td>{{ $customer->city }}</td>
                        <td>{{ $customer->sign }}</td>
                        <td>{{ $customer->score }}</td>
                        <td>{{ $customer->mark }}</td>
                        <td>{{ $customer->duty }}</td>
                        <td>{{ $customer->wealth }}</td>
                        <td>
                            <a class="layui-btn layui-btn-small" href="{{ url('/admin/'. $customer->id . '/edit') }}">编辑</a>
                            <a class="layui-btn layui-btn-primary layui-btn-small" href="{{ url('/admin', $customer->id) }}">查看</a>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
        </table>
    </div>
@endsection
