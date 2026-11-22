@extends('layouts.app')

@section('titre', 'Contenus')

@section('contenu')

    <h1>Contenus multimédias</h1>

    @php
        $compteur = 0;
    @endphp

    @forelse ($publications as $publication)

        <x-carte :titre="$publication->titre" :vedette="$compteur === 0">

            <p>{{ $publication->contenu }}</p>

            <p>
                <strong>Catégorie :</strong>
                {{ $publication->categorie->nom ?? 'Sans catégorie' }}
            </p>

            <p>
                <strong>Auteur :</strong>
                {{ $publication->auteur->name ?? 'Auteur inconnu' }}
            </p>
            <a href="{{ route('contenus.show', $publication->id) }}">
                    Voir les détails
            </a>

        </x-carte>

        @php
            $compteur++;
        @endphp

    @empty
        <p>Aucune publication disponible pour le moment.</p>
    @endforelse

    {{ $publications->links() }}

@endsection

