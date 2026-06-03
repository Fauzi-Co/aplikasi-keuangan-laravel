<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_success()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        $res = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $res->assertStatus(200)->assertJsonStructure(['token']);
    }

    public function test_login_invalid_credentials()
    {
        User::create([
            'name' => 'User',
            'email' => 'user2@example.com',
            'password' => bcrypt('password123'),
        ]);

        $res = $this->postJson('/api/login', [
            'email' => 'user2@example.com',
            'password' => 'wrongpass',
        ]);

        $res->assertStatus(401)->assertJson(['error' => 'Email dan Password Salah']);
    }

    public function test_login_validation_errors()
    {
        $res = $this->postJson('/api/login', [
            'email' => 'not-an-email',
            'password' => 'short',
        ]);

        $res->assertStatus(422)->assertJsonStructure(['message', 'errors']);
    }
}
