{{ Form::model($consultation, ['route' => ['consultations.update', $consultation], 'method' => 'put', 'id' => 'update_cons']) }}

@if(request()->has('statut'))
    <div class="md-card-toolbar">
        <div class="md-card-toolbar-actions" style="padding-top: 0">
            <button type="submit"  class="md-btn md-btn-flat">
                <i class="md-icon material-icons">&#xE161;</i>
            </button>
        </div>
    </div>
@else
    <div class="md-card-toolbar hidden-print">
        <div class="md-card-toolbar-actions hidden-print" style="padding-top: 0">
            {{--<i class="md-icon material-icons" id="invoice_print">&#xE8ad;</i>--}}
            <a href="javascript:void(0)" id="invoice_print" class="md-btn md-btn-flat">
                <i class="md-icon material-icons">&#xE8ad;</i>
            </a>
            <a href="{{ route('consultations.edit', [$consultation->id, 'statut' => 'ENC']) }}" class="md-btn md-btn-flat">
                <i class="md-icon material-icons">&#xe3c9;</i>
            </a>
        </div>
        <input title="Nom du patient" class="md-card-toolbar-input" type="text" value="{{ $consultation->patient->nom_complet }}" readonly />
    </div>
@endif

<div class="md-card-content invoice_content print_bg invoice_footer_active">
    <div class="uk-margin-medium-bottom">
        <h3 class="heading_a uk-margin-bottom">Consultation  </h3>
        <span class="uk-text-muted uk-text-medium uk-text-italic">Date: <span id="date_cons"></span></span>
        <span class="uk-text-muted uk-text-medium uk-text-italic" style="float: right;">
            Statut : {{ $consultation->nom_statut }}
        </span>
    </div>

    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-1-2">
            <h3>Prénom(s)</h3>
            <p>{{ $consultation->patient->prenom }}</p>
        </div>
        <div class="uk-width-1-2">
            <h3>Nom</h3>
            <p>{{ $consultation->patient->nom }}</p>
        </div>
    </div>
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-1-3">
            <h3>Sexe</h3>
            <p>{{ $consultation->patient->sexe=='M' ? 'Masculin' : 'Féminin' }}</p>
        </div>
        <div class="uk-width-1-3">
            <h3>Date de naissance</h3>
            <p>{{ $consultation->patient->date_naissance ?? '' }}</p>
        </div>
        <div class="uk-width-1-3">
            <h3>Adresse email</h3>
            <p>{{ $consultation->patient->email ?? '' }}</p>
        </div>
    </div>

    @if(request()->has('statut'))
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">

                {{ Form::label('code_statut', 'Statut *') }}
                {{ Form::select('code_statut', ['RDV' => 'Rendez-vous', 'ATT' => 'Ajouté à la file d\'attente', 'ENC' => 'En cours'], old('code_statut'),
                array( 'class'=>'md-input'.($errors->has('code_statut') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('code_statut', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}

            </div>
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                <h3>Notes</h3>
                {{ Form::textarea('notes', old('notes'),array('rows'=>'6','class'=>'label-fixed md-input'.($errors->has('notes') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('notes', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
            </div>
        </div>
    @else


        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-1-1">
                <h3>Notes</h3>
                <p>{!! $consultation->notes ?? '' !!}</p>
            </div>
        </div>

    @endif
</div>

{{ Form::close() }}