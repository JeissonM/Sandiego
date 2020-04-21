<?php

namespace App\Models\Personal;

use App\Models\Datosgenerales\Estadocivil;
use App\Models\Datosgenerales\Tipodoc;
use Illuminate\Database\Eloquent\Model;

class Personanatural extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'direccion', 'mail', 'celular', 'telefono', 'numero_documento', 'lugar_expedicion', 'fecha_expedicion', 'primer_nombre', 'segundo_nombre', 'sexo', 'fecha_nacimiento', 'libreta_militar', 'rh', 'primer_apellido', 'segundo_apellido', 'distrito_militar', 'clase_libreta', 'tipodoc_id', 'estadocivil_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function tipodoc()
    {
        return $this->belongsTo(Tipodoc::class);
    }

    public function estadocivil()
    {
        return $this->belongsTo(Estadocivil::class);
    }

    public function docente()
    {
        return $this->hasOne(Docente::class);
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class);
    }

    public function padrefamilia()
    {
        return $this->hasOne(Padrefamilia::class);
    }

    public function coordinador()
    {
        return $this->hasOne(Coordinador::class);
    }

    public function orientador()
    {
        return $this->hasOne(Orientador::class);
    }
}
