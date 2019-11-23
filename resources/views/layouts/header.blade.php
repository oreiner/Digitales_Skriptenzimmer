<!DOCTYPE html>

<html class="no-js" lang="zxx">

<head>

    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="description" content="Skriptenzimmer Koeln">

    <meta name="keywords" content="Protokoll, Protokolle, Skripte, Köln, Prüfungen, Medizin, Medfak, Studium">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">



    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/bootstrap.min.css')}}" defer>

    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/font-awesome.min.css')}}" defer />
<!-- slider
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/magnific-popup.css')}}" defer />

    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/layers.min.css')}}" defer />

    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/navigation.min.css')}}" defer />

    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/settings.min.css')}}" defer />

    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/slick.css')}}" defer />

    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/slick-theme.css')}}" defer>
!-->
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/meanmenu.css')}}" defer>

   <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/style.min.css')}}" defer>

    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/responsive.min.css')}}" defer>

<!-- correct location is mailpdf.blade.php, I think
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/js/vendor/select2/dist/css/select2.min.css')}}" defer>

    <link rel="stylesheet" type="text/css" href="{{asset('eduread/js/vendor/select2/dist/css/select2-bootstrap.min.css')}}" defer>
!-->
    {{--<link href="{{ asset('css/site.min.css') }}" rel="stylesheet" defer>--}}
	

    <script type="text/javascript">

        var base_path = '{{URL::to('/')}}';

    </script>

    <script>

        window.Laravel = <?php echo json_encode([

            'csrfToken' => csrf_token(),

        ]); ?>

    </script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134069936-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-134069936-1');
	</script>


</head>

<!-- mailpdf needs a slightly different header. must include select2 files and variable  userType -->