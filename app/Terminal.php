<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    // cotizador
    
    // relacionamos la tabla terminales con la de fits para obtener los descuentos por terminal
    public function fits()
    {
        return $this->hasMany('App\Fit');
    }
    // relacionamos la tabla terminales con la de fits para obtener los descuentos por terminal
    public function fit()
    {
        return $this->belongsTo('App\Fit', 'id', 'terminal_id');
    }
    // relacionamos la tabla terminales con la de competidores para obtener la relacion correspondiente
    public function competitions()
    {
        return $this->hasMany('App\Competition');
    }
    // relacionamos la tabla terminales con la de valero para obtener los precios
    public function valeros()
    {
        return $this->hasMany('App\Valero');
    }
    protected $fillable = [
        'id', 'razon_social', 'rfc', 'nombre_terminal', 'status', 'codigo_postal', 'tipo_de_vialidad', 'nombre_de_vialidad', 'n_exterior', 'n_interior',
    ];
}
