<li>
    <a onclick="location.href='{{ route('ordonnances.edit', [$ordo->id]) }}'" href="{{ route('ordonnances.edit', [$ordo->id]) }}" class="md-list-content liste_consultations">
        <span id="date_consultation_text" class="md-list-heading uk-text-truncate">{{ $ordo->date_creation }}</span>
    </a>
</li>