<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPayments extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order', 'id_order');
    }
    // relacionamos los pedidos con los estatus
    public function status()
    {
        return $this->hasMany('App\Statu_order', 'id', 'id_status');
    }

    protected $fillable = [
        'id_order', 'cantidad', 'url', 'id_status'
    ];
}
