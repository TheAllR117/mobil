<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NameFreight extends Model
{
    protected $fillable = [
        'id','name','rfc','cre','telefono','direccion','contacto'
    ];
}
