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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register/step1', [RegisterController::class, 'show'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register/step2', [WeightInitController::class, 'show'])->name('register.step2');
Route::post('/register/step2', [WeightInitController::class, 'store']);

Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

Route::resource('weight_logs', WeightLogController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');

    Route::get('/weight_logs/{weight_log}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{weight_log}', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::resource('weight_logs', WeightLogController::class);

    Route::get('/target_weight/edit', [TargetWeightController::class, 'edit'])->name('target_weight.edit');
    Route::put('/target_weight', [TargetWeightController::class, 'update'])->name('target_weight.update');

    Route::delete('/weight_logs/{weight_log}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');
    // 目標体重の設定・更新
    Route::get('/goal_setting', [TargetWeightController::class, 'edit'])->name('target_weight.edit');
    Route::put('/goal_setting', [TargetWeightController::class, 'update'])->name('target_weight.update');
});
