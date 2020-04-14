@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li class="active">Entes de Control</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Entes de Control</h3>
    <div class="well">
        <a href="{{route('entecontrol.create')}}" class="btn btn-personal"><i class="fa fa-plus"></i> Crear Nuevo</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="panel-info widget-shadow">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="personal">
                        <th>REPRESENTANTE LEGAL</th>
                        <th>ENTE</th>
                        <th>DIRECCIÓN</th>
                        <th>TELÉFONO</th>
                        <th>CORREO</th>
                        <th>RÉGIMEN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entes as $m)
                    <tr>
                        <td>{{$m->representantelegal}}</td>
                        <td>{{$m->razonsocial}}</td>
                        <td>{{$m->direccion}}</td>
                        <td>{{$m->telefono." - ".$m->celular}}</td>
                        <td>{{$m->mail}}</td>
                        <td>@if($m->regimen!=null)
                            {{$m->regimen->descripcion}}
                            @endif
                        </td>
                        <td>
                            <a href="{{route('entecontrol.edit',$m->id)}}" data-toggle="tooltip" title="Editar Ente" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="{{route('entecontrol.show',$m->id)}}" data-toggle="tooltip" title="Ver Ente" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                            <a href="{{route('entecontrol.delete',$m->id)}}" data-toggle="tooltip" title="Eliminar Ente" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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
                        <p>Esta funcionalidad permite la gestión de los Entes de Control (hospitales, secreatarías de salud, bomberos, policía, etc).</p>
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