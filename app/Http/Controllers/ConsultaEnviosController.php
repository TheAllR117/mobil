<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Control;
use App\NameFreight;

class ConsultaEnviosController extends Controller
{
    //
    public function index(Request $request)
    {
        $array_pedidos = array();

        if( $request->fecha_inicio !== null && $request->fecha_termino !== null)
        {
            $fecha_inicio = $request->fecha_inicio;
            $fecha_termino = $request->fecha_termino;

            $pedidos = Control::all();

            foreach($pedidos as $pedido)
            {
                if( $pedido->dia_entrega >= $fecha_inicio  && $pedido->dia_entrega <= $fecha_termino )
                {
                    array_push($array_pedidos,
                        array(
                            'fletera' => $pedido->freights[0]->namefreights[0]->name,
                            'conductor' =>  $pedido->driver->name,
                            'terminal' => $pedido->terminals->razon_social,
                            'tractor' => $pedido->tractors->tractor."-".$pedido->tractors->placas,
                            'dia_entrega' => $pedido->dia_entrega
                        )
                    );
                }
            }

        }

        return view('consultaenvios.index', compact('array_pedidos') );

    }

}
