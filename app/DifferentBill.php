<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DifferentBill extends Model
{
    public function estacions()
    {
        return $this->hasMany('App\Estacion', 'id', 'id_estacion');
    }

    protected $fillable = [
        'id_estacion', 'description', 'add_or_subtract', 'quantity', 'file_pdf', 'file_xml'
    ];
}
