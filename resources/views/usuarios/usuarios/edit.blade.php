@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.usuarios') }}">Usuarios</a></li>
<li><a href="{{ route('usuario.index') }}">Usuarios</a></li>
<li class="active">Editar & Eliminar</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: red !important;">Editar/Eliminar Usuario</h3>
    <div class="well">
        <a href="{{route('menu.usuarios')}}" class="btn btn-danger"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('usuario.update',$user->id)}}">
                @csrf
                <input name="_method" type="hidden" value="PUT" />
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Identificación del Usuario</label>
                        <input type="text" name="identificacion" value="{{$user->identificacion}}" class="form-control" placeholder="Escriba el número de identificación del usuario, con éste tendrá acceso al sistema" required="required" />
                    </div>
                    <div class="form-group">
                        <label>Nombres del Usuario</label>
                        <input type="text" name="nombres" value="{{$user->nombres}}" class="form-control" placeholder="Escriba los nombres del usuario" required="required" />
                    </div>
                    <div class="form-group">
                        <label>Apellidos del Usuario</label>
                        <input type="text" name="apellidos" value="{{$user->apellidos}}" class="form-control" placeholder="Escriba los apellidos del usuario" required="required" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>E-mail del Usuario</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="Escriba el correo electrónico del usuario" required="required" />
                    </div>
                    <div class="form-group">
                        <label>Seleccione Estado del Usuario</label>
                        <select class="form-control" name="estado" required="required">
                            <option value="0">-- Seleccione una opción --</option>
                            @if($user->estado=='ACTIVO')
                            <option value="ACTIVO" selected>ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                            @else
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO" selected>INACTIVO</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Seleccione los Grupos o Roles de Usuarios</label>
                        <select class="form-control select2" name="grupos[]" required="required" multiple>
                            @foreach($grupos as $key=>$value)
                            <?php
                            $existe = false;
                            ?>
                            @foreach($user->grupousuarios as $g)
                            @if($g->id==$key)
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
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-save"></i>Guardar</button>
                        <a href="{{ route('usuario.delete',$user->id)}}" class="btn btn-danger"><i class="fa fa-fw fa-lg fa-trash-o"></i>Eliminar Usuario</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row-one" style="margin-top: 20px;">
    <h3 class="title1" style="color: red !important;"> Cambio de Contraseña</h3>
    <div class="panel-info widget-shadow">
        <form class="form" role="form" method="POST" action="{{route('usuario.cambiarPass')}}">
            @csrf
            <div class="col-md-12">
                <div class="form-group">
                    <label>Identificación del Usuario</label>
                    <input type="text" name="identificacion2" value="{{$user->identificacion}}" class="form-control" readonly required="required" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Escriba la Nueva Contraseña</label>
                    <input type="password" name="pass1" class="form-control" placeholder="Mínimo 6 caracteres" required="required" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Vuelva a Escribir La Nueva Contraseña</label>
                    <input type="password" name="pass2" class="form-control" placeholder="Mínimo 6 caracteres" required="required" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-save"></i>Guardar</button>
                </div>
            </div>
        </form>
        <div class="clearfix"> </div>
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
                        <p>Modifique o elimine un usuario del sistema. Además puede usted cambiar la contraseña al usuario.</p>
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