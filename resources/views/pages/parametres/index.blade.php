@extends('layouts.app')

@section('before_styles')

    <link rel="stylesheet" href="{{ asset('dist/assets/skins/dropify/css/dropify.css') }}">
    <style>
        .dropify-wrapper {
            height:100px !important;
        }
    </style>

@endsection

@section('after_scripts')

    <script src="{{ asset('dist/assets/js/pages/page_settings.min.js') }}"></script>

    <!--  dropify -->
    <script src="{{ asset('dist/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

    <!--  form file input functions -->
    <script src="{{ asset('dist/assets/js/pages/forms_file_input.min.js') }}"></script>

@endsection

@section('content')

    {{ Form::model($parametre, array('route' => array('parametres_generaux.update', $parametre), 'method' => 'put', 'enctype'=>'multipart/form-data')) }}
    <h4 class="heading_a uk-margin-bottom">
        Paramètres généraux

        <button type="submit"
{{--                href="{{ route('restaurer_parametres') }}"--}}
                class="md-btn md-btn-primary md-btn-small md-btn-wave-light md-btn-icon waves-effect waves-button waves-light"
                style="float: right;">
            <i class="uk-icon-save"></i>
            Enregistrer les paramètres
        </button>
    </h4>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-large-1-3 uk-width-medium-1-1">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-form-row">
                            {{ Form::label('nom_salle', 'Nom de la salle de GYM *') }}
                            {{ Form::text('nom_salle', old('nom_salle'),array('class'=>'md-input'.($errors->has('nom_salle') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('nom_salle', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                        <div class="uk-form-row">
                            {{ Form::label('slogan', 'Slogan') }}
                            {{ Form::text('slogan', old('slogan'),array('class'=>'md-input'.($errors->has('slogan') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('slogan', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                        <div class="uk-form-row">
                            <div class="uk-input-group">
                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                {{ Form::label('date_creation', 'Date de creation') }}
                                {{ Form::text('date_creation', old('date_creation'),array('data-uk-datepicker'=>"{format:'DD/MM/YYYY'}",'class'=>'md-input'.($errors->has('date_creation') ? ' md-input-danger' : ''))) }}
                                {!! $errors->first('date_creation', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                            </div>
                        </div>
                        <div class="uk-form-row">

                            <h3 class="heading_a uk-margin-small-bottom">
                                Logo (Taille : environ 300x300)
                            </h3>
                            {{ Form::file('logo',array('id'=>'input-file-b', 'data-default-file' => $parametre->logo ? asset('images/logo').'/'.$parametre->logo : '', 'class'=>'dropify-fr '.($errors->has('logo') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('logo', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                        <div class="uk-form-row">
                            <h3 class="heading_a uk-margin-small-bottom">
                                Favicon (Taille : 32x32 / 64x64)
                            </h3>
                            {{ Form::file('favicon',array('id'=>'input-file-b', 'data-default-file' => $parametre->favicon ? asset('images/favicon').'/'.$parametre->favicon : '', 'class'=>'dropify-fr '.($errors->has('favicon') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('favicon', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-large-1-3 uk-width-medium-1-2">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-form-row">
                            {{ Form::label('adresse', 'Adresse *') }}
                            {{ Form::text('adresse', old('adresse'),array('class'=>'md-input'.($errors->has('adresse') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('adresse', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                        <div class="uk-form-row">
                            {{ Form::label('email_contact', 'Email') }}
                            {{ Form::text('email_contact', old('email_contact'),array('class'=>'md-input'.($errors->has('email_contact') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('email_contact', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                        <div class="uk-form-row">
                            <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-2" data-uk-grid-margin>
                                <div>
                                    {{ Form::label('telephone1', 'Téléphone 1 *') }}
                                    {{ Form::number('telephone1', old('telephone1'),array('class'=>'md-input'.($errors->has('telephone1') ? ' md-input-danger' : ''))) }}
                                    {!! $errors->first('telephone1', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                                </div>
                                <div>
                                    {{ Form::label('telephone2', 'Téléphone 2') }}
                                    {{ Form::number('telephone2', old('telephone2'),array('class'=>'md-input'.($errors->has('telephone2') ? ' md-input-danger' : ''))) }}
                                    {!! $errors->first('telephone2', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="uk-form-row">
                            {{ Form::label('site_web', 'Site web') }}
                            {{ Form::text('site_web', old('site_web'),array('class'=>'md-input'.($errors->has('site_web') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('site_web', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-1-1 uk-width-medium-1-1" style="margin-top: 20px">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-form-row">
                                {{ Form::label('delai_rappel', 'Délai de rappel de fin d\'abonnement (jours) *') }}
                                {{ Form::number('delai_rappel', old('delai_rappel'),array('class'=>'md-input'.($errors->has('delai_rappel') ? ' md-input-danger' : ''))) }}
                                {!! $errors->first('delai_rappel', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-large-1-3 uk-width-medium-1-2">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-form-row">
                            <h4 class="heading_list">Couleur de fond de la barre d'entête *</h4>
                            <input type="color" name="couleur_header" value="{{ $parametre->couleur_header }}" style="width:100%;">
                        </div>
                        <div class="uk-form-row">
                            <h4 class="heading_list">Couleur des éléments de la barre d'entête *</h4>
                            <input type="color" name="couleur_header_icons" value="{{ $parametre->couleur_header_icons }}" style="width:100%;">
                        </div>
                        <div class="uk-form-row">
                            <h4 class="heading_list">Couleur de fond du panneau latéral *</h4>
                            <input type="color" name="couleur_sidebar" value="{{ $parametre->couleur_sidebar }}" style="width:100%;">
                        </div>
                        <div class="uk-form-row">
                            <h4 class="heading_list">Couleur du texte du panneau latéral *</h4>
                            <input type="color" name="couleur_texte_sidebar" value="{{ $parametre->couleur_texte_sidebar }}" style="width:100%;">
                        </div>
                        <div class="uk-form-row">
                            <h4 class="heading_list">Couleur du texte selectionné du panneau latéral *</h4>
                            <input type="color" name="couleur_texte_sidebar_selectionne" value="{{ $parametre->couleur_texte_sidebar_selectionne }}" style="width:100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{ Form::close() }}

    {{ Form::open(['route' => ['restaurer_parametres'], 'style' => 'float: right']) }}

    <div class="md-fab-wrapper">
        <button type="submit" class="md-fab md-fab-small md-fab-danger"
                data-remote="false" data-confirm="Êtes-vous sûr de vouloir restaurer les paramètres par défaut ?">
            <i class="material-icons">&#xe5d5;</i>
        </button>
    </div>
    {{ Form::close() }}

@endsection