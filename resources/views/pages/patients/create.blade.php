@extends('layouts.client')

@section('content')

    {{ Form::open(array('route' => 'patients.store', 'enctype' => 'multipart/form-data')) }}

    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-large-7-10">
            <div class="md-card">
                <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                    <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput" style="display: none;">
                        <div class="fileinput-new thumbnail">
                            <img src="{{ asset('/images/avatars/user.png') }}" alt="user avatar"/>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div class="user_avatar_controls">
                            <span class="btn-file">
                                <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                {{ Form::file('user_edit_avatar_control') }}
                            </span>
                            <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                        </div>
                    </div>
                    <div class="user_heading_content">
                        <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname">{{ old('prenom') }}</span>
                            <span class="sub-heading" id="user_edit_position">{{ old('nom') }}</span>
                        </h2>
                    </div>
                    <div class="md-fab-wrapper">
                        <div class="md-fab md-fab-toolbar md-fab-small md-fab-accent">
                            <i class="material-icons">&#xE8BE;</i>
                            <div class="md-fab-toolbar-actions">
                                <a href="{{ route('patients.index') }}" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Annuler">
                                    <i class="material-icons md-color-white">&#xe166;</i>
                                </a>
                                <button type="submit" id="user_edit_save" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Enregistrer les modifications">
                                    <i class="material-icons md-color-white">&#xe145;</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_content">
                    <ul id="user_edit_tabs" class="uk-tab" data-uk-tab="{connect:'#user_edit_tabs_content'}">
                        <li class="uk-active"><a href="#">Informations du patient</a></li>
                        {{--<li><a href="#">Consultations</a></li>--}}
                        {{--<li><a href="#">Examens</a></li>--}}
                        {{--<li><a href="#">Ordonnances</a></li>--}}
                    </ul>
                    <ul id="user_edit_tabs_content" class="uk-switcher uk-margin">
                        @include('pages.patients.infos_patient')
                        {{--@include('pages.patients.consultations')--}}
                        {{--@include('pages.patients.examens')--}}
                        {{--@include('pages.patients.ordonnances')--}}
                    </ul>
                </div>
            </div>
        </div>

        <div class="uk-width-large-3-10">
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_c uk-margin-medium-bottom">Informations complémentaires</h3>
                    <div class="uk-form-row">
                        {{ Form::label('notes', 'Notes') }}
                        {{ Form::textarea('notes', old('notes'),array('rows' => '3','class'=>'md-input'.($errors->has('notes') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('notes', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ Form::close() }}

    @push('pagescripts')
            <!-- file input -->
    <script src="{{ asset('/dist/assets/js/custom/uikit_fileinput.min.js') }}"></script>

    <!--  user edit functions -->
    <script src="{{ asset('/dist/assets/js/pages/page_user_edit.js') }}"></script>

    {{--<script src="{{ asset('/js/rails.min.js') }}"></script>--}}

    @endpush

@endsection
