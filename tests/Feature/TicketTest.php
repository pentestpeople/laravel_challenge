<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Ticket;

class TicketTest extends TestCase
{
    public function testOpenTicketsAreListedSuccessfully()
    {
        $user = User::factory()->create();
        $token = $user->createToken(APP_TOKEN)->accessToken;

        $headers = ["Authorization" => "Bearer $token", 
                    "Accept" => "application/json", 
                    "Content-Type" => "application/json"];

        Ticket::factory()->create([
            'subject' => 'Test Subject',
            'content' => 'Test Content',
            'username' => $user->name,
            'useremail' => $user->email,
            'status' => 0
        ]);

        Ticket::factory()->create([
            'subject' => 'Test another Subject',
            'content' => 'Test another Content',
            'username' => $user->name,
            'useremail' => $user->email,
            'status' => 0
        ]);
        
        // call API and get response from API
        $response = $this->json('GET', 'api/tickets/open', [], $headers)
            ->assertStatus(200);
        
        // check if api-response has result key
        $this->assertArrayHasKey('tickets', $response);
    }

    public function testCloseTicketsAreListedSuccessfully()
    {
        $user = User::factory()->create();
        $token = $user->createToken(APP_TOKEN)->accessToken;
       
        $headers = ["Authorization" => "Bearer $token", 
                    "Accept" => "application/json", 
                    "Content-Type" => "application/json"];

        Ticket::factory()->create([
            'subject' => 'Test Close Ticket Subject',
            'content' => 'Test Close Ticket Content',
            'username' => $user->name,
            'useremail' => $user->email,
            'status' => 1
        ]);

        Ticket::factory()->create([
            'subject' => 'Test another close ticket Subject',
            'content' => 'Test another close ticket Content',
            'username' => $user->name,
            'useremail' => $user->email,
            'status' => 1
        ]);
        
        // call API and get response from API
        $response = $this->json('GET', 'api/tickets/closed', [], $headers)
            ->assertStatus(200);
        
        // check if api-response has result key
        $this->assertArrayHasKey('tickets', $response);
    }
}
