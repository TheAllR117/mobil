<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pipe extends Model
{
    protected $fillable = [
        'id', 'id_status', 'numero', 'numero_economico', 'capacidad', 'compartimentos','capacidad_1','capacidad_2','contenedor_disponible', 'tractor_id',
    ];
    // Relacion con los tractores
    public function tractors()
    {
        return $this->belongsTo(Tractor::class, 'tractor_id', 'id');
    }
}
