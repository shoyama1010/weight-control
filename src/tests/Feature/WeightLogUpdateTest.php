<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WeightLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeightLogUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_update_weight_log()
    {
        $user = User::factory()->create();

        $weightLog = WeightLog::factory()->create([
            'user_id' => $user->id,
            'date' => '2026-05-10',
            'weight' => 66.5,
            'calories' => 1200,
            'exercise_time' => '02:30',
            'exercise_content' => 'ジムトレーニング',
        ]);

        $updateData = [
            'date' => '2026-05-11',
            'weight' => 65.8,
            'calories' => 1100,
            'exercise_time' => '01:45',
            'exercise_content' => 'ウォーキング',
        ];

        $response = $this->actingAs($user)
            ->put("/weight_logs/{$weightLog->id}", $updateData);

        $response->assertRedirect(route('weight_logs.index'));

        $this->assertDatabaseHas('weight_logs', [
            'id' => $weightLog->id,
            'user_id' => $user->id,
            'date' => '2026-05-11',
            'weight' => 65.8,
            'calories' => 1100,
            'exercise_time' => '01:45:00',
            'exercise_content' => 'ウォーキング',
        ]);

        $this->assertDatabaseMissing('weight_logs', [
            'id' => $weightLog->id,
            'date' => '2026-05-10',
            'weight' => 66.5,
            'calories' => 1200,
            'exercise_time' => '02:30:00',
            'exercise_content' => 'ジムトレーニング',
        ]);
    }
}
