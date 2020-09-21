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
use Exception;

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
    public function create(Request $request, Order $order, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $terminal=Terminal::all();
        $pipe=Pipe::all();
        $tractor=Tractor::all();
        $driver=Driver::all();
        $namefreight=NameFreight::all();
        $idFreight=-1;
        $idTractor=-1;
        $idPipeOne=-1;
        $idPipeTwo=-1;
        $idDrive=-1;
        $idTerminal=-1;
        $orderControler=[];
        $idOrderControler=-1;
        try{
            $control=Control::find($request->control);
            $idFreight=$control->freights[0]->id_freights;
            $idTractor = $control->freights[0]->id_tractor;
            $idPipeOne=$control->freights[0]->id_pipa_1;
            $idPipeTwo=$control->freights[0]->id_pipa_2;
            $idDrive=$control->freights[0]->id_chofer;
            $orderControler=$order::where('control_id',$request->control)->get();
            $idOrderControler=$request->control;
            $idTerminal=$control->terminal_id;
        }catch(Exception $e){}
        
        if($idOrderControler != -1 && $control->dia_entrega != null){
            $fecha=date("Y-m-d",strtotime($control->dia_entrega));
        }else{
            $fecha = "+1 days";

            if( date("l") == 'Saturday'){
                $fecha = "+2 days";
            }
            $fecha=date("d/m/Y",strtotime($fecha));
        }
        $estaciones = $estacion::select('id','razon_social','nombre_sucursal')->get();
        $orders = $order::where('status_id',2)->orderByDesc('id')->get();
        $data=[
            'orders' => $orders,
            'estaciones'=>$estaciones,
            'terminals'=>$terminal,
            'pipes'=>$pipe,
            'tractores' => $tractor,
            'drivers' => $driver,
            'fecha'=>$fecha,
            'namefreights'=>$namefreight,
            'idFreight'=>$idFreight,
            'idTractor'=>$idTractor,
            'idPipaUno'=>$idPipeOne,
            'idPipaDos'=>$idPipeTwo,
            'idConductor'=>$idDrive,
            'orderControler'=>$orderControler,
            'idOrderControler'=>$idOrderControler,
            'idTerminal'=>$idTerminal
        ];

        return view('control.create', $data);  
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
        // $conductores_total = array();
        
        $pipas = $freight::where('id_tractor',$request->id_tractor)->get();

        for($i=0; $i<count($pipas); $i++){
            array_push($pipas_total, $pipas[$i]->pipes,$pipas[$i]->pipes2);
            // array_push($conductores_total, $pipas[$i]->drivers);
        }

        $selecion = array('pipas' => $pipas_total);

        return json_encode($selecion);
    }
    public function fletes_contador(Request $request)
    {
        $dia_entrega = $request->dia_entrega;
        $fletes = Control::where('dia_entrega', $dia_entrega)->get();
        $count_fletes = count($fletes);

        return $count_fletes;
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
        // return $request->all();
        $tractor::where('id', $request->tractor_id)->update(['id_status' => 2]);

        $pipas_selec = explode(',', $request->pipa_id);
        for($i=0; $i<count($pipas_selec); $i++){
            $pipe::where('id', $pipas_selec[$i])->update(['id_status' => 2]);
        }

        $driver::where('id', $request->chofer_id)->update(['id_status' => 2]);

        $control->create($request->except('_token','_method','pipa_id','tractor_id','0','1','2','4'));

        $id_control = $control->get()->last();
        $pedidos = $request->except('_token','_method','pipa_id','tractor_id','terminal_id','chofer_id','fletera','id_freights');
        //dd($pedidos);
        sort($pedidos);

        for($i=0; $i<count($pedidos); $i++){
            $order::where('id', $pedidos[$i])->update(['control_id' => $id_control->id, 'status_id'=>3]);
        }
        return redirect()->route('pedidos.index')->withStatus(__('Armado de pedido exitoso.'));

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
    public function update(Request $request,Control $control,Order $order,Pipe $pipe, Tractor $tractor,Driver $driver)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $tractor::where('id', $request->tractor_id)->update(['id_status' => 2]);

        $pipas_selec = explode(',', $request->pipa_id);
        for($i=0; $i<count($pipas_selec); $i++){
            $pipe::where('id', $pipas_selec[$i])->update(['id_status' => 2]);
        }

        $driver::where('id', $request->conductor_id)->update(['id_status' => 2]);
        
        $id_control = $control::find($request->idOrderControler);
        $id_control->update($request->except('_token','_method','pipa_id','tractor_id','0','1','2','4'));
        
        $pedidos = $request->except('_token','_method','pipa_id','tractor_id','terminal_id','chofer_id','fletera','id_freights','controlers','idOrderControler','dia_entrega');

        $pedidosOriginales= $id_control->orders;

        for ($i=0;$i<count($pedidosOriginales);$i++){
            $order::find($pedidosOriginales[$i]->id)->update(['control_id' => null, 'status_id'=>2]);
        }
        //dd($pedidos);
        sort($pedidos);

        // return $pedidos;

        for($i=0; $i<count($pedidos); $i++){
            $order::where('id', $pedidos[$i])->update(['control_id' => $id_control->id, 'status_id'=>3]);
        }
        return redirect()->route('pedidos.index')->withStatus(__('Armado de pedido exitoso.'));
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
    // Funcion para calcular la pocision dentro de un arreglo
    private function position($array, $model, $idName){
        for($i=0;$i<count($array);$i++){
            if($array[$i]->id==$model->freights[0]->$idName){
                return $i;
            }
        }
        return -1;
    }
    // Funcion para calcular la pocision dentro de un arreglo
    private function positionPipesDrivers($array, $model, $idName){
        for($i=0;$i<count($array);$i++){
            if($array[$i][0]->id==$model->freights[0]->$idName){
                return $i;
            }
        }
        return -1;
    }
}
