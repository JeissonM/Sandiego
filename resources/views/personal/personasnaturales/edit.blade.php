@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li><a href="{{ route('personanatural.index') }}">Personas Naturales</a></li>
<li class="active">Editar</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Editar Persona</h3>
    <div class="well">
        <a href="{{route('personanatural.index')}}" class="btn btn-personal"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos de la Persona</h4>
        </div>
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('personanatural.update',$persona->id)}}">
                @csrf
                <input name="_method" type="hidden" value="PUT" />
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>Tipo Documento*</label>
                            <select class="form-control select2" style="width: 100%;" required="required" name="tipodoc_id">
                                <option value="0">-- Seleccione una opción --</option>
                                @foreach($tipodocs as $key=>$value)
                                @if($persona->tipodoc_id==$key)
                                <option selected value="{{$key}}">{{$value}}</option>
                                @else
                                <option value="{{$key}}">{{$value}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Número Documento*</label>
                            <input class="form-control" value="{{$persona->numero_documento}}" type="text" required="required" name="numero_documento">
                        </div>
                        <div class="col-md-4">
                            <label>Sexo*</label>
                            <select class="form-control select2" style="width: 100%;" required="required" name="sexo">
                                <option value="0">-- Seleccione una opción --</option>
                                @foreach($sexos as $key=>$value)
                                @if($persona->sexo==$key)
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
                        <div class="col-md-3">
                            <label>Fecha Nacimiento</label>
                            <input class="form-control" value="{{$persona->fecha_nacimiento}}" type="date" name="fecha_nacimiento">
                        </div>
                        <div class="col-md-3">
                            <label>Grupo y Factor Sanguíneo</label>
                            <input class="form-control" value="{{$persona->rh}}" type="text" name="rh">
                        </div>
                        <div class="col-md-3">
                            <label>Lugar de Expedición Doc.</label>
                            <input class="form-control" value="{{$persona->lugar_expedicion}}" type="text" name="lugar_expedicion">
                        </div>
                        <div class="col-md-3">
                            <label>Fecha Expedición Doc.</label>
                            <input class="form-control" value="{{$persona->fecha_expedicion}}" type="date" name="fecha_expedicion">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Primer Nombre*</label>
                            <input class="form-control" value="{{$persona->primer_nombre}}" type="text" required="required" name="primer_nombre">
                        </div>
                        <div class="col-md-3">
                            <label>Segundo Nombre</label>
                            <input class="form-control" value="{{$persona->segundo_nombre}}" type="text" name="segundo_nombre">
                        </div>
                        <div class="col-md-3">
                            <label>Primer Apellido*</label>
                            <input class="form-control" value="{{$persona->primer_apellido}}" type="text" required="required" name="primer_apellido">
                        </div>
                        <div class="col-md-3">
                            <label>Segundo Apellido</label>
                            <input class="form-control" value="{{$persona->segundo_apellido}}" type="text" name="segundo_apellido">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Dirección</label>
                            <input class="form-control" value="{{$persona->direccion}}" type="text" name="direccion">
                        </div>
                        <div class="col-md-3">
                            <label>Correo</label>
                            <input class="form-control" value="{{$persona->mail}}" type="text" name="mail">
                        </div>
                        <div class="col-md-3">
                            <label>Celular</label>
                            <input class="form-control" value="{{$persona->celular}}" type="text" name="celular">
                        </div>
                        <div class="col-md-3">
                            <label>Teléfono</label>
                            <input class="form-control" value="{{$persona->telefono}}" type="text" name="telefono">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Libreta Militar Número</label>
                            <input class="form-control" value="{{$persona->libreta_militar}}" type="text" name="libreta_militar">
                        </div>
                        <div class="col-md-3">
                            <label>Clase de Libreta</label>
                            <input class="form-control" value="{{$persona->clase_libreta}}" type="text" name="clase_libreta">
                        </div>
                        <div class="col-md-3">
                            <label>Distrito Militar Nro.</label>
                            <input class="form-control" value="{{$persona->distrito_militar}}" type="text" name="distrito_militar">
                        </div>
                        <div class="col-md-3">
                            <label>Estado Civil</label>
                            <select class="form-control select2" style="width: 100%;" name="estadocivil_id">
                                <option value="0">-- Seleccione una opción --</option>
                                @foreach($estados as $key=>$value)
                                @if($persona->estadocivil_id==$key)
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
                        <p>Edite los datos de las Personas, las personas naturales son los estudiantes, entes rectores, docentes, padres de familia, entre otros de la institución.</p>.</p>
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