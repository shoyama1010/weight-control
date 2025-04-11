<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>初期目標体重登録</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="auth-container">
    <h1>初期目標体重登録</h1>

        <form method="POST" action="{{ url('/register/step2') }}">
            @csrf
            <div>
                <label>現在の体重 (kg)</label>
                <input type="text" name="current_weight" value="{{ old('current_weight') }}">
                @error('current_weight') <div>{{ $message }}</div> @enderror
            </div>

            <div>
                <label>目標体重 (kg)</label>
                <input type="text" name="target_weight" value="{{ old('target_weight') }}">
                @error('target_weight') <div>{{ $message }}</div> @enderror
            </div>

            <button type="submit">アカウント作成</button>
        </form>
    </div>

</body>



</html>
