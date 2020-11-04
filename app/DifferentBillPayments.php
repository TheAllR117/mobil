<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DifferentBillPayments extends Model
{
    // relacionamos los pedidos con los estatus
    public function status()
    {
        return $this->hasMany('App\Statu_order', 'id', 'id_status');
    }
    public function differentbills()
    {
        return $this->belongsTo('App\DifferentBill', 'id_different_bill');
    }
    protected $fillable = [
        'id_different_bill', 'cantidad', 'url', 'id_status', 'deposit_date'
    ];
}
