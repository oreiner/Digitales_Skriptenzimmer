@extends('admin.layouts.login')
@section('title','Login')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/admin')}}"><b>Skripte.Koeln</b></a>

        </div>
        @if(session()->has('login_error'))
            <div class="alert alert-danger">
                {{ session()->get('login_error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Administrator-Anmeldung</p>
                <form method="POST" action="{{ url('/admin/login') }}">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ old('email') }}" required autofocus placeholder="E-Mail-Adresse or Benutzername *">
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="
						*">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Passwort merken
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Einloggen</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

@endsection
