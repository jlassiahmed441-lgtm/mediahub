@extends('layouts.app')

@section('titre', 'Connexion')

@section('contenu')

    <h1>Se connecter</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $erreur)
                <p style="color: red;">{{ $erreur }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('connexion.authenticate') }}" method="POST">
        @csrf

        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Se connecter</button>
    </form>

    <p>Pas encore de compte ?
        <a href="{{ route('inscription') }}">Créer un compte</a>
    </p>

@endsection
