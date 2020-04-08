<?php

namespace App\Models\Datosgenerales;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'periodo_id', 'grado_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }
}
