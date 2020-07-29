<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    // cotizador
    
    public function prices()
    {
        return $this->hasMany('App\Price');
    }

    public function terminals()
    {
        return $this->hasManyThrough('App\Terminal', 'App\Competition', 'terminal_id');
        // return $this->hasOneThrough('App\Competition','App\Terminal', 'terminal_id');
    }

    protected $fillable = [
        'id', 'nombre', 'terminal_id', 'created_at', 'updated_at'
    ];
}
