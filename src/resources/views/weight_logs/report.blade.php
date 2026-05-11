@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/report.css') }}">

@section('content')

<div class="report-container">

  <h2 class="report-title">
    レポート
  </h2>

  {{-- 上部ボタン --}}
  <div class="report-actions">
    <a href="{{ route('weight_logs.index') }}" class="back-btn">
      ← 戻る
    </a>
  </div>

  {{-- レポートカード --}}
  <div class="report-cards">

    <div class="report-card">
      <h3>平均体重</h3>
      <p>{{ $avgWeight }} kg</p>
    </div>

    <div class="report-card">
      <h3>最大体重</h3>
      <p>{{ $maxWeight }} kg</p>
    </div>

    <div class="report-card">
      <h3>最小体重</h3>
      <p>{{ $minWeight }} kg</p>
    </div>

    <div class="report-card">
      <h3>記録数</h3>
      <p>{{ $countLogs }} 件</p>
    </div>

    <div class="report-card">
      <h3>平均カロリー</h3>
      <p>{{ $avgCalories }} kcal</p>
    </div>

  </div>

</div>

@endsection