@extends('layouts.app')

@section('content')

    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <div class="dt_colVis_buttons"></div>
            <table id="liste_patients" class="uk-table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    @foreach($table_headers as $table_header)
                        <th>{{$table_header}}</th>
                    @endforeach
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="md-fab-wrapper fab-save">
        <a class="md-fab md-fab-success md-fab-wave-light" href="{{ route('patients.create') }}" title="Ajouter un nouveau patient">
            <i class="material-icons">&#xe7fe;</i>
        </a>
    </div>

@endsection

@push('pagescripts')

    <script>

        var datatable_columns = [
            {data: 'action', orderable: false, searchable: false},
            {data: 'code_patient', name: 'code_patient'},
            {data: 'prenom', name: 'prenom'},
            {data: 'nom', name: 'nom'},
            {data: 'sexe', name: 'sexe'},
            {data: 'telephone', name: 'telephone'},
            {data: 'adresse', name: 'adresse'},
            {data: 'age', name: 'age'},
        ];
        var get_data_url = '{!! route('get_liste_patients') !!}';
        var order_columns = [];

    </script>

@endpush
