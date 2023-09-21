<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録 - MCEM</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('top') }}">MCEM</a>
            <div class="navbar-nav collapse navbar-collapse">
                <span class="navbar-text">music composition event manager</span>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        <h1 class="pb-4">ユーザー登録</h1>
        <form class="row g-3 needs-validation" action="{{ route('register.store') }}" method="POST">
            @csrf
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                required>
            <label for="username" class="form-label">ユーザー名</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}"
                required>
            <label for="password" class="form-label">パスワード</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <label for="password_comfirm" class="form-label">確認用パスワード</label>
            <input type="password" class="form-control" id="password_comfirm" name="password_comfirm" required>
            <button class="btn btn-primary" type="submit">登録</button>
        </form>
    </div>
</body>

</html>
