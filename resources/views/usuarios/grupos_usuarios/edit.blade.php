@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.usuarios') }}">Usuarios</a></li>
<li><a href="{{ route('grupousuario.index') }}">Grupos de Usuarios</a></li>
<li class="active">Editar Grupo</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: red !important;">Editar Grupo</h3>
    <div class="well">
        <a href="{{route('grupousuario.index')}}" class="btn btn-danger"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos del Grupo</h4>
        </div>
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('grupousuario.update',$grupo->id)}}">
                @csrf
                <input name="_method" type="hidden" value="PUT" />
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Nombre del Grupo*</label>
                        <input class="form-control" value="{{$grupo->nombre}}" type="text" required="required" name="nombre">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Descripción</label>
                        <input class="form-control" value="{{$grupo->descripcion}}" type="text" name="descripcion">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Seleccione los Módulos a los que el Grupo Tendrá Acceso*</label>
                        <select class="form-control select2" multiple="multiple" style="width: 100%;" name="modulos[]">
                            <option value="0">-- Seleccione una opción --</option>
                            @foreach($modulos as $key=>$value)
                            <?php
                            $existe = false;
                            ?>
                            @foreach($grupo->modulos as $m)
                            @if($m->id==$key)
                            <?php
                            $existe = true;
                            ?>
                            @endif
                            @endforeach
                            @if($existe)
                            <option value="{{$key}}" selected>{{$value}}</option>
                            @else
                            <option value="{{$key}}">{{$value}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-save"></i>Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Información de Ayuda</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="alert alert-default" role="alert" style="text-align: justify;">
                        <p>Edite los datos de los grupos, los grupos de usuarios son los roles o agrupaciones de usuarios que permite asignarle privilegios a todo un conglomerado de usuarios que comparte funciones. Ejemplo de grupos de usuarios: ADMINISTRADORES, ESTUDIANTES, BIENESTAR, SISTEMAS, DOCENTES, ETC.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
        $('.select2').select2();
    });
</script>
@endsection