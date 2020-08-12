@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.datos_basicos') }}">Datos Generales</a></li>
<li class="active">Tipos de Casos</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: #287094 !important;">Tipos de Casos</h3>
    <div class="well">
        <a href="{{route('tipocaso.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Nuevo</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="panel-info widget-shadow">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="info">
                        <th>ID</th>
                        <th>TIPO DE CASO</th>
                        <th>NIVEL</th>
                        <th>CREADO</th>
                        <th>MODIFICADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipocasos as $m)
                    <tr>
                        <td>{{$m->id}}</td>
                        <td>{{$m->descripcion}}</td>
                        <td>{{$m->nivel}}</td>
                        <td>{{$m->created_at}}</td>
                        <td>{{$m->updated_at}}</td>
                        <td>
                            <a href="{{route('tipocaso.edit',$m->id)}}" data-toggle="tooltip" title="Editar Tipo de Caso" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="{{route('tipocaso.delete',$m->id)}}" data-toggle="tooltip" title="Eliminar Tipo de Caso" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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
                        <p>Esta funcionalidad permite la gestión de los Tipos de Casos o eventos que se pueden presentar en la institución. Están clasificados por niveles dónde el primer nivel contiene los casos de riesgo bajo, el segundo nivel los casos de riesgo medio y el tercer nivel los casos con un nivel de riesgo alto.</p>
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