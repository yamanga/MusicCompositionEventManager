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
        <h1>Music Composition Event manager</h1>
        <h3>作曲イベントを簡単に開催・参加！</h3>
        <p>ユーザー登録を行うことで簡単に作曲イベントを運営し
            参加する事ができます。</p>
        <a href="{{ route('event.search') }}">イベントを検索</a>
    </div>
</body>

</html>
