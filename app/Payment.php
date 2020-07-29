<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // establecemos la relacion de los abonos de con la estacion que los realizo
	public function estacions()
    {
        return $this->hasMany('App\Estacion','id', 'id_estacion');
    }
    
    // establecemos la relacion de los abonos de con la estacion que los realizo
    public function statu_orders()
    {
        return $this->belongsTo('App\Statu_order','id_status');
    }

    protected $fillable = [
        'id', 'id_estacion', 'cantidad', 'url', 'id_status','created_at', 'updated_at',
    ];
}
