<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Ticket;

class StatsTest extends TestCase
{
    public function testStatListedSuccessfully()
    {
        $user = User::factory()->create();
        $token = $user->createToken(APP_TOKEN)->accessToken;

        $headers = ["Authorization" => "Bearer $token", 
                    "Accept" => "application/json", 
                    "Content-Type" => "application/json"];

        $response = $this->json('GET', 'api/stats', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'total_tickets',
                    'unprocessed_tickets',
                    'highest_tickets_submitted_by',
                    'last_process_ticket_time'
                ],
                "message"
            ]);
    }
}
