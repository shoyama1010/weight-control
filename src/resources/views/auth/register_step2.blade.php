
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>初期目標体重登録</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

    <div class="auth-container">

        {{-- ブランド --}}
        <div class="auth-brand">
            <div class="brand-icon">B</div>

            <h1>BODYCON</h1>

            <p class="brand-copy">
                毎日の記録から、理想のカラダへ。
            </p>
        </div>

        {{-- タイトル --}}
        <div class="auth-heading">
            <span class="step-label">STEP 2 / 2</span>

            <h2>体重目標を設定</h2>

            <p>現在の体重と目標体重を入力してください</p>
        </div>

        <form method="POST" action="{{ url('/register/step2') }}">
            @csrf

            {{-- 現在体重 --}}
            <div>
                <label for="current_weight">
                    現在の体重
                </label>

                <div class="weight-input-wrapper">
                    <input
                        id="current_weight"
                        type="text"
                        name="current_weight"
                        value="{{ old('current_weight') }}"
                        placeholder="例：68.0"
                        inputmode="decimal">

                    <span class="weight-unit">kg</span>
                </div>

                @error('current_weight')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- 目標体重 --}}
            <div>
                <label for="target_weight">
                    目標体重
                </label>

                <div class="weight-input-wrapper">
                    <input
                        id="target_weight"
                        type="text"
                        name="target_weight"
                        value="{{ old('target_weight') }}"
                        placeholder="例：65.0"
                        inputmode="decimal">

                    <span class="weight-unit">kg</span>
                </div>

                @error('target_weight')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">
                アカウント作成
            </button>

        </form>

    </div>

</body>

</html>