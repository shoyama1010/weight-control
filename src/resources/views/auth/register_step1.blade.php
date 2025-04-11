<!-- resources/views/auth/register_step1.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>会員登録</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="auth-container">
        <h2>新規会員登録</h2>
        <form action="{{ url('/register/step1') }}" method="POST">
            @csrf
            <div>
                <label>名前</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name') <div>{{ $message }}</div> @enderror
            </div>

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

            <p>アカウントをお持ちの方はこちらから <a href="{{ route('login') }}">ログイン</a></p>

            <button type="submit">次に進む</button>
        </form>

    </div>
</body>

</html>
