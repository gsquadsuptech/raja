<aside id="sidebar_main">
    <div class="menu_section">
        <div class="sidebar_main_header" {{--style="margin-top: -125px; position: fixed;"--}}>
            <div class="sidebar_logo">
                <a href="{{ url('patients') }}" class="sSidebar_hide sidebar_logo_large" style="text-align: center; padding: 20px 0;">
                    <img class="logo_regular" src="{{ asset('images/logo_rabia.jpg') }}" alt="" {{--height="15" width="75%"--}}/>
                </a>
            </div>
        </div>
        <ul {{--style="padding-top: 80px"--}}>
            {{--<li class="{{ isActiveRoute('dashboard') }}" title="Tableau de bord">--}}
                {{--<a href="{{ route('dashboard') }}">--}}
                    {{--<div style="width: 32px; display: inline-block;">--}}
                        {{--<img src="{{ asset('images/menu/tableau-de-bord.png') }}" width="25px" alt="">--}}
                    {{--</div>--}}
                    {{--<span class="menu_title">Tableau de bord</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            
            @can('permission', [App\User::class, 'patients-list'])
            <li title="Patients" class="{{ isActiveRoute('patients') }}">
                <a href="{{ url('patients') }}">
                    <span class="menu_icon"><i class="material-icons">&#xe914;</i></span>
                    <span class="menu_title">Patients</span>
                </a>
            </li>
            @endcan

            @can('permission', [App\User::class, 'consultations-list'])
            <li title="Consultations" class="{{ Request::has('rdv') ? 'current_section' : '' }}">
                <a href="{{ route('consultations.index', ['rdv']) }}">
                    <span class="menu_icon"><i class="material-icons">&#xe855;</i></span>
                    <span class="menu_title">Rendez-vous</span>
                </a>
            </li>
            @endcan

            @can('permission', [App\User::class, 'consultations-list'])
            <li title="Consultations" class="{{ Request::has('att') ? 'current_section' : '' }}">
                <a href="{{ route('consultations.index', ['att']) }}">
                    <span class="menu_icon"><i class="material-icons">&#xe065;</i></span>
                    <span class="menu_title">File d'attente</span>
                </a>
            </li>
            @endcan

        </ul>
    </div>
</aside>