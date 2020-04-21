@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li><a href="{{ route('directorgrupo.index') }}">Directores de Grupo</a></li>
<li class="active">Crear</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Crear Directores</h3>
    <div class="well">
        <a href="{{route('directorgrupo.index')}}" class="btn btn-personal"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos del Docente Director de Grupo</h4>
        </div>
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('directorgrupo.store')}}">
                @csrf
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Docente Director*</label>
                        <select class="form-control select2" style="width: 100%;" name="docente_id">
                            <option value="0">-- Seleccione una opción --</option>
                            @foreach($personas as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Seleccione Período*</label>
                        <select class="form-control select2" style="width: 100%;" required="required" id="periodo" name="periodo_id">
                            <option value="0">-- Seleccione una opción --</option>
                            @foreach($periodos as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Seleccione Grado*</label>
                        <select class="form-control select2" style="width: 100%;" required="required" onchange="grupos()" id="grado" name="grado_id">
                            <option value="0">-- Seleccione una opción --</option>
                            @foreach($grados as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Grupo*</label>
                        <select class="form-control" style="width: 100%;" id="grupo" name="grupo_id">
                            <option value="0">-- Seleccione una opción --</option>
                        </select>
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
                        <p>Agregue nuevos Docentes Directores.</p>
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

    function grupos() {
        var g = $("#grado").val();
        var p = $("#periodo").val();
        $.ajax({
            type: 'GET',
            url: url + "datos_basicos/grupo/" + g + "/" + p + "/grupos",
            data: {},
        }).done(function(msg) {
            $('#grupo option').each(function() {
                $(this).remove();
            });
            if (msg !== "NO") {
                var m = JSON.parse(msg);
                $.each(m, function(index, item) {
                    console.log(item);
                    $("#grupo").append("<option value='" + item.id + "'>" + item.nombre + "</option>");
                });
            } else {
                notify('Atención', 'No hay grupos para los parámetros dados.', 'error');
            }
        });
    }
</script>
@endsection