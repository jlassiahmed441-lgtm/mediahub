<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Categorie;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Models\User;

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
    $contenu->update($request->validated());

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






