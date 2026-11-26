<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Publication;

class PublicationPolicy
{
    // Vérifier si l'utilisateur peut modifier la publication
    public function update(User $user, Publication $publication): bool
    {
        return $user->role === 'admin'
            || $user->id === (int) $publication->user_id;
    }

    // Vérifier si l'utilisateur peut supprimer la publication
    public function delete(User $user, Publication $publication): bool
    {
        return $user->role === 'admin'
            || $user->id === (int) $publication->user_id;
    }
}


