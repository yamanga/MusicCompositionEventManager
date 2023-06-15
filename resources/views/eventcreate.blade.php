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
                    <a href="{{ route('mypage') }}" class="btn btn-success btn-sm">マイページ</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="pb-4">イベント作成</h1>

        <form class="row g-3 needs-validation" action="{{ route('event.store') }}" method="POST">
            @csrf
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" required>
            <label for="detail" class="form-label">説明</label>
            <textarea class="form-control" id="detail" name="detail" required></textarea>
            <label for="participate" class="form-label">参加期限</label>
            <input type="datetime-local" class="form-control" id="participate" name="participate" required>
            <label for="submit" class="form-label">提出期限</label>
            <input type="datetime-local" class="form-control" id="submit" name="submit" required>
            <button class="btn btn-primary" type="submit">作成</button>
        </form>

    </div>
</body>

</html>
