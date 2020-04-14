@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li><a href="{{ route('entecontrol.index') }}">Entes de Control</a></li>
<li class="active">Editar</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Editar Ente</h3>
    <div class="well">
        <a href="{{route('entecontrol.index')}}" class="btn btn-personal"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos del Ente</h4>
        </div>
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('entecontrol.update',$ente->id)}}">
                @csrf
                <input name="_method" type="hidden" value="PUT" />
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Tipo Documento*</label>
                            <select class="form-control select2" style="width: 100%;" required="required" name="tipodoc_id">
                                <option value="0">-- Seleccione una opción --</option>
                                @foreach($tipodocs as $key=>$value)
                                @if($ente->tipodoc_id==$key)
                                <option selected value="{{$key}}">{{$value}}</option>
                                @else
                                <option value="{{$key}}">{{$value}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Número Documento*</label>
                            <input class="form-control" value="{{$ente->numero_documento}}" type="text" required="required" name="numero_documento">
                        </div>
                        <div class="col-md-3">
                            <label>Lugar de Expedición Doc.</label>
                            <input class="form-control" type="text" value="{{$ente->lugar_expedicion}}" name="lugar_expedicion">
                        </div>
                        <div class="col-md-3">
                            <label>Fecha Expedición Doc.</label>
                            <input class="form-control" type="date" value="{{$ente->fecha_expedicion}}" name="fecha_expedicion">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Razón Social*</label>
                            <input class="form-control" value="{{$ente->razonsocial}}" type="text" required="required" name="razonsocial">
                        </div>
                        <div class="col-md-3">
                            <label>Número Resolución</label>
                            <input class="form-control" value="{{$ente->numeroresolucion}}" type="text" name="numeroresolucion">
                        </div>
                        <div class="col-md-3">
                            <label>Representante Legal*</label>
                            <input class="form-control" value="{{$ente->representantelegal}}" type="text" required="required" name="representantelegal">
                        </div>
                        <div class="col-md-3">
                            <label>Cargo Representante</label>
                            <input class="form-control" value="{{$ente->cargorepresentante}}" type="text" name="cargorepresentante">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Dirección</label>
                            <input class="form-control" value="{{$ente->direccion}}" type="text" name="direccion">
                        </div>
                        <div class="col-md-3">
                            <label>Correo</label>
                            <input class="form-control" value="{{$ente->mail}}" type="text" name="mail">
                        </div>
                        <div class="col-md-3">
                            <label>Celular</label>
                            <input class="form-control" value="{{$ente->celular}}" type="text" name="celular">
                        </div>
                        <div class="col-md-3">
                            <label>Teléfono</label>
                            <input class="form-control" value="{{$ente->telefono}}" type="text" name="telefono">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>Fax</label>
                            <input class="form-control" type="text" name="fax">
                        </div>
                        <div class="col-md-4">
                            <label>Tipo de Persona Jurídica</label>
                            <select class="form-control select2" style="width: 100%;" name="tipopersonaj_id">
                                <option value="0">-- Seleccione una opción --</option>
                                @foreach($tipopjs as $key=>$value)
                                @if($ente->tipopersonaj_id==$key)
                                <option selected value="{{$key}}">{{$value}}</option>
                                @else
                                <option value="{{$key}}">{{$value}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Régimen</label>
                            <select class="form-control select2" style="width: 100%;" name="regimen_id">
                                <option value="0">-- Seleccione una opción --</option>
                                @foreach($regimens as $key=>$value)
                                @if($ente->regimen_id==$key)
                                <option selected value="{{$key}}">{{$value}}</option>
                                @else
                                <option value="{{$key}}">{{$value}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
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
                        <p>Edite los datos de los entes, los Entes de Control son los hospitales, secreatarías de salud, bomberos, policía, etc.</p>
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