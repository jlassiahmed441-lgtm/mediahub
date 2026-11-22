@extends('layouts.app')

@section('titre', $publication->titre)

@section('contenu')

    <h1>{{ $publication->titre }}</h1>

    <div class="carte">
        <p>{{ $publication->contenu }}</p>

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

