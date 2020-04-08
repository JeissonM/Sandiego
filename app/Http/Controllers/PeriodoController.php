<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeriodoRequest;
use App\Models\Auditoria\Auditoriadatosgenerales;
use App\Models\Datosgenerales\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::all()->sortBy('created_at');
        return view('datos_basicos.periodos.list')
            ->with('location', 'datos-basicos')
            ->with('periodos', $periodos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('datos_basicos.periodos.create')
            ->with('location', 'datos-basicos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeriodoRequest $request)
    {
        $periodo = new Periodo($request->all());
        foreach ($periodo->attributesToArray() as $key => $value) {
            $periodo->$key = strtoupper($value);
        }
        $u = Auth::user();
        $result = $periodo->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE PERIODO. DATOS: ";
            foreach ($periodo->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El período <strong>" . $periodo->periodo . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('periodo.index');
        } else {
            flash("El período <strong>" . $periodo->periodo . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('periodo.index');
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
        /*$periodo = Periodo::find($id);
        return view('datos-basicos.periodos.show')
            ->with('location', 'datos-basicos')
            ->with('periodo', $periodo);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $periodo = Periodo::find($id);
        return view('datos_basicos.periodos.edit')
            ->with('location', 'datos-basicos')
            ->with('periodo', $periodo);
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
        $periodo = Periodo::find($id);
        $m = new Periodo($periodo->attributesToArray());
        foreach ($periodo->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $periodo->$key = strtoupper($request->$key);
            }
        }
        $u = Auth::user();
        $result = $periodo->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE PERIODO. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($periodo->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El período <strong>" . $periodo->periodo . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('periodo.index');
        } else {
            flash("El período <strong>" . $periodo->periodo . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('periodo.index');
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
        $periodo = Periodo::find($id);
        /*if (count($periodo->paginas) > 0 || count($periodo->modulos) > 0 || count($periodo->users) > 0) {
            flash("El Grupo de usuario <strong>" . $periodo->nombre . "</strong> no pudo ser eliminado porque tiene permisos o datos-basicos asociados.")->warning();
            return redirect()->route('periodo.index');
        } else {*/
        $result = $periodo->delete();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE PERIODOS. DATOS ELIMINADOS: ";
            foreach ($periodo->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El período <strong>" . $periodo->periodo . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('periodo.index');
        } else {
            flash("El período <strong>" . $periodo->periodo . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('periodo.index');
        }
        //}
    }
}
