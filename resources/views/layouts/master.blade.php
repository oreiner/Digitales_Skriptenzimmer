﻿<!DOCTYPE html><html class="no-js" lang="zxx"><head>    <meta charset="utf-8">    <meta http-equiv="x-ua-compatible" content="ie=edge">    <meta name="description" content="Skriptenzimmer Koeln">    <meta name="keywords" content="Protokoll, Protokolle, Skripte, Köln, Prüfungen, Medizin, Medfak, Studium">    <meta name="viewport" content="width=device-width, initial-scale=1">    <title>{{ config('app.name') }} | @yield('title')</title>    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">    <meta name="csrf-token" content="{{ csrf_token() }}">    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/bootstrap.min.css')}}" defer>    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/font-awesome.min.css')}}" defer /><!-- slider    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/magnific-popup.css')}}" defer />    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/layers.min.css')}}" defer />    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/navigation.min.css')}}" defer />    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/settings.min.css')}}" defer />    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/slick.css')}}" defer />    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/slick-theme.css')}}" defer>!-->    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/meanmenu.css')}}" defer>   <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/style.min.css')}}" defer>    <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/responsive.min.css')}}" defer><!-- correct location is mailpdf.blade.php, I think    <link rel="stylesheet" type="text/css" href="{{asset('eduread/js/vendor/select2/dist/css/select2.min.css')}}" defer>    <link rel="stylesheet" type="text/css" href="{{asset('eduread/js/vendor/select2/dist/css/select2-bootstrap.min.css')}}" defer>!-->    {{--<link href="{{ asset('css/site.min.css') }}" rel="stylesheet" defer>--}}	    <script type="text/javascript">        var base_path = '{{URL::to('/')}}';    </script>    <script>        window.Laravel = <?php echo json_encode([            'csrfToken' => csrf_token(),        ]); ?>    </script>	<!-- Global site tag (gtag.js) - Google Analytics -->	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134069936-1"></script>	<script>	  window.dataLayer = window.dataLayer || [];	  function gtag(){dataLayer.push(arguments);}	  gtag('js', new Date());	  gtag('config', 'UA-134069936-1');	</script></head><body> @yield('content') @include('layouts.footer')<!--<script src="{{ asset('eduread/js/vendor/jquery-1.12.4.min.js') }}"></script>!--><script src="{{ asset('eduread/js/vendor/jquery-3.3.1.min.js') }}"></script><script src="https://code.jquery.com/jquery-migrate-3.0.1.min.js"></script><!-- <script src="{{ asset('eduread/js/vendor/select2/vendor/jquery-2.1.0.js') }}"></script>!--><script src="{{ asset('eduread/js/assets/bootstrap.min.js') }}"></script><script src="{{ asset('eduread/js/assets/owl.carousel.min.js') }}"></script><!--  slider<script src="{{ asset('eduread/js/assets/revolution/jquery.themepunch.revolution.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/jquery.themepunch.tools.min.js') }}"></script><script src="{{ asset('eduread/js/assets/jquery.magnific-popup.min.js') }}"></script>--><script src="{{ asset('eduread/js/assets/jquery.sticky.js') }}"></script><script src="{{ asset('eduread/js/assets/jquery.counterup.min.js') }}"></script><script src="{{ asset('eduread/js/assets/waypoints.min.js') }}"></script><!--<script src="{{ asset('eduread/js/assets/slick.min.js') }}"></script>--><script src="{{ asset('eduread/js/assets/jquery.meanmenu.min.js') }}"></script><!-- silder. only for local server<script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.actions.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.carousel.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.kenburn.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.layeranimation.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.migration.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.navigation.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.parallax.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.slideanims.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.video.min.js') }}"></script>!--><!--<script src="{{ asset('eduread/js/assets/revolution/revolution.min.js') }}"></script>!--><!-- correct location is mailpdf.blade.php, I think <script src="{{ asset('eduread/js/vendor/select2/dist/js/select2.full.min.js') }}"></script> !--><script src="{{ asset('eduread/js/custom.js') }}"></script> <script src="{{ asset('eduread/js/function.js') }}"></script>{{--<script src="{{ asset('js/site.js') }}" defer></script>--}} <script type="text/javascript">     $.ajaxSetup({         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }     }); </script><!-- cookie consent !--><link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" /><script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script><script>window.addEventListener("load", function(){window.cookieconsent.initialise({  "palette": {    "popup": {      "background": "#eb6c44",      "text": "#ffffff"    },    "button": {      "background": "#f5d948"    }  },  "theme": "classic",  "content": {    "message": "Um unsere Webseite für Sie optimal zu gestalten und fortlaufend verbessern zu können, verwenden wir Cookies. Durch die weitere Nutzung der Webseite stimmen Sie der Verwendung von Cookies zu. Weitere Informationen zu Cookies erhalten Sie in unserer Datenschutzerklärung.",    "dismiss": "OK",    "link": "Lese mehr",    "href": "{{route('terms')}}"  }})});</script>  <!-- cookie consent !--></body></html>