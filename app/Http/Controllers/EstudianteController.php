<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstudianteRequest;
use App\Models\Auditoria\Auditoriapersonal;
use App\Models\Datosgenerales\Grado;
use App\Models\Personal\Estudiante;
use App\Models\Personal\Padrefamilia;
use App\Models\Personal\Personanatural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('personal.estudiantes.list')
            ->with('location', 'personal')
            ->with('estudiantes', $estudiantes);
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
        $padres = Padrefamilia::where('acudiente', 'SI')->get();
        $padr = null;
        if (count($padres) > 0) {
            foreach ($padres as $pa) {
                $padr[$pa->id] = $pa->personanatural->primer_nombre . " " . $pa->personanatural->segundo_nombre . " " . $pa->personanatural->primer_apellido . " " . $pa->personanatural->segundo_apellido;
            }
        }
        $grados = Grado::all()->pluck('grado', 'id');
        return view('personal.estudiantes.create')
            ->with('location', 'personal')
            ->with('personas', $per)
            ->with('padres', $padr)
            ->with('grados', $grados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudianteRequest $request)
    {
        $estudiante = new Estudiante($request->all());
        foreach ($estudiante->attributesToArray() as $key => $value) {
            $estudiante->$key = strtoupper($value);
        }
        if ($estudiante->padrefamilia_id == 0) {
            $estudiante->padrefamilia_id = null;
        }
        $u = Auth::user();
        $result = $estudiante->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE ESTUDIANTES. DATOS: ";
            foreach ($estudiante->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El estudiante <strong>" . $estudiante->personanatural->primer_nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('estudiante.index');
        } else {
            flash("El estudiante <strong>" . $estudiante->personanatural->primer_nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('estudiante.index');
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
        $est = Estudiante::find($id);
        $grados = Grado::all()->pluck('grado', 'id');
        $padres = Padrefamilia::where('acudiente', 'SI')->get();
        $padr = null;
        if (count($padres) > 0) {
            foreach ($padres as $pa) {
                $padr[$pa->id] = $pa->personanatural->primer_nombre . " " . $pa->personanatural->segundo_nombre . " " . $pa->personanatural->primer_apellido . " " . $pa->personanatural->segundo_apellido;
            }
        }
        return view('personal.estudiantes.edit')
            ->with('location', 'personal')
            ->with('grados', $grados)
            ->with('est', $est)
            ->with('padres', $padr);
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
        $estudiante = Estudiante::find($id);
        $m = new Estudiante($estudiante->attributesToArray());
        foreach ($estudiante->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $estudiante->$key = strtoupper($request->$key);
            }
        }
        if ($estudiante->padrefamilia_id == 0) {
            $estudiante->padrefamilia_id = null;
        }
        $u = Auth::user();
        $result = $estudiante->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE ESTUDIANTES. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($estudiante->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El estudiante <strong>" . $estudiante->personanatural->primer_nombre . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('estudiante.index');
        } else {
            flash("El estudiante <strong>" . $estudiante->personanatural->primer_nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('estudiante.index');
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
        $estudiante = Estudiante::find($id);
        /*if (count($estudiante->paginas) > 0 || count($estudiante->modulos) > 0 || count($estudiante->users) > 0) {
            flash("El Grupo de usuario <strong>" . $estudiante->nombre . "</strong> no pudo ser eliminado porque tiene permisos o datos-basicos asociados.")->warning();
            return redirect()->route('estudiante.index');
        } else {*/
        $result = $estudiante->delete();
        if ($result) {
            $aud = new Auditoriapersonal();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE ESTUDIANTE. DATOS ELIMINADOS: ";
            foreach ($estudiante->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El estudiante <strong>" . $estudiante->personanatural->primer_nombre . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('estudiante.index');
        } else {
            flash("El estudiante <strong>" . $estudiante->personanatural->primer_nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('estudiante.index');
        }
        //}
    }
}
