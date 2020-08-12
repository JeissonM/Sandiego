<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//RUTAS PUBLICAS
//REGISTRO DE PERSONAL
Route::get('/registro/publico/{source}', 'RegistropublicoController@create')->name('registropublico.crear');
Route::post('/registro/publico/registro/guardar', 'RegistropublicoController@store')->name('registropublico.store');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//GRUPO DE RUTAS PARA LOS MENUS
Route::group(['middleware' => ['auth'], 'prefix' => 'menu'], function () {
    Route::get('usuarios', 'MenuController@usuarios')->name('menu.usuarios');
    Route::get('datos_basicos', 'MenuController@datos_basicos')->name('menu.datos_basicos');
    Route::get('personal', 'MenuController@personal')->name('menu.personal');
    Route::get('citas', 'MenuController@citas')->name('menu.citas');
});


//GRUPO DE RUTAS PARA LA ADMINISTRACIÓN DE USUARIOS
Route::group(['middleware' => ['auth'], 'prefix' => 'usuarios'], function () {
    //MODULOS
    Route::resource('modulo', 'ModuloController');
    //PAGINAS O ITEMS DE LOS MODULOS
    Route::resource('pagina', 'PaginaController');
    //GRUPOS DE USUARIOS
    Route::resource('grupousuario', 'GrupousuarioController');
    Route::get('grupousuario/{id}/delete', 'GrupousuarioController@destroy')->name('grupousuario.delete');
    Route::get('privilegios', 'GrupousuarioController@privilegios')->name('grupousuario.privilegios');
    Route::get('grupousuario/{id}/privilegios', 'GrupousuarioController@getPrivilegios');
    Route::post('grupousuario/privilegios', 'GrupousuarioController@setPrivilegios')->name('grupousuario.guardar');
    //USUARIOS
    Route::resource('usuario', 'UsuarioController');
    Route::get('usuario/{id}/delete', 'UsuarioController@destroy')->name('usuario.delete');
    Route::post('operaciones', 'UsuarioController@operaciones')->name('usuario.operaciones');
    Route::post('usuarios/contrasenia/cambiar/admin/finalizar', 'UsuarioController@cambiarPass')->name('usuario.cambiarPass');
    Route::post('acceso', 'HomeController@confirmaRol')->name('rol');
    Route::get('inicio', 'HomeController@inicio')->name('inicio');
});

//GRUPO DE RUTAS PARA LA GESTIÓN DE DATOS BÁSICOS
Route::group(['middleware' => ['auth'], 'prefix' => 'datos_basicos'], function () {
    //PERIODOS
    Route::resource('periodo', 'PeriodoController');
    Route::get('periodo/{id}/delete', 'PeriodoController@destroy')->name('periodo.delete');
    //GRADOS
    Route::resource('grado', 'GradoController');
    Route::get('grado/{id}/delete', 'GradoController@destroy')->name('grado.delete');
    //ESTADO CIVIL
    Route::resource('estadocivil', 'EstadocivilController');
    Route::get('estadocivil/{id}/delete', 'EstadocivilController@destroy')->name('estadocivil.delete');
    //GRUPOS
    Route::resource('grupo', 'GrupoController');
    Route::get('grupo/{id}/delete', 'GrupoController@destroy')->name('grupo.delete');
    Route::get('grupo/{grado}/{periodo}/grupos', 'GrupoController@grupos')->name('grupo.grupos');
    //REGIMEN
    Route::resource('regimen', 'RegimenController');
    Route::get('regimen/{id}/delete', 'RegimenController@destroy')->name('regimen.delete');
    //TIPO DOCUMENTO
    Route::resource('tipodoc', 'TipodocController');
    Route::get('tipodoc/{id}/delete', 'TipodocController@destroy')->name('tipodoc.delete');
    //TIPO PERSONA JURIDICA
    Route::resource('tipopersonaj', 'TipopersonajController');
    Route::get('tipopersonaj/{id}/delete', 'TipopersonajController@destroy')->name('tipopersonaj.delete');
    //TIPO DE CASOS
    Route::resource('tipocaso', 'TipocasoController');
    Route::get('tipocaso/{id}/delete', 'TipocasoController@destroy')->name('tipocaso.delete');
});

//GRUPO DE RUTAS PARA LA GESTIÓN DEL PERSONAL
Route::group(['middleware' => ['auth'], 'prefix' => 'personal'], function () {
    //PERSONAS NATURALES
    Route::resource('personanatural', 'PersonanaturalController');
    Route::get('personanatural/{id}/delete', 'PersonanaturalController@destroy')->name('personanatural.delete');
    //ENTES DE CONTROL
    Route::resource('entecontrol', 'EntecontrolController');
    Route::get('entecontrol/{id}/delete', 'EntecontrolController@destroy')->name('entecontrol.delete');
    //DOCENTES
    Route::resource('docente', 'DocenteController');
    Route::get('docente/{id}/delete', 'DocenteController@destroy')->name('docente.delete');
    //ESTUDIANTES
    Route::resource('estudiante', 'EstudianteController');
    Route::get('estudiante/{id}/delete', 'EstudianteController@destroy')->name('estudiante.delete');
    //PADRE FAMILIA
    Route::resource('padrefamilia', 'PadrefamiliaController');
    Route::get('padrefamilia/{id}/delete', 'PadrefamiliaController@destroy')->name('padrefamilia.delete');
    Route::get('padrefamilia/{estudiante}/delete/{padre}/quitar', 'PadrefamiliaController@destroyestudiante')->name('padrefamilia.deleteestudiante');
    Route::get('padrefamilia/{estudiante}/estudiantes/{padre}/agregar', 'PadrefamiliaController@addestudiante')->name('padrefamilia.addestudiante');
    Route::get('padrefamilia/{padre}/hijos', 'PadrefamiliaController@hijos')->name('padrefamilia.hijos');
    Route::get('padrefamilia/{padre}/hijos/{hijo}/remove', 'PadrefamiliaController@removehijo')->name('padrefamilia.removehijo');
    Route::get('padrefamilia/{padre}/hijos/{hijo}/add', 'PadrefamiliaController@addhijo')->name('padrefamilia.addhijo');
    //DOCENTES DIRECTORES DE GRUPO
    Route::resource('directorgrupo', 'DirectorgrupoController');
    Route::get('directorgrupo/{id}/delete', 'DirectorgrupoController@destroy')->name('directorgrupo.delete');
    //COORDINADORES
    Route::resource('coordinador', 'CoordinadorController');
    Route::get('coordinador/{id}/delete', 'CoordinadorController@destroy')->name('coordinador.delete');
    //ORIENTADORES
    Route::resource('orientador', 'OrientadorController');
    Route::get('orientador/{id}/delete', 'OrientadorController@destroy')->name('orientador.delete');
});

//GRUPO DE RUTAS PARA LA GESTIÓN DE CITAS
Route::group(['middleware' => ['auth'], 'prefix' => 'citas'], function () {
    //DISPONIBILIDAD DE CITAS
    Route::resource('disponibilidad', 'DisponibilidadController');
    Route::get('disponibilidad/{id}/delete', 'DisponibilidadController@destroy')->name('disponibilidad.delete');
    Route::get('disponibilidad/{id}/crear', 'DisponibilidadController@create')->name('disponibilidad.crear');
});
