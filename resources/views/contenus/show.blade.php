
@extends('layouts.app')

@section('titre', $publication->titre)

@section('contenu')

    <h1>{{ $publication->titre }}</h1>

    <div class="carte">

        <p>{{ $publication->contenu }}</p>
        @if ($publication->image)
    <div>
        <h3>Image de la publication</h3>
        <img
            src="{{ Storage::url($publication->image) }}"
            alt="Image de {{ $publication->titre }}"
            style="max-width: 100%; height: auto; border-radius: 10px;"
        >
    </div>
@endif

@if ($publication->fichier_media)
    <div>
        <h3>Fichier média</h3>

        @if ($publication->type_media === 'audio')
            <audio controls>
                <source src="{{ Storage::url($publication->fichier_media) }}">
                Votre navigateur ne supporte pas la lecture audio.
            </audio>

        @elseif ($publication->type_media === 'video')
            <video controls style="max-width: 100%;">
                <source src="{{ Storage::url($publication->fichier_media) }}">
                Votre navigateur ne supporte pas la lecture vidéo.
            </video>
        @endif
    </div>
@endif

        <p>
            <strong>Catégorie :</strong>
            {{ $publication->categorie->nom ?? 'Sans catégorie' }}
        </p>

        <p>
            <strong>Auteur :</strong>
            {{ $publication->auteur->name ?? 'Auteur inconnu' }}
        </p>

    </div>

    <h2>Commentaires</h2>

    @forelse ($publication->commentaires as $commentaire)

        <div class="carte">
            <p>{{ $commentaire->contenu }}</p>

            <p>
                <strong>Auteur :</strong>
                {{ $commentaire->auteur->name ?? 'Auteur inconnu' }}
            </p>
        </div>

    @empty
        <p>Aucun commentaire pour cette publication.</p>
    @endforelse

    <a href="{{ route('contenus.index') }}">Retour aux contenus</a>

@endsection
