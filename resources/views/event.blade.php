<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCEM</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('top') }}">MCEM</a>
            <div class="navbar-nav collapse navbar-collapse">
                <span class="navbar-text">music composition event manager</span>
            </div>
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    @auth
                        <a href="{{ route('mypage') }}" class="btn btn-success btn-sm">マイページ</a>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm">ログイン</a>
                    @endguest
                </li>
            </ul>
        </div>
    </nav>

    <div class="container my-4">
        <h1>{{ $eventinfo->title }}</h1>
        <p class="fs-5 text-end">イベント主催者　{{ $eventinfo->user->username }}</p>
        <p class="fs-6 fw-light text-center">参加期限　{{ date('Y/m/d H:i', strtotime($eventinfo->participate)) }}</p>
        <p class="fs-6 fw-light text-center">提出期限　{{ date('Y/m/d H:i', strtotime($eventinfo->submit)) }}</p>
        <p class="fs-4">{!! nl2br(e($eventinfo->detail)) !!}</p>
    </div>
</body>

</html>
