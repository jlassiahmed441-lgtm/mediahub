<?php

namespace App\Http\Controllers;

class ContenuController extends Controller
{
    public function index($tri = 'recent')
{
    return 'Liste des contenus multimédias - Tri : ' . $tri;
}

  public function show($id)
{
    return 'Détail du contenu numéro ' . $id;
}
}

