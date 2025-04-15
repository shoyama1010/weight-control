<!-- resources/views/auth/register_step1.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="auth-container">
        <h1>PiGLy</h1>
        <h2>新規会員登録</h2>
        <p class="account-text">step1アカウント情報の登録</p>

        <form action="{{ url('/register/step1') }}" method="POST">
            @csrf
            <div>
                <label>名前</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label>パスワード</label>
                <input type="password" name="password">
                @error('password')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">次に進む</button>
            <p class="center-text"><a href="{{ route('login') }}">ログインはこちら</a></p>

        </form>

    </div>
</body>

</html>
