@extends('layouts.app')

@section('content')

<!-- main content start-->
<div id="page-wrapper" style="min-height: 400px !important;">
    <div class="main-page login-page ">
        <h3 class="title1">INGRESAR AL SISTEMA {{ config('app.name') }}</h3>
        <div class="widget-shadow">
            <div class="login-top">
                <h4>Bienvenido a la administración del sistema {{ config('app.name') }} <br><a href="#"> Selecciona tu ROL para continuar</a> </h4>
            </div>
            <div class="login-body">
                <div class="row" style="margin: 0 !important;">
                    <div class="col-md-4">
                        <img style="width: 100%; align-content: center; text-align: center;" src="{{asset('images/logo.jpeg')}}">
                    </div>
                    <div class="col-md-8">
                        <form class="form-horizontal" method="POST" action="{{ route('rol') }}">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('grupos', 'Seleccione rol para Ingresar', ['class' => 'control-label'])!!}
                                    {!! Form::select('grupo',$grupos,null,['class'=>'form-control col-md-12','placeholder'=>'-- Seleccione una opción --','required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success" name="Sign In" value="Continuar">
                                </div>
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
        $("#page-wrapper").css("min-height", "540px");
    });
</script>
@endsection