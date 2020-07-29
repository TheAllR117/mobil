<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Estacion;
use App\Terminal;
use App\Pipe;
use App\Tractor;
use App\Driver;
use App\Control;
use App\Freight;
use App\NameFreight;


class ControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $order)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        return view('control.index', ['orders'=> $order::where('status_id',5)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Order $order, Estacion $estacion,Terminal $terminal, Pipe $pipe, Tractor $tractor, Driver $driver, NameFreight $namefreight)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);

        $fecha = "+1 days";

        if( date("l") == 'Saturday'){
            $fecha = "+2 days";
        }

        $estaciones = $estacion::select('id','razon_social','nombre_sucursal')->get();
        $orders = $order::where('dia_entrega',date("Y-m-d",strtotime($fecha)))->where('status_id',2)->get();

        return view('control.create', ['orders' => $orders, 'estaciones'=>$estaciones, 'terminals'=>$terminal::all(), 'pipes'=>$pipe::all(), 'tractores' => $tractor::all(), 'drivers' => $driver::all(),'fecha'=>date("d/m/Y",strtotime($fecha)), 'namefreights'=>$namefreight::all()]);   
    }


    public function seleccionar_tractor(Freight $freight, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $tractores_total = array();
        
        $tractores = $freight::where('id_freights',$request->id_freights)->get();

        for($i=0; $i<count($tractores); $i++){
            array_push($tractores_total, $tractores[$i]->Tractors);
        }
        $selecion = array('tractores' => $tractores_total, 'id' => $tractores[0]->id);
        return json_encode($selecion);
    }


    public function seleccionar_pipa(Freight $freight, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $pipas_total = array();
        $conductores_total = array();
        
        $pipas = $freight::where('id_tractor',$request->id_tractor)->get();

        for($i=0; $i<count($pipas); $i++){
            array_push($pipas_total, $pipas[$i]->pipes,$pipas[$i]->pipes2);
            array_push($conductores_total, $pipas[$i]->drivers);
        }

        $selecion = array('pipas' => $pipas_total, 'conductores' => $conductores_total);

        return json_encode($selecion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Control $control,Order $order,Pipe $pipe, Tractor $tractor,Driver $driver)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);

        $tractor::where('id', $request->tractor_id)->update(['id_status' => 2]);

        $pipas_selec = explode(',', $request->pipa_id);
        for($i=0; $i<count($pipas_selec); $i++){
            $pipe::where('id', $pipas_selec[$i])->update(['id_status' => 2]);
        }

        $driver::where('id', $request->conductor_id)->update(['id_status' => 2]);

        $control->create($request->except('_token','_method','pipa_id','tractor_id','conductor_id','0','1','2','4'));
        $id_control = $control->get()->last();
        $pedidos = $request->except('_token','_method','pipa_id','tractor_id','terminal_id','conductor_id','fletera','id_freights');
        //dd($pedidos);
        sort($pedidos);

        for($i=0; $i<count($pedidos); $i++){
            $order::where('id', $pedidos[$i])->update(['control_id' => $id_control->id, 'status_id'=>3]);
        }
        return redirect()->route('pedidos.index')->withStatus(__('Armado de pedido exictoso.'));

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
