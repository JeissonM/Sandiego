<?php

namespace App\Models\Auditoria;

use Illuminate\Database\Eloquent\Model;

class Auditoriadatosgenerales extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'usuario', 'operacion', 'detalles', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];
}
