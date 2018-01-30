@extends('layouts.admin')

@section('content')
    <div class="" style="padding: 15px;">

        <table class="layui-table">
            <tbody>
                <tr>
                    <th>用户名</th>
                    <td>{{ $customer->username }}></td>
                </tr>
                <tr>
                    <th>性别</th>
                    <td>{{ $customer->sex == 1 ? '男' : '女' }}></td>
                </tr>
                <tr>
                    <th>城市</th>
                    <td>{{ $customer->city }}</td>
                </tr>
                <tr>
                    <th>签名</th>
                    <td>{{ $customer->sign }}</td>
                </tr>
                <tr>
                    <th>积分</th>
                    <td>{{ $customer->score }}</td>
                </tr>
                <tr>
                    <th>评分</th>
                    <td>{{ $customer->mark }}</td>
                </tr>
                <tr>
                    <th>职业</th>
                    <td>{{ $customer->duty }}</td>
                </tr>
                <tr>
                    <th>财富</th>
                    <td>{{ $customer->wealth }}</td>
                </tr>
            </tbody>
        </table>

        <form action="{{ url('/admin', $customer->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="layui-btn layui-btn-danger" lay-submit="" lay-filter="demo1">删除</button>
        </form>
    </div>
@endsection
