@extends('layouts.app')

@section('content')

    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'put', 'id' => 'user_form')) }}

    <div class="uk-grid">
        <div class="uk-width-medium-4-5 uk-container-center">
            <div class="md-card">
                <div class="md-card-content large-padding">
                    @include('pages.utilisateurs.user_form')
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper md-fab-speed-dial-horizontal fab-save" data-fab-hover>
        <div class="md-fab-wrapper-small">
            {!! Html::decode(link_to_route('users.index', '<i class="material-icons">&#xe166;</i></a>', null,
                    array('class' => 'md-fab md-fab-small md-fab-default', 'title' => 'Annuler'))) !!}
            <a class="md-fab md-fab-small md-fab-danger" href="{{ route('users.delete', [$user->id]) }}"
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

@endsection
