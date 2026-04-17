@extends('layouts.app')

@section('after_scripts')

    <script src="{{ asset('dist/assets/js/pages/page_invoices.js') }}"></script>

    <script>
        setTimeout(function () {
            $('#invoice_add').trigger('click');
        }, 300);
    </script>

@endsection

@section('content')

    <div class="uk-width-medium-8-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-7-10">
                <div class="md-card md-card-single main-print" id="invoice">
                    <div id="invoice_preview"></div>
                    <div id="invoice_form"></div>
                </div>
            </div>
            <div class="uk-width-large-3-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <div class="md-list-outside-inner">
                        <ul class="md-list md-list-outside invoices_list" >

                            <li class="heading_list">Consultations</li>

                            <li>
                                <a href="javascript:void(0)" class="md-list-content liste_consultations">
                                    <span class="uk-badge uk-badge-primary">RDV</span>
                                    <span id="date_consultation_text" class="md-list-heading uk-text-truncate">Nouvelle consultation</span>
                                </a>
                            </li>

                            @if(isset($patient) && liste_consultations($patient->id))
                                @foreach(liste_consultations($patient->id) as $key => $consultation_l)
                                    @include('pages.consultations.liste_consultations', ['cons' => $consultation_l])
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper" style="top: 75px;">
        <a class="md-fab md-fab-default md-fab-wave-light" href="{{ isset($patient) ? route('patients.edit', [$patient->id]) : route('consultations.index') }}" id="Retour">
            <i class="material-icons">&#xe166;</i>
        </a>
    </div>

    <div class="md-fab-wrapper" style="display: none;">
        <a class="md-fab md-fab-accent md-fab-wave-light" href="#" id="invoice_add">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>

    @isset($patient)
        @include('pages.consultations.boutons_actions', ['p_id' => $patient->id, 'hide' => 'hide'])
    @else
        @include('pages.consultations.boutons_actions', ['hide' => 'hide'])
    @endisset

    <div id="invoice_form_template" style="display: none;">
        {{ Form::open(['route' => 'consultations.store']) }}
            <div class="md-card-toolbar">
                <div class="md-card-toolbar-actions" style="padding-top: 0">
                    <button type="submit" class="md-btn md-btn-flat">
                        <i class="md-icon material-icons">&#xE161;</i>
                    </button>
                </div>
                @isset($patient)
                    {{ Form::hidden('patient_id', $patient->id) }}
                    <input title="Nom du patient" class="md-card-toolbar-input" type="text" value="{{ $patient->nom_complet }}" readonly />
                @else
                    <p>
                        NOUVELLE CONSULTATION
                    </p>
                @endisset
            </div>
            <div class="md-card-content large-padding">
                @isset($patient)
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">

                            {{ Form::label('code_statut', 'Statut *') }}
                            {{ Form::select('code_statut', ['RDV' => 'Rendez-vous', 'ATT' => 'Ajouté à la file d\'attente', 'ENC' => 'En cours'], 'RDV',
                            array( 'class'=>'md-input'.($errors->has('code_statut') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('code_statut', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}

                        </div>
                    </div>
                @else
                    {{ Form::hidden('from_consultation','true') }}
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">

                            {{ Form::label('code_statut', 'Statut *') }}
                            {{ Form::select('code_statut', ['RDV' => 'Rendez-vous', 'ATT' => 'Ajouté à la file d\'attente'], 'RDV',
                            array('class'=>'md-input'.($errors->has('code_statut') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('code_statut', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}

                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">

                            {{ Form::label('patient_id', 'Patient *') }}
                            {{ Form::select('patient_id', $liste_patients, old('patient_id'),
                            array('class'=>'md-input'.($errors->has('patient_id') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('patient_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}

                        </div>
                    </div>
                @endisset
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">

                        {{ Form::label('date_consultation', 'Date de consultation *') }}
                        {{ Form::text('date_consultation', \Carbon\Carbon::now()->format('d/m/Y H:i'),
                        array('placeholder'=>'Date de consultation','style'=>'width:100%; margin-top:5px',
                        'data-uk-datepicker'=>"{format:'DD/MM/YYYY HH:mm'}",
                        'id'=>'date_consultation','class'=>'label-fixed md-input'.($errors->has('date_consultation') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('date_consultation', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}

                    </div>
                </div>
            </div>
        {{ Form::close() }}
    </div>

@endsection