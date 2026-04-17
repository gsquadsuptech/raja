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
                @foreach($roles as $role)
                    <tr>
                        <td>
                            {!! Html::decode(link_to_route('roles.edit','<i class="uk-icon-pencil uk-icon-small"></i>',$role->id)) !!} &nbsp;&nbsp;
                            <a href="{{ route('roles.delete', [$role->id]) }}" class="destroy-btn"
                               data-remote="true" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">
                                <i class="md-icon material-icons">&#xE872;</i>
                            </a>
                        </td>
                        <td>{{ $role->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="md-fab-wrapper fab-save">
        <a class="md-fab md-fab-success md-fab-wave-light" href="{{ route('roles.create') }}" title="Ajouter un role"><i class="material-icons">&#xe7fe;</i></a>
    </div>

@endsection
