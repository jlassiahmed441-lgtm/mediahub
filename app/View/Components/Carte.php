<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Carte extends Component
{
    public string $titre;

    public function __construct(string $titre)
    {
        $this->titre = $titre;
    }

    public function render(): View|Closure|string
    {
        return view('components.carte');
    }

}

