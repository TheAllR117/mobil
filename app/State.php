<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	public function orders()
    {
        return $this->belongsTo('App\Order', 'status_id');
    }

    protected $fillable = [
        'id', 'estado', 'descripcion',
    ];
}
