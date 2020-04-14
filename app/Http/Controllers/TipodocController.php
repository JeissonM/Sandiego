<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipodocRequest;
use App\Models\Auditoria\Auditoriadatosgenerales;
use App\Models\Datosgenerales\Tipodoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipodocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipodocs = Tipodoc::all()->sortBy('created_at');
        return view('datos_basicos.tipodocs.list')
            ->with('location', 'datos-basicos')
            ->with('tipodocs', $tipodocs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('datos_basicos.tipodocs.create')
            ->with('location', 'datos-basicos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipodocRequest $request)
    {
        $tipodoc = new Tipodoc($request->all());
        foreach ($tipodoc->attributesToArray() as $key => $value) {
            $tipodoc->$key = strtoupper($value);
        }
        $u = Auth::user();
        $result = $tipodoc->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE TIPO DE DOCUMENTO. DATOS: ";
            foreach ($tipodoc->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El tipo de documento <strong>" . $tipodoc->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('tipodoc.index');
        } else {
            flash("El tipo de documento <strong>" . $tipodoc->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('tipodoc.index');
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
        /*$tipodoc = Tipodoc::find($id);
        return view('datos-basicos.tipodocs.show')
            ->with('location', 'datos-basicos')
            ->with('Tipodoc', $tipodoc);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipodoc = Tipodoc::find($id);
        return view('datos_basicos.tipodocs.edit')
            ->with('location', 'datos-basicos')
            ->with('tipodoc', $tipodoc);
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
        $tipodoc = Tipodoc::find($id);
        $m = new Tipodoc($tipodoc->attributesToArray());
        foreach ($tipodoc->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $tipodoc->$key = strtoupper($request->$key);
            }
        }
        $u = Auth::user();
        $result = $tipodoc->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE TIPOS DE DOCUMENTOS. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($tipodoc->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El tipo de documento <strong>" . $tipodoc->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('tipodoc.index');
        } else {
            flash("El tipo de documento <strong>" . $tipodoc->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('tipodoc.index');
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
        $tipodoc = Tipodoc::find($id);
        if (count($tipodoc->personanaturals) > 0 || count($tipodoc->entecontrols) > 0) {
            flash("El tipo de documento <strong>" . $tipodoc->descripcion . "</strong> no pudo ser eliminado porque tiene datos asociados.")->warning();
            return redirect()->route('tipodoc.index');
        } else {
            $result = $tipodoc->delete();
            if ($result) {
                $aud = new Auditoriadatosgenerales();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "ELIMINAR";
                $str = "ELIMINACIÓN DE TIPO DE DOCUMENTO. DATOS ELIMINADOS: ";
                foreach ($tipodoc->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                flash("El tipo de documento <strong>" . $tipodoc->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('tipodoc.index');
            } else {
                flash("El tipo de documento <strong>" . $tipodoc->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('tipodoc.index');
            }
        }
    }
}
