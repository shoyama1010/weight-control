<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightTarget;

// 「目標体重を設定・更新」するため
class TargetWeightController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $target = Auth::user()->weightTarget;

        return view('weight_logs.goal_setting', ['targetWeight' => $target->target_weight ?? '']);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'target_weight' =>  [
                    'required',
                    'numeric',
                    'min:1',
                    'regex:/^\d{1,3}(\.\d)?$/'
                ],
            ],
            [
                'target_weight.required' => '目標体重を入力してください。',
                'target_weight.numeric' => '数字で入力してください。',
                'target_weight.min' => '1以上の数値を入力してください。',
                'target_weight.regex' => '最大3桁＋小数点1位までの数値にしてください。',
            ]
        );

        // ★ これを追加！
        $user = Auth::user();

        $target = Auth::user()->weightTarget;

         // ★ モデルの保存
        WeightTarget::updateOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => $request->input('target_weight')]
        );

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました！');
    }

    public function destroy(WeightLog $weight_log)
    {
        $weight_log->delete();
        return redirect()->route('weight_logs.index')->with('success', '削除しました');
    }
}
