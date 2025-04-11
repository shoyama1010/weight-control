<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Str;

class WeightLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. ダミーユーザーを1人作成
        $user = User::firstOrCreate(
            ['email' => 'dummy@example.com'],
            [
                'name' => 'ダミーユーザー',
                'email_verified_at' => now(), // ← 追加でエラー回避！
                'password' => bcrypt('password'), // 実際にログインして確認可能
                'remember_token' => Str::random(10),
            ]
        );

        // 2. 目標体重を1件作成して紐づけ
        if (!$user->weightTarget) {
            $user->weightTarget()->create(
                WeightTarget::factory()->make()->toArray()
            );
        }
        // $user->weightTarget()->create(
        //     WeightTarget::factory()->make()->toArray()
        // );

        // 3. weight_logs を35件作成して紐づけ
        if ($user->weightLogs()->count() < 35) {
            $remaining = 35 - $user->weightLogs()->count();
            for ($i = 0; $i < 35; $i++) {
                $user->weightLogs()->create(
                    WeightLog::factory()->make()->toArray()
                );
            }
        }
    }
}
