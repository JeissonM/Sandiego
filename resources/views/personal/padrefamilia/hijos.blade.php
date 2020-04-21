@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li><a href="{{ route('padrefamilia.index') }}">Padres de Familia</a></li>
<li><a href="{{ route('padrefamilia.hijos',$padre->id) }}">Hijos</a></li>
<li class="active">Gestionar</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Gestionar Hijos</h3>
    <div class="well">
        <a class="btn btn-personal" data-toggle="modal" data-target="#gridSystemModal1"><i class="fa fa-plus"></i> Agregar Hijo</a>
        <a href="{{route('padrefamilia.index')}}" class="btn btn-personal"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="panel-info widget-shadow">
        <div class="form-title" style="margin-bottom: 20px;">
            <h4>Listado de HIJOS</h4>
        </div>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="personal">
                        <th>DOCUMENTO</th>
                        <th>HIJO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hijos as $m)
                    <tr>
                        <td>{{$m->estudiante->personanatural->tipodoc->abreviatura." - ".$m->estudiante->personanatural->numero_documento}}</td>
                        <td>{{$m->estudiante->personanatural->primer_nombre." ".$m->estudiante->personanatural->segundo_nombre." ".$m->estudiante->personanatural->primer_apellido." ".$m->estudiante->personanatural->segundo_apellido}}</td>
                        <td>
                            <a href="{{route('padrefamilia.removehijo',[$padre->id,$m->id])}}" data-toggle="tooltip" title="Eliminar Hijo" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                        <p>Esta funcionalidad permite especificar el listado de hijos de un padre de familia.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="gridSystemModal1" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Información de Ayuda</h4>
            </div>
            <div class="modal-body">
                <div class="form-title" style="margin-bottom: 20px;">
                    <h4>Busque su Hijo y presione adicionar</h4>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="personal">
                                    <th>DOCUMENTO</th>
                                    <th>ESTUDIANTE</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personas as $key=>$p)
                                <tr>
                                    <td>{{$p->personanatural->tipodoc->abreviatura." - ".$p->personanatural->numero_documento}}</td>
                                    <td>{{$p->personanatural->primer_nombre." ".$p->personanatural->segundo_nombre." ".$p->personanatural->primer_apellido." ".$p->personanatural->segundo_apellido}}</td>
                                    <td>
                                        <a href="{{route('padrefamilia.addhijo',[$padre->id,$key])}}" data-toggle="tooltip" title="Agregar Hijo" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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