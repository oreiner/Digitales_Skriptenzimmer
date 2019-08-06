<nav class="navbar edu-navbar">
    <div class="container">
        <div class="navbar-header">			<!--
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>			-->
            <a href="{{url('/')}}" class="navbar-brand  data-scroll"><img src="{{url('images/logo.png')}}" alt=""><span>Skriptenzimmer Köln</span></a>
        </div>

        <div class="collapse navbar-collapse edu-nav main-menu" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right">
                <li class="active"><a href="{{url('/')}}" data-scroll >Startseite</a></li>
				@guest
				<li><a data-scroll href="{{url('register')}}">Registrierung</a></li>
				<li><a data-scroll href="{{url('login')}}">Anmeldung</a></li>
				@else
				<li><a data-scroll href="{{url('mailpdf')}}">Protokolle</a></li>
				<li><a data-scroll href="{{url('download')}}">Skripte</a></li>
				<li><a data-scroll href="{{url('profile')}}">Profil</a></li>
				@endguest
				<li><a data-scroll href="{{url('terms')}}">AGB</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>