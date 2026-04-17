@extends('layouts.app')

@section('after_scripts')

    <!-- page specific plugins -->
    <!-- handlebars.js -->
    <script src="{{ asset('dist/bower_components/handlebars/handlebars.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/custom/handlebars_helpers.min.js') }}"></script>
    <!-- instafilta -->
    <script src="{{ asset('dist/assets/js/custom/instafilta.min.js') }}"></script>

    <!--  invoices functions -->
    <script src="{{ asset('dist/assets/js/pages/page_invoices.js') }}"></script>

    <script src="{{ asset('dist/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('dist/bower_components/ckeditor/adapters/jquery.js') }}"></script>

    <script>

        setTimeout(function () {
            CKEDITOR.replace( 'contenu' );
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
                    <div class="md-list-outside-inner">
                        <ul class="md-list md-list-outside invoices_list" >

                            <li class="heading_list">Ordonnances</li>

                            <li style="background-color: aqua;">
                                <a href="{{ route('ordonnances.edit', [$ordonnance->id]) }}" class="md-list-content liste_consultations">
                                    <span id="date_consultation_text" class="md-list-heading uk-text-truncate">{{ $ordonnance->date_creation}}</span>
                                </a>
                            </li>

                            @if(isset($ordonnance) && liste_ordonnances($ordonnance->consultation_id, $ordonnance->id))
                                @foreach(liste_ordonnances($ordonnance->consultation_id, $ordonnance->id) as $key => $ordonnance_l)
                                    @include('pages.consultations.liste_ordonnances', ['ordo' => $ordonnance_l])
                                @endforeach
                            @endif

                            <li class="heading_list">Consultation sélectionnée</li>

                            @if(isset($ordonnance->consultation) && liste_consultations($ordonnance->consultation->patient_id))
                                @foreach(liste_consultations($ordonnance->consultation->patient_id) as $key => $consultation_l)
                                    @if($consultation_l->id == $ordonnance->consultation_id)
                                        @include('pages.consultations.liste_consultations', ['cons' => $consultation_l, 'current' => 'current'])
                                    @endif
                                @endforeach
                            @endif

                            <li class="heading_list">Examens</li>

                            @if(isset($ordonnance->consultation) && liste_examens($ordonnance->consultation->id))
                                @foreach(liste_examens($ordonnance->consultation->id) as $key => $liste_examen)
                                    @include('pages.consultations.liste_examens', ['exam' => $liste_examen])
                                @endforeach
                            @endif

                            @if(isset($ordonnance->consultation) && liste_consultations($ordonnance->consultation->patient_id, $ordonnance->consultation_id))

                                <li class="heading_list">Autres consultations</li>

                                @foreach(liste_consultations($ordonnance->consultation->patient_id, $ordonnance->consultation_id) as $key => $consultation_l)
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
        <a class="md-fab md-fab-default md-fab-wave-light" href="{{ route('patients.edit', [$ordonnance->consultation->patient_id]) }}" id="Retour">
            <i class="material-icons">&#xe166;</i>
        </a>
    </div>

    @include('pages.consultations.boutons_actions', ['c_id' => $ordonnance->consultation->id, 'p_id' => $ordonnance->consultation->patient_id])

    <div id="invoice_form_template" style="display: none;">
    </div>

    <div id="invoice_template" style="display: none">

        @include('pages.consultations.form_ordonnance')

    </div>

@endsection