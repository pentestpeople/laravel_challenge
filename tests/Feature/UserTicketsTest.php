<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Ticket;

class UserTicketsTest extends TestCase
{
    public function testUserTicketsAreListedSuccessfully()
    {
        $user = User::factory()->create();
        $token = $user->createToken(APP_TOKEN)->accessToken;

        $headers = ["Authorization" => "Bearer $token", 
                    "Accept" => "application/json", 
                    "Content-Type" => "application/json"];

        // call API and get response from API
        $response = $this->json('GET', 'api/users/'.$user->email.'/tickets', [], $headers)
            ->assertStatus(200);
        
        // check if api-response has result key
        $this->assertArrayHasKey('tickets', $response);
    }
}
