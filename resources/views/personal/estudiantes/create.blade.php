@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li><a href="{{ route('estudiante.index') }}">Estudiantes</a></li>
<li class="active">Crear</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Crear Estudiante</h3>
    <div class="well">
        <a href="{{route('estudiante.index')}}" class="btn btn-personal"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos del Estudiante</h4>
        </div>
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('estudiante.store')}}">
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>Desplazado*</label>
                            <select class="form-control" style="width: 100%;" required name="desplazado">
                                <option value="0">-- Seleccione una opción --</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">EPS*</label>
                            <input class="form-control" type="text" required="required" name="eps">
                        </div>
                        <div class="col-md-4">
                            <label>Vive Con...</label>
                            <input class="form-control" type="text" name="vive_con">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>Estudiante*</label>
                            <select class="form-control select2" style="width: 100%;" required name="personanatural_id">
                                <option value="0">-- Seleccione una opción --</option>
                                @foreach($personas as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Acudiente</label>
                            <select class="form-control select2" style="width: 100%;" name="padrefamilia_id">
                                <option value="0">-- Seleccione una opción --</option>
                                @if($padres!=null)
                                @foreach($padres as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Grado*</label>
                            <select class="form-control select2" style="width: 100%;" required name="grado_id">
                                <option value="0">-- Seleccione una opción --</option>
                                @foreach($grados as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-save"></i>Guardar</button>
                        </div>
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
                        <p>Agregue nuevos Estudiantes.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection