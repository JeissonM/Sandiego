<?php

namespace App\Models\Datosgenerales;

use App\Models\Personal\Estudiante;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'grado', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
