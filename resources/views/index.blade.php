@extends('layouts.app')

@section('head-extension')
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content" style="width: 80%; margin-top: -80px;">
        <div class="m-b-md">
            <h2>诚工物联</h2>
        </div>
        @auth
            <a href="{{ route('newqr') }}"><button type="button" class="btn btn-primary btn-lg btn-block">生成二维码</button></a>
            <a href="{{ route('deqr') }}"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-top: 20px;">填写产品信息</button></a>
        @else
            <a href="{{ route('login') }}"><button type="button" class="btn btn-primary btn-lg btn-block">登录</button></a>
        @endauth


    </div>
</div>

@endsection
