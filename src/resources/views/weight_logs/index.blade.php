@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="title">体重管理画面！</h1>

    <div class="stats-box">
        <div>目標体重 <span>{{ number_format($targetWeight, 1) ?? '未設定' }} kg</span></div>
        <div>目標まで <span>
                @if(is_numeric($weightDiff))
                {{ number_format($weightDiff, 1) }} kg
                @else
                未計算
                @endif
            </span></div>
        <div>最新体重 <span>{{ number_format($latestWeight, 1) ?? '未記録' }} kg</span></div>
    </div>

    {{-- 横並び用のラッパー --}}
    <div class="search-add-wrapper">
        {{-- 検索フォーム --}}
        <form class="search-form" action="{{ route('weight_logs.search') }}" method="GET" >
            <label for="from">
                <!-- 日付（from） -->
            </label>
            <input type="date" id="from" name="from" value="{{ request('from') }}">

            <label for="to">
                <!-- 日付（to） -->～
            </label>
            <input type="date" id="to" name="to" value="{{ request('to') }}">

            <button type="submit">検索</button>

            @if(request('from') || request('to'))
            <a href="{{ route('weight_logs.index') }}" class="reset-btn">リセット</a>
            @endif
        </form>

        {{-- 検索条件の表示（任意） --}}
        @if(request('from') || request('to'))
        <div class="search-summary">
            検索中：
            @if(request('from')) {{ request('from') }} ～ @endif
            @if(request('to')) {{ request('to') }} @endif
        </div>
        @endif

        {{-- 右：データ追加ボタン --}}
        <div class="actions">
            <a href="#modal1" class="btn-add">データ追加</a>
        </div>
    </div>
    <!--*********: データー管理詳細（下部）********** -->
    <table class="weight-table">
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>カロリー</th>
                <th>運動内容</th>
                <th>運動時間</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weightLogs as $log)
            <tr>
                <td>{{ $log->date }}</td>
                <td>{{ $log->weight }}kg</td>
                <td>{{ $log->calories }}kcal</td>
                <td>{{ $log->exercise_content }}</td>
                <td>{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}</td>
                <td><a href="{{ route('weight_logs.edit', $log->id) }}">✏</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        <!-- {{ $weightLogs->links() }} -->
        <nav class="pagination">
            <a href="?page=1" class="page-link">1</a>
            <a href="?page=2" class="page-link">2</a>
            <a href="?page=3" class="page-link">3</a>
        </nav>
    </div>

</div>

<!-- モーダル -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <a href="#" class="close-btn">✕</a>
        <h2>Weight Log追加</h2>

        <form action="{{ route('weight_logs.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">日付</label>
                <input type="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="weight">体重 <span class="unit">（kg）</span></label>
                <input type="number" step="0.1" name="weight" required>
            </div>
            <div class="form-group">
                <label for="calories">摂取カロリー <span class="unit">（kcal）</span></label>
                <input type="number" name="calories" required>
            </div>
            <div class="form-group">
                <label for="exercise_time">運動時間</label>
                <input type="time" name="exercise_time">
            </div>

            <div class="form-group">
                <label for="exercise_content">運動内容</label>
                <textarea name="exercise_content" placeholder="運動内容を追加" rows="3"></textarea>
            </div>

            <div class="form-buttons">
                <a href="#" class="btn-back">戻る</a>
                <button type="submit" class="btn-submit">登録</button>
            </div>
        </form>
    </div>

</div>

@endsection
