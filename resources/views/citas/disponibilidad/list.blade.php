@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.citas') }}">Citas</a></li>
<li class="active">Disponibilidad</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: #162221 !important;">Disponibilidad - Programar Agenda</h3>
    <div class="well">
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="panel-info widget-shadow">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="citas">
                        <th>PERÍODO</th>
                        <th>FECHA INICIO</th>
                        <th>FECHA FIN</th>
                        <th>CONTINUAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periodos as $m)
                    <tr>
                        <td>{{$m->periodo}}</td>
                        <td>{{$m->fecha_inicio}}</td>
                        <td>{{$m->fecha_fin}}</td>
                        <td>
                            <a href="{{route('disponibilidad.edit',$m->id)}}" data-toggle="tooltip" title="Programar Agenda" class="btn btn-primary btn-xs"><i class="fa fa-arrow-right"></i> PROGRAMAR AGENDA</a>
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
                        <p>Seleccione el período para proceder a consultar o programar la agenda para las citas de orientación</p>
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