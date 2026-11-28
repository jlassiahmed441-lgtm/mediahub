<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategorieTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_category(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->post('/categories', [
            'nom' => 'Podcast',
            'slug' => 'podcast',
        ]);

        $response->assertRedirect('/categories');

        $this->assertDatabaseHas('categories', [
            'nom' => 'Podcast',
            'slug' => 'podcast',
        ]);
    }
}
