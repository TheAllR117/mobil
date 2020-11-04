<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DifferentBill extends Model
{
    public function estacions()
    {
        return $this->hasMany('App\Estacion', 'id', 'id_estacion');
    }

    public function differentbills()
    {
        return $this->hasMany('App\DifferentBillPayments', 'id_different_bill');
    }

    protected $fillable = [
        'id_estacion', 'description', 'add_or_subtract', 'quantity', 'file_pdf', 'file_xml', 'id_status', 'expiration_date'
    ];
}
