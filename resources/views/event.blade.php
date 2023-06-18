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
        <p class="fw-6">
            @switch($eventinfo->status)
                @case('participate')
                    参加者募集中
                @break

                @case('submit')
                    提出受付中
                @break

                @case('result')
                    結果発表待ち
                @break

                @case('finished')
                    終了
                @break

                @case('cancelled')
                    中止
                @break

                @default
                    エラー
            @endswitch
        </p>
        <p class="fs-5 text-end">イベント主催者　{{ $eventinfo->user->username }}</p>
        <p class="fs-6 fw-light text-center">参加期限　{{ date('Y/m/d H:i', strtotime($eventinfo->participate)) }}</p>
        <p class="fs-6 fw-light text-center">提出期限　{{ date('Y/m/d H:i', strtotime($eventinfo->submit)) }}</p>
        <p class="fs-4">{!! nl2br(e($eventinfo->detail)) !!}</p>
        @switch($eventinfo->status)
            @case('participate')
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">ログインして参加</a>
                @else
                    @if ($eventinfo->participants->contains('id', Auth::user()->id))
                        <a href="#" class="btn btn-primary">楽曲提出</a>
                    @else
                        <form action="{{ route('event.participate', $eventinfo->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary" type="submit">イベントに参加</button>
                        </form>
                    @endif
                @endguest
            @break

            @case('submit')
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">ログインして提出</a>
                @else
                    @if ($eventinfo->participants->contains('id', Auth::user()->id))
                        @if ($eventinfo->submits->contains('participant_id', Auth::user()->id))
                            <p>楽曲提出済み</p>
                        @else
                            <a href="#" class="btn btn-primary">楽曲提出</a>
                        @endif
                    @else
                        <p class="">イベントに参加していません</p>
                    @endif
                @endguest
            @break

            @case('result')
                <p>結果発表待ちです</p>
            @break

            @case('finished')
                <p>結果はこちら</p>
            @break

            @case('cancelled')
                <p>イベントは中止されました</p>
            @break

            @default
                <p>イベント状態にエラーが発生しています</p>
        @endswitch

    </div>
</body>

</html>
