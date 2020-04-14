<?php

namespace App\Models\Personal;

use App\Models\Datosgenerales\Regimen;
use App\Models\Datosgenerales\Tipodoc;
use App\Models\Datosgenerales\Tipopersonaj;
use Illuminate\Database\Eloquent\Model;

class Entecontrol extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'direccion', 'mail', 'celular', 'telefono', 'numero_documento', 'lugar_expedicion', 'fecha_expedicion', 'numeroresolucion', 'razonsocial', 'representantelegal', 'cargorepresentante', 'fax', 'tipopersonaj_id', 'tipodoc_id', 'regimen_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function tipopersonaj()
    {
        return $this->belongsTo(Tipopersonaj::class);
    }

    public function tipodoc()
    {
        return $this->belongsTo(Tipodoc::class);
    }

    public function regimen()
    {
        return $this->belongsTo(Regimen::class);
    }
}
