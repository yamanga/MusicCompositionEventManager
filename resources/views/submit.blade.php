<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>楽曲提出 - MCEM</title>
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

    <div class="container my-4">
        <p>{{ $eventinfo->title }}</p>
        <h1>楽曲提出</h1>

        <form class="row g-3 needs-validation" action="{{ route('submit.store', $eventinfo->id) }}" method="POST">
            @csrf
            <label for="title" class="form-label">楽曲名</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            <label for="link" class="form-label">リンク</label>
            <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}"
                required>

            <button class="btn btn-primary" type="submit">提出</button>
        </form>

    </div>
</body>

</html>
