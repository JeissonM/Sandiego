<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipocasoRequest;
use App\Models\Auditoria\Auditoriadatosgenerales;
use App\Models\Datosgenerales\Tipocaso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipocasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipocasos = Tipocaso::all()->sortBy('nivel');
        return view('datos_basicos.tipocasos.list')
            ->with('location', 'datos-basicos')
            ->with('tipocasos', $tipocasos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveles = [
            'RIESGO BAJO (PRIMER NIVEL)' => 'RIESGO BAJO (PRIMER NIVEL)',
            'RIESGO MEDIO (SEGUNDO NIVEL)' => 'RIESGO MEDIO (SEGUNDO NIVEL)',
            'RIESGO ALTO (TERCER NIVEL)' => 'RIESGO ALTO (TERCER NIVEL)',
        ];
        return view('datos_basicos.tipocasos.create')
            ->with('location', 'datos-basicos')
            ->with('niveles', $niveles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipocasoRequest $request)
    {
        $tipocaso = new Tipocaso($request->all());
        foreach ($tipocaso->attributesToArray() as $key => $value) {
            $tipocaso->$key = strtoupper($value);
        }
        $u = Auth::user();
        $result = $tipocaso->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE TIPO DE CASOS. DATOS: ";
            foreach ($tipocaso->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El tipo de caso <strong>" . $tipocaso->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('tipocaso.index');
        } else {
            flash("El tipo de caso <strong>" . $tipocaso->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('tipocaso.index');
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
        /*$tipocaso = Tipocaso::find($id);
        return view('datos-basicos.tipocasos.show')
            ->with('location', 'datos-basicos')
            ->with('Tipodoc', $tipocaso);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $niveles = [
            'RIESGO BAJO (PRIMER NIVEL)' => 'RIESGO BAJO (PRIMER NIVEL)',
            'RIESGO MEDIO (SEGUNDO NIVEL)' => 'RIESGO MEDIO (SEGUNDO NIVEL)',
            'RIESGO ALTO (TERCER NIVEL)' => 'RIESGO ALTO (TERCER NIVEL)',
        ];
        $tipocaso = Tipocaso::find($id);
        return view('datos_basicos.tipocasos.edit')
            ->with('location', 'datos-basicos')
            ->with('tipocaso', $tipocaso)
            ->with('niveles', $niveles);
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
        $tipocaso = Tipocaso::find($id);
        $m = new Tipocaso($tipocaso->attributesToArray());
        foreach ($tipocaso->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $tipocaso->$key = strtoupper($request->$key);
            }
        }
        $u = Auth::user();
        $result = $tipocaso->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE TIPOS DE CASOS. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($tipocaso->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El tipo de caso <strong>" . $tipocaso->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('tipocaso.index');
        } else {
            flash("El tipo de caso <strong>" . $tipocaso->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('tipocaso.index');
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
        $tipocaso = Tipocaso::find($id);
        /*if (count($tipocaso->personanaturals) > 0 || count($tipocaso->entecontrols) > 0) {
            flash("El tipo de caso <strong>" . $tipocaso->descripcion . "</strong> no pudo ser eliminado porque tiene datos asociados.")->warning();
            return redirect()->route('tipocaso.index');
        } else {*/
        $result = $tipocaso->delete();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE TIPO DE CASO. DATOS ELIMINADOS: ";
            foreach ($tipocaso->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El tipo de caso <strong>" . $tipocaso->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('tipocaso.index');
        } else {
            flash("El tipo de caso <strong>" . $tipocaso->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('tipocaso.index');
        }
        //}
    }
}
