<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pipe extends Model
{
    protected $fillable = [
        'id', 'id_status', 'numero', 'numero_economico', 'capacidad', 'compartimentos', 'capacidad_compartimiento',
    ];
}
