<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register(): void
    {
        $response = $this->post('/inscription', [
            'name' => 'Ahmed',
            'email' => 'ahmed@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ]);

        $response->assertRedirect('/connexion');

        $this->assertDatabaseHas('users', [
            'name' => 'Ahmed',
            'email' => 'ahmed@example.com',
            'role' => 'auteur',
        ]);
    }

    public function test_login_fails_with_invalid_credentials(): void
    {
        $response = $this->from('/connexion')->post('/connexion', [
            'email' => 'inconnu@example.com',
            'password' => 'WrongPassword123',
        ]);

        $response->assertRedirect('/connexion');
        $response->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
