@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li class="active">Datos Generales</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: #287094 !important;">Menú Datos Generales</h3>
    <div class="panel-info widget-shadow">
        <div class="alert alert-info" role="alert">
            <strong>Ayuda:</strong> En esta funcionalidad podrá configurar los datos generales necesarios para el funcionamiento de la aplicación. Estos datos pueden ser períodos académicos, grados, etc.
        </div>
        @if(session()->exists('PAG_DATOS-GENERALES-PERIODOS'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('periodo.index')}}" class="btn btn-primary btn-raised btn-block btn-flat"> PERÍODOS ACADÉMICOS</a>
        </div>
        @endif
        @if(session()->exists('PAG_DATOS-GENERALES-GRADOS'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('grado.index')}}" class="btn btn-primary btn-raised btn-block btn-flat"> GRADOS</a>
        </div>
        @endif
        @if(session()->exists('PAG_DATOS-GENERALES-ESTADO-CIVIL'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('estadocivil.index')}}" class="btn btn-primary btn-raised btn-block btn-flat"> ESTADOS CIVILES</a>
        </div>
        @endif
        @if(session()->exists('PAG_DATOS-GENERALES-GRUPOS'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('grupo.index')}}" class="btn btn-primary btn-raised btn-block btn-flat"> GRUPOS ACADÉMICOS (CURSOS)</a>
        </div>
        @endif
        @if(session()->exists('PAG_DATOS-GENERALES-REGIMEN'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('regimen.index')}}" class="btn btn-primary btn-raised btn-block btn-flat"> REGIMEN</a>
        </div>
        @endif
        @if(session()->exists('PAG_DATOS-GENERALES-TIPODOC'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('tipodoc.index')}}" class="btn btn-primary btn-raised btn-block btn-flat"> TIPOS DE DOCUMENTOS</a>
        </div>
        @endif
        @if(session()->exists('PAG_DATOS-GENERALES-TIPO-PERSONA-JURIDICA'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('tipopersonaj.index')}}" class="btn btn-primary btn-raised btn-block btn-flat"> TIPO DE PERSONA JURÍDICA</a>
        </div>
        @endif
        @if(session()->exists('PAG_DATOS-GENERALES-TIPOS-DE-CASOS'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('tipocaso.index')}}" class="btn btn-primary btn-raised btn-block btn-flat"> TIPOS DE CASOS</a>
        </div>
        @endif
        <div class="clearfix"> </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection