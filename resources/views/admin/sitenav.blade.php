@extends('layouts.admin')

@section('nav')
	@foreach($sites as $site)
		<li class="layui-nav-item"><a href="{{ url('/admin/site?site_id='.$site->url) }}">{{ $site->name }}</a></li>
	@endforeach
@endsection

@section('content')
   	@yield('content')
@endsection
