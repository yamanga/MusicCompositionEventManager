<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ - MCEM</title>
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
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">ログアウト</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container my-4">
        <h1>{{ Auth::user()->username }}</h1>

        <div class="container-fluid pt-4">
            <h5>主催イベント</h5>
            @forelse (Auth::user()->events as $event)
                <p class="fs-4"><a href="{{ route('event.show', $event->id) }}">{{ $event->title }}</a> <a
                        href="{{ route('event.manage', $event->id) }}">管理</a>
                </p>
            @empty
                <p class="fs-4">なし</p>
            @endforelse

            <a href="{{ route('event.create') }}" class="btn btn-sm btn-primary">イベントを作成</a>
        </div>
        <div class="container-fluid pt-4">
            <h5>参加イベント</h5>
            @forelse (Auth::user()->partinevents as $event)
                <a class="fs-4" href="{{ route('event.show', $event->id) }}">{{ $event->title }}</a>
                @if ($event->status == 'participate' || $event->status == 'submit')
                    @if ($event->submits->doesntContain('participant_id', Auth::user()->id))
                        <p>楽曲未提出</p>
                    @endif
                @endif
                <br>
            @empty
                <p class="fs-4">なし</p>
            @endforelse
        </div>
    </div>
</body>

</html>
