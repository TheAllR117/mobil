<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Hash;
use App\State;
use App\Order;
use App\Estacion;
use App\Terminal;
use App\Statu_order;
use App\Freight;
use App\Control;
use DB;

use App\Tractor;
use App\Pipe;
use App\Driver;
use DateTime;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $model, Estacion $estacion, Freight $freight,Control $control,Terminal $terminal)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion']);

        $sucursal_usuario = $request->user()->estacions[0]->id;

        $fecha = "+3 days";
        if(date("l") == 'Friday' || date("l") == 'Saturday'){
            $fecha = "+4 days";
        }        
        //dd(date("l"));

        if($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica") {

            return view('pedidos.index', ['orders' => $model::whereBetween('dia_entrega', [date("Y-m-d"), date("Y-m-d", strtotime($fecha))])->get(), 'fecha'=>date("d/m/Y"), 'fecha_sig'=>'a '.date("d/m/Y", strtotime($fecha)), 'freights'=>$freight::all(),'controls'=>$control::whereBetween('created_at', [date("Y-m-d"), date("Y-m-d", strtotime($fecha))])->get(),'terminals'=>$terminal::all()]);

        }else{

            $estaciones = array();
            
            for($i=0; $i<count($request->user()->estacions); $i++){
                array_push($estaciones, $request->user()->estacions[$i]->id);
            }

            return view('pedidos.index', ['orders' => $model::whereIn('estacion_id',$estaciones)->whereBetween('dia_entrega',[date("Y-m-d"), date("Y-m-d", strtotime($fecha))])->get(), 'fecha'=>date("d/m/Y", strtotime($fecha)), 'fecha_sig'=>'','controls'=>$control::whereBetween('created_at', [date("Y-m-d"), date("Y-m-d", strtotime($fecha))])->get(), 'terminals'=>$terminal::all(),'freights'=>$freight::all(),]);
        }
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, State $state,Estacion $estacion, Terminal $terminal, Statu_order $statu_order)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion']);

        if($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica") {

            $estaciones = $estacion::select('id','razon_social','nombre_sucursal')->where("id","!=",1)->get();

        }else{

            $estaciones = array();
            
            for($i=0; $i<count($request->user()->estacions); $i++){
                array_push($estaciones, $request->user()->estacions[$i]->id);
            }

            $estaciones = $estacion::select('id','razon_social','nombre_sucursal')->whereIn('id',$estaciones)->get();
           
        }

        
        $terminales = $terminal::all();
        $statu_orders = $statu_order::all();
        return view('pedidos.create',compact('estaciones','terminales','statu_orders'));
    }


    public function seleccionado(Request $request, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion']);
        //$estaciones = $estacion::where('id', $request->id)->get()->last();
        $estaciones = Estacion::findOrFail($request->id);
        $selecion = array('estacion' => $estaciones, 'price' => $estaciones->prices);
        //$selecion = $request->id;
        return json_encode($selecion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $model,Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion']);

        $model->create($request->except('credito_usado','disponible','credito','saldo'));

        $estacion_up = $estacion::findorfail($request->estacion_id);

        
        
        if($request->saldo != $request->saldo1 && $request->saldo > 0){
            $resta = $request->disponible - $request->credito_usado;
            //dd($request->all());
            //dd($resta);
            $estacion_up->update($request->merge(['saldo' => $request->saldo1, 'credito_usado' => $resta])->all());
        } else {
            //dd($request->costo_aprox);
            //$request->credito_usado
            $credito = $estacion_up->credito_usado + $request->costo_aprox;
            $estacion_up->update($request->merge(['credito_usado' => $credito])->all());
        }
        return redirect()->route('pedidos.index')->withStatus(__('Pedido generado correctamente.'));
    }

    public function individual(Request $request,Control $control,Order $order,Pipe $pipe, Tractor $tractor,Driver $driver,Freight $freight)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $fletera = $freight::where('id_estacion', $request->id)->get();
        //dd($fletera);
        for($i=0; $i<count($fletera); $i++){

            if($fletera[$i]->Tractors[0]->id_status == 1 && $fletera[$i]->pipes[0]->id_status == 1 && $fletera[$i]->drivers[0]->id_status == 1 ){
                //dd($fletera[$i]->drivers[0]->name);
                DB::table('controls')->insert(
                    ['id_freights' => $fletera[$i]->id, 'terminal_id' => $request->id_terminal,'created_at'=>date("Y-m-d"),'updated_at'=>date("Y-m-d")]
                );
                $control_now = $control::where('id_freights', $fletera[$i]->id)->get()->last();
                $order_now = $order::where('estacion_id', $request->id)->get()->last()->update(['control_id'=>$control_now->id ,'status_id' => 3]);

                $driver::where('id', $fletera[$i]->drivers[0]->id)->update(['id_status'=> 2]);
                $tractor::where('id', $fletera[$i]->Tractors[0]->id)->update(['id_status'=> 2]);
                $pipe::where('id', $fletera[$i]->pipes[0]->id)->update(['id_status'=> 2]);
                return redirect()->route('pedidos.index')->withStatus(__('Pedido en camino.'));
                break;

            }else{
                return redirect()->route('pedidos.index')->withStatus(__('No hay Equipo disponible para el envio.'));
            }
            //var_dump( $fletera[$i]->Tractors[0]->id_status);
        }
        //dd($fletera[0]->Tractors[0]->id_status);
    }

    public function emergencia(Request $request,Order $order)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        if($request->id != "" && $request->order_id_e != ""){

            $order = $order::findorfail($request->order_id_e);
            $control_id = $order->control_id;
            $_firstDate = date($order->dia_entrega);
            $_newDate = strtotime($_firstDate.'+1 days');
            $order_emer = $order::where('so_number', $request->id)->update(['control_id'=>$order->control_id ,'status_id'=> 3]);
            $order->update(['control_id'=>null,'status_id'=> 2 ,'dia_entrega'=> date("Y-m-d",$_newDate)]);
            
            return redirect()->route('pedidos.index')->withStatus(__('Pedido cambiado exitosamente.'));
        }else{
            return redirect()->route('pedidos.index')->withStatus(__('Error al cambiar el pedido.'));
        }
        
    }

    public function sonomber(Request $request, Order $model)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
       
        $order = $model::findorfail($request->id);
        $order->update($request->all());
        
        return json_encode('SO Number agregado Correctamente.');
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
    public function edit(Request $request,$id)
    {
       
    }

    public function cambiar_status(Request $request, $id, Order $model)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $order = $model::findorfail($request->id);
        $order->update(['status_id'=>4]);
        return redirect()->route('pedidos.index')->withStatus(__('Pedido Concluido.'));
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
    public function destroy(Request $request, $id, Order $order, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion']);

        $orders = $order::findorfail($id);
        $estacions = $estacion::findorfail($orders->estacions[0]->id);
        $estacions->update($request->all());

        $saldo = 0;

        if($orders->estacions[0]->credito_usado == 0){
            $saldo = $orders->estacions[0]->saldo + $orders->costo_aprox;
            //dd($saldo);
            $estacions->saldo = $saldo;
            $estacions->save();
            //$estacions->update($request->all());
        }else{

            $saldo = $orders->estacions[0]->credito_usado - $orders->costo_aprox;
            
            if($saldo < 0)
            {
                //dd(abs($saldo));
                $estacions->saldo = abs($saldo);
                $estacions->credito_usado = 0;
            }else{
                $estacions->credito_usado = $saldo;
            }
            
            $estacions->save();
            //$estacions->update($request->all());
        }
        //echo $saldo;
        //dd($orders->costo_aprox);
        $orders->delete();

        return redirect()->route('pedidos.index')->withStatus(__('Pedido eliminado exitosamente.'));
    }


    public function destroy_order(Request $request, $id, Order $order, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);

        $orders = $order::findorfail($id);
        $estacions = $estacion::findorfail($orders->estacions[0]->id);
        $estacions->update($request->all());

        $saldo = 0;

        if($orders->estacions[0]->credito_usado == 0){
            $saldo = $orders->estacions[0]->saldo + $orders->costo_aprox;
            $estacions->saldo = $saldo;
            $estacions->save();
            //$estacions->update($request->all());
        }else{
            $saldo = $orders->estacions[0]->credito_usado - $orders->costo_aprox;
            $estacions->credito_usado = $saldo;
            $estacions->save();
            //$estacions->update($request->all());
        }
        //echo $saldo;
        //dd($orders->costo_aprox);
        $orders->status_id = 6;
        $orders->save();

        return redirect()->route('pedidos.index')->withStatus(__('Pedido Cancelado correctamente.'));
    }

    public function liberar_flete(Request $request, Freight $freight,Pipe $pipe, Tractor $tractor,Driver $driver,Order $order, Control $control)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);

        $orders = $order::where('control_id',$request->id)->get();
        $controls = $control::find($orders[0]->control_id);
        //dd($orders[0]->control_id);
        $freights = $freight::findorfail($controls->id_freights);
        
        //dd($id);
        for($i=0; $i<count($orders->all()); $i++){
            $order::where('id',$orders[$i]->id)->update(['status_id' => 5]);
        }
        $tractor::where('id', $freights->id_tractor)->update(['id_status' => 1]);
        $pipe::where('id', $freights->id_pipa_1)->update(['id_status' => 1]);
        if($freights->id_pipa_2 != ""){
            $pipe::where('id', $freights->id_pipa_2)->update(['id_status' => 1]);
        }
        $driver::where('id', $freights->id_chofer)->update(['id_status' => 1]);

        return redirect()->route('pedidos.index')->withStatus(__('Flete liberado correctamente'));
    }
}
