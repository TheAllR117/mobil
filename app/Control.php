<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    // relacionamos el control con la fletera que lleva el pedido
    public function freights()
    {
        return $this->hasMany('App\Freight', 'id', 'id_freights');
    }

    // relacionamos el control con los pedidos correspondientes
    public function orders()
    {
        return $this->hasMany('App\Order', 'control_id', 'id');
    }

    // Relacion con los choferes
    public function driver()
    {
        return $this->belongsTo('App\Driver', 'id_chofer', 'id');
    }

    // Relacion con las pipas
    public function pipeUno()
    {
        return $this->belongsTo(Pipe::class, 'pipe_id_1', 'id');
    }
    public function pipeDos()
    {
        return $this->belongsTo(Pipe::class, 'pipe_id_2', 'id');
    }
    public function pipeTres()
    {
        return $this->belongsTo(Pipe::class, 'pipe_id_3', 'id');
    }
    protected $fillable = [
        'id', 'id_freights', 'terminal_id', 'id_chofer', 'dia_entrega', 'pipe_id_1', 'pipe_id_2', 'pipe_id_3', 'created_at', 'updated_at',
    ];
}
