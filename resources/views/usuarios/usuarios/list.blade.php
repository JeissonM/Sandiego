@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.usuarios') }}">Usuarios</a></li>
<li class="active">Usuarios</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: red !important;">Usuarios del Sistema</h3>
    <div class="panel-info widget-shadow">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="danger">
                        <th>IDENTIFICACIÓN</th>
                        <th>USUARIO</th>
                        <th>CORREO</th>
                        <th>ESTADO</th>
                        <th>ROLES</th>
                        <th>CREADO</th>
                        <th>MODIFICADO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->identificacion}}</td>
                        <td>{{$usuario->nombres}} {{$usuario->apellidos}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>@if($usuario->estado=='ACTIVO')<label class="label label-success">ACTIVO</label>@else<label class="label label-danger">INACTIVO</label>@endif</td>
                        <td>
                            @foreach($usuario->grupousuarios as $grupo)
                            {{$grupo->nombre}} -
                            @endforeach
                        </td>
                        <td>{{$usuario->created_at}}</td>
                        <td>{{$usuario->updated_at}}</td>
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
        $('#example1').DataTable();
    });
</script>
@endsection