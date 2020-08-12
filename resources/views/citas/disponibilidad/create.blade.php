@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.citas') }}">Citas</a></li>
<li><a href="{{ route('disponibilidad.index') }}">Disponibilidad</a></li>
<li><a href="{{ route('disponibilidad.edit',$per->id) }}">Fechas Programadas</a></li>
<li class="active">Crear Fechas</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #162221 !important;">Crear Fechas</h3>
    <div class="well">
        <a href="{{route('disponibilidad.edit',$per->id)}}" class="btn btn-citas"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Fechas Nuevas</h4>
        </div>
        <div class="form-body">
            <h3 style="background-color: #ebefef; text-align: left; border-left: 10px solid; border-color: #0c845b; padding: 20px;">Período: {{$per->periodo}}</h3>
            <br>
            <form class="form" role='form' method="POST" action="{{route('disponibilidad.store')}}">
                @csrf
                <input type="hidden" value="{{$per->id}}" name="periodo_id" />
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha a Programar</label>
                        <input class="form-control" type="date" required="required" name="fecha">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hora Inicio (Formato 24 Horas, sin los 2 puntos ":", ejemplo: 0800)</label>
                        <input class="form-control" type="text" placeholder="Hora en que da inicio la cita" maxlength="4" name="horainicio" id="horainicio">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hora Fin (Formato 24 Horas, sin los 2 puntos ":", ejemplo 1400)</label>
                        <input class="form-control" type="text" placeholder="Hora en que da fin la cita" maxlength="4" name="horafin" id="horafin">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>.</label>
                        <button class="btn btn-success icon-btn pull-left btn-block" type="button" onclick="add()"><i class="fa fa-fw fa-lg fa-plus-square-o"></i>Agregar Horario</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4 style="background-color: #ebefef; text-align: left; border-left: 10px solid; border-color: #0c845b; padding: 20px;">Lista de horarios para la fecha seleccionada</h4>
                    <br>
                    <div class="table-responsive">
                        <table id="fechasf" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="citas">
                                    <th>HORA INICIO</th>
                                    <th>HORA FIN</th>
                                    <th>RETIRAR</th>
                                </tr>
                            </thead>
                            <tbody id="fechas">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
                        <button class="btn btn-success icon-btn pull-left" type="submit"><i class="fa fa-fw fa-lg fa-save"></i>Guardar</button>
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

    $(document).on('click', '.borrar', function(event) {
        event.preventDefault();
        $(this).closest('tr').remove();
    });

    function add() {
        var hi = $("#horainicio").val();
        var hf = $("#horafin").val();
        if (hi.length !== 4 || hf.length !== 4) {
            notify('Error', 'Las horas deben tener 4 caracteres!', 'error');
        } else if (hi.length == 0 || hf.length == 0) {
            notify('Error', 'No debe dejar las horas vacías!', 'error');
        } else if (hi >= hf) {
            notify('Error', 'La hora final debe ser mayor a la hora inicial!', 'error');
        } else {
            var html = "<tr><td><input type='text' name='hora_inicio[]' value='" + hi + "' class='form-control' /></td><td><input type='text' name='hora_fin[]' value='" + hf + "' class='form-control' /></td><td><a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Quitar Horario' class='btn borrar'><i class='fa fa-trash-o'></i></a></td></tr>";
            $('#fechasf tbody').append(html);
        }
    }
</script>
@endsection