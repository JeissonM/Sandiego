@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li class="active">Directores de Grupo</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Directores de Grupo</h3>
    <div class="well">
        <a href="{{route('directorgrupo.create')}}" class="btn btn-personal"><i class="fa fa-plus"></i> Crear Nuevo</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="panel-info widget-shadow">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="personal">
                        <th>DOCUMENTO</th>
                        <th>DOCENTE DIRECTOR</th>
                        <th>GRUPO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($directores ?? '' as $m)
                    <tr>
                        <td>{{$m->docente->personanatural->tipodoc->abreviatura." - ".$m->docente->personanatural->numero_documento}}</td>
                        <td>{{$m->docente->personanatural->primer_nombre." ".$m->docente->personanatural->segundo_nombre." ".$m->docente->personanatural->primer_apellido." ".$m->docente->personanatural->segundo_apellido}}</td>
                        <td>{{$m->grupo->nombre." - ".$m->grupo->grado->grado." - ".$m->grupo->periodo->periodo}}</td>
                        <td>
                            <a href="{{route('directorgrupo.delete',$m->id)}}" data-toggle="tooltip" title="Eliminar Director" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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
                        <p>Esta funcionalidad permite la gestión de los Docentes Directores de Grupo de la institución, la edición de los datos se realiza en <b>persona natural</b>, tenga en cuenta que al eliminar un director, no será quitada la información de persona natural ni de docente.</p>
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