<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradoRequest;
use App\Models\Auditoria\Auditoriadatosgenerales;
use App\Models\Datosgenerales\Grado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grados = Grado::all()->sortBy('created_at');
        return view('datos_basicos.grados.list')
            ->with('location', 'datos-basicos')
            ->with('grados', $grados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('datos_basicos.grados.create')
            ->with('location', 'datos-basicos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradoRequest $request)
    {
        $grado = new Grado($request->all());
        foreach ($grado->attributesToArray() as $key => $value) {
            $grado->$key = strtoupper($value);
        }
        $u = Auth::user();
        $result = $grado->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE GRADO. DATOS: ";
            foreach ($grado->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El grado <strong>" . $grado->grado . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('grado.index');
        } else {
            flash("El grado <strong>" . $grado->grado . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('grado.index');
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
        /*$grado = Grado::find($id);
        return view('datos-basicos.Grados.show')
            ->with('location', 'datos-basicos')
            ->with('Grado', $grado);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grado = Grado::find($id);
        return view('datos_basicos.grados.edit')
            ->with('location', 'datos-basicos')
            ->with('grado', $grado);
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
        $grado = Grado::find($id);
        $m = new Grado($grado->attributesToArray());
        foreach ($grado->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $grado->$key = strtoupper($request->$key);
            }
        }
        $u = Auth::user();
        $result = $grado->save();
        if ($result) {
            $aud = new Auditoriadatosgenerales();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE GRADOS. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($grado->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El grado <strong>" . $grado->grado . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('grado.index');
        } else {
            flash("El grado <strong>" . $grado->grado . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('grado.index');
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
        $grado = Grado::find($id);
        if (count($grado->grupos) > 0) {
            flash("El grado <strong>" . $grado->grado . "</strong> no pudo ser eliminado porque tiene grupos o cursos asociados.")->warning();
            return redirect()->route('grado.index');
        } else {
            $result = $grado->delete();
            if ($result) {
                $aud = new Auditoriadatosgenerales();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "ELIMINAR";
                $str = "ELIMINACIÓN DE GRADOS. DATOS ELIMINADOS: ";
                foreach ($grado->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                flash("El grado <strong>" . $grado->grado . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('grado.index');
            } else {
                flash("El grado <strong>" . $grado->grado . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('grado.index');
            }
        }
    }
}
