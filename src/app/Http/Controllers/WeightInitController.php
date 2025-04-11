<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegisterWeightRequest;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class WeightInitController extends Controller
{
    public function show()
    {
        return view('auth.register_step2');
    }

    public function store(RegisterWeightRequest $request)
    {
        WeightTarget::create([
            'user_id' => Auth::id(),
            'target_weight' => $request->target_weight,
        ]);

        // 必要に応じて体重ログなど初期値保存も可

        return redirect('/weight_logs')->with('success', '登録が完了しました');
    }
}
