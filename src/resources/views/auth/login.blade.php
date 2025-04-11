{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="auth-container">
    <h2>ログイン</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email') <div>{{ $message }}</div> @enderror
            </div>

            <div>
                <label>パスワード</label>
                <input type="password" name="password">
                @error('password') <div>{{ $message }}</div> @enderror
            </div>

            <button type="submit">ログイン</button>

            <p><a href="{{ url('/register/step1') }}">アカウント作成はこちら</a></p>
        </form>
    </div>
</body>

</html>
