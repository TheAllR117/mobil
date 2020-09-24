<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // relacionamos los pedidos con las estaciones
	public function estacions()
    {
        return $this->hasMany('App\Estacion', 'id','estacion_id');
    }

    // relacionamos los pedidos con los estatus
    public function status()
    {
        return $this->hasMany('App\Statu_order','id', 'status_id');
    }

    // relacionamos los pedidos con el control de entregas
    public function controls()
    {
        return $this->hasMany('App\Control','id', 'control_id');
    }

    // relacionamos los pedidos con las freteras
    public function freights()
    {
        return $this->hasOneThrough('App\Freight','App\Control','control_id','id');
    }

    protected $fillable = [
        'id','control_id', 'estacion_id', 'terminal_id', 'status_id', 'camino', 'producto', 'so_number', 'cantidad_lts','costo_aprox','dia_entrega','po',
        'fecha_expiracion', 'pagado', 'metodo_pago', 'total_abonado'
    ];
}
