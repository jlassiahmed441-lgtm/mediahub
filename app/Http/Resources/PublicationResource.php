<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PublicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'contenu' => $this->contenu,

            'categorie' => $this->categorie
                ? $this->categorie->nom
                : null,

            'auteur' => $this->auteur
                ? $this->auteur->name
                : null,

            'image' => $this->image
                ? Storage::url($this->image)
                : null,

            'type_media' => $this->type_media,

            'publie_le' => $this->created_at
                ? $this->created_at->toDateString()
                : null,
        ];
    }
}

