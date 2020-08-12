<?php

namespace App\Http\Controllers;

use App\Models\Auditoria\Auditoriapersonal;
use App\Models\Datosgenerales\Estadocivil;
use App\Models\Datosgenerales\Grado;
use App\Models\Datosgenerales\Tipodoc;
use App\Models\Personal\Docente;
use App\Models\Personal\Estudiante;
use App\Models\Personal\Padrefamilia;
use App\Models\Personal\Personanatural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistropublicoController extends Controller
{
    //devuelve el formulario para la creacion de personal desde el ambito público
    public function create($source)
    {
        $tipodocs = Tipodoc::all()->pluck('descripcion', 'id');
        $estadoscivil = Estadocivil::all()->pluck('descripcion', 'id');
        $grados = Grado::all()->pluck('grado', 'id');
        return view('publico.registropersonas.create')
            ->with('tipodocs', $tipodocs)
            ->with('estados', $estadoscivil)
            ->with('grados', $grados)
            ->with('source', $source);
    }

    //almacena la información
    public function store(Request $request)
    {
        //dd($request->all());
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
        if ($persona->estadocivil_id == "" || $persona->estadocivil_id == "0") {
            $persona->estadocivil_id = null;
        }
        $exito = false;
        if ($persona->save()) {
            $this->auditoriaPersona($persona, $request);
            if ($request->source == 'DOCENTE') {
                if ($this->setDocente($request, $persona)) {
                    $exito = true;
                } else {
                    $persona->delete();
                }
            }
            if ($request->source == 'PADRE-DE-FAMILIA') {
                if ($this->setPadre($persona)) {
                    $exito = true;
                } else {
                    $persona->delete();
                }
            }
            if ($request->source == 'ESTUDIANTE') {
                if ($this->setEstudiante($request, $persona)) {
                    $exito = true;
                } else {
                    $persona->delete();
                }
            }
            if ($request->source == 'PERSONA-NATURAL') {
                $exito = true;
            }
            if ($exito) {
                flash("El/La " . $request->source . " <stong>" . $persona->primer_nombre . "</strong> fue almacenado(a) de forma exitosa!")->success();
                return redirect('/');
            } else {
                flash("La persona <strong>" . $persona->primer_nombre . "</strong> no pudo ser almacenada.")->error();
                return redirect('/');
            }
        } else {
            flash("La persona <strong>" . $persona->primer_nombre . "</strong> no pudo ser almacenada.")->error();
            return redirect('/');
        }
    }

    public function auditoriaPersona($persona, $request)
    {
        $aud = new Auditoriapersonal();
        $aud->usuario = "ID: " . $request->identificacion . ",  USUARIO: " . $request->primer_nombre . " " . $request->segundo_nombre . " " . $request->primer_apellido . " " . $request->segundo_apellido;
        $aud->operacion = "INSERTAR";
        $str = "CREACIÓN DE PERSONAS NATURALES DESDE EL ENTORNO PÚBLICO. DATOS: ";
        foreach ($persona->attributesToArray() as $key => $value) {
            $str = $str . ", " . $key . ": " . $value;
        }
        $aud->detalles = $str;
        $aud->save();
    }

    //almacena un docente
    public function setDocente($request, $persona)
    {
        $docente = new Docente();
        $docente->profesion = strtoupper($request->profesion);
        if ($request->fecha_graduacion == "") {
            $docente->fecha_graduacion = null;
        } else {
            $docente->fecha_graduacion = $request->fecha_graduacion;
        }
        $docente->personanatural_id = $persona->id;
        if ($docente->save()) {
            $aud2 = new Auditoriapersonal();
            $aud2->usuario = "ID: " . $request->identificacion . ",  USUARIO: " . $request->primer_nombre . " " . $request->segundo_nombre . " " . $request->primer_apellido . " " . $request->segundo_apellido;
            $aud2->operacion = "INSERTAR";
            $str2 = "CREACIÓN DE DOCENTE. DATOS: ";
            foreach ($docente->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            $aud2->detalles = $str2;
            $aud2->save();
            return true;
        } else {
            return false;
        }
    }

    //almacena un padre de familia
    public function setPadre($persona)
    {
        $padre = new Padrefamilia();
        $padre->personanatural_id = $persona->id;
        $padre->acudiente = "NO";
        if ($padre->save()) {
            $aud3 = new Auditoriapersonal();
            $aud3->usuario = "ID: " . $persona->identificacion . ",  USUARIO: " . $persona->primer_nombre . " " . $persona->segundo_nombre . " " . $persona->primer_apellido . " " . $persona->segundo_apellido;
            $aud3->operacion = "INSERTAR";
            $str3 = "CREACIÓN DE PADRE DE FAMILIA. DATOS: ";
            foreach ($padre->attributesToArray() as $key => $value) {
                $str3 = $str3 . ", " . $key . ": " . $value;
            }
            $aud3->detalles = $str3;
            $aud3->save();
            return true;
        } else {
            return false;
        }
    }

    //almacena un estudiante
    public function setEstudiante($request, $persona)
    {
        $estudiante = new Estudiante($request->all());
        $estudiante->desplazado = $request->desplazado;
        $estudiante->vive_con = $request->vive_con;
        $estudiante->eps = $request->eps;
        $estudiante->grado_id = $request->grado_id;
        $estudiante->padrefamilia_id = null;
        $estudiante->personanatural_id = $persona->id;
        if ($estudiante->save()) {
            $aud4 = new Auditoriapersonal();
            $aud4->usuario = "ID: " . $request->identificacion . ",  USUARIO: " . $request->primer_nombre . " " . $request->segundo_nombre . " " . $request->primer_apellido . " " . $request->segundo_apellido;
            $aud4->operacion = "INSERTAR";
            $str4 = "CREACIÓN DE ESTUDIANTES. DATOS: ";
            foreach ($estudiante->attributesToArray() as $key => $value) {
                $str4 = $str4 . ", " . $key . ": " . $value;
            }
            $aud4->detalles = $str4;
            $aud4->save();
            return true;
        } else {
            return false;
        }
    }
}
