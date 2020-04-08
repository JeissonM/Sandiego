@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.usuarios') }}">Usuarios</a></li>
<li><a href="{{ route('grupousuario.index') }}">Grupos de Usuarios</a></li>
<li class="active">Ver Rol</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: red !important;">Ver Grupo</h3>
    <div class="well">
        <a href="{{route('grupousuario.index')}}" class="btn btn-danger"><i class="fa fa-reply-o"></i> Volver</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos del Grupo</h4>
        </div>
        <div class="form-body">
            <table class="table table-hover">
                <tbody>
                    <tr class="read">
                        <td class="contact"><b>Id del Grupo</b></td>
                        <td class="subject">{{$grupo->id}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Nombre</b></td>
                        <td class="subject">{{$grupo->nombre}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Descripción</b></td>
                        <td class="subject">{{$grupo->descripcion}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Cantidad de Usuarios en el Grupo</b></td>
                        <td class="subject">{{$total}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Creado</b></td>
                        <td class="subject">{{$grupo->created_at}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Modificado</b></td>
                        <td class="subject">{{$grupo->updated_at}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="alert alert-danger" role="alert">
                <h5>MÓDULOS A LOS QUE TIENE ACCESO EL GRUPO DE USUARIOS </h5>
            </div>
            <table class="table table-hover">
                <tbody>
                    @foreach($grupo->modulos as $modulo)
                    <tr class="read">
                        <td class="contact"><b>{{$modulo->nombre}}</b></td>
                        <td class="subject">{{$modulo->descripcion}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection