@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

@section('content')
<div class="container">
    <h2 class="title">Weight Log_edit</h2>

    {{-- 更新フォーム --}}
    <form id="update-form" action="{{ route('weight_logs.update', $weight_log->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date">日付</label>
            <input type="date" id="date" name="date" value="{{ old('date', $weight_log->date) }}">
        </div>

        <div class="form-group">
            <label for="weight">体重（kg）</label>
            <input type="number" step="0.1" id="weight" name="weight" value="{{ old('weight', $weight_log->weight) }}">
        </div>

        <div class="form-group">
            <label for="calories">摂取カロリー（kcal）</label>
            <input type="number" id="calories" name="calories" value="{{ old('calories', $weight_log->calories) }}">
        </div>

        <div class="form-group">
            <label for="exercise_time">運動時間</label>
            <input type="time" id="exercise_time" name="exercise_time" value="{{ old('exercise_time', $weight_log->exercise_time) }}">
        </div>

        <div class="form-group">
            <label for="exercise_content">運動内容</label>
            <textarea id="exercise_content" name="exercise_content" placeholder="運動内容を追加">{{ old('exercise_content', $weight_log->exercise_content) }}</textarea>
        </div>

        {{-- ボタン3つを横並び --}}
        <div class="button-group">
            <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>

            <button type="submit" class="btn-update">更新</button>

            <form action="{{ route('weight_logs.destroy', $weight_log->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">🗑️ 削除</button>
            </form>

        </div>

    </form><!-- 更新フォームの閉じタグはここで閉じる -->

</div>

<!-- </div> -->
@endsection
