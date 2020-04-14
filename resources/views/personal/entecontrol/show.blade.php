@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.personal') }}">Personal</a></li>
<li><a href="{{ route('entecontrol.index') }}">Entes de Control</a></li>
<li class="active">Ver Ente</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Ver Ente de Control</h3>
    <div class="well">
        <a href="{{route('entecontrol.index')}}" class="btn btn-personal"><i class="fa fa-reply-o"></i> Volver</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos del Ente</h4>
        </div>
        <div class="form-body">
            <table class="table table-hover">
                <tbody>
                    <tr class="read">
                        <td class="contact"><b>Id</b></td>
                        <td class="subject">{{$ente->id}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Tipo Documento</b></td>
                        <td class="subject">{{$ente->tipodoc->descripcion}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Número</b></td>
                        <td class="subject">{{$ente->numero_documento}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Lugar y Fecha de Expedición</b></td>
                        <td class="subject">{{$ente->lugar_expedicion." - ".$ente->fecha_expedicion}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Ente</b></td>
                        <td class="subject">{{$ente->razonsocial}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Número Resolución</b></td>
                        <td class="subject">{{$ente->numeroresolucion}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Representante Legal - Cargo</b></td>
                        <td class="subject">{{$ente->representantelegal." - ".$ente->cargorepresentante}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Dirección</b></td>
                        <td class="subject">{{$ente->direccion}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Correo</b></td>
                        <td class="subject">{{$ente->mail}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Teléfono</b></td>
                        <td class="subject">{{$ente->telefono}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Celular</b></td>
                        <td class="subject">{{$ente->celular}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Fax</b></td>
                        <td class="subject">{{$ente->fax}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Tipo Persona Jurídica</b></td>
                        <td class="subject">@if($ente->tipopersonaj!=null){{$ente->tipopersonaj->descripcion}}@endif</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Régimen</b></td>
                        <td class="subject">@if($ente->regimen!=null){{$ente->regimen->descripcion}}@endif</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Creado</b></td>
                        <td class="subject">{{$ente->created_at}}</td>
                    </tr>
                    <tr class="read">
                        <td class="contact"><b>Modificado</b></td>
                        <td class="subject">{{$ente->updated_at}}</td>
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