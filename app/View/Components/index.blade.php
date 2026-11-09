@extends('layouts.app')

@section('titre', 'Contenus')

@section('contenu')

    <h1>Contenus multimédias</h1>

    @php
        $compteur = 0;
    @endphp

    @forelse ($contenus as $contenu)

        <x-carte :titre="$contenu->titre" :vedette="$compteur === 0">
            <p>{{ $contenu->description }}</p>
        </x-carte>

        @php
            $compteur++;
        @endphp

    @empty
        <p>Aucun contenu disponible pour le moment.</p>
    @endforelse

@endsection