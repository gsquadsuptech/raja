<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="{{ asset('/dist/assets/img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('/dist/assets/img/favicon-32x32.png') }}" sizes="32x32">

    <title>Altair Admin v2.20.1</title>

    <!-- additional styles for plugins -->
    <!-- weather icons -->
    <link rel="stylesheet" href="{{ asset('/dist/bower_components/weather-icons/css/weather-icons.min.css') }}" media="all">
    <!-- metrics graphics (charts) -->
    <link rel="stylesheet" href="{{ asset('/dist/bower_components/metrics-graphics/dist/metricsgraphics.css') }}">
    <!-- chartist -->
    <link rel="stylesheet" href="{{ asset('/dist/bower_components/chartist/dist/chartist.min.css') }}">

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

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    <script type="text/javascript" src="{{ asset('/dist/bower_components/matchMedia/matchMedia.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/bower_components/matchMedia/matchMedia.addListener.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/ie.css') }}" media="all">
    <![endif]-->

</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
<!-- main header -->
@include('includes.header')
<!-- main header end -->

<!-- main sidebar -->
@include('includes.sidebar_main')
<!-- main sidebar end -->

@yield('content')

<!-- secondary sidebar -->
@include('includes.sidebar_secondary')
<!-- secondary sidebar end -->

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
<!-- d3 -->
<script src="{{ asset('/dist/bower_components/d3/d3.min.js') }}"></script>
<!-- metrics graphics (charts) -->
<script src="{{ asset('/dist/bower_components/metrics-graphics/dist/metricsgraphics.min.js') }}"></script>
<!-- chartist (charts) -->
<script src="{{ asset('/dist/bower_components/chartist/dist/chartist.min.js') }}"></script>
<!-- maplace (google maps) -->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyC2FodI8g-iCz1KHRFE7_4r8MFLA7Zbyhk"></script>
<script src="{{ asset('/dist/bower_components/maplace-js/dist/maplace.min.js') }}"></script>
<!-- peity (small charts) -->
<script src="{{ asset('/dist/bower_components/peity/jquery.peity.min.js') }}"></script>
<!-- easy-pie-chart (circular statistics) -->
<script src="{{ asset('/dist/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
<!-- countUp -->
<script src="{{ asset('/dist/bower_components/countUp.js/dist/countUp.min.js') }}"></script>
<!-- handlebars.js -->
<script src="{{ asset('/dist/bower_components/handlebars/handlebars.min.js') }}"></script>
<script src="{{ asset('/dist/assets/js/custom/handlebars_helpers.min.js') }}"></script>
<!-- CLNDR -->
<script src="{{ asset('/dist/bower_components/clndr/clndr.min.js') }}"></script>

<!--  dashbord functions -->
<script src="{{ asset('/dist/assets/js/pages/dashboard.min.js') }}"></script>

<script>
    $(function() {
        if(isHighDensity()) {
            $.getScript( "assets/js/custom/dense.min.js", function(data) {
                // enable hires images
                altair_helpers.retina_images();
            });
        }
        if(Modernizr.touch) {
            // fastClick (touch devices)
            FastClick.attach(document.body);
        }
    });
    $window.load(function() {
        // ie fixes
        altair_helpers.ie_fix();
    });
</script>

</body>
</html>