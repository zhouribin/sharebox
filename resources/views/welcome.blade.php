@extends('layouts.app')
<style>
    html, body {
        background-image: url({{ asset('svg/star-bg.svg') }}),
        linear-gradient(#191c20,#191c20 50%);
        background-size: auto;
        color: #ffffff;
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

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
        color: #ffffff;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>

@section('content')

    <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Share Box
                </div>
                <div class="links">
                    <a href="{{ url('/home') }}">首页</a>
                </div>
            </div>

    </div>
@endsection
