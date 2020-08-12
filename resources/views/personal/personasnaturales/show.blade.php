@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li><a href="{{ route('personanatural.index') }}">Personas Naturales</a></li>
<li class="active">Ver Persona</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Ver Persona Natural</h3>
    <div class="well">
        <a href="{{route('personanatural.index')}}" class="btn btn-personal"><i class="fa fa-reply-o"></i> Volver</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos de la Persona</h4>
        </div>
        <div class="form-body">
            <table class="table table-hover">
                <tbody>
                    <tr class="read">
                        <td class="contact"><b>Id</b></td>
                        <td class="subject">{{$persona->id}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Tipo Documento</b></td>
                        <td class="subject">{{$persona->tipodoc->descripcion}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Número</b></td>
                        <td class="subject">{{$persona->numero_documento}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Lugar y Fecha de Expedición</b></td>
                        <td class="subject">{{$persona->lugar_expedicion." - ".$persona->fecha_expedicion}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Persona</b></td>
                        <td class="subject">{{$persona->primer_nombre." ".$persona->segundo_nombre." ".$persona->primer_apellido." ".$persona->segundo_apellido}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Sexo y Tipo Sanguíneo</b></td>
                        <td class="subject">{{$persona->sexo." - ".$persona->rh}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Dirección</b></td>
                        <td class="subject">{{$persona->direccion}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Correo</b></td>
                        <td class="subject">{{$persona->mail}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Teléfono</b></td>
                        <td class="subject">{{$persona->telefono}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Celular/b></td>
                        <td class="subject">{{$persona->celular}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Fecha Nacimiento</b></td>
                        <td class="subject">{{$persona->fecha_nacimiento}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Estado Civil</b></td>
                        <td class="subject">@if($persona->estadocivil!=null){{$persona->estadocivil->descripcion}}@else ---- @endif</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Libreta Militar</b></td>
                        <td class="subject">{{$persona->libreta_militar." - ".$persona->distrito_militar." - ".$persona->clase_libreta}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Creado</b></td>
                        <td class="subject">{{$persona->created_at}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Modificado</b></td>
                        <td class="subject">{{$persona->updated_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection