<?php

namespace App\Http\Controllers;

use App\Models\Datosgenerales\Regimen;
use App\Http\Requests\RegimenRequest;
use App\Models\Auditoria\Auditoriadatosgenerales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegimenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regimens = Regimen::all();
        return view('datos_basicos.regimen.list')
            ->with('location', 'datos-basicos')
            ->with('regimens', $regimens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('datos_basicos.regimen.create')
            ->with('location', 'datos-basicos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegimenRequest $request)
    {
        $regimen = new Regimen($request->all());
        foreach ($regimen->attributesToArray() as $key => $value) {
            $regimen->$key = strtoupper($value);
        }
        $u = Auth::user();
        $result = $regimen->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE REGIMEN. DATOS: ";
            foreach ($regimen->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El regimen <stong>" . $regimen->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('regimen.index');
        } else {
            flash("El regimen <strong>" . $regimen->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('regimen.index');
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
        /*$Regimen = Regimen::find($id);
        return view('datos-basicos.regimen.show')
            ->with('location', 'datos-basicos')
            ->with('Regimen', $Regimen);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regimen = Regimen::find($id);
        return view('datos_basicos.regimen.edit')
            ->with('location', 'datos-basicos')
            ->with('regimen', $regimen);
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
        $regimen = Regimen::find($id);
        $m = new Regimen($regimen->attributesToArray());
        foreach ($regimen->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $regimen->$key = strtoupper($request->$key);
            }
        }
        $u = Auth::user();
        $result = $regimen->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE REGIMEN. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($regimen->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El regimen <strong>" . $regimen->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('regimen.index');
        } else {
            flash("El regimen <strong>" . $regimen->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('regimen.index');
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
        $regimen = Regimen::find($id);
        if (count($regimen->entecontrols) > 0) {
            flash("El régimen <strong>" . $regimen->descripcion . "</strong> no pudo ser eliminado porque tiene datos asociados.")->warning();
            return redirect()->route('regimen.index');
        } else {
            $result = $regimen->delete();
            if ($result) {
                $aud = new Auditoriadatosgenerales();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "ELIMINAR";
                $str = "ELIMINACIÓN DE REGIMEN. DATOS ELIMINADOS: ";
                foreach ($regimen->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                flash("El regimen <strong>" . $regimen->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('regimen.index');
            } else {
                flash("El regimen <strong>" . $regimen->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('regimen.index');
            }
        }
    }
}
