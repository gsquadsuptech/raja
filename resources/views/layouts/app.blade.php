<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon2.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon2.png') }}" sizes="32x32">

    <title>{{ $heading ?? "" }} | Cabinet Medical Rabia</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    @yield('before_styles')

            <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('/dist/bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="{{ asset('/dist/assets/icons/flags/flags.min.css') }}" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/style_switcher.min.css') }}" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/main.min.css') }}" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/themes/themes_combined.min.css') }}" media="all">

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('/css/custom-01.css') }}" media="all">

    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('/dist/bower_components/select2/dist/css/select2.min.css') }}">

    @yield('after_styles')

</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe @if(isset($double_header)) header_double_height @endif">
<!-- main header -->
@include('includes.header')
        <!-- main header end -->

<!-- main sidebar -->
@include('includes.sidebar_main')
        <!-- main sidebar end -->

<div id="page_content">

    @if(isset($heading) && !isset($double_header))
        <div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">
            <h1 id="product_edit_name">{{ $heading }}</h1>
            @if(isset($subheading))
                <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">{{ $subheading }}</span>
            @endif
        </div>
    @endif

    <div id="page_content_inner">

        @yield('content')

        @if (\Session::has('success_msg'))
            <button id="success-notification"
                    style="display: none;"
                    class="md-btn"
                    data-message="<a href='#' id='clear-notification' class='notify-action'><i class='uk-icon-times uk-text-contrast'></i></a> {{ \Session::get('success_msg') }}"
                    data-status="success"
                    data-pos="top-center">
            </button>
        @endif
        @if (\Session::has('error_msg'))
            <button id="error-notification"
                    style="display: none;"
                    class="md-btn"
                    data-message="<a href='#' id='clear-notification' class='notify-action'><i class='uk-icon-times uk-text-contrast'></i></a> {{ \Session::get('error_msg') }}"
                    data-status="danger"
                    data-pos="top-center">
            </button>
        @endif
        @if (\Session::has('forbidden'))
            <button id="error-notification"
                    style="display: none;"
                    class="md-btn"
                    data-message="<a href='#' id='clear-notification' class='notify-action'><i class='uk-icon-times'></i></a> {{ \Session::get('forbidden') }}"
                    data-status="success"
                    data-pos="top-center">
            </button>
        @endif
    </div>
</div>


<!-- secondary sidebar -->
@include('includes.sidebar_secondary')
        <!-- secondary sidebar end -->


<!-- page specific plugins -->
@yield('before_scripts')

        <!-- google web fonts -->
<script>
    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:400,300,500,700,400italic:latin'
            ]
        }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>

<script>

    @if (\Session::has('success_msg'))
    setTimeout(function() {
        $( "#success-notification" ).trigger( "click" );
    }, 200);
    setTimeout(function() {
        $( "#clear-notification" ).trigger( "click" );
    }, 5000);
    @endif

    @if (\Session::has('error_msg'))
    setTimeout(function() {
        $( "#error-notification" ).trigger( "click" );
    }, 200);
    setTimeout(function() {
        $( "#clear-notification" ).trigger( "click" );
    }, 5000);
    @endif

    @if (\Session::has('forbidden'))
    setTimeout(function() {
        $( "#error-notification" ).trigger( "click" );
    }, 200);
    setTimeout(function() {
        $( "#clear-notification" ).trigger( "click" );
    }, 5000);
    @endif

</script>

<!-- common functions -->
<script src="{{ asset('/dist/assets/js/common.min.js') }}"></script>
<!-- uikit functions -->
<script src="{{ asset('/dist/assets/js/uikit_custom.min.js') }}"></script>
<!-- altair common functions/helpers -->
<script src="{{ asset('/dist/assets/js/altair_admin_common.min.js') }}"></script>

<!-- page specific plugins -->
<!-- datatables -->
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<!-- datatables buttons-->
<script src="{{ asset('/dist/bower_components/datatables-buttons/js/dataTables.buttons.js') }}"></script>
<script src="{{ asset('/dist/assets/js/custom/datatables/buttons.uikit.js') }}"></script>
<script src="{{ asset('/dist/bower_components/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('/dist/bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('/dist/bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('/dist/bower_components/datatables-buttons/js/buttons.colVis.js') }}"></script>
<script src="{{ asset('/dist/bower_components/datatables-buttons/js/buttons.html5.js') }}"></script>
<script src="{{ asset('/dist/bower_components/datatables-buttons/js/buttons.print.js') }}"></script>

<!-- datatables custom integration -->
<script src="{{ asset('/dist/assets/js/custom/datatables/datatables.uikit.min.js') }}"></script>

<!-- datatables functions -->
<script src="{{ asset('/dist/assets/js/pages/plugins_datatables.min.js') }}"></script>

<!--  notifications functions -->
<script src="{{ asset('/dist/assets/js/pages/components_notifications.min.js') }}"></script>

<script src="{{ asset('/js/rails.min.js') }}"></script>
<!-- select2 -->
<script src="{{ asset('/dist/bower_components/select2/dist/js/select2.min.js') }}"></script>
<!--  contact list functions -->
<script src="{{ asset('/dist/assets/js/pages/page_contact_list.min.js') }}"></script>
<!--  forms advanced functions -->
<!-- <script src="{{ asset('/dist/assets/js/pages/forms_advanced.min.js') }}"></script> -->

{{--axios--}}
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- custom js -->
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!};
</script>

@stack('pagescripts')

<script src="{{ asset('/js/custom-04.js') }}"></script>

<!-- page specific plugins -->
@yield('after_scripts')

</body>
</html>
