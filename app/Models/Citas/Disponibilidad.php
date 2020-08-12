<?php

namespace App\Models\Citas;

use App\Models\Datosgenerales\Periodo;
use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fecha', 'horainicio', 'horafin', 'estado', 'periodo_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function periodos()
    {
        return $this->belongsTo(Periodo::class);
    }
}
