<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WeightLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeightLogIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_view_weight_logs_index()
    {
        $user = User::factory()->create();

        WeightLog::factory()->create([
            'user_id' => $user->id,
            'date' => '2026-05-01',
            'weight' => 66.5,
            'calories' => 1200,
            'exercise_time' => '02:30',
            'exercise_content' => 'ジムトレーニング',
        ]);

        $response = $this->actingAs($user)->get('/weight_logs');

        $response->assertStatus(200);
        $response->assertSee('Weight-control');
        $response->assertSee('66.5');
        $response->assertSee('ジムトレーニング');
    }
}
