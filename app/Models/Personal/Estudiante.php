<?php

namespace App\Models\Personal;

use App\Models\Datosgenerales\Grado;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'desplazado', 'vive_con', 'eps', 'grado_id', 'personanatural_id', 'padrefamilia_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function personanatural()
    {
        return $this->belongsTo(Personanatural::class);
    }

    public function padrefamilia()
    {
        return $this->belongsTo(Padrefamilia::class);
    }

    public function padreestudiantes()
    {
        return $this->hasMany(Padreestudiante::class);
    }
}
