@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li class="active">Personal</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: #ea4c89 !important;">Menú Personal</h3>
    <div class="panel-info widget-shadow">
        <div class="alert alert-personal" role="alert">
            <strong>Ayuda:</strong> En esta funcionalidad podrá gestionar la información de personas naturales y jurídicas de la institución. Las naturales pueden ser: docentes, coordinadores, psicoorientadores, padres de familia y acudientes, estudiantes, etc. Las personas jurídicas son los entes de control.
        </div>
        @if(session()->exists('PAG_PERSONAL-PERSONA-NATURAL'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('personanatural.index')}}" class="btn btn-personal btn-raised btn-block btn-flat"> PERSONAS NATURALES</a>
        </div>
        @endif
        @if(session()->exists('PAG_PERSONAL-PERSONA-JURIDICA'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('entecontrol.index')}}" class="btn btn-personal btn-raised btn-block btn-flat"> ENTES DE CONTROL</a>
        </div>
        @endif
        @if(session()->exists('PAG_PERSONAL-DOCENTES'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('docente.index')}}" class="btn btn-personal btn-raised btn-block btn-flat"> DOCENTES</a>
        </div>
        @endif
        @if(session()->exists('PAG_PERSONAL-ESTUDIANTES'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('estudiante.index')}}" class="btn btn-personal btn-raised btn-block btn-flat"> ESTUDIANTES</a>
        </div>
        @endif
        @if(session()->exists('PAG_PERSONAL-PADRES'))
        <div class="col-md-4" style="padding: 10px;">
            <a disabled class="btn btn-personal btn-raised btn-block btn-flat"> PADRES DE FAMILIA (ACUDIENTES)</a>
        </div>
        @endif
        @if(session()->exists('PAG_PERSONAL-DIRECTOR-GRUPO'))
        <div class="col-md-4" style="padding: 10px;">
            <a disabled class="btn btn-personal btn-raised btn-block btn-flat"> DIRECTOR DE GRUPO</a>
        </div>
        @endif
        @if(session()->exists('PAG_PERSONAL-COORDINADORES'))
        <div class="col-md-4" style="padding: 10px;">
            <a disabled class="btn btn-personal btn-raised btn-block btn-flat"> COORDINADORES</a>
        </div>
        @endif
        @if(session()->exists('PAG_PERSONAL-PSICOORIENTADOR'))
        <div class="col-md-4" style="padding: 10px;">
            <a disabled class="btn btn-personal btn-raised btn-block btn-flat"> ORIENTADORES ESCOLARES</a>
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