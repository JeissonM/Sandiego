@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.usuarios') }}">Usuarios</a></li>
<li><a href="{{ route('pagina.index') }}">Páginas</a></li>
<li class="active">Crear Página</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: red !important;">Crear Página</h3>
    <div class="well">
        <a href="{{route('pagina.index')}}" class="btn btn-danger"><i class="fa fa-reply-o"></i> Volver</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Datos de la Página</h4>
        </div>
        <div class="form-body">
            <form class="form" role='form' method="POST" action="{{route('pagina.store')}}">
                @csrf
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Nombre de la Página*</label>
                        <input class="form-control" type="text" required="required" name="nombre">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Descripción</label>
                        <input class="form-control" type="text" name="descripcion">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-save"></i>Guardar</button>
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
                        <p>Agregue nuevas páginas, el nombre de la página no debe llevar acentos, eñes (ñ) ni caracteres especiales, el nombre de la página debe iniciar con "PAG_" seguido del nombre que usted desee. Las paginas o ítems de los módulos del sistema son las funcionalidades más específicas o detalladas de los módulos. Ejemplo de página general: ESTUDIANTES, CIUDADES, DOCENTES, MATERIAS, ETC.</p>
                        <p><b>Nota:</b> No modifique los nombres de las páginas ya creadas ya que puede ocasionar fallas en el sistema.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
@endsection