<?php

namespace App\Models\Personal;

use Illuminate\Database\Eloquent\Model;

class Orientador extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'personanatural_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function personanatural()
    {
        return $this->belongsTo(Personanatural::class);
    }
}
