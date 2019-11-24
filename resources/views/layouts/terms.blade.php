<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Skriptenzimmer">
    <meta name="keywords" content="Protokoll, Protokolle, Skripte, Prüfungen, Medizin, Medfak, Studium">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/font-awesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/magnific-popup.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/layers.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/navigation.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/settings.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/slick.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/meanmenu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/responsive.css')}}">
    {{--<link href="{{ asset('css/site.css') }}" rel="stylesheet">--}}
    <script type="text/javascript">
        var base_path = '{{URL::to('/')}}';
    </script>

	<!-- Global site tag (gtag.js) - Google Analytics hier -->

</head>
<body class="register">
     <!-- Preloader -->
     <div id="preloader">
         <div id="status">&nbsp;</div>
     </div>
     <header id="header">
         @include('layouts.topmenu')

         <div class="header-body">
             @include('layouts.topnavbar')

             <div class="container">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="intro-text ">
                             <h1>Allgemeine Geschäftsbedingungen</h1>
                             <p><span><a href="{{route('login')}}">Startseite</a> <i class='fa fa-angle-right'></i></a></span><span class="b-active"><a href="#">AGB</a></span></p>
                         </div>
                     </div>
                 </div><!-- /.row -->
             </div><!-- /.container -->
         </div>
     </header>
     <!--  End header section-->


            @yield('content')
            @include('layouts.footer')

 <script src="{{ asset('eduread/js/vendor/jquery-1.12.4.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/bootstrap.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/owl.carousel.min.js') }}"></script>
 <!--
 <script src="{{ asset('eduread/js/assets/revolution/jquery.themepunch.revolution.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/jquery.themepunch.tools.min.js') }}"></script>
  !-->
 <script src="{{ asset('eduread/js/assets/jquery.magnific-popup.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/jquery.sticky.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/jquery.counterup.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/waypoints.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/slick.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/jquery.meanmenu.min.js') }}"></script>
<!--
 <script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.actions.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.carousel.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.kenburn.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.layeranimation.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.migration.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.navigation.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.parallax.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.slideanims.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.video.min.js') }}"></script>
 <script src="{{ asset('eduread/js/assets/revolution/revolution.js') }}"></script>
 !-->
 <script src="{{ asset('eduread/js/vendor/select2/dist/js/select2.full.js') }}"></script>
 <script src="{{ asset('eduread/js/custom.js') }}"></script>
 <script src="{{ asset('eduread/js/function.js') }}"></script>

 {{--<script src="{{ asset('js/site.js') }}" defer></script>--}}
</body>
</html>
