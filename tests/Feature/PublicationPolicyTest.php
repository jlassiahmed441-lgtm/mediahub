<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Categorie;
use App\Models\Publication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicationPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_author_can_update_own_publication(): void
    {
        $auteur = User::factory()->create([
            'role' => 'auteur',
        ]);

        $categorie = Categorie::create([
            'nom' => 'Podcast',
            'slug' => 'podcast',
        ]);

        $publication = Publication::factory()->create([
            'user_id' => $auteur->id,
            'categorie_id' => $categorie->id,
        ]);

        $response = $this->actingAs($auteur)->put(
            '/contenus/' . $publication->id,
            [
                'titre' => 'Mon titre modifie',
                'contenu' => 'Voici un contenu suffisamment long pour passer la validation.',
                'categorie_id' => $categorie->id,
            ]
        );

        $response->assertRedirect('/contenus/' . $publication->id);

        $this->assertDatabaseHas('publications', [
            'id' => $publication->id,
            'titre' => 'Mon titre modifie',
        ]);
    }
}
