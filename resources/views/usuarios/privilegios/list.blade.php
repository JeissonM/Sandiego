@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
<li><a href="{{ route('menu.usuarios') }}">Usuarios</a></li>
<li class="active">Privilegios</li>
@endsection

@section('content')
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="row-one">
    <h3 class="title1" style="color: red !important;">Administrar Privilegios</h3>
    <div class="well">
        <a class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-question"></i> Ayuda</a>
    </div>
    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
        <div class="form-title">
            <h4>Privilegios a Grupo</h4>
        </div>
        <div class="form-body">
            <div class="form-group">
                <div class="col-md-12">
                    <label>Seleccione Grupo o Rol de Usuario</label>
                    <select class="form-control" onchange="traerData()" id="grupousuario_id">
                        <option value="0">-- Seleccione una opción --</option>
                        @foreach($grupos as $key=>$value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5" style="margin-top: 20px;">
                <div class="alert alert-danger" role="alert">
                    <h2>Páginas del Sistema</h2>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <select class="form-control" name="paginas[]" multiple="multiple" size="20" id="paginas" style="height: 400px !important;">
                            @foreach($paginas as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="margin-top: 10%;">
                <center>
                    <button type="button" class="btn btn-success btn-block" onclick="agregar()"> Agregar </button>
                    <button type="button" class="btn btn-danger btn-block" onclick="retirar()"> Quitar </button>
                    <button type="button" class="btn btn-success btn-block" onclick="agregarTodas()"> Agregar Todo </button>
                    <button type="button" class="btn btn-danger btn-block" onclick="retirarTodas()"> Quitar Todo </button>
                </center>
            </div>
            <div class="col-md-5" style="margin-top: 20px;">
                <div class="alert alert-danger" role="alert">
                    <h2>Privilegios del Grupo</h2>
                </div>
                <form class="form" role='form' method="POST" action="{{route('grupousuario.guardar')}}" id="form-privilegios">
                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <div class="form-group">
                        <div class="col-md-12">
                            <select class="form-control" name="privilegios[]" id="privilegios" multiple="multiple" size="20" style="height: 400px !important;" required="required"></select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <br /><button type="submit" id="btn-enviar" class="btn btn-primary btn-flat btn-raised btn-block">Guardar los Cambios Para el Grupo Seleccionado</button>
                        </div>
                    </div>
                </form>
            </div>
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
                        <P>Los privilegios a páginas son los permisos que se deben asignar a los grupos de usuarios o roles para acceder a las funciones específicas de los módulos, es decir, sus páginas. En este sentido, si añade páginas a un grupo de usuario usted le estaría concediendo permisos al grupo para actuar sobre dichas páginas.</P>
                        <P><b>Modo de Operar:</b> Seleccione un grupo de usuario y agregue permisos de izquierda a derecha o elimine privilegios del grupo pasando de derecha a izquierda.</P>
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
        $("#btn-enviar").click(function(e) {
            validar(e);
        });
        $('#example1').DataTable();
        $("#body").attr('class', 'cbp-spmenu-push cbp-spmenu-push-toright');
        $('#showLeftPush').attr('class', 'active');
        $("#cbp-spmenu-s1").attr('class', 'cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cbp-spmenu-open');
    });

    function validar(e) {
        e.preventDefault();
        var id = $("#id").val();
        if (id.length === 0) {
            notify('Atención', 'Debe seleccionar un grupo de usuarios para agregar privilegios.', 'warning');
        } else {
            $('#privilegios option').each(function() {
                var valor = $(this).attr('value');
                $("#privilegios").find("option[value='" + valor + "']").prop("selected", true);
            });
            $("#form-privilegios").submit();
        }
    }

    function agregar() {
        var id = $("#grupousuario_id").val();
        if (id === null) {
            notify('Atención', 'Debe seleccionar un grupo de usuarios para agregar privilegios.', 'warning');
        } else {
            $.each($('#paginas :selected'), function() {
                var valor = $(this).val();
                var texto = $(this).text();
                if (!existe(valor)) {
                    $("#privilegios").append("<option value='" + valor + "'>" + texto + "</option>");
                    $("#paginas").find("option[value='" + valor + "']").prop("disabled", true);
                }
            });
        }
    }

    function agregarTodas() {
        var id = $("#grupousuario_id").val();
        if (id === null) {
            notify('Atención', 'Debe seleccionar un grupo de usuarios para agregar privilegios.', 'warning');
        } else {
            $('#paginas option').each(function() {
                var valor = $(this).attr('value');
                var texto = $(this).text();
                if (texto !== "-- Seleccione una opción --") {
                    if (!existe(valor)) {
                        $("#privilegios").append("<option value='" + valor + "'>" + texto + "</option>");
                        $("#paginas").find("option[value='" + valor + "']").prop("disabled", true);
                    }
                }
            });
        }
    }

    function existe(valor) {
        var array = [];
        $("#privilegios option").each(function() {
            array.push($(this).attr('value'));
        });
        var index = $.inArray(valor, array);
        if (index !== -1) {
            return true;
        } else {
            return false;
        }
    }

    function retirar() {
        $.each($('#privilegios :selected'), function() {
            var valor = $(this).val();
            $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
            $(this).remove();
        });
    }

    function retirarTodas() {
        $('#privilegios option').each(function() {
            var valor = $(this).attr('value');
            $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
            $(this).remove();
        });
    }

    function traerData() {
        var id = $("#grupousuario_id").val();
        $("#id").val(id);
        $.ajax({
            type: 'GET',
            url: url + "usuarios/grupousuario/" + id + "/privilegios",
            data: {},
        }).done(function(msg) {
            $('#privilegios option').each(function() {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $('#paginas option').each(function() {
                    var valor = $(this).attr('value');
                    $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
                });
                $.each(m, function(index, item) {
                    $("#privilegios").append("<option value='" + item.id + "'>" + item.value + "</option>");
                    $("#paginas").find("option[value='" + item.id + "']").prop("disabled", true);
                });
            } else {
                notify('Atención', 'El grupo de usuarios seleccionado no tiene privilegios asignados aún.', 'error');
                $('#paginas option').each(function() {
                    var valor = $(this).attr('value');
                    $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
                });
            }
        });
    }
</script>
@endsection