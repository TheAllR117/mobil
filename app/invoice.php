<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    // relacionamos las facturas con los pedidos
    public function orders()
    {
        return $this->hasMany('App\Order','id', 'pedido_id');
    }

    protected $fillable = [
        'id', 'pedido_id', 'pdf', 'xml','created_at', 'updated_at',
    ];
}
