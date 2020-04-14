<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocenteRequest;
use App\Models\Auditoria\Auditoriapersonal;
use App\Models\Personal\Docente;
use App\Models\Personal\Personanatural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docente::all();
        return view('personal.docentes.list')
            ->with('location', 'personal')
            ->with('docentes', $docentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = Personanatural::all();
        $per = null;
        if (count($personas) > 0) {
            foreach ($personas as $p) {
                $per[$p->id] = $p->primer_nombre . " " . $p->segundo_nombre . " " . $p->primer_apellido . " " . $p->segundo_apellido;
            }
        }
        return view('personal.docentes.create')
            ->with('location', 'personal')
            ->with('personas', $per);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocenteRequest $request)
    {
        $docente = new Docente($request->all());
        foreach ($docente->attributesToArray() as $key => $value) {
            $docente->$key = strtoupper($value);
        }
        if ($docente->fecha_graduacion == "") {
            $docente->fecha_graduacion = null;
        }
        $u = Auth::user();
        $result = $docente->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE docente. DATOS: ";
            foreach ($docente->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El docente <strong>" . $docente->personanatural->primer_nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('docente.index');
        } else {
            flash("El docente <strong>" . $docente->personanatural->primer_nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('docente.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $docente = Docente::find($id);
        /*if (count($docente->paginas) > 0 || count($docente->modulos) > 0 || count($docente->users) > 0) {
            flash("El Grupo de usuario <strong>" . $docente->nombre . "</strong> no pudo ser eliminado porque tiene permisos o datos-basicos asociados.")->warning();
            return redirect()->route('docente.index');
        } else {*/
        $result = $docente->delete();
        if ($result) {
            $aud = new Auditoriapersonal();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE DOCENTE. DATOS ELIMINADOS: ";
            foreach ($docente->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El docente <strong>" . $docente->personanatural->primer_nombre . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('docente.index');
        } else {
            flash("El docente <strong>" . $docente->personanatural->primer_nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('docente.index');
        }
        //}
    }
}
