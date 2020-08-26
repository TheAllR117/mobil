<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{   
    // relacionamos el control con la fletera que lleva el pedido
    public function freights()
    {
        return $this->hasMany('App\Freight','id', 'id_freights');
    }
    
    // relacionamos el control con los pedidos correspondientes
    public function orders()
    {
        return $this->hasMany('App\Order','control_id','id');
    }

    protected $fillable = [
        'id','id_freights', 'terminal_id', 'dia_entrega', 'created_at','updated_at',
    ];
}
