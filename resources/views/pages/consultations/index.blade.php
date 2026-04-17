@extends('layouts.app')

@section('content')

    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <div class="dt_colVis_buttons"></div>
            <table id="dt_colVis" class="uk-table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    @foreach($table_headers as $table_header)
                        <th>{{$table_header}}</th>
                    @endforeach
                </tr>
                </thead>

                <tbody>
                @foreach($consultations as $consultation)
                    <tr>
                        <td>
                            {!! Html::decode(link_to_route('consultations.edit','<i class="md-icon material-icons">&#xE254;</i>',$consultation)) !!}
                            <a href="{{ route('consultations.destroy', [$consultation]) }}" class="destroy-btn"
                               data-remote="true" data-method="delete" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">
                                <i class="md-icon material-icons">&#xE872;</i>
                            </a>
                        </td>
                        <td>{{ $consultation->nom_complet_patient }}</td>
{{--                        <td>{{ $consultation->nom_medecin }}</td>--}}
                        <td>{{ $consultation->date_consultation }}</td>
                        <td>{{ $consultation->nom_statut }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="md-fab-wrapper fab-save">
        <a class="md-fab md-fab-success md-fab-wave-light" href="{{ route('consultations.create') }}" title="Ajouter une nouvelle consultation">
            <i class="material-icons">&#xe7fe;</i>
        </a>
    </div>

@endsection