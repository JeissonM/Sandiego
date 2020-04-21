<?php

namespace App\Http\Controllers;

use App\Http\Requests\GrupoRequest;
use App\Models\Auditoria\Auditoriadatosgenerales;
use App\Models\Datosgenerales\Grado;
use App\Models\Datosgenerales\Grupo;
use App\Models\Datosgenerales\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\json_decode;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupo::all();
        return view('datos_basicos.grupos.list')
            ->with('location', 'datos-basicos')
            ->with('grupos', $grupos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periodos = Periodo::all()->sortBy('created_at')->pluck('periodo', 'id');
        $grados = Grado::all()->pluck('grado', 'id');
        return view('datos_basicos.grupos.create')
            ->with('location', 'datos-basicos')
            ->with('grados', $grados)
            ->with('periodos', $periodos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrupoRequest $request)
    {
        $grupo = new Grupo($request->all());
        foreach ($grupo->attributesToArray() as $key => $value) {
            $grupo->$key = strtoupper($value);
        }
        $u = Auth::user();
        $result = $grupo->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE GRUPOS. DATOS: ";
            foreach ($grupo->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El grupo <stong>" . $grupo->nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('grupo.index');
        } else {
            flash("El grupo <strong>" . $grupo->nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('grupo.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$Grupo = Grupo::find($id);
        return view('datos-basicos.Grupo.show')
            ->with('location', 'datos-basicos')
            ->with('Grupo', $Grupo);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupo = Grupo::find($id);
        $periodos = Periodo::all()->sortBy('created_at')->pluck('periodo', 'id');
        $grados = Grado::all()->pluck('grado', 'id');
        return view('datos_basicos.grupos.edit')
            ->with('location', 'datos-basicos')
            ->with('grupo', $grupo)
            ->with('grados', $grados)
            ->with('periodos', $periodos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grupo = Grupo::find($id);
        $m = new Grupo($grupo->attributesToArray());
        foreach ($grupo->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $grupo->$key = strtoupper($request->$key);
            }
        }
        $u = Auth::user();
        $result = $grupo->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE GRUPO. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($grupo->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El grupo <strong>" . $grupo->nombre . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('grupo.index');
        } else {
            flash("El grupo <strong>" . $grupo->nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('grupo.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = Grupo::find($id);
        /*if (count($Grupo->paginas) > 0 || count($Grupo->modulos) > 0 || count($Grupo->users) > 0) {
            flash("El Grupo de usuario <strong>" . $Grupo->nombre . "</strong> no pudo ser eliminado porque tiene permisos o datos-basicos asociados.")->warning();
            return redirect()->route('Grupo.index');
        } else {*/
        $result = $grupo->delete();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE GRUPO. DATOS ELIMINADOS: ";
            foreach ($grupo->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El grupo <strong>" . $grupo->nombre . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('grupo.index');
        } else {
            flash("El grupo <strong>" . $grupo->nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('grupo.index');
        }
        //}
    }

    //grupos para un grado y periodo
    public function grupos($g, $p)
    {
        $grupos = Grupo::where([['periodo_id', $p], ['grado_id', $g]])->get();
        if (count($grupos) > 0) {
            return json_encode($grupos);
        } else {
            return "NO";
        }
    }
}
