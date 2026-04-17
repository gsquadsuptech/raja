<li style="{{ isset($current) ? 'background-color: aqua;' : '' }}">
    <a onclick="location.href='{{ route('consultations.edit', [$cons->id]) }}'" href="{{ route('consultations.edit', [$cons->id]) }}" class="md-list-content liste_consultations">
        @if($cons->nom_statut)
            <span class="uk-badge uk-badge-primary">{{ $cons->nom_statut }}</span>
        @endif
        <span id="date_consultation_text" class="md-list-heading uk-text-truncate">{{ $cons->date_consultation }}</span>
        <span class="uk-text-small uk-text-muted">{{ $cons->nom_medecin }}</span>
    </a>
</li>