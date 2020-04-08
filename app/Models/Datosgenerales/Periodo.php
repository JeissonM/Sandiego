<?php

namespace App\Models\Datosgenerales;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'periodo', 'fecha_inicio', 'fecha_fin', 'created_at', 'updated_at'
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
}
