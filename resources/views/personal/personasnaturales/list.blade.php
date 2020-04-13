@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li class="active">Personas Naturales</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Personas Naturales</h3>
    <div class="well">
        <a href="{{route('personanatural.create')}}" class="btn btn-personal"><i class="fa fa-plus"></i> Crear Nuevo</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="panel-info widget-shadow">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="personal">
                        <th>IDENTIFICACIÓN</th>
                        <th>PERSONA</th>
                        <th>DIRECCIÓN</th>
                        <th>TELÉFONO</th>
                        <th>CORREO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personas as $m)
                    <tr>
                        <td>{{$m->tipodoc->abreviatura." - ".$m->numero_documento}}</td>
                        <td>{{$m->primer_nombre." ".$m->segundo_nombre." ".$m->primer_apellido." ".$m->segundo_apellido}}</td>
                        <td>{{$m->direccion}}</td>
                        <td>{{$m->telefono." - ".$m->celular}}</td>
                        <td>{{$m->mail}}</td>
                        <td>
                            <a href="{{route('personanatural.edit',$m->id)}}" data-toggle="tooltip" title="Editar Persona" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="{{route('personanatural.show',$m->id)}}" data-toggle="tooltip" title="Ver Persona" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                            <a href="{{route('personanatural.delete',$m->id)}}" data-toggle="tooltip" title="Eliminar Persona" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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
                        <p>Esta funcionalidad permite la gestión de las personas naturales (docentes, estudiantes, entes rectores, padres de familia, etc) de la institución.</p>
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
    });
</script>
@endsection