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

    <script src="{{ asset('dist/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('dist/bower_components/ckeditor/adapters/jquery.js') }}"></script>

    <script>

        setTimeout(function () {
            CKEDITOR.replace( 'notes' );
        }, 700);

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
                    {{--<div class="md-list-outside-search">--}}
                        {{--<input type="text" class="md-input inverted-colors" placeholder="Recherche (consultation, examen, ...)" id="invoice-filtering"/>--}}
                    {{--</div>--}}
                    <div class="md-list-outside-inner">
                        <ul class="md-list md-list-outside invoices_list" >

                            <li class="heading_list">Consultation sélectionnée</li>

                            <li style="background-color: aqua;">
                                <a href="{{ route('consultations.edit', [$consultation->id]) }}" class="md-list-content liste_consultations">
                                    @if($consultation->nom_statut)
                                        <span class="uk-badge uk-badge-primary">{{ $consultation->nom_statut }}</span>
                                    @endif
                                    <span id="date_consultation_text" class="md-list-heading uk-text-truncate">{{ $consultation->date_consultation }}</span>
                                    <span class="uk-text-small uk-text-muted">{{ $consultation->nom_medecin }}</span>
                                </a>
                            </li>

                            <li class="heading_list">Examens</li>

                            @if(isset($consultation) && liste_examens($consultation->id))
                                @foreach(liste_examens($consultation->id) as $key => $liste_examen)
                                    @include('pages.consultations.liste_examens', ['exam' => $liste_examen])
                                @endforeach
                            @endif

                            <li class="heading_list">Ordonnances</li>

                            @if(isset($consultation) && liste_ordonnances($consultation->id))
                                @foreach(liste_ordonnances($consultation->id) as $key => $ordonnance_l)
                                    @include('pages.consultations.liste_ordonnances', ['ordo' => $ordonnance_l])
                                @endforeach
                            @endif

                            @if(isset($consultation) && liste_consultations($consultation->patient_id, $consultation->id))
                                <li class="heading_list">Autres consultations</li>

                                @foreach(liste_consultations($consultation->patient_id, $consultation->id) as $key => $consultation_l)
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
        <a class="md-fab md-fab-default md-fab-wave-light" href="{{ route('patients.edit', [$consultation->patient_id]) }}" id="Retour">
            <i class="material-icons">&#xe166;</i>
        </a>
    </div>

    @include('pages.consultations.boutons_actions', ['c_id' => $consultation->id, 'p_id' => $consultation->patient_id])

    <div id="invoice_template" style="display: none">

        @include('pages.consultations.form_consultation')

    </div>

@endsection