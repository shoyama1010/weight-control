<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\WeightLogRequest;

class WeightLogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // 一覧取得
        $weightLogs = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->paginate(8);
        // 最新体重（最も新しい日付のレコード）
        $firstLog = $weightLogs->first();
        $latestWeight = $firstLog ? $firstLog->weight : null;

        // 目標体重（ユーザーに対して1対1）
        $target = $user->weightTarget;
        $targetWeight = $target ? $target->target_weight : null;

        // 減量差分（数値同士であれば計算）
        $weightDiff = is_numeric($latestWeight) && is_numeric($targetWeight)
            ? $latestWeight - $targetWeight
            : null;

        $searchCount = $weightLogs->total();

        return view('weight_logs.index', [
            'weightLogs' => $weightLogs,
            'latestWeight' => $latestWeight,
            'targetWeight' => $targetWeight,
            'weightDiff' => $weightDiff,
            'searchCount' => $searchCount, // ← これを渡す
        ]);
    }

    public function create()
    {
        return $this->index();
    }

    public function store(WeightLogRequest $request)
    {
        $validated = $request->validated();

        $user = auth()->user();
        $user->weightLogs()->create($validated);

        return redirect()->route('weight_logs.index')->with('success', '体重ログを追加しました！');
    }

    public function edit(WeightLog $weight_log)
    {
        return view('weight_logs.edit', compact('weight_log'));
    }

    // 更新処理
    public function update(WeightLogRequest $request, WeightLog $weight_log)
    {
        $validated = $request->validated();

        $weight_log->update($validated);


        return redirect()->route('weight_logs.index')->with('success', '更新しました');
    }


    public function search(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $query = WeightLog::query();

        if ($from) {
            $query->where('date', '>=', $from);
        }

        if ($to) {
            $query->where('date', '<=', $to);
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(8);

        $searchCount = $weightLogs->total(); // ページネーション全体件数を取得

        // 必要に応じて、目標体重などの変数も取得
        $user = auth()->user();

        $targetWeight = optional($user)->target_weight;
        $latestWeight = optional($weightLogs->first())->weight;

        // / ⭐ 目標体重との差を計算（小数第1位まで）
        $weightDiff = isset($latestWeight, $targetWeight)
            ? round($latestWeight - $targetWeight, 1)
            : null;

        return view('weight_logs.index', compact(
            'weightLogs',
            'targetWeight',
            'latestWeight',
            'weightDiff',
            'searchCount' // ←追加
        ));
    }

    public function destroy(WeightLog $weight_log)
    {
        $weight_log->delete();

        return redirect()->route('weight_logs.index')->with('success', '削除しました');
    }
}
