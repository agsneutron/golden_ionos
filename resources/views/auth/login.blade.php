@extends('layouts.auth')


@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <img src="{{ asset('graphics/logo_md.png') }}" alt="" style="width: 90%">
                <h1 class="logo-name"></h1>
            </div>
            <h3>Bienvenido</h3>
            <p>Utilice su usuario y contraseña para acceder al sistema.</p>
            @if(env('PROFILE') == 'PRUEBAS')
            <div align="center">
                <h2 class="text-danger">PRUEBAS</h2>
            </div>
            @endif
            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Contraseña" required="">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Ingresar</button>
                <div class="form-group">
                    <a class="btn btn-white block full-width m-b" href="{{ url('/password/reset') }}">
                        Olvidaste tu contraseña?
                    </a>
                </div>
                <!--<a href="#"><small>¿Olvidaste tu contraseña?</small></a>-->
            </form>
            <p class="m-t">
                <p>
                    <b>
                        <a href="http://encodesystems.com.mx/" target="_blank" style="color: #fff">
                            Impulsado por<br>
                            <img src="{{ asset('graphics/logoEncode.png') }}" alt="" style="width: 30%">
                        </a>
                    </b>
                </p>
            </p>
        </div>
    </div>
@endsection
