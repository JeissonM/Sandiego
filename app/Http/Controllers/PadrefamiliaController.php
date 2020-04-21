<?php

namespace App\Http\Controllers;

use App\Http\Requests\PadrefamiliaRequest;
use App\Models\Auditoria\Auditoriapersonal;
use App\Models\Personal\Estudiante;
use App\Models\Personal\Padreestudiante;
use App\Models\Personal\Padrefamilia;
use App\Models\Personal\Personanatural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PadrefamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $padres = Padrefamilia::all();
        return view('personal.padrefamilia.list')
            ->with('location', 'personal')
            ->with('padres', $padres);
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
        return view('personal.padrefamilia.create')
            ->with('location', 'personal')
            ->with('personas', $per);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PadrefamiliaRequest $request)
    {
        $padre = new Padrefamilia($request->all());
        foreach ($padre->attributesToArray() as $key => $value) {
            $padre->$key = strtoupper($value);
        }
        $u = Auth::user();
        $result = $padre->save();
        if ($result) {
            $aud = new Auditoriapersonal();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE PADRE DE FAMILIA. DATOS: ";
            foreach ($padre->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El padre de familia <strong>" . $padre->personanatural->primer_nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('padrefamilia.index');
        } else {
            flash("El padre de familia <strong>" . $padre->personanatural->primer_nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('padrefamilia.index');
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
        $padre = Padrefamilia::find($id);
        $acudidos = $padre->estudiantes;
        if (count($acudidos) > 0) {
            $padre->acudiente = "SI";
            $padre->save();
        }
        $personas = Estudiante::all();
        $per = null;
        if (count($personas) > 0) {
            foreach ($personas as $p) {
                $per[$p->id] = $p;
            }
        }
        return view('personal.padrefamilia.edit')
            ->with('location', 'personal')
            ->with('padre', $padre)
            ->with('personas', $per)
            ->with('acudidos', $acudidos);
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
        $padre = Padrefamilia::find($id);
        /*if (count($padre->paginas) > 0 || count($padre->modulos) > 0 || count($padre->users) > 0) {
            flash("El Grupo de usuario <strong>" . $padre->nombre . "</strong> no pudo ser eliminado porque tiene permisos o datos-basicos asociados.")->warning();
            return redirect()->route('padrefamilia.index');
        } else {*/
        $result = $padre->delete();
        if ($result) {
            $aud = new Auditoriapersonal();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE PADRE DE FAMILIA. DATOS ELIMINADOS: ";
            foreach ($padre->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El padre de familia <strong>" . $padre->personanatural->primer_nombre . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('padrefamilia.index');
        } else {
            flash("El padre de familia <strong>" . $padre->personanatural->primer_nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('padrefamilia.index');
        }
        //}
    }

    //agrega agrega un estudiante a la lista de acudidos del padre de familia
    public function addestudiante($e, $p)
    {
        $est = Estudiante::find($e);
        $pad = Padrefamilia::find($p);
        $pad->acudiente = "SI";
        $est->padrefamilia_id = $p;
        if ($est->save()) {
            if ($pad->save()) {
                $aud = new Auditoriapersonal();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "ELIMINAR";
                $str = "ADICIONAR ESTUDIANTE A LISTA DE ACUDIDOS DEL PADRE. DATOS MODIFICADOS EN ESTUDIANTE: ";
                foreach ($est->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $str = $str . "   --- DATOS MODIFICADOS EN PADRE DE FAMILIA: ";
                foreach ($pad->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                flash("Operación exitosa, el estudiante fue puesto como acudido por el padre indicado")->success();
                return redirect()->route('padrefamilia.edit', $p);
            } else {
                $est->padrefamilia_id = null;
                $est->save();
                flash("No se pudo procesar la solicitud, repita nuevamente la operación")->error();
                return redirect()->route('padrefamilia.edit', $p);
            }
        } else {
            flash("No se pudo procesar la solicitud, repita nuevamente la operación")->error();
            return redirect()->route('padrefamilia.edit', $p);
        }
    }

    //quita un estudiante a la lista de acudidos del padre de familia
    public function destroyestudiante($e, $p)
    {
        $est = Estudiante::find($e);
        $pad = Padrefamilia::find($p);
        $pad->acudiente = "NO";
        $est->padrefamilia_id = null;
        if ($est->save()) {
            if ($pad->save()) {
                $aud = new Auditoriapersonal();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "ELIMINAR";
                $str = "ELIMINAR ESTUDIANTE DE LA LISTA DE ACUDIDOS DEL PADRE. DATOS MODIFICADOS EN ESTUDIANTE: ";
                foreach ($est->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $str = $str . "   --- DATOS MODIFICADOS EN PADRE DE FAMILIA: ";
                foreach ($pad->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                $acudidos = $pad->estudiantes;
                if (count($acudidos) > 0) {
                    $pad->acudiente = "SI";
                    $pad->save();
                }
                flash("Operación exitosa, el estudiante fue retirado de la lista del padre indicado")->success();
                return redirect()->route('padrefamilia.edit', $p);
            } else {
                $est->padrefamilia_id = $p;
                $est->save();
                flash("No se pudo procesar la solicitud, repita nuevamente la operación")->error();
                return redirect()->route('padrefamilia.edit', $p);
            }
        } else {
            flash("No se pudo procesar la solicitud, repita nuevamente la operación")->error();
            return redirect()->route('padrefamilia.edit', $p);
        }
    }

    //gestionar hijos del padre
    public function hijos($p)
    {
        $pad = Padrefamilia::find($p);
        $personas = Estudiante::all();
        $per = null;
        if (count($personas) > 0) {
            foreach ($personas as $p) {
                $per[$p->id] = $p;
            }
        }
        return view('personal.padrefamilia.hijos')
            ->with('location', 'personal')
            ->with('padre', $pad)
            ->with('personas', $per)
            ->with('hijos', $pad->padreestudiantes);
    }

    //adiciona un hijo
    public function addhijo($p, $h)
    {
        $old = Padreestudiante::where([['padrefamilia_id', $p], ['estudiante_id', $h]])->first();
        if ($old != null) {
            flash("El estudiante que intenta agregar como hijo ya está asociado al padre de familia")->warning();
            return redirect()->route('padrefamilia.hijos', $p);
        }
        $pe = new Padreestudiante();
        $pe->padrefamilia_id = $p;
        $pe->estudiante_id = $h;
        if ($pe->save()) {
            $aud = new Auditoriapersonal();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ADICIONAR HIJO A LISTA DE HIJOS DEL PADRE. DATOS AGREGADOS: ";
            foreach ($pe->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("Operación exitosa, el estudiante fue puesto como hijo del padre indicado")->success();
            return redirect()->route('padrefamilia.hijos', $p);
        } else {
            flash("No se pudo procesar la solicitud, repita nuevamente la operación")->error();
            return redirect()->route('padrefamilia.hijos', $p);
        }
    }

    //retira un hijo
    public function removehijo($p, $h)
    {
        $pe = Padreestudiante::find($h);
        if ($pe->delete()) {
            $aud = new Auditoriapersonal();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINAR HIJO DE LA LISTA DE HIJOS DEL PADRE. DATOS ELIMINADOS: ";
            foreach ($pe->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("Operación exitosa, el estudiante fue retirado como hijo del padre indicado")->success();
            return redirect()->route('padrefamilia.hijos', $p);
        } else {
            flash("No se pudo procesar la solicitud, repita nuevamente la operación")->error();
            return redirect()->route('padrefamilia.hijos', $p);
        }
    }
}
