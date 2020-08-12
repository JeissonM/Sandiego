@extends('layouts.app')

@section('content')

<!-- main content start-->
<div id="page-wrapper" style="min-height: 400px !important;">
    <div class="main-page login-page " style="width: 85% !important;">
        <h3 class="title1">INSTITUCIÓN EDUCATIVA MANUEL RODRIGUEZ TORICES</h3>
        <div class="widget-shadow">
            <div class="login-top">
                <h4>Registro de Personal</h4>
                <img style="width: 100px; align-content: center; text-align: center;" src="{{asset('images/logo.jpeg')}}">
            </div>
            <div class="login-body">
                <div class="row" style="margin: 0 !important;">
                    <div class="col-md-12">
                        <form class="form" role='form' method="POST" action="{{route('registropublico.store')}}">
                            @csrf
                            <input type="hidden" name="source" value="{{$source}}" />
                            <h3 class="title1">REGISTRO DE {{$source}} - Datos Generales</h3>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Tipo Documento*</label>
                                        <select class="form-control select2" style="width: 100%;" required="required" name="tipodoc_id">
                                            <option value="0">-- Seleccione una opción --</option>
                                            @foreach($tipodocs as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Número Documento*</label>
                                        <input class="form-control" type="text" required="required" name="numero_documento">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Sexo*</label>
                                        <select class="form-control select2" style="width: 100%;" required="required" name="sexo">
                                            <option value="0">-- Seleccione una opción --</option>
                                            <option value="M">MASCULINO</option>
                                            <option value="F">FEMENINO</option>
                                            <option value="O">OTRO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label>Fecha Nacimiento</label>
                                        <input class="form-control" type="date" name="fecha_nacimiento">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Grupo y Factor Sanguíneo</label>
                                        <input class="form-control" type="text" name="rh">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Lugar de Expedición Doc.</label>
                                        <input class="form-control" type="text" name="lugar_expedicion">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Fecha Expedición Doc.</label>
                                        <input class="form-control" type="date" name="fecha_expedicion">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label>Primer Nombre*</label>
                                        <input class="form-control" type="text" required="required" name="primer_nombre">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Segundo Nombre</label>
                                        <input class="form-control" type="text" name="segundo_nombre">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Primer Apellido*</label>
                                        <input class="form-control" type="text" required="required" name="primer_apellido">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Segundo Apellido</label>
                                        <input class="form-control" type="text" name="segundo_apellido">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label>Dirección</label>
                                        <input class="form-control" type="text" name="direccion">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Correo</label>
                                        <input class="form-control" type="text" name="mail">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Celular</label>
                                        <input class="form-control" type="text" name="celular">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Teléfono</label>
                                        <input class="form-control" type="text" name="telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label>Libreta Militar Número</label>
                                        <input class="form-control" type="text" name="libreta_militar">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Clase de Libreta</label>
                                        <input class="form-control" type="text" name="clase_libreta">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Distrito Militar Nro.</label>
                                        <input class="form-control" type="text" name="distrito_militar">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Estado Civil</label>
                                        <select class="form-control select2" style="width: 100%;" name="estadocivil_id">
                                            <option value="0">-- Seleccione una opción --</option>
                                            @foreach($estados as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if($source=='DOCENTE')
                            <h3 class="title1">Datos Docente</h3>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Profesión*</label>
                                        <input class="form-control" type="text" required="required" name="profesion">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Fecha de Graduación</label>
                                        <input class="form-control" type="date" name="fecha_graduacion">
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($source=='ESTUDIANTE')
                            <h3 class="title1">Datos Estudiante</h3>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Desplazado*</label>
                                        <select class="form-control" style="width: 100%;" required name="desplazado">
                                            <option value="0">-- Seleccione una opción --</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">EPS*</label>
                                        <input class="form-control" type="text" required="required" name="eps">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Vive Con...</label>
                                        <input class="form-control" type="text" name="vive_con">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Grado*</label>
                                        <select class="form-control select2" style="width: 100%;" required name="grado_id">
                                            <option value="0">-- Seleccione una opción --</option>
                                            @foreach($grados as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <a href="{{url('/')}}" class="btn btn-danger"><i class="fa fa-fw fa-lg fa-reply"></i>Cancelar</a>
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-save"></i>Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<div class="footer">
    <p>&copy; 2020 {{ config('app.name') }}. Todos los derechos reservados</p>
</div>
<!--//footer-->
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $("#page-wrapper").removeAttr('style');
        $("#page-wrapper").css("min-height", "400px");
    });
</script>
@endsection