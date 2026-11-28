<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Http\Resources\PublicationResource;
use Illuminate\Http\Request;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    // Afficher la liste des publications
    public function index()
    {
        $publications = Publication::with(['categorie', 'auteur'])
            ->latest()
            ->paginate(10);

        return PublicationResource::collection($publications);
    }

    // Afficher une publication
    public function show(Publication $publication)
    {
        return new PublicationResource(
            $publication->load(['categorie', 'auteur'])
        );
    }

    // Créer une publication
    public function store(StorePublicationRequest $request)
{
    $donnees = $request->validated();

    // Associer la publication à l'utilisateur connecté
    $donnees['user_id'] = auth()->id();

    // Enregistrer l'image
    if ($request->hasFile('image')) {
        $donnees['image'] = $request->file('image')
            ->store('publications', 'public');
    }

    // Enregistrer le fichier audio ou vidéo
    if ($request->hasFile('fichier_media')) {
        $fichier = $request->file('fichier_media');

        $donnees['fichier_media'] = $fichier
            ->store('medias', 'public');

        $donnees['type_media'] =
            str_starts_with($fichier->getMimeType(), 'audio')
                ? 'audio'
                : 'video';
    }

    $publication = Publication::create($donnees);

    return (new PublicationResource(
        $publication->load(['categorie', 'auteur'])
    ))->response()->setStatusCode(201);
}

    // Modifier une publication
public function update(UpdatePublicationRequest $request, Publication $publication)
{
    // Vérifier les autorisations
    $this->authorize('update', $publication);

    $donnees = $request->validated();

    // Remplacer l'image si une nouvelle image est envoyée
    if ($request->hasFile('image')) {
        if ($publication->image) {
            Storage::disk('public')->delete($publication->image);
        }

        $donnees['image'] = $request->file('image')
            ->store('publications', 'public');
    }

    // Remplacer le fichier audio ou vidéo
    if ($request->hasFile('fichier_media')) {
        if ($publication->fichier_media) {
            Storage::disk('public')->delete($publication->fichier_media);
        }

        $fichier = $request->file('fichier_media');

        $donnees['fichier_media'] = $fichier
            ->store('medias', 'public');

        $donnees['type_media'] =
            str_starts_with($fichier->getMimeType(), 'audio')
                ? 'audio'
                : 'video';
    }

    $publication->update($donnees);

    return new PublicationResource(
        $publication->load(['categorie', 'auteur'])
    );
}

// Supprimer une publication
public function destroy(Publication $publication)
{
    // Vérifier les autorisations
    $this->authorize('delete', $publication);

    $publication->delete();

    return response()->json([
        'message' => 'Publication supprimée avec succès.'
    ]);
}
}