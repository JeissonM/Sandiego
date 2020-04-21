<?php

namespace App\Models\Personal;

use Illuminate\Database\Eloquent\Model;

class Padrefamilia extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'acudiente', 'personanatural_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    public function personanatural()
    {
        return $this->belongsTo(Personanatural::class);
    }

    public function padreestudiantes()
    {
        return $this->hasMany(Padreestudiante::class);
    }
}
