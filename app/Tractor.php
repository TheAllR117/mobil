<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tractor extends Model
{
    protected $fillable = [
        'id', 'id_status', 'tractor', 'placas', 'marca', 'compartimentos', 'modelo','descripcion',
    ];
}
