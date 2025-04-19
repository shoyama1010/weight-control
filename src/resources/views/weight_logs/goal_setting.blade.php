@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/target-weight.css') }}">

@section('title', '目標体重設定')

@section('content')
<!-- <div class="container"> -->
<div class="target-weight-box">
    <h2 class="title">目標体重設定</h2>

    <form method="POST" action="{{ route('target_weight.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="target_weight">目標体重（kg）</label>
            <input type="number" name="target_weight" id="target_weight" step="0.1" value="{{ old('target_weight', $targetWeight) }}">
            @error('target_weight')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="button-group">
            <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">変更</button>
        </div>
    </form>
</div>
@endsection

