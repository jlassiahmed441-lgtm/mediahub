<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Categorie;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $publication = Publication::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'categorie_id' => $request->categorie_id,
            'user_id' => 1
        ]);

        return redirect()
            ->route('contenus.show', $publication)
            ->with('succes', 'Publication créée avec succès.');
    }
    public function edit(Publication $contenu)
{
    $categories = Categorie::all();

    return view('contenus.edit', [
        'publication' => $contenu,
        'categories' => $categories
    ]);
}

public function update(Request $request, Publication $contenu)
{
    $contenu->update([
        'titre' => $request->titre,
        'contenu' => $request->contenu,
        'categorie_id' => $request->categorie_id
    ]);

    return redirect()
        ->route('contenus.show', $contenu)
        ->with('succes', 'Publication modifiée avec succès.');
}

public function destroy(Publication $contenu)
{
    $contenu->delete();

    return redirect()
        ->route('contenus.index')
        ->with('succes', 'Publication supprimée avec succès.');
}
}






