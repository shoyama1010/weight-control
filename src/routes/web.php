<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WeightInitController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\TargetWeightController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register/step1', [RegisterController::class, 'show'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register/step2', [WeightInitController::class, 'show'])->name('register.step2');
Route::post('/register/step2', [WeightInitController::class, 'store']);

// 一般ユーザーが閲覧できる体重記録メイン画面
Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');


Route::middleware(['auth'])->group(function () {
    // 管理画面の一覧作成
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    // 検索
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');
    // CSV
    Route::get('/weight_logs/export/csv', [WeightLogController::class, 'exportCsv'])
        ->name('weight_logs.export.csv');
    // レポート
    Route::get('/weight_logs/report', [WeightLogController::class, 'report'])
        ->name('weight_logs.report');
    // ※あえて index メソッドを使って create画面（モーダル）を表示する
    Route::get('/weight_logs/create', [WeightLogController::class, 'index'])->name('weight_logs.create');
    // 登録
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
    // 編集
    Route::get('/weight_logs/{weight_log}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    // 更新
    Route::put('/weight_logs/{weight_log}', [WeightLogController::class, 'update'])->name('weight_logs.update');
    // 削除
    Route::delete('/weight_logs/{weight_log}', [WeightLogController::class, 'destroy'])
        ->name('weight_logs.destroy');
    
    // 目標体重の設定・更新
    Route::get('/goal_setting', [TargetWeightController::class, 'edit'])->name('target_weight.edit');
    Route::put('/goal_setting', [TargetWeightController::class, 'update'])->name('target_weight.update');

    // 不要な show ルートは除外（エラー対策）
    Route::resource('weight_logs', WeightLogController::class)->except(['show']);    
});
