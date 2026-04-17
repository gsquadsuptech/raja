{{ Form::model($examen, array('route' => array('examens.update', $examen->id), 'method' => 'put', 'id' => 'examen_form')) }}


@if(request()->has('statut'))
    <div class="md-card-toolbar">
        <div class="md-card-toolbar-actions" style="padding-top: 0">
            <button type="submit" class="md-btn md-btn-flat">
                <i class="md-icon material-icons">&#xE161;</i>
            </button>
        </div>
        {{ Form::hidden('consultation_id', $examen->consultation_id) }}
        <input title="Nom du patient" class="md-card-toolbar-input" type="text" value="{{ $examen->consultation->patient->nom_complet ?? '' }}" readonly />
    </div>

    <div class="md-card-content large-padding">
        @if($examen->examen_modele_id == 6)
            @include('pages.examens.examen_stress_form',['action' => 'edit'])
        @else
            @include('pages.examens.examen_form',['action' => 'edit'])
        @endif
    </div>
@else
    <div class="md-card-toolbar hidden-print">
        <div class="md-card-toolbar-actions hidden-print" style="padding-top: 0">
            <a href="javascript:void(0)" id="invoice_print" class="md-btn md-btn-flat">
                <i class="md-icon material-icons">&#xE8ad;</i>
            </a>
            <a href="{{ route('examens.edit', [$examen->id, 'statut' => 'edit']) }}" class="md-btn md-btn-flat">
                <i class="md-icon material-icons">&#xe3c9;</i>
            </a>
        </div>
        <input title="Nom du patient" class="md-card-toolbar-input" type="text" value="{{ $examen->consultation->patient->nom_complet }}" readonly />
    </div>

    <div class="md-card-content large-padding" style="padding-bottom: 0;">
        @if($examen->examen_modele_id == 6)
            @include('pages.examens.examen_stress_form',['action' => 'show'])
        @else
            @include('pages.examens.examen_form',['action' => 'show'])
        @endif
    </div>

@endif

{{ Form::close() }}