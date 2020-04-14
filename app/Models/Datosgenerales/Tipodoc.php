<?php

namespace App\Models\Datosgenerales;

use App\Models\Personal\Entecontrol;
use App\Models\Personal\Personanatural;
use Illuminate\Database\Eloquent\Model;

class Tipodoc extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'abreviatura', 'created_at', 'updated_at'
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

    public function entecontrols()
    {
        return $this->hasMany(Entecontrol::class);
    }
}
