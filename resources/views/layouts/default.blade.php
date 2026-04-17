<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="{{ asset('/images/favicon.png') }}">

    <title>{{ $page_title ?? "SMARTGYM" }} | {{ parametre('nom_salle') }}</title>

    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('/dist/bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/main.min.css') }}" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/themes/themes_combined.min.css') }}" media="all">

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('/css/custom-01.css') }}" media="all">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    <script type="text/javascript" src="{{ asset('/dist/bower_components/matchMedia/matchMedia.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/bower_components/matchMedia/matchMedia.addListener.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/ie.css') }}" media="all">
    <![endif]-->

</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe {{--sidebar_slim sidebar_slim_inactive--}}">
<!-- main header -->
@include('includes.header')
<!-- main header end -->

<!-- main sidebar -->
@include('includes.sidebar_main')
<!-- main sidebar end -->

<div id="page_content">



    @if(isset($heading))
    <div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">
        <h1 id="product_edit_name">{{ $heading }}</h1>
        @if(isset($page_title))
        <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">{{ $page_title }}</span>
        @endif
    </div>
    @endif

    <div id="page_content_inner">

        @if(isset($page_description))
        <h4 class="heading_a uk-margin-bottom">{{ $page_description }}</h4>
        @endif

        @yield('content')

        @if (\Session::has('success_msg'))
            <button id="success-notification"
                    style="display: none;"
                    class="md-btn"
                    data-message="<a href='#' id='clear-notification' class='notify-action'><i class='uk-icon-times'></i></a> {{ \Session::get('success_msg') }}"
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
{{--@include('includes.sidebar_secondary')--}}
<!-- secondary sidebar end -->

{{--<script>--}}
    {{--WebFontConfig = {--}}
        {{--google: {--}}
            {{--families: [--}}
                {{--'Source+Code+Pro:400,700:latin',--}}
                {{--'Roboto:400,300,500,700,400italic:latin'--}}
            {{--]--}}
        {{--}--}}
    {{--};--}}
    {{--(function() {--}}
        {{--var wf = document.createElement('script');--}}
        {{--wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +--}}
                {{--'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';--}}
        {{--wf.type = 'text/javascript';--}}
        {{--wf.async = 'true';--}}
        {{--var s = document.getElementsByTagName('script')[0];--}}
        {{--s.parentNode.insertBefore(wf, s);--}}
    {{--})();--}}
{{--</script>--}}

<!-- common functions -->
<script src="{{ asset('/dist/assets/js/common.min.js') }}"></script>
<!-- uikit functions -->
<script src="{{ asset('/dist/assets/js/uikit_custom.min.js') }}"></script>
<!-- altair common functions/helpers -->
<script src="{{ asset('/dist/assets/js/altair_admin_common.min.js') }}"></script>

<!-- page specific plugins -->
<!-- datatables -->
<script src="{{ asset('/dist/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
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

<!-- countUp -->
<script src="{{ asset('/dist/bower_components/countUp.js/dist/countUp.min.js') }}"></script>

<!-- custom js -->
<script type="text/javascript">
    var URL_API_PAYS = '{{ env('URL_API_PAYS') }}';
</script>

<script>
    $(window).on('load',function(){
        countUp();
    });
    function countUp() {
        $('.countUpMe').each(function () {
            var target = this,
                    countTo = $(target).text();
            theAnimation = new CountUp(target, 0, countTo, 0, 2);
            theAnimation.start();
        });
    }
</script>
<script src="{{ asset('/js/custom-04.js') }}"></script>

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

</body>
</html>