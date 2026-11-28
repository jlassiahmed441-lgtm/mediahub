<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Categorie;
use App\Models\Publication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_publications(): void
    {
        $categorie = Categorie::create([
            'nom' => 'Podcast',
            'slug' => 'podcast',
        ]);

        Publication::factory()->count(5)->create([
            'categorie_id' => $categorie->id,
        ]);

        $response = $this->getJson('/api/publications');

        $response->assertOk();
        $response->assertJsonCount(5, 'data');
    }

    public function test_api_creation_requires_authentication(): void
    {
        $response = $this->postJson('/api/publications', [
            'titre' => 'Nouvelle publication',
            'contenu' => 'Voici un contenu suffisamment long pour la validation.',
            'categorie_id' => 1,
        ]);

        $response->assertUnauthorized();
    }
}

