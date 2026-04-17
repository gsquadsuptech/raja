@extends('layouts.auth')

@section('content')

    <div class="uk-container uk-container-center">
        <div class="md-card">
            <div class="md-card-content padding-reset">
                <div class="uk-grid uk-grid-collapse">
                    {{--<div class="uk-width-large-1-2 uk-hidden-medium uk-hidden-small">--}}
                        {{--<div class="login_page_info uk-height-1-1" --}}{{--style="background-image: url('{{ asset('images/login-bg.png') }}')"--}}{{-->--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="uk-width-large-1-2 uk-width-medium-2-3 uk-container-center" style="padding-top: 5%">
                        <div class="login_page_forms">
                            <div id="login_card">
                                <div id="login_form">
                                    <div class="login_heading">
                                        <img src="{{ asset('images/logo_rabia.jpg') }}" alt="" {{--height="15" width="50%"--}}/>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="uk-form-row">
                                            <label for="name">Email</label>
                                            <input class="md-input {{ $errors->has('email') ? 'md-input-danger' : '' }}" type="email" id="email" name="email" value="{{ old('email') }}" />
                                            {!! $errors->first('email', '<span style="color:#dd4b39 !important"><i class="fa fa-times-circle-o"></i> :message</span>') !!}
                                        </div>
                                        <div class="uk-form-row">
                                            <label for="login_password">Mot de passe</label>
                                            <input class="md-input {{ $errors->has('password') ? 'md-input-danger' : '' }}" type="password" id="password" name="password" />
                                            {!! $errors->first('password', '<span style="color:#dd4b39 !important"><i class="fa fa-times-circle-o"></i> :message</span>') !!}
                                        </div>
                                        <div class="uk-margin-medium-top">
                                            <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large" style="background-color: #313131">Se connecter</button>
                                        </div>
                                        <div class="uk-margin-top">
                                            <span class="icheck-inline">
                                                <input type="checkbox" name="login_page_stay_signed" id="login_page_stay_signed" data-md-icheck />
                                                <label for="login_page_stay_signed" class="inline-label">Se souvenir de moi !</label>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
