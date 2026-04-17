<header id="header_main">
    <div class="header_main_content">
        <nav class="uk-navbar">

            <!-- main sidebar switch -->
            <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                <span class="sSwitchIcon"></span>
            </a>

            <!-- secondary sidebar switch -->
            <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check" style="display: block !important;">
                <span class="sSwitchIcon"></span>
            </a>
            {{--<div id="menu_top_dropdown" class="uk-float-left uk-hidden-small">--}}
                {{--<div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">--}}
                    {{--<a href="#" class="top_menu_toggle"><i class="material-icons md-24">&#xe8b6;</i></a>--}}
                    {{--<div class="uk-dropdown uk-dropdown-width-2">--}}
                        {{--<div class="uk-grid uk-dropdown-grid">--}}
                            {{--<form action="{{ route('acces.salle.recherche')}}" method="GET">--}}
                                {{--<div class="uk-width-large-1-1 uk-width-medium-1-1">--}}
                                    {{--<div class="uk-input-group">--}}
                                        {{--<label>Numéro de téléphone</label>--}}
                                        {{--<input type="text" name="telephone" class="md-input" required/>--}}
                                        {{--<span class="uk-input-group-addon"><button type="submit" class="md-btn md-btn-primary" href="#">Rechercher</button></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav user_actions">
                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                        <a href="#" class="user_action_image"><img class="md-user-image" src="{{ asset('images/avatars/user_icon.png') }}" alt=""/></a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav js-uk-prevent">
                                <li><a href="javascript:void(0)">Mon profil</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Déconnexion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>