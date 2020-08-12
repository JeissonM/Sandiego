<?php

namespace App\Models\Datosgenerales;

use Illuminate\Database\Eloquent\Model;

class Tipocaso extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'nivel', 'created_at', 'updated_at'
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
