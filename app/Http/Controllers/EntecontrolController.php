<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntecontrolRequest;
use App\Models\Auditoria\Auditoriapersonal;
use App\Models\Datosgenerales\Regimen;
use App\Models\Datosgenerales\Tipodoc;
use App\Models\Datosgenerales\Tipopersonaj;
use App\Models\Personal\Entecontrol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntecontrolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entes = Entecontrol::all();
        return view('personal.entecontrol.list')
            ->with('location', 'personal')
            ->with('entes', $entes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipodocs = Tipodoc::all()->pluck('descripcion', 'id');
        $tipopjs = Tipopersonaj::all()->pluck('descripcion', 'id');
        $regimen = Regimen::all()->pluck('descripcion', 'id');
        return view('personal.entecontrol.create')
            ->with('location', 'personal')
            ->with('tipodocs', $tipodocs)
            ->with('tipopjs', $tipopjs)
            ->with('regimens', $regimen);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntecontrolRequest $request)
    {
        $ente = new Entecontrol($request->all());
        foreach ($ente->attributesToArray() as $key => $value) {
            $ente->$key = strtoupper($value);
        }
        if ($ente->fecha_expedicion == "") {
            $ente->fecha_expedicion = null;
        }
        if ($ente->tipopersonaj_id == 0) {
            $ente->tipopersonaj_id = null;
        }
        if ($ente->regimen_id == 0) {
            $ente->regimen_id = null;
        }
        $u = Auth::user();
        $result = $ente->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE ENTES DE CONTROL. DATOS: ";
            foreach ($ente->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El ente de control <strong>" . $ente->razonsocial . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('entecontrol.index');
        } else {
            flash("El ente de control <strong>" . $ente->razonsocial . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('entecontrol.index');
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
        $ente = Entecontrol::find($id);
        return view('personal.entecontrol.show')
            ->with('location', 'personal')
            ->with('ente', $ente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ente = Entecontrol::find($id);
        $tipodocs = Tipodoc::all()->pluck('descripcion', 'id');
        $tipodocs = Tipodoc::all()->pluck('descripcion', 'id');
        $tipopjs = Tipopersonaj::all()->pluck('descripcion', 'id');
        $regimen = Regimen::all()->pluck('descripcion', 'id');
        return view('personal.entecontrol.edit')
            ->with('location', 'personal')
            ->with('ente', $ente)
            ->with('tipodocs', $tipodocs)
            ->with('tipopjs', $tipopjs)
            ->with('regimens', $regimen);
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
        $ente = Entecontrol::find($id);
        $m = new Entecontrol($ente->attributesToArray());
        foreach ($ente->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $ente->$key = strtoupper($request->$key);
            }
        }
        if ($ente->tipopersonaj_id == 0) {
            $ente->tipopersonaj_id = null;
        }
        if ($ente->regimen_id == 0) {
            $ente->regimen_id = null;
        }
        $u = Auth::user();
        $result = $ente->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE ENTES DE CONTROL. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($ente->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El ente de control <strong>" . $ente->razonsocial . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('entecontrol.index');
        } else {
            flash("El ente de control <strong>" . $ente->razonsocial . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('entecontrol.index');
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
        $ente = Entecontrol::find($id);
        /*if (count($ente->paginas) > 0 || count($ente->modulos) > 0 || count($ente->users) > 0) {
            flash("El Grupo de usuario <strong>" . $ente->nombre . "</strong> no pudo ser eliminado porque tiene permisos o datos-basicos asociados.")->warning();
            return redirect()->route('entecontrol.index');
        } else {*/
        $result = $ente->delete();
        if ($result) {
            $aud = new Auditoriapersonal();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE ENTE DE CONTROL. DATOS ELIMINADOS: ";
            foreach ($ente->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El ente de control <strong>" . $ente->razonsocial . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('entecontrol.index');
        } else {
            flash("El ente de control <strong>" . $ente->razonsocial . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('entecontrol.index');
        }
        //}
    }
}
