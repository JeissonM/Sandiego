<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonanaturalRequest;
use App\Models\Auditoria\Auditoriapersonal;
use App\Models\Datosgenerales\Estadocivil;
use App\Models\Datosgenerales\Tipodoc;
use App\Models\Personal\Personanatural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonanaturalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Personanatural::all();
        return view('personal.personasnaturales.list')
            ->with('location', 'personal')
            ->with('personas', $personas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipodocs = Tipodoc::all()->pluck('descripcion', 'id');
        $estadoscivil = Estadocivil::all()->pluck('descripcion', 'id');
        return view('personal.personasnaturales.create')
            ->with('location', 'personal')
            ->with('tipodocs', $tipodocs)
            ->with('estados', $estadoscivil);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonanaturalRequest $request)
    {
        $persona = new Personanatural($request->all());
        foreach ($persona->attributesToArray() as $key => $value) {
            $persona->$key = strtoupper($value);
        }
        if ($persona->fecha_expedicion == "") {
            $persona->fecha_expedicion = null;
        }
        if ($persona->fecha_nacimiento == "") {
            $persona->fecha_nacimiento = null;
        }
        $u = Auth::user();
        $result = $persona->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE PERSONAS NATURALES. DATOS: ";
            foreach ($persona->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La persona <stong>" . $persona->primer_nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('personanatural.index');
        } else {
            flash("La persona <strong>" . $persona->primer_nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('personanatural.index');
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
        $persona = Personanatural::find($id);
        return view('personal.personasnaturales.show')
            ->with('location', 'personal')
            ->with('persona', $persona);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Personanatural::find($id);
        $tipodocs = Tipodoc::all()->pluck('descripcion', 'id');
        $estadoscivil = Estadocivil::all()->pluck('descripcion', 'id');
        $sexos['M'] = 'MASCULINO';
        $sexos['F'] = 'FEMENINO';
        $sexos['O'] = 'OTRO';
        return view('personal.personasnaturales.edit')
            ->with('location', 'personal')
            ->with('persona', $persona)
            ->with('tipodocs', $tipodocs)
            ->with('estados', $estadoscivil)
            ->with('sexos', $sexos);
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
        $persona = Personanatural::find($id);
        $m = new Personanatural($persona->attributesToArray());
        foreach ($persona->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $persona->$key = strtoupper($request->$key);
            }
        }
        $u = Auth::user();
        $result = $persona->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE PERSONAS NATURALES. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($persona->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("La persona <strong>" . $persona->primer_nombre . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('personanatural.index');
        } else {
            flash("La persona <strong>" . $persona->primer_nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('personanatural.index');
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
        $persona = Personanatural::find($id);
        if ($persona->docente != null || $persona->estudiante != null || $persona->padrefamilia != null) {
            flash("La persona <strong>" . $persona->primer_nombre . "</strong> no pudo ser eliminado porque tiene datos asociados.")->warning();
            return redirect()->route('personanatural.index');
        } else {
            $result = $persona->delete();
            if ($result) {
                $aud = new Auditoriapersonal();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "ELIMINAR";
                $str = "ELIMINACIÓN DE PERSONA NATURAL. DATOS ELIMINADOS: ";
                foreach ($persona->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                flash("La persona <strong>" . $persona->primer_nombre . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('personanatural.index');
            } else {
                flash("La persona <strong>" . $persona->primer_nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('personanatural.index');
            }
        }
    }
}
