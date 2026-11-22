<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
    ];

    // Une catégorie possède plusieurs publications
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}


