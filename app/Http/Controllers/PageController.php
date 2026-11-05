<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function accueil()
    {
        return 'Accueil de MediaHub';
    }

    public function aPropos()
    {
        return 'A propos de MediaHub';
    }
}

