<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    public function testUserIsLoggedOutProperly()
    {
        $user = User::factory()->create(['email' => 'user@test.com']);
        $token = $user->createToken(APP_TOKEN)->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('post', '/api/logout', [], $headers)->assertStatus(200)
            ->assertStatus(200)
            ->assertJson([
                "message" => "User has successfully logged out"
            ]);
    }
}
