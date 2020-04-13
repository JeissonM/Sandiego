<?php

namespace App\Models\Datosgenerales;

use App\Models\Personal\Personanatural;
use Illuminate\Database\Eloquent\Model;

class Estadocivil extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function personanaturals()
    {
        return $this->hasMany(Personanatural::class);
    }
}
