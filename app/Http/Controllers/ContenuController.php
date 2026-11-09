<?php

namespace App\Http\Controllers;

class ContenuController extends Controller
{
    public function index($tri = 'recent')
    {
        $contenus = [
            (object) [
                'titre' => 'Court-métrage documentaire',
                'description' => 'Un aperçu de la vie urbaine.'
            ],
            (object) [
                'titre' => 'Podcast technologie',
                'description' => 'Actualités du développement web.'
            ],
        ];

        return view('contenus.index', [
            'contenus' => $contenus,
            'tri' => $tri
        ]);
    }

    public function show($id)
    {
        return 'Détail du contenu numéro ' . $id;
    }
}


