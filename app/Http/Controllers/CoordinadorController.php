<?php

namespace App\Http\Controllers;

use App\Models\Auditoria\Auditoriapersonal;
use App\Models\Personal\Coordinador;
use App\Models\Personal\Personanatural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coordinadores = Coordinador::all();
        return view('personal.coordinador.list')
            ->with('location', 'personal')
            ->with('coordinadores', $coordinadores);
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
        return view('personal.coordinador.create')
            ->with('location', 'personal')
            ->with('personas', $per);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->docente_id == '0') {
            flash("Debe indicar todos los parámetros")->warning();
            return redirect()->route('coordinador.index');
        }
        $d = new Coordinador($request->all());
        $u = Auth::user();
        $result = $d->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE COORDINADOR. DATOS: ";
            foreach ($d->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El coordinador fue almacenado de forma exitosa!")->success();
            return redirect()->route('coordinador.index');
        } else {
            flash("El coordinador no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('coordinador.index');
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
        $d = Coordinador::find($id);
        /*if (count($padre->paginas) > 0 || count($padre->modulos) > 0 || count($padre->users) > 0) {
            flash("El Grupo de usuario <strong>" . $padre->nombre . "</strong> no pudo ser eliminado porque tiene permisos o datos-basicos asociados.")->warning();
            return redirect()->route('coordinador.index');
        } else {*/
        $result = $d->delete();
        if ($result) {
            $aud = new Auditoriapersonal();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE COORDINADOR. DATOS ELIMINADOS: ";
            foreach ($d->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El coordinador fue eliminado de forma exitosa!")->success();
            return redirect()->route('coordinador.index');
        } else {
            flash("El coordinador no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('coordinador.index');
        }
        //}
    }
}
