@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.usuarios') }}">Usuarios</a></li>
<li><a href="{{ route('usuario.index') }}">Usuarios</a></li>
<li class="active">Crear</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: red !important;">Crear Usuario</h3>
    <div class="well">
        <a href="{{route('usuario.index')}}" class="btn btn-danger"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos del Usuario</h4>
        </div>
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('usuario.store')}}">
                @csrf
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Identificacion del Usuario</label>
                        <input class="form-control" type="text" name="identificacion" required="required" id="identificacion">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nombres del Usuario</label>
                        <input class="form-control" type="text" name="nombres" required="required" id="txt_nombres">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Apellidos del Usuario</label>
                        <input class="form-control" type="text" name="apellidos" required="required" id="txt_apellidos">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>E-mail del Usuario</label>
                        <input class="form-control" type="email" name="email" required="required" id="txt_email">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Seleccione el Estado del Usuario</label>
                        <select class="form-control" required="required" name="estado">
                            <option value="0">-- Seleccione una opción --</option>
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Contraseña del Usuario</label>
                        <input class="form-control" type="password" name="password" required="required">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Seleccione los Grupos o Roles</label>
                        <select class="form-control select2" multiple="multiple" style="width: 100%;" required="required" name="grupos[]">
                            <option value="0">-- Seleccione una opción --</option>
                            @foreach($grupos as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
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
                        <p>Agregue un usuario al sistema y registre su/sus roles de acceso. Puede crear un usuario llenando todos los campos, a partir de las personas generales ó partiendo de un estudiante.</p>
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