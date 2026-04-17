@unless(isset($hide))
@if(isset($c_id) || isset($p_id))
<div class="md-fab-wrapper md-fab-in-card md-fab-speed-dial" data-fab-hover>
    <div class="md-fab-wrapper-small">
        @isset($c_id)
        <a class="md-fab md-fab-small md-fab-warning"
           data-uk-tooltip="Terminer la consultation" title="Terminer la consultation"
           href="{{ route('consultations.terminer', [$c_id]) }}"><i class="material-icons">&#xe876;</i></a>
        <a class="md-fab md-fab-small md-fab-danger"
           data-uk-tooltip="Ajouter une ordonnance" title="Ajouter une ordonnance"
           href="{{ route('ordonnances.create', [$c_id]) }}"><i class="material-icons">&#xe065;</i></a>
        <a class="md-fab md-fab-small md-fab-danger"
           data-uk-tooltip="Ajouter un Examen" title="Ajouter un Examen"
           href="{{ route('examens.create', [$c_id]) }}"><i class="material-icons">&#xe84e;</i></a>
        @endisset
        @isset($p_id)
        <a class="md-fab md-fab-small md-fab-success"
           data-uk-tooltip="Programmer un rendez-vous" title="Programmer un rendez-vous"
           href="{{ route('consultations.create', [$p_id]) }}"><i class="material-icons">&#xe855;</i></a>
        @endisset
    </div>
    <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xe896;</i></a>
</div>
@endif
@endunless