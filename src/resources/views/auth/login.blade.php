
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ログイン | BODYCON</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

    <main class="auth-page">

        <div class="auth-container">

            <div class="auth-brand">
                <div class="auth-logo">B</div>

                <h1>BODYCON</h1>

                <p class="auth-description">
                    毎日の記録から、理想のカラダへ。
                </p>
            </div>

            <div class="auth-header">
                <h2>ログイン</h2>
                <p>アカウント情報を入力してください</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">メールアドレス</label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="example@email.com">

                    @error('email')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="パスワードを入力">

                    @error('password')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="login-button">
                    ログイン
                </button>

                <p class="account-text">
                    アカウントをお持ちでない方は
                    <a href="{{ url('/register/step1') }}">
                        新規登録
                    </a>
                </p>

            </form>

        </div>

    </main>

</body>

</html>