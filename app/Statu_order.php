<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statu_order extends Model
{
    // mobil
    
    //establecemos la relacion de los pedidos con los status
	public function orders()
    {
        return $this->belongsTo('App\Order', 'id');
    }
    
    //establecemos la relacion de los abonos con los status
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
    protected $fillable = [
        'id', 'name', 'descripcion',
    ];
}
