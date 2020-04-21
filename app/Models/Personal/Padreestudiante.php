<?php

namespace App\Models\Personal;

use Illuminate\Database\Eloquent\Model;

class Padreestudiante extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'padrefamilia_id', 'estudiante_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function padrefamilia()
    {
        return $this->belongsTo(Padrefamilia::class);
    }
}
