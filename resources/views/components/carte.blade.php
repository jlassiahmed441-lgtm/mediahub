@props(['titre', 'vedette' => false])

<div class="carte {{ $vedette ? 'carte-vedette' : '' }}">
   

    <h2>{{ $titre }}</h2>

    <div class="carte-corps">
        {{ $slot }}
    </div>

    @if ($vedette)
        <span>⭐ Contenu vedette</span>
    @endif
</div>