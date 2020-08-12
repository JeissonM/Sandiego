@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.citas') }}">Citas</a></li>
<li><a href="{{ route('disponibilidad.index') }}">Disponibilidad</a></li>
<li class="active">Fechas Programadas</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #162221 !important;">Fechas Programadas</h3>
    <div class="well">
        <a href="{{route('disponibilidad.crear',$per->id)}}" class="btn btn-citas"><i class="fa fa-plus"></i> Agregar Fechas</a>
        <a href="{{route('disponibilidad.index')}}" class="btn btn-citas"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Listado de Fechas Programadas en el Período</h4>
        </div>
        <div class="form-body">
            <h3 style="background-color: #ebefef; text-align: left; border-left: 10px solid; border-color: #0c845b; padding: 20px;">Período: {{$per->periodo}}</h3>
            <br>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="citas">
                            <th>FECHA</th>
                            <th>HORA INICIO</th>
                            <th>HORA FIN</th>
                            <th>ESTADO</th>
                            <th>RETIRAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agenda as $a)
                        <tr>
                            <td>{{$a->fecha}}</td>
                            <td>{{$a->horainicio}}</td>
                            <td>{{$a->horafin}}</td>
                            <td>{{$a->estado}}</td>
                            <td>
                                <a href="{{route('disponibilidad.delete',$a->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Eliminar Horario"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                        <p>En éste apartado realice la asignación de fechas y horas para la realización de las citas de seguimiento disciplinario. Es a partir de estas fechas donde los diferentes roles podrán elegir el día y la hora para la cita.</p>
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
        $('#example1').DataTable();
    });
</script>
@endsection