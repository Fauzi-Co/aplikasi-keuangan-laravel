<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegistrasiTest extends TestCase
{
    use RefreshDatabase;

    public function test_registrasi_sukses()
    {
        $res = $this->postJson('/api/registrasi', [
            'name' => 'Andi',
            'email' => 'andi@example.com',
            'password' => 'palingKau123_',
        ]);
        $res->assertStatus(200)->assertJson(['data' => []]);
        $this->assertDatabaseHas('users', ['email' => 'andi@example.com']);
    }

    public function test_registrasi_duplicate_email()
    {
        User::create(['name' => 'A', 'email' => 'a@example.com', 'password' => bcrypt('password')]);
        $res = $this->postJson('/api/registrasi', [
            'name' => 'B',
            'email' => 'a@example.com',
            'password' => 'palingKau123_',
        ]);
        $res->assertStatus(422)->assertJsonStructure(['error']);
    }

    public function test_registrasi_password_too_short()
    {
        $res = $this->postJson('/api/registrasi', [
            'name' => 'C',
            'email' => 'c@example.com',
            'password' => 'short',
        ]);
        $res->assertStatus(422)->assertJsonStructure(['error']);
    }
}
