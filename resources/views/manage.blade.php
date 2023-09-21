<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>イベント管理 {{ $eventinfo->title }} - MCEM</title>
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
                    <a href="{{ route('mypage') }}" class="btn btn-success btn-sm">マイページ</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container my-3">
        <h4>{{ $eventinfo->title }}</h4>
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
        <h1>イベント管理</h1>
        <div class="container-fluid my-4">
            <h4>結果発表</h4>
            @switch($eventinfo->status)
                @case('participate')
                @case('submit')
                    <p>結果登録期間ではありません</p>
                @break

                @case('cancelled')
                    <p>キャンセルされました</p>
                @break

                @case('finished')
                    <p>発表済みです</p>
                @break

                @case('result')
                    <form class="row g-3 needs-validation" action="{{ route('result.store', $eventinfo->id) }}" method="POST">
                        @csrf
                        <label class="form-label">発表形式</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="table" id="table" name="result_type"
                                {{ old('result_type') == 'table' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="table">
                                表形式
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="link" id="link" name="result_type"
                                {{ old('result_type') == 'link' ? 'checked' : '' }}>
                            <label class="form-check-label" for="link">
                                リンク形式
                            </label>
                        </div>
                        <label for="linktext" class="form-label">リンク（リンク形式で発表する場合入力）</label>
                        <input type="text" class="form-control" id="linktext" name="link" value="{{ old('link') }}">
                        <button class="btn btn-primary" type="submit">発表</button>
                    </form>
                @break

                @default
                    <p>エラー</p>
            @endswitch
        </div>
        <div class="container-fluid my-4">
            <h4>参加者提出一覧</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ユーザー</th>
                        <th scope="col">提出</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventinfo->participants as $user)
                        <td>{{ $user->username }}</td>
                        @if ($eventinfo->submits->contains('participant_id', $user->id))
                            <td>
                                <a
                                    href="{{ $eventinfo->submits->where('participant_id', '=', $user->id)->sortByDesc('created_at')->first()->link }}">{{ $eventinfo->submits->where('participant_id', '=', $user->id)->sortByDesc('created_at')->first()->link }}</a>
                            </td>
                        @else
                            <td>未提出</td>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($eventinfo->status != 'cancelled' && $eventinfo->status != 'finished')
            <div class="container-fluid my-4">
                <form action="{{ route('event.cancel', $eventinfo->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">イベントをキャンセル</button>
                </form>
            </div>
        @endif

    </div>

</body>

</html>
