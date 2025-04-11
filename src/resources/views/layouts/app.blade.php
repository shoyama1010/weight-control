<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', '体重管理')</title>

    @if (request()->is('login') || request()->is('register/*'))
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @elseif (request()->is('weight_logs/*/edit'))
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    
    @elseif (request()->is('weight_logs*'))
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

    @endif

</head>

<body>
    <header class="header-inner">
        <div class="logo">PiGLy</div>
        <div>
            <a href="{{ route('target_weight.edit') }}">目標体重設定</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
    </header>
    <main class="container">
        @yield('content')
    </main>
</body>
</html>
