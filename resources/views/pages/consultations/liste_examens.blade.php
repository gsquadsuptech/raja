<li>
    <a onclick="location.href='{{ route('examens.edit', [$exam->id]) }}'" href="{{ route('examens.edit', [$exam->id]) }}" class="md-list-content liste_consultations">
        <span id="date_consultation_text" class="md-list-heading uk-text-truncate">{{ $exam->examen_modele->nom_examen ?? '' }}</span>
        <span class="uk-text-small uk-text-muted">{{ $exam->date_creation }}</span>
    </a>
</li>