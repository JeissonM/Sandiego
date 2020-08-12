@extends('layouts.admin')

@section('breadcrumb')
<li><a href="{{ route('inicio') }}">Inicio</a></li>
@endsection

@section('content')
<div class="row-one">
    <div class="alert alert-success" role="alert">
        <strong>Bienvenido {{Auth::user()->nombres." ".Auth::user()->apellidos}}</strong> al aplicativo web de la institución, con tu ROL de <b>..:: {{session('ROL')}} ::..</b> podrás realizar las siguientes funciones en el sistema...
    </div>
</div>
<div class="row-one">
    <div class="social-media widget-shadow" style="padding: 10px; display:inline-block; text-align: center;">
        @if(session()->exists('MOD_INICIO'))
        <div class="wid-social twitter" style="cursor: pointer;" onclick="ir(this.id)" id="inicio">
            <div class="social-icon">
                <i class="fa fa-home text-light icon-xlg "></i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">Inicio</h3>
                <h4 class="counttype text-light">Del Sistema</h4>
            </div>
        </div>
        @endif
        @if(session()->exists('MOD_USUARIOS'))
        <div class="wid-social google-plus" style="cursor: pointer;" onclick="ir(this.id)" id="usuarios">
            <div class="social-icon">
                <i class="fa fa-users text-light icon-xlg "></i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">Usuarios</h3>
                <h4 class="counttype text-light">Del Sistema</h4>
            </div>
        </div>
        @endif
        @if(session()->exists('MOD_DATOS-BASICOS'))
        <div class="wid-social facebook" style="cursor: pointer;" onclick="ir(this.id)" id="datos-basicos">
            <div class="social-icon">
                <i class="fa fa-file text-light icon-xlg "></i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">Datos</h3>
                <h4 class="counttype text-light">Generales</h4>
            </div>
        </div>
        @endif
        @if(session()->exists('MOD_PERSONAL'))
        <div class="wid-social dribbble" style="cursor: pointer;" onclick="ir(this.id)" id="personal">
            <div class="social-icon">
                <i class="fa fa-user text-light icon-xlg "></i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">Personal</h3>
                <h4 class="counttype text-light">De La Institución</h4>
            </div>
        </div>
        @endif
        @if(session()->exists('MOD_CITAS'))
        <div class="wid-social vimeo" style="cursor: pointer;" onclick="ir(this.id)" id="citas">
            <div class="social-icon">
                <i class="fa fa-bookmark text-light icon-xlg"> </i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">Citas</h3>
                <h4 class="counttype text-light">Gestión</h4>
            </div>
        </div>
        @endif
        <!--
        <div class="wid-social xing">
            <div class="social-icon">
                <i class="fa fa-xing text-light icon-xlg "></i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">2525</h3>
                <h4 class="counttype text-light">Connections</h4>
            </div>
        </div>
        <div class="wid-social flickr">
            <div class="social-icon">
                <i class="fa fa-android text-light icon-xlg"></i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">1221</h3>
                <h4 class="counttype text-light">Media</h4>
            </div>
        </div>
        <div class="wid-social yahoo">
            <div class="social-icon">
                <i class="fa fa-yahoo text-light icon-xlg"> Y!</i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">2525</h3>
                <h4 class="counttype text-light">Connections</h4>
            </div>
        </div>
        <div class="wid-social rss">
            <div class="social-icon">
                <i class="fa fa-rss text-light icon-xlg"></i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">1523</h3>
                <h4 class="counttype text-light">Subscribers</h4>
            </div>
        </div>-->
        <div class="wid-social google-plus" style="cursor: pointer;" onclick="ir(this.id)" id="salir">
            <div class="social-icon">
                <i class="fa fa-sign-out text-light icon-xlg"></i>
            </div>
            <div class="social-info">
                <h3 class="number_counter bold count text-light start_timer counted">Salir</h3>
                <h4 class="counttype text-light">Del Sistema</h4>
                <form id="logout-form3" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function ir(destino) {
        switch (destino) {
            case 'salir':
                document.getElementById('logout-form3').submit();
                break;
            case 'inicio':
                location.href = url + "usuarios/inicio";
                break;
            case 'usuarios':
                location.href = url + "menu/usuarios";
                break;
            case 'datos-basicos':
                location.href = url + "menu/datos_basicos";
                break;
            case 'personal':
                location.href = url + "menu/personal";
                break;
            case 'citas':
                location.href = url + "menu/citas";
                break;
            default:
                break;
        }
    }
</script>
@endsection