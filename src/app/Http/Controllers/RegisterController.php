<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register_step1');
    }

    public function register(RegisterUserRequest $request)
    {
        // ユーザー登録
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ログイン処理（必要なら）
        auth()->login($user);

        // 初期体重登録画面へリダイレクト
        return redirect('/register/step2');
    }
}
