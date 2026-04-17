@extends('layouts.app')

@section('after_scripts')

        <!-- kendo UI -->
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

@endsection

@section('content')

    {{ Form::model($consultation, array('route' => array('consultations.update', $consultation), 'method' => 'put')) }}

    <div class="uk-grid">
        <div class="uk-width-medium-4-5 uk-container-center">
            <div class="md-card">
                <div class="md-card-content large-padding">
                    @include('pages.consultations.consultations_form')
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper md-fab-speed-dial-horizontal fab-save" data-fab-hover>
        <div class="md-fab-wrapper-small">
            {!! Html::decode(link_to_route('consultations.index', '<i class="material-icons">&#xe166;</i></a>', null,
                    array('class' => 'md-fab md-fab-small md-fab-default', 'title' => 'Annuler'))) !!}
            <a class="md-fab md-fab-small md-fab-danger" href="{{ route('consultations.delete', [$consultation]) }}"
               data-remote="false" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">
                <i class="material-icons">&#xe872;</i>
            </a>
            <button class="md-fab md-fab-small md-fab-warning" type="submit">
                <i class="material-icons">&#xE161;</i>
            </button>
        </div>
        <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xe896;</i></a>
    </div>

    {{ Form::close() }}

    <div class="uk-grid" style="margin-top: 40px">
        <div class="uk-width-medium-1-1 uk-container-center">
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <a style="float: right;" class="md-fab md-fab-success md-fab-wave-light" href="javascript:void(0)">
                        <i class="material-icons">&#xe145;</i>
                    </a>
                    <h3 class="heading_a uk-margin-bottom">Liste des examens</h3>
                    <table id="dt_colVis" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Analyse (SCAN)</th>
                            <th>ECG (SCAN)</th>
                            <th>Echo</th>
                            <th>Ordonnance</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($liste_examens as $examen)
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--{!! Html::decode(link_to_route('consultations.edit','<i class="md-icon material-icons">&#xE254;</i>',$consultation)) !!}--}}
                                    {{--<a href="{{ route('consultations.destroy', [$consultation]) }}" class="destroy-btn"--}}
                                       {{--data-remote="true" data-method="delete" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">--}}
                                        {{--<i class="md-icon material-icons">&#xE872;</i>--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                                {{--<td>{{ $consultation->nom_complet_patient }}</td>--}}
                                {{--<td>{{ $consultation->nom_medecin }}</td>--}}
                                {{--<td>{{ $consultation->date_consultation }}</td>--}}
                                {{--<td>{{ $consultation->nom_statut }}</td>--}}
                            {{--</tr>--}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection