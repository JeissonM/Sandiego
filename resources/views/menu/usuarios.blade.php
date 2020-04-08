@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li class="active">Usuarios</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: red !important;">Menú Usuarios del Sistema</h3>
    <div class="panel-info widget-shadow">
        <div class="alert alert-danger" role="alert">
            <strong>Ayuda:</strong> En esta funcionalidad podrá configurar los módulos u opciones de menú de la aplicación, definir las páginas o botones de los menús, crear usuarios y grupos de usuarios(roles), asignar permisos y realizar operaciones generales sobre los usuarios.
        </div>
        @if(session()->exists('PAG_MODULOS'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('modulo.index')}}" class="btn btn-danger btn-raised btn-block btn-flat"> MÓDULOS DEL SISTEMA</a>
        </div>
        @endif
        @if(session()->exists('PAG_PAGINAS'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('pagina.index')}}" class="btn btn-danger btn-raised btn-block btn-flat"> PÁGINAS DEL SISTEMA</a>
        </div>
        @endif
        @if(session()->exists('PAG_GRUPOS-ROLES'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('grupousuario.index')}}" class="btn btn-danger btn-raised btn-block btn-flat"> GRUPOS DE USUARIOS(ROLES)</a>
        </div>
        @endif
        @if(session()->exists('PAG_PRIVILEGIOS'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('grupousuario.privilegios')}}" class="btn btn-danger btn-raised btn-block btn-flat"> PRIVILEGIOS A PÁGINAS</a>
        </div>
        @endif
        @if(session()->exists('PAG_USUARIOS'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('usuario.index')}}" class="btn btn-danger btn-raised btn-block btn-flat" data-toggle="tooltip" data-placement="left" data-original-title="Tenga en cuenta que al cargar gran cantidad de registros puede hacer que el navegador se bloquee y deba esperar a que este cargue todos los registros de la base de datos para continuar la navegación."> LISTAR TODOS LOS USUARIOS</a>
        </div>
        @endif
        @if(session()->exists('PAG_USUARIO-MANUAL'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('usuario.create')}}" class="btn btn-danger btn-raised btn-block btn-flat"> CREAR USUARIO</a>
        </div>
        @endif
        <div class="clearfix"> </div>
    </div>
</div>
@if(session()->exists('PAG_OPERACIONES-USUARIO'))
<div class="row-one" style="margin-top: 20px;">
    <h3 class="title1" style="color: red !important;">Modificación, Eliminación de Usuarios & Cambio de Contraseña</h3>
    <div class="panel-info widget-shadow">
        <form class="form" role="form" method="POST" action="{{route('usuario.operaciones')}}">
            @csrf
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" id="id" name="id" class="form-control" placeholder="Escriba la identificación a consultar" />
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-danger icon-btn pull-left btn-raised btn-block" type="submit"><i class="fa fa-fw fa-lg fa-search"></i>Consultar Usuario</button>
            </div>
        </form>
        <div class="clearfix"> </div>
    </div>
</div>
@endif
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection