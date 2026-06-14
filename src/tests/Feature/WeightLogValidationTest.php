<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeightLogValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_weight_log_store_requires_required_fields()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->from('/weight_logs/create')->post('/weight_logs', [
            'date' => '',
            'weight' => '',
            'calories' => '',
            'exercise_time' => '',
            'exercise_content' => '',
        ]);

        $response->assertRedirect('/weight_logs/create');

        $response->assertSessionHasErrors([
            'date',
            'weight',
            'calories',
            'exercise_time',
        ]);

        $this->assertDatabaseCount('weight_logs', 0);
    }
}
