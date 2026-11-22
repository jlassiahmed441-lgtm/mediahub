
@extends('layouts.app')

@section('titre', 'Liste des catégories')

@section('contenu')

    <h1>Liste des catégories</h1>

    <a href="{{ route('categories.create') }}">
        Ajouter une catégorie
    </a>

    @forelse ($categories as $categorie)

        <div class="carte">

            <h2>{{ $categorie->nom }}</h2>

            <p>
                Nombre de publications :
                {{ $categorie->publications_count }}
            </p>

            <a href="{{ route('categories.edit', $categorie->id) }}">
                Modifier
            </a>

            <form
                action="{{ route('categories.destroy', $categorie->id) }}"
                method="POST"
                style="display:inline;"
                onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit">Supprimer</button>
            </form>

        </div>

    @empty

        <p>Aucune catégorie disponible.</p>

    @endforelse

@endsection
