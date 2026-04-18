{{ Form::model($ordonnance, ['route' => ['ordonnances.update', $ordonnance], 'method' => 'put']) }}

@if(request()->has('statut'))
    <div class="md-card-toolbar">
        <div class="md-card-toolbar-actions" style="padding-top: 0">
            <button type="submit" class="md-btn md-btn-flat">
                <i class="md-icon material-icons">&#xE161;</i>
            </button>
        </div>
        {{ Form::hidden('consultation_id', $ordonnance->consultation_id) }}
        <input title="Nom du patient" class="md-card-toolbar-input" type="text" value="{{ $ordonnance->consultation->patient->nom_complet ?? '' }}" readonly />
    </div>
    <div class="md-card-content large-padding">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">

                <h3>Contenu de l'ordonnance *</h3>
                {{ Form::textarea('contenu', old('contenu'),
                array('id'=>'contenu','class'=>'contenu label-fixed md-input'.($errors->has('contenu') ? ' md-input-danger' : ''))) }}
                {!! $errors->first('contenu', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}

            </div>
        </div>
    </div>
@else


    <style>
        .blue-logo {
            color: #25366e;
        }
        @media print {
            .blue-logo {
                color: #25366e !important;
            }
        }
    </style>
    <div class="md-card-toolbar hidden-print">
        <div class="md-card-toolbar-actions hidden-print" style="padding-top: 0">
            {{--<i class="md-icon material-icons" id="invoice_print">&#xE8ad;</i>--}}
            <a href="javascript:void(0)" id="invoice_print" class="md-btn md-btn-flat">
                <i class="md-icon material-icons">&#xE8ad;</i>
            </a>
            <a href="{{ route('ordonnances.edit', [$ordonnance->id, 'statut' => 'edit']) }}" class="md-btn md-btn-flat">
                <i class="md-icon material-icons">&#xe3c9;</i>
            </a>
        </div>
        <input title="Nom du patient" class="md-card-toolbar-input" type="text" value="{{ $ordonnance->consultation->patient->nom_complet }}" readonly />
    </div>
    <div class="md-card-content large-padding">

        <div class="invoice_header" style="border-bottom: 1px solid rgba(0, 0, 0, 0.12); height: unset; padding: 4px; padding-top: 30px">
            <div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
                <div class="uk-width-1-1">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                            <img src="{{ asset('images/logo_rabia.jpg') }}"  alt="" style="width: 300px; float: right;">

                            <h3 class="blue-logo" style="margin: 0; font-weight: 600;">CABINET MEDICAL RABIA</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-grid">
            <div class="uk-width-1-2 uk-text-left uk-text-large">
                {{ $ordonnance->consultation->patient->nom_age ?? '' }}
            </div>
            <div class="uk-width-1-2 uk-text-right uk-text-large">
                {{ $ordonnance->date_ordonnance }}
            </div>
        </div>

        <div class="uk-grid">
            <div class="uk-width-1-1">
                <h3 class="uk-text-center">ORDONNANCE</h3>
                <h3>{!! $ordonnance->contenu !!}</h3>
            </div>
        </div>
    </div>
    <style>
        @media print{
            .invoice_header{
                margin-top: -40px;
            }
        }
    </style>

@endif
{{ Form::close() }}