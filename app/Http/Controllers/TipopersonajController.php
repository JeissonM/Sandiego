<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipopersonajRequest;
use App\Models\Auditoria\Auditoriadatosgenerales;
use App\Models\Datosgenerales\Tipopersonaj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipopersonajController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipopersonajs = Tipopersonaj::all()->sortBy('created_at');
        return view('datos_basicos.tipopersonajs.list')
            ->with('location', 'datos-basicos')
            ->with('tipopersonajs', $tipopersonajs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('datos_basicos.tipopersonajs.create')
            ->with('location', 'datos-basicos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipopersonajRequest $request)
    {
        $tpj = new Tipopersonaj($request->all());
        foreach ($tpj->attributesToArray() as $key => $value) {
            $tpj->$key = strtoupper($value);
        }
        $u = Auth::user();
        $result = $tpj->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE TIPO DE PERSONA JURÍDICA. DATOS: ";
            foreach ($tpj->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El tipo de persona jurídica <strong>" . $tpj->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('tipopersonaj.index');
        } else {
            flash("El tipo de persona jurídica <strong>" . $tpj->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('tipopersonaj.index');
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
        /*$tpj = Tipopersonaj::find($id);
        return view('datos-basicos.tipopersonajs.show')
            ->with('location', 'datos-basicos')
            ->with('Tipodoc', $tpj);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tpj = Tipopersonaj::find($id);
        return view('datos_basicos.tipopersonajs.edit')
            ->with('location', 'datos-basicos')
            ->with('tpj', $tpj);
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
        $tpj = Tipopersonaj::find($id);
        $m = new Tipopersonaj($tpj->attributesToArray());
        foreach ($tpj->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $tpj->$key = strtoupper($request->$key);
            }
        }
        $u = Auth::user();
        $result = $tpj->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE TIPOS DE PERSONAS JURÍDICAS. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($tpj->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El tipo de persona jurídica <strong>" . $tpj->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('tipopersonaj.index');
        } else {
            flash("El tipo de persona jurídica <strong>" . $tpj->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('tipopersonaj.index');
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
        $tpj = Tipopersonaj::find($id);
        if (count($tpj->entecontrols) > 0) {
            flash("El tipo de persona jurídica <strong>" . $tpj->descripcion . "</strong> no pudo ser eliminado porque tiene datos asociados.")->warning();
            return redirect()->route('tipopersonaj.index');
        } else {
            $result = $tpj->delete();
            if ($result) {
                $aud = new Auditoriadatosgenerales();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "ELIMINAR";
                $str = "ELIMINACIÓN DE TIPO DE PERSONA JURÍDICA. DATOS ELIMINADOS: ";
                foreach ($tpj->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                flash("El tipo de persona jurídica <strong>" . $tpj->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('tipopersonaj.index');
            } else {
                flash("El tipo de persona jurídica <strong>" . $tpj->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('tipopersonaj.index');
            }
        }
    }
}
