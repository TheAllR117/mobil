<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DifferentBillPayments extends Model
{
    public function differentbills()
    {
        return $this->hasMany('App\DifferentBill', 'id', 'id_different_bill');
    }
}
