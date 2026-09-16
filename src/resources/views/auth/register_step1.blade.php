
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <main class="auth-page">
        <div class="auth-container">

            {{-- ブランド --}}
            <div class="auth-brand">
                <div class="brand-icon">B</div>
                <h1>BODYCON</h1>
                <p class="brand-copy">
                    毎日の記録から、理想のカラダへ。
                </p>
            </div>

            {{-- 登録タイトル --}}
            <div class="auth-heading">
                <span class="step-label">STEP 1 / 2</span>
                <h2>新規アカウント作成</h2>
                <p>まずはアカウント情報を入力してください</p>
            </div>

            <form action="{{ url('/register/step1') }}" method="POST">
                @csrf

                {{-- 名前 --}}
                <div>
                    <label for="name">名前</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="山田 太郎"
                        autocomplete="name">

                    @error('name')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- メールアドレス --}}
                <div>
                    <label for="email">メールアドレス</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="example@email.com"
                        autocomplete="email">

                    @error('email')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- パスワード --}}
                <div>
                    <label for="password">パスワード</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="パスワードを入力"
                        autocomplete="new-password">

                    @error('password')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">次に進む</button>

                <p class="center-text">
                    すでにアカウントをお持ちの方
                    <a href="{{ route('login') }}">ログイン</a>
                </p>
            </form>

        </div>
    </main>
</body>

</html>