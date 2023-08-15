<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>イベント検索 - MCEM</title>
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
        <form action="#" method="GET">
            <div class="mb-3">
                <label for="keyword">キーワード</label>
                <input type="text" class="form-control" id="keyword" name="keyword"
                    value="{{ request()->input('keyword') }}">
            </div>
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="true" type="checkbox" name="participate" id="participate"
                        {{ request()->input('participate') || request()->input() == null ? 'checked' : '' }}>
                    <label for="participate" class="form-check-label">参加者募集中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="true" type="checkbox" name="submit" id="submit"
                        {{ request()->input('submit') ? 'checked' : '' }}>
                    <label for="submit" class="form-check-label">提出待ち</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="true" type="checkbox" name="result" id="result"
                        {{ request()->input('result') ? 'checked' : '' }}>
                    <label for="result" class="form-check-label">結果発表待ち</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="true" type="checkbox" name="finished" id="finished"
                        {{ request()->input('finished') ? 'checked' : '' }}>
                    <label for="finished" class="form-check-label">終了</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="true" type="checkbox" name="cancelled" id="cancelled"
                        {{ request()->input('cancelled') ? 'checked' : '' }}>
                    <label for="cancelled" class="form-check-label">キャンセル</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">検索</button>
        </form>
    </div>
    <div class="container">
        @if (isset($events))
            @foreach ($events as $event)
                <div class="my-2 border-dark rounded">
                    <div class="">
                        <h5 class="d-inline"><a href="{{ route('event.show', $event->id) }}">{{ $event->title }}</a>
                        </h5>
                        <p class="text-secondary fw-light d-inline">
                            @switch($event->status)
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
                                    キャンセル
                                @break

                                @default
                                    エラー
                            @endswitch
                        </p>
                    </div>
                    <p>{{ $event->detail }}</p>
                </div>
            @endforeach
            <div>
                {{ $events->links() }}
            </div>
        @else
        @endif
    </div>
</body>

</html>
