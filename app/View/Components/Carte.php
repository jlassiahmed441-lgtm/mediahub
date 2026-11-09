<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Carte extends Component
{
    public string $titre;
    public bool $vedette;

   public function __construct(string $titre, bool $vedette = false)
{
   

    $this->titre = $titre;
    $this->vedette = $vedette;
}

public function render(): View|Closure|string
{
    return view('components.carte');
}
}
