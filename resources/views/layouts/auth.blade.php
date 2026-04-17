<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon2.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon2.png') }}" sizes="32x32">

    <title>Cabinet Medical Rabia | CONNEXION</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('/dist/bower_components/uikit/css/uikit.almost-flat.min.css') }}"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="{{ asset('/dist/assets/css/login_page.min.css') }}" />

    <style>
        body{
            padding: unset !important;
            height: 100% !important;
        }
        label{
            color: #fff !important;
        }
        .md-input-wrapper.md-input-filled.md-input-focus > label{
            color: #ddd !important;
        }
        .md-input-wrapper.md-input-focus > label{
            color: #ddd !important;
        }
        .md-input-wrapper.md-input-filled > label{
            color: #ddd !important;
        }
        input{
            /*color: #fff !important;*/
        }
        .uk-container.uk-container-center{
            width: 100% !important;
            height: 100% !important;
            max-width: none !important;
            padding: unset !important;
            display: table !important;
        }
        .uk-grid.uk-grid-collapse{
            width: 100% !important;
            height: 100% !important;
            background-color: #38B9C2;
        }
        .md-card{
            height: 100% !important;
        }
        .md-card-content.padding-reset{
            height: 100% !important;
        }
    </style>
</head>
<body class="login_page login_page_v2">

@yield('content')

<!-- common functions -->
<script src="{{ asset('/dist/assets/js/common.min.js') }}"></script>
<!-- uikit functions -->
<script src="{{ asset('/dist/assets/js/uikit_custom.min.js') }}"></script>
<!-- altair core functions -->
<script src="{{ asset('/dist/assets/js/altair_admin_common.min.js') }}"></script>

<!-- altair login page functions -->
<script src="{{ asset('/dist/assets/js/pages/login.min.js') }}"></script>

<script>
    // check for theme
    if (typeof(Storage) !== "undefined") {
        var root = document.getElementsByTagName( 'html' )[0],
                theme = localStorage.getItem("altair_theme");
        if(theme == 'app_theme_dark' || root.classList.contains('app_theme_dark')) {
            root.className += ' app_theme_dark';
        }
    }
</script>

</body>
</html>