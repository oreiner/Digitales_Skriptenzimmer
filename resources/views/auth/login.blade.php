@extends('layouts.login')
@section('title', 'Login')
@section('content')
    <!-- Teachers Area section -->
    <section class="login-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form method="POST" action="{{ route('login') }}" class="learnpro-register-form text-center">
                        @csrf
                        <p class="lead">Willkommen zurück</p>

                        @if(session()->has('login_error'))
                            <div class="alert alert-danger">
                                {{ session()->get('login_error') }}
                            </div>
                        @endif



                        <div class="form-group">
                            <input id="identity" type="text" class="required form-control{{ $errors->has('identity') ? ' is-invalid' : '' }}" name="identity" value="{{ old('identity') }}" required autofocus   autocomplete="off"  placeholder="Benutzername oder E-Mail-Adresse *">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input  name="password" type="password" id="password"  placeholder="Passwort *" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>  @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif</div>
                        <div class="form-group register-btn">
                             <submit class="btn btn-primary btn-lg" onclick="$(this).closest('form').submit();">Login</submit>
                        </div>
                        <p>Noch nicht registriert? <a href="{{route('register')}}"><strong>registriere dich heute</strong></a></p>
						<p>Passwort vergessen? <a href="{{route('password.request')}}"><strong>passwort zurücksetzen</strong></a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
