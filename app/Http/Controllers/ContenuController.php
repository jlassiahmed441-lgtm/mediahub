<?php

namespace App\Http\Controllers;

use App\Models\Publication;

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

}




