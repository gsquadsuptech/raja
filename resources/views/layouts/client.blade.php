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

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/main.min.css') }}" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/themes/themes_combined.min.css') }}" media="all">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    <script type="text/javascript" src="{{ asset('/dist/bower_components/matchMedia/matchMedia.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/bower_components/matchMedia/matchMedia.addListener.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/ie.css') }}" media="all">
    <![endif]-->

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('/css/custom-01.css') }}" media="all">

    @yield('after_styles')

</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
<!-- main header -->
@include('includes.header')
        <!-- main header end -->

<!-- main sidebar -->
@include('includes.sidebar_main')
        <!-- main sidebar end -->

<div id="page_content">

    {{--@if(isset($heading))--}}
        {{--<div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">--}}
            {{--<h1 id="product_edit_name">{{ $heading }}</h1>--}}
            {{--@if(isset($subheading))--}}
                {{--<span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">{{ $subheading }}</span>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--@endif--}}

    <div id="page_content_inner">
        @yield('content')
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

<!-- common functions -->
<script src="{{ asset('/dist/assets/js/common.min.js') }}"></script>
<!-- uikit functions -->
<script src="{{ asset('/dist/assets/js/uikit_custom.min.js') }}"></script>
<!-- altair common functions/helpers -->
<script src="{{ asset('/dist/assets/js/altair_admin_common.min.js') }}"></script>

<!-- page specific plugins -->
@stack('pagescripts')

<script src="{{ asset('/js/custom-04.js') }}"></script>

<!-- page specific plugins -->
@yield('after_scripts')

</body>
</html>
