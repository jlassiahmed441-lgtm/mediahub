
@extends('layouts.app')

@section('titre', 'Modifier une catégorie')

@section('contenu')

    <h1>Modifier une catégorie</h1>

    <form action="{{ route('categories.update', $categorie) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom"
                   value="{{ old('nom', $categorie->nom) }}" required>

            @error('nom')
                <span class="erreur-champ">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="slug">Slug :</label>
            <input type="text" name="slug" id="slug"
                   value="{{ old('slug', $categorie->slug) }}" required>

            
<div>
    <label for="slug">Slug :</label>
    <input type="text" name="slug" id="slug"
           value="{{ old('slug', $categorie->slug) }}" required>

    @error('slug')
        <span class="erreur-champ">{{ $message }}</span>
    @enderror
</div>


        <button type="submit">Enregistrer les modifications</button>
    </form>

@endsection





