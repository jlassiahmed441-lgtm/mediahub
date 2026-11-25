
@extends('layouts.app')

@section('titre', 'Ajouter une catégorie')

@section('contenu')

    <h1>Ajouter une catégorie</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom"
                   value="{{ old('nom') }}" required>

            @error('nom')
                <span class="erreur-champ">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="slug">Slug :</label>
            <input type="text" name="slug" id="slug"
                   value="{{ old('slug') }}" required>

            @error('slug')
    <span class="erreur-champ">{{ $message }}</span>
@enderror
        </div>

        <button type="submit">Ajouter la catégorie</button>
    </form>

@endsection
