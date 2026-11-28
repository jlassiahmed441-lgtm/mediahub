# API REST - MediaHub

## 1. Présentation

L'API REST de MediaHub permet de consulter, créer, modifier et supprimer des publications multimédias.

**URL de base :**
`http://127.0.0.1:8000/api`

## 2. Authentification

L'API utilise Laravel Sanctum pour sécuriser les opérations de modification.

### Connexion

- **Méthode :** POST
- **URL :** `/connexion`

Données JSON :

```json
{
    "email": "ahmed@test.com",
    "password": "votre_mot_de_passe"
}
```

La réponse contient un token d'authentification.

Pour les routes protégées, ajouter cet en-tête :

`Authorization: Bearer VOTRE_TOKEN`

## 3. Routes publiques

| Méthode | URL | Description |
|---|---|---|
| GET | `/publications` | Liste des publications |
| GET | `/publications/{id}` | Détail d'une publication |

La liste des publications est paginée (10 publications par page).

## 4. Routes protégées

Ces routes nécessitent un token Sanctum valide.

| Méthode | URL | Description |
|---|---|---|
| POST | `/publications` | Ajouter une publication |
| PUT | `/publications/{id}` | Modifier une publication |
| DELETE | `/publications/{id}` | Supprimer une publication |

## 5. Données d'une publication

Les champs utilisés sont :

- `titre` : titre de la publication.
- `contenu` : contenu textuel.
- `categorie_id` : identifiant de la catégorie.
- `image` : image facultative.
- `fichier_media` : fichier audio ou vidéo facultatif.

Les fichiers sont envoyés avec une requête `multipart/form-data`.

## 6. Autorisations

Les règles d'accès sont définies dans `PublicationPolicy`.

- Un administrateur peut modifier ou supprimer toutes les publications.
- Un utilisateur peut modifier ou supprimer uniquement ses propres publications.
- Un utilisateur non authentifié ne peut pas accéder aux opérations protégées.

## 7. Codes HTTP

| Code | Signification |
|---|---|
| 200 | Requête réussie |
| 201 | Publication créée |
| 401 | Utilisateur non authentifié |
| 403 | Action non autorisée |
| 404 | Ressource introuvable |
| 422 | Erreur de validation |

## 8. Technologies utilisées

- Laravel 12
- PHP
- Laravel Sanctum
- API REST
- JSON