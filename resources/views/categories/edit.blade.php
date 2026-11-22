@extends('layouts.app')

@section('titre', 'Modifier une catégorie')

@section('contenu')

    <h1>Modifier une catégorie</h1>

    <form action="{{ route('categories.update', $categorie->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom de la catégorie :</label>
            <input
                type="text"
                id="nom"
                name="nom"
                value="{{ old('nom', $categorie->nom) }}"
                required
            >
        </div>

        <div>
            <label for="slug">Slug :</label>
            <input
                type="text"
                id="slug"
                name="slug"
                value="{{ old('slug', $categorie->slug) }}"
                required
            >
        </div>

        <button type="submit">Enregistrer les modifications</button>

    </form>

@endsection
