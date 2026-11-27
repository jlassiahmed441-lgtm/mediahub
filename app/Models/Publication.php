<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Publication extends Model
{
    use HasFactory, SoftDeletes;
    protected static function booted(): void
{
    static::deleting(function (Publication $publication) {

        // Supprimer l'image
        if ($publication->image) {
            Storage::disk('public')->delete($publication->image);
        }

        // Supprimer le fichier audio ou vidéo
        if ($publication->fichier_media) {
            Storage::disk('public')->delete($publication->fichier_media);
        }

    });
}

    protected $fillable = [
    'titre',
    'contenu',
    'categorie_id',
    'user_id',
    'image',
    'fichier_media',
    'type_media',
    ];

    // Une publication appartient à une catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    // Une publication appartient à un auteur
public function auteur()
{
    return $this->belongsTo(User::class, 'user_id');
}
// Une publication possède plusieurs commentaires
public function commentaires()
{
    return $this->hasMany(Commentaire::class);
}
}


