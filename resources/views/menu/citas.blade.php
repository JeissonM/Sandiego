@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li class="active">Citas</li>
@endsection

@section('content')
<div class="row-one">
    <h3 class="title1" style="color: #162221 !important;">Menú Citas</h3>
    <div class="panel-info widget-shadow">
        <div class="alert alert-citas" role="alert">
            <strong>Ayuda:</strong> En esta funcionalidad podrá gestionar la información relacionada con las citas desde agendar una cita hasta gestionar el proceso de la cita. Las tareas a las que puede acceder del módulo dependeran de su ROL
        </div>
        @if(session()->exists('PAG_CITAS-DISPONIBILIDAD'))
        <div class="col-md-4" style="padding: 10px;">
            <a href="{{route('disponibilidad.index')}}" class="btn btn-citas btn-raised btn-block btn-flat"> DISPONIBILIDAD</a>
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