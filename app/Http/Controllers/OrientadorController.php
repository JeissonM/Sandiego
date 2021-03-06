<?php

namespace App\Http\Controllers;

use App\Models\Auditoria\Auditoriapersonal;
use App\Models\Personal\Orientador;
use App\Models\Personal\Personanatural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrientadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orientadores = Orientador::all();
        return view('personal.orientador.list')
            ->with('location', 'personal')
            ->with('orientadores', $orientadores);
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
        return view('personal.orientador.create')
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
        if ($request->personanatural_id == '0') {
            flash("Debe indicar todos los parámetros")->warning();
            return redirect()->route('orientador.index');
        }
        $d = new Orientador($request->all());
        $u = Auth::user();
        $result = $d->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE ORIENTADOR. DATOS: ";
            foreach ($d->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El orientador fue almacenado de forma exitosa!")->success();
            return redirect()->route('orientador.index');
        } else {
            flash("El orientador no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('orientador.index');
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
        $d = Orientador::find($id);
        /*if (count($padre->paginas) > 0 || count($padre->modulos) > 0 || count($padre->users) > 0) {
            flash("El Grupo de usuario <strong>" . $padre->nombre . "</strong> no pudo ser eliminado porque tiene permisos o datos-basicos asociados.")->warning();
            return redirect()->route('orientador.index');
        } else {*/
        $result = $d->delete();
        if ($result) {
            $aud = new Auditoriapersonal();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE ORIENTADOR. DATOS ELIMINADOS: ";
            foreach ($d->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El orientador fue eliminado de forma exitosa!")->success();
            return redirect()->route('orientador.index');
        } else {
            flash("El orientador no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('orientador.index');
        }
        //}
    }
}
