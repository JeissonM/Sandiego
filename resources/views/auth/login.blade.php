@extends('layouts.app')

@section('content')

<!-- main content start-->
<div id="page-wrapper" style="min-height: 400px !important;">
    <div class="main-page login-page ">
        <h3 class="title1">INGRESAR AL SISTEMA {{ config('app.name') }}</h3>
        <div class="widget-shadow">
            <div class="login-top">
                <h4>Bienvenido a la administración del sistema {{ config('app.name') }} <br> ¿No tiene una cuenta? <a href="{{url('/')}}"> Regístrese »</a> </h4>
            </div>
            <div class="login-body">
                <div class="row" style="margin: 0 !important;">
                    <div class="col-md-4">
                        <img style="width: 100%; align-content: center; text-align: center;" src="{{asset('images/logo.jpeg')}}" >
                    </div>
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="number" class="user  @error('identificacion') is-invalid @enderror" name="identificacion" value="{{ old('identificacion') }}" required autocomplete="identificacion" autofocus placeholder="Identificación...">
                            @error('identificacion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input placeholder="Contraseña..." id="password" type="password" class="lock @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="submit" class="btn btn-success" name="Sign In" value="Ingresar al Sistema">
                            <div class="forgot-grid">
                                <label class="checkbox"><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><i></i>Recordarme</label>
                                @if (Route::has('password.request'))
                                <div class="forgot">
                                    <a href="{{ route('password.request') }}">¿Olvidaste la contraseña?</a>
                                </div>
                                @endif
                                <div class="clearfix"> </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<div class="footer">
    <p>&copy; 2020 {{ config('app.name') }}. Todos los derechos reservados</p>
</div>
<!--//footer-->
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $("#page-wrapper").removeAttr('style');
        $("#page-wrapper").css("min-height", "400px");
    });
</script>
@endsection