<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('publications')->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $categorie = Categorie::create(
            $request->only('nom', 'slug')
        );

        return redirect()
            ->route('categories.index')
            ->with('succes', 'Catégorie créée avec succès.');
    }

    public function edit(Categorie $category)
    {
        return view('categories.edit', [
            'categorie' => $category
        ]);
    }

    public function update(Request $request, Categorie $category)
    {
        $category->update($request->only('nom', 'slug'));

        return redirect()
            ->route('categories.index')
            ->with('succes', 'Catégorie modifiée avec succès.');
    }

   
public function destroy(Categorie $category)
{
    if ($category->publications()->exists()) {
        return redirect()
            ->route('categories.index')
            ->with('erreur', 'Impossible de supprimer cette catégorie : elle contient encore des publications.');
    }

    $category->delete();

    return redirect()
        ->route('categories.index')
        ->with('succes', 'Catégorie supprimée avec succès.');
}

}


