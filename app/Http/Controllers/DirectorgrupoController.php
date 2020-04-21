<?php

namespace App\Http\Controllers;

use App\Models\Auditoria\Auditoriapersonal;
use App\Models\Datosgenerales\Grado;
use App\Models\Datosgenerales\Grupo;
use App\Models\Datosgenerales\Periodo;
use App\Models\Personal\Directorgrupo;
use App\Models\Personal\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectorgrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directores = Directorgrupo::all();
        return view('personal.director_grupo.list')
            ->with('location', 'personal')
            ->with('directores', $directores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = Docente::all();
        $per = null;
        if (count($personas) > 0) {
            foreach ($personas as $p) {
                $per[$p->id] = $p->personanatural->primer_nombre . " " . $p->personanatural->segundo_nombre . " " . $p->personanatural->primer_apellido . " " . $p->personanatural->segundo_apellido;
            }
        }
        $periodos = Periodo::all()->sortBy('created_at')->pluck('periodo', 'id');
        $grados = Grado::all()->pluck('grado', 'id');
        return view('personal.director_grupo.create')
            ->with('location', 'personal')
            ->with('personas', $per)
            ->with('grados', $grados)
            ->with('periodos', $periodos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->periodo_id == '0' || $request->grupo_id == '0' || $request->grado_id == '0' || $request->docente_id == '0') {
            flash("Debe indicar todos los parámetros")->warning();
            return redirect()->route('directorgrupo.index');
        }
        $d = new Directorgrupo($request->all());
        $u = Auth::user();
        $result = $d->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE DIRECTOR DE GRUPO. DATOS: ";
            foreach ($d->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El director fue almacenado de forma exitosa!")->success();
            return redirect()->route('directorgrupo.index');
        } else {
            flash("El director no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('directorgrupo.index');
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
        $d = Directorgrupo::find($id);
        /*if (count($padre->paginas) > 0 || count($padre->modulos) > 0 || count($padre->users) > 0) {
            flash("El Grupo de usuario <strong>" . $padre->nombre . "</strong> no pudo ser eliminado porque tiene permisos o datos-basicos asociados.")->warning();
            return redirect()->route('directorgrupo.index');
        } else {*/
        $result = $d->delete();
        if ($result) {
            $aud = new Auditoriapersonal();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE DIRECTOR DE GRUPO. DATOS ELIMINADOS: ";
            foreach ($d->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El director fue eliminado de forma exitosa!")->success();
            return redirect()->route('directorgrupo.index');
        } else {
            flash("El director no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('directorgrupo.index');
        }
        //}
    }
}
