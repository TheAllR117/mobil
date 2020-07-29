<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estacion extends Model
{

    // relacionamos la estacion con los usuarios
    public function users(){
        return $this->belongsToMany('App\User');
    }
    
    // relacionamos la estacion con su historial de precios de combustible
    public function prices()
    {
        return $this->hasMany('App\Price','id_estacion');
    }
    
    // relacionamos la estacion con sus pedidos correspondientes
    public function orders()
    {
        return $this->hasMany('App\Order', 'estacion_id');
    }
    
    // relacionamos la estacion con sus fleteras si llegara a tener
    public function freights()
    {
        return $this->hasMany('App\Freight','id_estacion','id');
    }
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'razon_social', 'rfc', 'cre', 'sh', 'saldo', 'nombre_sucursal', 'linea_credito', 'credito', 'credito_usado', 'dias_credito', 'retencion' ,'status', 'datos_fiscales', 'codigo_postal','tipo_de_vialidad','nombre_de_vialidad', 'n_exterior','n_interior','nombre_colonia','nombre_localidad','nombre_municipio_o_demarcacion_territorial','nombre_entidad_federativa','entre_calle','y_calle','flete_r','flete_p','flete_d','ieps_r','ieps_p','ieps_d','utilidad_r','utilidad_p','utilidad_d'
    ];

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    //protected $dates = ['created_at'];
}
