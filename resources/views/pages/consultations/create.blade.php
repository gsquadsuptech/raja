@extends('layouts.app')

@section('after_scripts')

    <link rel="stylesheet" href="{{ asset('dist/bower_components/kendo-ui/styles/kendo.common-material.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dist/bower_components/kendo-ui/styles/kendo.material.min.css') }}" id="kendoCSS"/>

    <!-- kendo UI -->
    <script src="{{ asset('dist/assets/js/kendoui_custom.min.js') }}"></script>

    <script>
        $('#date_consultation').kendoDateTimePicker({
            format: "dd/MM/yyyy HH:mm",
            interval: 30
        });
    </script>

    <!-- page specific plugins -->
    <!-- handlebars.js -->
    <script src="{{ asset('dist/bower_components/handlebars/handlebars.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/custom/handlebars_helpers.min.js') }}"></script>
    <!-- instafilta -->
    <script src="{{ asset('dist/assets/js/custom/instafilta.min.js') }}"></script>

    <!--  invoices functions -->
    <script src="{{ asset('dist/assets/js/pages/page_invoices.js') }}"></script>

    <script>
        $('.liste_consultations').click(function(e){

            var date_consultation = $(this).children('#date_consultation_text').text();

            setTimeout(function () {
                $('#date_cons').html(date_consultation).trigger("change");
                console.log(date_consultation);
            }, 500);

        });
    </script>

@endsection

@section('content')

    {{ Form::open(array('route' => 'consultations.store')) }}

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
                    <div class="md-list-outside-search">
                        <input type="text" class="md-input inverted-colors" placeholder="Recherche (consultation, examen, ...)" id="invoice-filtering"/>
                    </div>
                    <div class="md-list-outside-inner">
                        <ul class="md-list md-list-outside invoices_list" id="invoices_list">

                            <li class="heading_list">Consultations</li>

                            @if(isset($liste_consultations))
                                @foreach($liste_consultations as $key => $consultation)
                                    <li>
                                        <a href="#" class="md-list-content liste_consultations" data-invoice-id="{{$key}}">
                                            @if($consultation->nom_statut)
                                            <span class="uk-badge uk-badge-primary">{{ $consultation->nom_statut }}</span>
                                            @endif
                                            <span id="date_consultation_text" class="md-list-heading uk-text-truncate">{{ $consultation->date_consultation }}</span>
                                            <span class="uk-text-small uk-text-muted">{{ $consultation->nom_medecin }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                            <li class="heading_list">Examens</li>
                            <li class="heading_list">Ordonnances</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper" style="top: 75px;">
        <a class="md-fab md-fab-default md-fab-wave-light" href="{{ route('patients.edit', [$patient]) }}" id="Retour">
            <i class="material-icons">&#xe166;</i>
        </a>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent md-fab-wave-light" href="#" id="invoice_add">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>

    {{ Form::close() }}

    <div id="invoice_form_template" style="display: none;">
        <form action="" class="uk-form-stacked">
            <div class="md-card-toolbar">
                <div class="md-card-toolbar-actions" style="padding-top: 0">
                    <button type="submit" class="md-btn md-btn-flat">
                        <i class="md-icon material-icons">&#xE161;</i>
                    </button>
                </div>
                <input title="Nom du patient" class="md-card-toolbar-input" type="text" value="{{ $patient->nom_complet }}" readonly />
            </div>
            <div class="md-card-content large-padding">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">

                        {{ Form::label('date_consultation', 'Date de consultation *') }}
                        {{ Form::text('date_consultation', $consultation->date_consultation ?? \Carbon\Carbon::now()->format('d/m/Y H:i'),
                        array('placeholder'=>'Date de consultation','style'=>'width:100%; margin-top:5px',
                        'data-uk-datepicker'=>"{format:'DD/MM/YYYY HH:mm'}",
                        'id'=>'date_consultation','class'=>'label-fixed md-input'.($errors->has('date_consultation') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('date_consultation', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}

                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="invoice_template" style="display: none">
        <div class="md-card-toolbar hidden-print">
            <div class="md-card-toolbar-actions hidden-print">
                <i class="md-icon material-icons" id="invoice_print">&#xE8ad;</i>
                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}">
                    <i class="md-icon material-icons">&#xE5D4;</i>
                    <div class="uk-dropdown uk-dropdown-small">
                        <ul class="uk-nav">
                            <li><a href="#">Archive</a></li>
                            <li><a href="#" class="uk-text-danger">Remove</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <input title="Nom du patient" class="md-card-toolbar-input" type="text" value="{{ $patient->nom_complet }}" readonly />
        </div>
        <div class="md-card-content invoice_content print_bg invoice_footer_active">
            <div class="uk-margin-medium-bottom">
                <h3 class="heading_a uk-margin-bottom">Consultation  </h3>
                <span class="uk-text-muted uk-text-small uk-text-italic">Date: <span id="date_cons"></span></span>
            </div>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-2">
                    {{ Form::label('prenom', 'Prénom(s)') }}
                    {{ Form::text('prenom', $patient->prenom,array('readonly','style'=>'','class'=>' md-input'.($errors->has('prenom') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('prenom', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
                <div class="uk-width-medium-1-2">
                    {{ Form::label('nom', 'Nom') }}
                    {{ Form::text('nom', $patient->nom,array('readonly','style'=>'','class'=>' md-input'.($errors->has('nom') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('nom', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
            </div>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-3">
                    {{ Form::label('sexe', 'Sexe') }}
                    {{ Form::text('sexe', $patient->sexe=='M'?'Masculin':'Féminin',array('readonly','style'=>'','class'=>' md-input'.($errors->has('sexe') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('sexe', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
                <div class="uk-width-medium-1-3">
                    {{ Form::label('date_naissance', 'Date de naissance') }}
                    {{ Form::text('date_naissance', $patient->date_naissance,array('readonly','style'=>'','class'=>' md-input'.($errors->has('date_naissance') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('date_naissance', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
                <div class="uk-width-medium-1-3">
                    {{ Form::label('email', 'Adresse email') }}
                    {{ Form::text('email', $patient->email,array('readonly','style'=>'','class'=>' md-input'.($errors->has('email') ? ' md-input-danger' : ''))) }}
                    {!! $errors->first('email', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                </div>
            </div>
        </div>
    </div>

@endsection