# Rapport de qualité — MediaHub

## 1. Tests automatisés

Les tests automatisés ont été réalisés avec PHPUnit et Laravel.

- Base de données de test : SQLite en mémoire.
- Nombre total de tests : 8.
- Tests réussis : 8.
- Tests échoués : 0.
- Assertions réussies : 19.
- Taux de réussite : 100 %.

### Tests réalisés

- Test de création d'une catégorie par un administrateur.
- Test d'inscription d'un utilisateur.
- Test d'échec de connexion avec des identifiants incorrects.
- Test d'autorisation : un auteur peut modifier sa propre publication.
- Test de récupération des publications via l'API.
- Test de protection de création d'une publication par l'API.

## 2. Optimisation des requêtes SQL

Le problème N+1 a été traité dans `ContenuController`.

Les relations catégorie et auteur sont chargées à l'avance avec `with()` :

```php
Publication::with(['categorie', 'auteur'])
    ->withCount('commentaires')
    ->latest()
    ->paginate(9);
```

`withCount('commentaires')` permet de récupérer le nombre de commentaires sans charger toutes les relations commentaires.

## 3. Mise en cache

Les catégories sont mises en cache pendant une heure (3600 secondes).

Clé utilisée : `categories.liste`.

La méthode `Cache::remember()` permet de réutiliser les données en cache.

Le cache est invalidé après :
- La création d'une catégorie.
- La modification d'une catégorie.
- La suppression réussie d'une catégorie.

## 4. Conclusion

Les tests automatisés sont tous réussis. Les optimisations des requêtes et la mise en cache permettent d'améliorer les performances de l'application MediaHub.