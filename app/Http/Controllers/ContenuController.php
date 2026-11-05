<?php

namespace App\Http\Controllers;

class ContenuController extends Controller
{
    public function index()
    {
        return 'Liste des contenus multimédias';
    }

  public function show($id)
{
    return 'Détail du contenu numéro ' . $id;
}
}

