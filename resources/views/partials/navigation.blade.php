<nav class="navigation">
    <a href="{{ route('accueil') }}">MediaHub</a>

    <a href="{{ route('contenus.index') }}">Contenus</a>

    <a href="{{ route('a-propos') }}">À propos</a>

    @guest
        <a href="{{ route('inscription') }}">Inscription</a>
        <a href="{{ route('connexion') }}">Connexion</a>
    @endguest

    @auth
        <span>Bonjour, {{ Auth::user()->name }}</span>

        <a href="{{ route('contenus.create') }}">Ajouter une publication</a>

        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}">Administration</a>
        @endif

        <form action="{{ route('deconnexion') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    @endauth
</nav>

