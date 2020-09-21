<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    // relacionamos las fleteras con las estaciones en caso de contar con una
	public function estacions()
    {
        return $this->hasMany('App\Estacion','id', 'id_estacion');
    }
    
    // relacionamos la fletera 
    public function namefreights()
    {
        return $this->hasMany('App\NameFreight','id', 'id_freights');
    }
    
    // relacionamos la fletera con las pipas correspondientes
    public function pipes()
    {
        return $this->hasMany('App\Pipe','id', 'id_pipa_1');
    }
    
    public function pipes2()
    {
        return $this->hasMany('App\Pipe','id', 'id_pipa_2');
    }
    
    // relacionas la fleteras con el tractor
    public function Tractors()
    {
        return $this->hasMany('App\Tractor','id', 'id_tractor');
    }

    protected $fillable = [
        'id','id_freights','id_estacion','id_pipa_1','id_pipa_2','id_tractor'
    ];
}
