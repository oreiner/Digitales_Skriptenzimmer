<!doctype html><html class="no-js" lang="zxx">   <head>      <meta charset="utf-8">      <meta http-equiv="x-ua-compatible" content="ie=edge">    <meta name="description" content="Skriptenzimmer Koeln">    <meta name="keywords" content="Protokoll, Protokolle, Skripte, Köln, Prüfungen, Medizin, Medfak, Studium">      <meta name="viewport" content="width=device-width, initial-scale=1">      <title>{{ config('app.name') }} | @yield('title')</title>      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">      <!-- CSRF Token -->          <meta name="csrf-token" content="{{ csrf_token() }}">      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/bootstrap.min.css')}}">      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/font-awesome.min.css')}}" />      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/magnific-popup.css')}}" />      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/layers.css')}}" />      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/navigation.css')}}" />      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/revolution/settings.css')}}" />      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/slick.css')}}" />      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/slick-theme.css')}}">      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/assets/meanmenu.css')}}">      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/style.css')}}">      <link rel="stylesheet" type="text/css" href="{{asset('eduread/css/responsive.css')}}">      {{--      <link href="{{ asset('css/site.css') }}" rel="stylesheet">      --}}		<style>		.verify-text {			color: gainsboro;		}		</style>	  <!-- Global site tag (gtag.js) - Google Analytics hier -->   </head>   <body class="login">      <!-- Preloader -->      <div id="preloader">         <div id="status">&nbsp;</div>      </div>      <header id="header">         @include('layouts.topmenu')             <div class="header-body">            {{--<a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary m-t">--}}            {{--<i class="fa fa-sign-out"></i> Log out ({{Auth::user()->name}} ({{Auth::user()->account}}))--}}        {{--</a>--}}        {{--            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}            {{--@csrf--}}        {{--</form>            --}}        {{--<a href="{{url('/')}}" class="btn btn-primary m-t">Home</a>--}}        {{--@include('layouts.topnavbar')--}}        			<div class="container">				<div class="row justify-content-center">					<div class="col-md-12">						<div class="intro-text ">							<h1><div class="card-header">Bestätige bitte zuerst deine E-Mail-Adresse.</div></h1><br>							<div class="card-body">								@if (session('resent'))									<div class="alert alert-success" role="alert">										{{ __('A fresh verification link has been sent to your email address.') }}									</div>								@endif							<h3 class="verify-text ">	Schaue in deinem Posteingang oder Spamordner nach.</h3>							<h3 class="verify-text ">	Wenn du keine E-Mail erhalten hast,  							<form class="d-inline" method="POST" action={{ route('verification.resend') }}>								@csrf								<button type="submit" class="btn btn-link p-0 m-0 align-baseline">								{{ __('klicke hier, um eine neue Mail anzufordern') }}</button></form>							</h3>							<h3 class="verify-text ">	Beziehungsweise,  <a href="{{ route('profile') }}">klicke hier, um deine E-Mail-Adresse anzupassen</a>.</h3>							</div>						</div>					</div>				</div>			</div>            <!-- /.container -->             </div>      </header>      <!--  End header section--> @yield('content') @include('layouts.footer')<script src="{{ asset('eduread/js/vendor/jquery-1.12.4.min.js') }}"></script><script src="{{ asset('eduread/js/assets/bootstrap.min.js') }}"></script><script src="{{ asset('eduread/js/assets/owl.carousel.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/jquery.themepunch.revolution.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/jquery.themepunch.tools.min.js') }}"></script><script src="{{ asset('eduread/js/assets/jquery.magnific-popup.min.js') }}"></script><script src="{{ asset('eduread/js/assets/jquery.sticky.js') }}"></script><script src="{{ asset('eduread/js/assets/jquery.counterup.min.js') }}"></script><script src="{{ asset('eduread/js/assets/waypoints.min.js') }}"></script><script src="{{ asset('eduread/js/assets/slick.min.js') }}"></script><script src="{{ asset('eduread/js/assets/jquery.meanmenu.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.actions.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.carousel.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.kenburn.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.layeranimation.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.migration.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.navigation.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.parallax.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.slideanims.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/extensions/revolution.extension.video.min.js') }}"></script><script src="{{ asset('eduread/js/assets/revolution/revolution.js') }}"></script><script src="{{ asset('eduread/js/custom.js') }}"></script>{{--<script src="{{ asset('js/site.js') }}" defer></script>--}}   </body></html>