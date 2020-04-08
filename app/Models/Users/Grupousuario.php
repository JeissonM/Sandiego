<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Grupousuario extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'descripcion',  'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function paginas()
    {
        return $this->belongsToMany(Pagina::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function modulos()
    {
        return $this->belongsToMany(Modulo::class);
    }
}
