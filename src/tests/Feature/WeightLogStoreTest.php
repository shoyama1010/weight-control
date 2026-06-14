<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeightLogStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_store_weight_log()
    {
        $user = User::factory()->create();

        $data = [
            'date' => '2026-05-10',
            'weight' => 66.5,
            'calories' => 1200,
            'exercise_time' => '02:30',
            'exercise_content' => 'ジムトレーニング',
        ];

        $response = $this->actingAs($user)->post('/weight_logs', $data);

        $response->assertRedirect(route('weight_logs.index'));

        $this->assertDatabaseHas('weight_logs', [
            'user_id' => $user->id,
            'date' => '2026-05-10',
            'weight' => 66.5,
            'calories' => 1200,
            'exercise_time' => '02:30:00',
            'exercise_content' => 'ジムトレーニング',
        ]);
    }
}
