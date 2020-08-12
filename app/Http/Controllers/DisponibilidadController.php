<?php

namespace App\Http\Controllers;

use App\Models\Auditoria\Auditoriacita;
use App\Models\Citas\Disponibilidad;
use App\Models\Datosgenerales\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisponibilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::all()->sortByDesc('created_at');
        return view('citas.disponibilidad.list')
            ->with('location', 'citas')
            ->with('periodos', $periodos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $per = Periodo::find($id);
        return view('citas.disponibilidad.create')
            ->with('location', 'citas')
            ->with('per', $per);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array = null;
        if (isset($request->hora_inicio)) {
            foreach ($request->hora_inicio as $key => $hi) {
                $ac = new Disponibilidad();
                $ac->periodo_id = $request->periodo_id;
                $ac->fecha = $request->fecha;
                $ac->horainicio = $hi;
                $ac->horafin = $request->hora_fin[$key];
                $array[] = $ac;
            }
            if ($array != null) {
                $response = "<h4>Detalles del proceso</h4>";
                foreach ($array as $r) {
                    if (strpos($r->horainicio, ':') == false) {
                        if ($r->save()) {
                            $u = Auth::user();
                            $aud = new Auditoriacita();
                            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                            $aud->operacion = "INSERTAR";
                            $str = "CREACIÓN DE HORARIOS PARA CITAS. DATOS: ";
                            foreach ($r->attributesToArray() as $key => $value) {
                                $str = $str . ", " . $key . ": " . $value;
                            }
                            $aud->detalles = $str;
                            $aud->save();
                            $response = $response . "<p>[OK]  El horario " . $r->horainicio . " - " . $r->horafin . " se guardó con éxito</p>";
                        } else {
                            $response = $response . "<p>[x]  El horario " . $r->horainicio . " - " . $r->horafin . " no se guardó</p>";
                        }
                    } else {
                        $response = $response . "<p>[x]  El horario " . $r->horainicio . " - " . $r->horafin . " no se guardó porque tiene 2 puntos (:)</p>";
                    }
                }
                flash($response)->success();
                return redirect()->route('disponibilidad.edit', $request->periodo_id);
            } else {
                flash('No hay horarios para guardar')->warning();
                return redirect()->route('disponibilidad.edit', $request->periodo_id);
            }
        } else {
            flash('No hay horarios para guardar')->warning();
            return redirect()->route('disponibilidad.edit', $request->periodo_id);
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
        $per = Periodo::find($id);
        $agenda = null;
        $agenda = $per->disponibilidads;
        if ($agenda != null) {
            foreach ($agenda as $a) {
                $hi = (string) $a->horainicio;
                $hf = (string) $a->horafin;
                if (strlen($hi) < 4) {
                    $a->horainicio = "0" . $hi[0] . ":" . $hi[1] . $hi[2];
                } else {
                    $a->horainicio = $hi[0] . $hi[1] . ":" . $hi[2] . $hi[3];
                }
                if (strlen($hf) < 4) {
                    $a->horafin = "0" . $hf[0] . ":" . $hf[1] . $hf[2];
                } else {
                    $a->horafin = $hf[0] . $hf[1] . ":" . $hf[2] . $hf[3];
                }
            }
        }
        return view('citas.disponibilidad.fechas')
            ->with('location', 'citas')
            ->with('per', $per)
            ->with('agenda', $agenda);
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
        $ac = Disponibilidad::find($id);
        $result = $ac->delete();
        if ($result) {
            $aud = new Auditoriacita();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE HORARIO DE CITAS. DATOS ELIMINADOS: ";
            foreach ($ac->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash('Eliminado con éxito')->success();
            return redirect()->route('disponibilidad.edit', $ac->periodo_id);
        } else {
            flash("No se pudo eliminar")->error();
            return redirect()->route('disponibilidad.edit', $ac->periodo_id);
        }
    }
}
