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

  {{-- ===== 月別平均レポート ===== --}}
  <h2 class="monthly-title">
    月別平均レポート
  </h2>
  <div class="monthly-report-list">
    @foreach($monthlyReports as $report)
    <div class="monthly-card">
      <h3>{{ $report->month }}</h3>
      <p>
        平均体重：
        <span>
          {{ number_format($report->avg_weight, 1) }} kg
        </span>
      </p>

      <p>
        平均カロリー：
        <span>
          {{ number_format($report->avg_calories, 0) }} kcal
        </span>
      </p>

      <p>
        記録数：
        <span>
          {{ $report->total_logs }} 件
        </span>
      </p>
    </div>
    @endforeach
  </div>

  {{-- ===== グラフ ===== --}}
  <hr class="report-line">

  <h2 class="report-subtitle">
    体重推移グラフ
  </h2>

  <div class="chart-area">
    <canvas id="weightChart"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
  const labels = @json($chartLabels);
  const weights = @json($chartWeights);

  const ctx = document.getElementById('weightChart');

  new Chart(ctx, {
    type: 'line',

    data: {
      labels: labels,

      datasets: [{
        label: '体重 (kg)',

        data: weights,

        borderColor: '#e54b9b',

        backgroundColor: 'rgba(229,75,155,0.15)',

        fill: true,

        tension: 0.3,

        borderWidth: 3,

        pointRadius: 5,

        pointBackgroundColor: '#e54b9b'
      }]
    },

    options: {
      responsive: true,

      plugins: {
        legend: {
          display: true
        }

      },

      scales: {
        y: {

          beginAtZero: false
        }

      }

    }

  });
</script>

@endsection