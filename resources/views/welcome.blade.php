@extends('layouts.app2')

@section('content')

<!-- main content start-->
<div id="page-wrapper">
    <div class="main-page login-page ">
        <h3 class="title1">INSTITUCIÓN EDUCATIVA MANUEL RODRIGUEZ TORICES</h3>
        <div class="widget-shadow">
            <div class="login-top">
                <h4>Bienvenido a la administración del sistema {{ config('app.name') }} <br><a href="#"> Selecciona una acción para continuar</a> </h4>
            </div>
            <div class="login-body">
                @include('flash::message')
                <div class="row" style="margin: 0 !important;">
                    <div class="col-md-4">
                        <img style="width: 100%; align-content: center; text-align: center;" src="{{asset('images/logo.jpeg')}}">
                    </div>
                    <div class="col-md-8">
                        <a href="{{route('login')}}" class="btn btn-success btn-block">Ingresar al Sistema</a>
                        <a href="{{route('registropublico.crear','DOCENTE')}}" class="btn btn-success btn-block">Registrarme Como Docente</a>
                        <a href="{{route('registropublico.crear','PADRE-DE-FAMILIA')}}" class="btn btn-success btn-block">Registrarme Como Padre de Familia</a>
                        <a href="{{route('registropublico.crear','ESTUDIANTE')}}" class="btn btn-success btn-block">Registrarme Como Estudiante</a>
                        <a href="{{route('registropublico.crear','PERSONA-NATURAL')}}" class="btn btn-success btn-block">Registrarme Como Persona Natural Para Otros Fines</a>
                    </div>
                    <div class="col-md-12">
                        <p>&copy; 2020 {{ config('app.name') }}. Todos los derechos reservados</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        //$("#page-wrapper").removeAttr('style');
        //$("#page-wrapper").css("min-height", "0");
    });
</script>
@endsection