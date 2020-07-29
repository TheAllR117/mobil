<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{   
    // establecemos la relacion de los precios por estacion
	public function estacion()
    {
        return $this->belongsTo('App\Estacion','id_estacion');
    }
    protected $fillable = [
        'id', 'id_estacion', 'extra','supreme','diesel','extra_u','supreme_u','diesel_u',
    ];

}
