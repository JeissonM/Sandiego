@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.datos_basicos') }}">Datos Generales</a></li>
<li><a href="{{ route('tipocaso.index') }}">Tipos de Casos</a></li>
<li class="active">Crear</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #287094 !important;">Crear Tipo de Caso</h3>
    <div class="well">
        <a href="{{route('tipocaso.index')}}" class="btn btn-primary"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos del Tipo de Caso</h4>
        </div>
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('tipocaso.store')}}">
                @csrf
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Descripción del Tipo de Caso*</label>
                        <input class="form-control" type="text" required="required" name="descripcion">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Nivel*</label>
                        <select class="form-control" style="width: 100%;" name="nivel" required>
                            <option value="0">-- Seleccione una opción --</option>
                            @foreach($niveles as $key=>$value)
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
                        <p>Agregue nuevos Tipos de Casos.</p>
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