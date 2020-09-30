<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tractor extends Model
{
    protected $fillable = [
        'id', 'id_status', 'tractor', 'placas', 'marca', 'compartimentos', 'modelo', 'descripcion',
    ];
    // relacion de los tractores con las pipas
    public function pipes()
    {
        return $this->hasMany(Pipe::class);
    }
}
