<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Categorie;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ContenuController extends Controller
{
    public function index($tri = 'recent')
    {
        $publications = Publication::with(['categorie', 'auteur'])
            ->latest()
            ->paginate(9);

        return view('contenus.index', [
            'publications' => $publications,
            'tri' => $tri
        ]);
    }

    public function show(Publication $contenu)
    {
        $contenu->load([
            'categorie',
            'auteur',
            'commentaires.auteur'
        ]);

        return view('contenus.show', [
            'publication' => $contenu
        ]);
    }

    public function create()
    {
        $categories = Categorie::all();

        return view('contenus.create', compact('categories'));
    }

    
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

        // Déterminer le type du média
        $donnees['type_media'] =
            str_starts_with($fichier->getMimeType(), 'audio')
                ? 'audio'
                : 'video';
    }

    $publication = Publication::create($donnees);

    return redirect()
        ->route('contenus.show', $publication)
        ->with('succes', 'Publication créée avec succès.');
}

    public function edit(Publication $contenu)
{
    $this->authorize('update', $contenu);
    $categories = Categorie::all();

    return view('contenus.edit', [
        'publication' => $contenu,
        'categories' => $categories
    ]);
}


public function update(UpdatePublicationRequest $request, Publication $contenu)
{
    $this->authorize('update', $contenu);

    $donnees = $request->validated();

    // Remplacer l'image si une nouvelle image est envoyée
    if ($request->hasFile('image')) {

        if ($contenu->image) {
            Storage::disk('public')->delete($contenu->image);
        }

        $donnees['image'] = $request->file('image')
            ->store('publications', 'public');
    }

    // Remplacer le fichier audio ou vidéo
    if ($request->hasFile('fichier_media')) {

        if ($contenu->fichier_media) {
            Storage::disk('public')->delete($contenu->fichier_media);
        }

        $fichier = $request->file('fichier_media');

        $donnees['fichier_media'] = $fichier
            ->store('medias', 'public');

        $donnees['type_media'] =
            str_starts_with($fichier->getMimeType(), 'audio')
                ? 'audio'
                : 'video';
    }

    $contenu->update($donnees);

    return redirect()
        ->route('contenus.show', $contenu)
        ->with('succes', 'Publication modifiée avec succès.');
}


public function destroy(Publication $contenu)
{
    $this->authorize('delete', $contenu);
    $contenu->delete();

    return redirect()
        ->route('contenus.index')
        ->with('succes', 'Publication supprimée avec succès.');
}
}






