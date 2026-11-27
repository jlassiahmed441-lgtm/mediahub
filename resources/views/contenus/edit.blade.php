@extends('layouts.app')

@section('titre', 'Modifier une publication')

@section('contenu')

    <h1>Modifier une publication</h1>

    <form action="{{ route('contenus.update', $publication) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre"
                   value="{{ old('titre', $publication->titre) }}" required>
        </div>

        <div>
            <label for="contenu">Contenu :</label>
            <textarea name="contenu" id="contenu" required>{{ old('contenu', $publication->contenu) }}</textarea>
        </div>

        <div>
            <label for="categorie_id">Catégorie :</label>

            <select name="categorie_id" id="categorie_id" required>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}"
                        {{ old('categorie_id', $publication->categorie_id) == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Enregistrer les modifications</button>
        {{-- Image actuelle --}}
@if ($publication->image)
    <div>
        <p>Image actuelle :</p>
        <img src="{{ Storage::url($publication->image) }}"
             alt="Image actuelle"
             style="max-width: 200px;">
    </div>
@endif

<div>
    <label for="image">Remplacer l'image :</label>
    <input type="file" name="image" id="image" accept="image/*">
    @error('image')
        <span class="erreur-champ">{{ $message }}</span>
    @enderror
</div>

{{-- Média actuel --}}
@if ($publication->fichier_media)
    <p>Média actuel : {{ $publication->type_media }}</p>
@endif

<div>
    <label for="fichier_media">Remplacer le fichier audio ou vidéo :</label>
    <input type="file" name="fichier_media" id="fichier_media"
           accept="audio/*,video/*">
    @error('fichier_media')
        <span class="erreur-champ">{{ $message }}</span>
    @enderror
</div>

    </form>

@endsection