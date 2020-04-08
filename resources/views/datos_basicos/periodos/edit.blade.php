@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.datos_basicos') }}">Datos Generales</a></li>
<li><a href="{{ route('periodo.index') }}">Períodos</a></li>
<li class="active">Editar</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #287094 !important;">Editar Período</h3>
    <div class="well">
        <a href="{{route('periodo.index')}}" class="btn btn-primary"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos del Período</h4>
        </div>
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('periodo.update',$periodo->id)}}">
                @csrf
                <input name="_method" type="hidden" value="PUT" />
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="exampleInputEmail1">Nombre del Período*</label>
                        <input class="form-control" value="{{$periodo->periodo}}" type="text" required="required" name="periodo">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Fecha Inicial</label>
                        <input class="form-control" value="{{$periodo->fecha_inicio}}" type="date" name="fecha_inicio">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Fecha Final</label>
                        <input class="form-control" value="{{$periodo->fecha_fin}}" type="date" name="fecha_fin">
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
                        <p>Edite los datos de los Períodos, los Períodos indican los intervalos de tiempo para el que se desarrollan las actividades de la institución</p>
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
        $('#example1').DataTable();
        $('.select2').select2();
    });
</script>
@endsection