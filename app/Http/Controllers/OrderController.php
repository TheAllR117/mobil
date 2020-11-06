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
use App\Price;
use DB;

use App\Tractor;
use App\Pipe;
use App\Driver;
use DateTime;
use vendor\autoload;
use Exception;

use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $model, Estacion $estacion, Freight $freight, Control $control, Terminal $terminal)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica', 'Admin-Estacion']);

        // eliminar pedidos vencidos que tengan status 1 o 2
        // Order::whereDate('fecha_eliminacion', '<=', date("Y/m/d"))->where('status_id', '==', '2')->delete();
        $pedidos_a_cancelar = Order::where('status_id', '2')->whereDate('fecha_eliminacion', '<=', date("Y/m/d"))->get();

        for($c=0; $c<count($pedidos_a_cancelar); $c++){
            // buscamos la estación
            $info_estacion = $estacion::findOrFail($pedidos_a_cancelar[$c]->estacion_id);
            // credito de la estación
            $credito = $info_estacion->credito;
            // credito usado de la estación
            $credito_usado = $info_estacion->credito_usado;
            // credito disponible de la estación
            $disponible = $credito - $credito_usado;
            
            /*  
                verificamos si la estación tiene credito usado igual a cero y saldo igual o mayor a cero, 
                para agregar el costo_aprox al saldo
            */
            if(floatval($info_estacion->saldo) >= 0 && floatval($info_estacion->credito_usado) == 0){
                $info_estacion->update(['saldo' => $pedidos_a_cancelar[$c]->costo_aprox + floatval($info_estacion->saldo)]);
            } 
            elseif (floatval($info_estacion->credito_usado) > 0) {
                /*  
                    verificamos si la estación tiene credito usado mayor a cero, 
                    para agregar el costo_aprox al credito_usado
                */
                $total = $pedidos_a_cancelar[$c]->costo_aprox + $disponible;
    
                if($total == $credito){
                   $info_estacion->update(['credito_usado' => 0]);
                }
                elseif($total < $credito)
                {
                    $info_estacion->update(['credito_usado' => $credito - $total]);
                }
                else
                {
                    $info_estacion->update(['credito_usado' => 0 ,'saldo' => $info_estacion->saldo + abs($total) ]);
                }
            }else{
                return json_encode($info_estacion->saldo);
            }

            $pedidos_a_cancelar[$c]->update(['status_id' => 6]);
            
        }

        $sucursal_usuario = $request->user()->estacions[0]->id;

        $fecha = "+3 days";
        if (date("l") == 'Friday' || date("l") == 'Saturday') {
            $fecha = "+4 days";
        }

        if ($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica") {
            return view('pedidos.index', ['orders' => $model::all(), 'fecha' => date("d/m/Y"), 'fecha_sig' => 'a ' . date("d/m/Y", strtotime($fecha)), 'freights' => $freight::all(), 'controls' => $control::all(), 'terminals' => $terminal::all(), 'choferes' => Driver::all(), 'estaciones' => $estacion::all()]);
        } else {

            $estaciones = array();

            for ($i = 0; $i < count($request->user()->estacions); $i++) {
                array_push($estaciones, $request->user()->estacions[$i]->id);
            }

            return view('pedidos.index', ['orders' => $model::whereIn('estacion_id', $estaciones)->get(), 'fecha' => date("d/m/Y", strtotime($fecha)), 'fecha_sig' => '', 'controls' => $control::all(), 'terminals' => $terminal::all(), 'freights' => $freight::all()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, State $state, Estacion $estacion, Terminal $terminal, Statu_order $statu_order, Pipe $pipas, Freight $freight)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica', 'Admin-Estacion']);

        $fleteras = $freight::where('id_estacion', null)->get();

        $pipas_capacidad = [];

        for($i=0; $i<count($fleteras); $i++){
            for($j=0; $j<count($fleteras[$i]->tractors); $j++){
                    array_push($pipas_capacidad, $fleteras[$i]->tractors[$j]->pipes()->select('capacidad_1')->groupBy('capacidad_1')->get());
                    array_push($pipas_capacidad, $fleteras[$i]->tractors[$j]->pipes()->select('capacidad_2')->groupBy('capacidad_2')->get());
                    array_push($pipas_capacidad, $fleteras[$i]->tractors[$j]->pipes()->select('capacidad')->groupBy('capacidad')->get());
            }
        }

        $capacidad_1 = [];
        foreach($pipas_capacidad as $tractor){
            foreach($tractor as $capacidad){
                if($capacidad['capacidad_1']){
                    array_push($capacidad_1, $capacidad['capacidad_1']);
                }
                if($capacidad['capacidad_2']){
                    array_push($capacidad_1, $capacidad['capacidad_2']);
                }
                if($capacidad['capacidad']){
                    array_push($capacidad_1, $capacidad['capacidad']);
                }
            }
        }

        
        $tem = array_unique($capacidad_1);
        sort($tem);
        

        if ($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica") {

            $estaciones = $estacion::select('id', 'razon_social', 'nombre_sucursal')->where("id", "!=", 1)->get();
        } else {

            $estaciones = array();

            for ($i = 0; $i < count($request->user()->estacions); $i++) {
                array_push($estaciones, $request->user()->estacions[$i]->id);
            }

            $estaciones = $estacion::select('id', 'razon_social', 'nombre_sucursal')->whereIn('id', $estaciones)->get();
        }


        $terminales = $terminal::all();
        $statu_orders = $statu_order::all();
        return view('pedidos.create', compact('estaciones', 'terminales', 'statu_orders', 'tem'));
    }


    public function seleccionado(Request $request, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica', 'Admin-Estacion']);
        //$estaciones = $estacion::where('id', $request->id)->get()->last();
        $estaciones = Estacion::findOrFail($request->id);

        /* Obtendremos los precios actualizados hasta la fecha */

        $id_estacion = $request->id;

        $fechas_precios = Price::select('extra', 'supreme', 'diesel', 'extra_u', 'supreme_u', 'diesel_u',
                DB::raw('DATEDIFF(created_at, CURDATE()) as dias'),
                DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as fecha')
            )
            ->where('id_estacion',$id_estacion)
            ->get();

        $valores_ultima_actualizacion = null;

        if( count($fechas_precios) > 0 ){

            $dias = $fechas_precios[0]->dias;


            foreach($fechas_precios as $fecha_precio)
            {
                if($fecha_precio->dias <= 0)
                {
                    if($fecha_precio->dias >= $dias)
                    {
                        $valores_ultima_actualizacion = $fecha_precio;
                        $dias = $fecha_precio->dias;
                    }
                }
            }
        }

        /* FIN precios actualizados hasta la fecha */

        /* Verificamos que no haya adeudo */

        $ordenes = Order::select( 'fecha_expiracion' ,DB::raw('DATEDIFF( STR_TO_DATE(fecha_expiracion, "%d-%m-%Y") , CURDATE()) as dias') )
            ->where('estacion_id', $id_estacion)
            ->where('metodo_pago','credito')
            ->where('pagado','FALSE')
            ->get();

        $hay_adeudo = 0;
        foreach($ordenes as $orden)
        {
            if($orden->dias < 0)
            {
                $hay_adeudo = 1;
            }
        }

        /* FIN verificar adeudo */


        $selecion = array(
            'estacion' => $estaciones,
            'price' => $estaciones->prices,
            'valores_ultima_actualizacion' => $valores_ultima_actualizacion,
            'hay_adeudo' => $hay_adeudo
        );
        //$selecion = $request->id;
        return json_encode($selecion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $model, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica', 'Admin-Estacion']);

        // $model->create($request->except('credito_usado', 'disponible', 'credito', 'saldo'));

        $estacion_up = $estacion::findorfail($request->estacion_id);

        $order_last = Order::all();

        if( count($order_last) > 0 )
        {
            $po_array = explode('MO', $order_last->last()->po);

            if( count($po_array) > 1 )
            {
                $po_last = "MO".( floatval($po_array[1]) + 1 );
            }else{
                $po_last = "MO50000";
            }

        }else{
            $po_last = "MO50000";
        }

        // asignar clave del producto
        $clave = '';
        if($request->producto == 'Extra'){
            $clave = '123497';
        } elseif($request->producto == 'Supreme'){
            $clave = '125427';
        } else{
            $clave = '123499';
        }

        $order = new Order();
        $order->estacion_id = $request->estacion_id;
        $order->status_id = $request->status_id;
        $order->producto = $request->producto;
        $order->clave_producto = $clave;
        $order->cantidad_lts = $request->cantidad_lts;
        $order->costo_aprox = $request->costo_aprox;
        $order->dia_entrega = $request->dia_entrega;
        $order->po = $po_last;

        $order->fecha_expiracion = date("d-m-Y",strtotime($request->dia_entrega."+ ".$estacion_up->dias_credito." days"));
        $order->total_abonado = 0;


        if ($request->saldo != $request->saldo1 && $request->saldo > 0) {
            $resta = $request->disponible - $request->credito_usado;

            $order->metodo_pago = "saldo";
            $estacion_up->update($request->merge(['saldo' => $request->saldo1, 'credito_usado' => $resta])->all());
        } else {
            $order->metodo_pago = "credito";
            $credito = $estacion_up->credito_usado + $request->costo_aprox;
            $estacion_up->update($request->merge(['credito_usado' => $credito])->all());
        }

        $order->save();

        return redirect()->route('pedidos.index')->with('status', __('Pedido Generado Correctamente.'))->with('color', 2);
    }

    public function individual(Request $request, Control $control, Order $order, Pipe $pipe, Tractor $tractor, Driver $driver, Freight $freight)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $fletera = $freight::where('id_estacion', $request->id)->get();

        for ($i = 0; $i < count($fletera); $i++) {

            // if ($fletera[$i]->Tractors[0]->id_status == 2) {
                /*$registro = DB::table('controls')->insert(
                    ['id_freights' => $fletera[$i]->id, 'terminal_id' => $request->id_terminal, 'id_chofer'=>$request->id_chofer, 'pipe_id_1'=>$request->id_pipe, 'pipe_id_2'=>null, 'pipe_id_2'=>null, 'created_at' => date("Y-m-d"), 'updated_at' => date("Y-m-d")]
                );*/
                $request->merge(['id_freights'=>$fletera[$i]->id, 'pipe_id_1' => $request->id_pipe , 'pipe_id_2' => null, 'pipe_id_3' => null ])->all();
                $lastControl = $control->create($request->except('_token', '_method', 'order_id', 'id', 'estacion_name', 'id_pipe', 'tractor_id'));
                

                $order_now = $order::where('estacion_id', $request->id)->get()->last()->update(['control_id' => $lastControl->id, 'status_id' => 3]);

                // $driver::where('id', $fletera[$i]->drivers[0]->id)->update(['id_status' => 2]);
                // $tractor::where('id', $fletera[$i]->Tractors[0]->id)->update(['id_status' => 2]);
                // $pipe::where('id', $fletera[$i]->pipes[0]->id)->update(['id_status' => 2]);
                return redirect()->route('pedidos.index')->withStatus(__('Pedido en camino.'));
            /*} else {
                return redirect()->route('pedidos.index')->withStatus(__('No hay Equipo disponible para el envio.'));
            }*/
        }
    }
    public function updateEstatus(Request $request, Order $order)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $camino = $request->camino;
        $id_pedido = $request->id_pedido;
        $order::where('id', $id_pedido)->update(['camino' => $camino]);
        return ["Actualizado" => true, "campo seleccionado" => $camino, "id del pedido" => $id_pedido];
    }

    public function emergencia(Request $request, Order $order)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        if ($request->id != "" && $request->order_id_e != "") {

            $order = $order::findorfail($request->order_id_e);
            $control_id = $order->control_id;
            $_firstDate = date($order->dia_entrega);
            $_newDate = strtotime($_firstDate . '+1 days');
            $order_emer = $order::where('so_number', $request->id)->update(['control_id' => $order->control_id, 'status_id' => 3]);
            $order->update(['control_id' => null, 'status_id' => 2, 'dia_entrega' => date("Y-m-d", $_newDate)]);

            return redirect()->route('pedidos.index')->with('status', __('Pedido Cambiado Exitosamente.'))->with('color', 2);
        } else {
            return redirect()->route('pedidos.index')->with('status', __('Error al Cambiar el Pedido.'))->with('color', 2);
        }
    }

    public function sonomber(Request $request, Order $model)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);

        $fecha_actual = date("Y-m-d");        
    
        $fecha_actual = date("Y-m-d",strtotime($fecha_actual."+ 2 days"));

        $order = $model::findorfail($request->id);
        $order->update($request->merge(['fecha_eliminacion' => $fecha_actual])->all());

        return json_encode('SO Number Agregado Correctamente.');
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
    public function edit(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $orders=Order::where('control_id',$request->id)->get();
        foreach($orders as $order){
            $order->status_id = 6;
            $order->update();
        }
        return redirect()->route('pedidos.index')->with('status', __('Pedido Eliminado Correctamente.'))->with('color', 2);
    }

    public function cambiar_status(Request $request, $id, Order $model)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $order = $model::findorfail($request->id);
        $order->update(['status_id' => 4]);
        return redirect()->route('pedidos.index')->with('status', __('Pedido Concluido.'))->with('color', 2);
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
        $request->user()->authorizeRoles(['Administrador', 'Logistica', 'Admin-Estacion']);

        $orders = $order::findorfail($id);
        $estacions = $estacion::findorfail($orders->estacions[0]->id);
        $estacions->update($request->all());

        $saldo = 0;

        if ($orders->estacions[0]->credito_usado == 0) {
            $saldo = $orders->estacions[0]->saldo + $orders->costo_aprox;
            //dd($saldo);
            $estacions->saldo = $saldo;
            $estacions->save();
            //$estacions->update($request->all());
        } else {

            $saldo = $orders->estacions[0]->credito_usado - $orders->costo_aprox;

            if ($saldo < 0) {
                //dd(abs($saldo));
                $estacions->saldo = abs($saldo);
                $estacions->credito_usado = 0;
            } else {
                $estacions->credito_usado = $saldo;
            }

            $estacions->save();
            //$estacions->update($request->all());
        }
        //echo $saldo;
        //dd($orders->costo_aprox);
        $orders->delete();

        return redirect()->route('pedidos.index')->with('status', __('Pedido Eliminado Exitosamente.'))->with('color', 2);
    }


    public function destroy_order(Request $request, $id, Order $order, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);

        $orders = $order::findorfail($id);
        $estacions = $estacion::findorfail($orders->estacions[0]->id);
        $estacions->update($request->all());

        $saldo = 0;

        if ($orders->estacions[0]->credito_usado == 0) {
            $saldo = $orders->estacions[0]->saldo + $orders->costo_aprox;
            $estacions->saldo = $saldo;
            $estacions->save();
            //$estacions->update($request->all());
        } else {
            $saldo = $orders->estacions[0]->credito_usado - $orders->costo_aprox;
            $estacions->credito_usado = $saldo;
            $estacions->save();
            //$estacions->update($request->all());
        }
        //echo $saldo;
        //dd($orders->costo_aprox);
        $orders->status_id = 6;
        $orders->save();

        return redirect()->route('pedidos.index')->with('status', __('Pedido Cancelado Correctamente.'))->with('color', 2);
    }

    public function liberar_flete(Request $request, Freight $freight, Pipe $pipe, Tractor $tractor, Driver $driver, Order $order, Control $control)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);

        $orders = $order::where('control_id', $request->id)->get();
        $controls = $control::find($orders[0]->control_id);
        //dd($orders[0]->control_id);
        $freights = $freight::findorfail($controls->id_freights);

        //dd($id);
        for ($i = 0; $i < count($orders->all()); $i++) {
            $order::where('id', $orders[$i]->id)->update(['status_id' => 5]);
        }
        $tractor::where('id', $freights->id_tractor)->update(['id_status' => 1]);
        $pipe::where('id', $freights->id_pipa_1)->update(['id_status' => 1]);
        if ($freights->id_pipa_2 != "") {
            $pipe::where('id', $freights->id_pipa_2)->update(['id_status' => 1]);
        }
        $driver::where('id', $freights->id_chofer)->update(['id_status' => 1]);

        return redirect()->route('pedidos.index')->with('status', __('Flete Liberado Correctamente.'))->with('color', 2);
    }

    public function getpipes(Request $request, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $estacion = Estacion::find($request->id);
        return response()->json([
            'pipas' => $estacion->freights[0]->tractors[0]->pipes
        ]);
    }

    public function import_pdf(Request $request) {
        $request->user()->authorizeRoles(['Administrador']);

        $fecha_recibida = date("d M Y", strtotime($request->dia_entrega));

        $array_so_number_mo = [];
        $array_so_number_mo_2 = [];
        $primer = "";
        $primer_1 = "";
        $primer_2 = ",";

        $primer_mo = "";
        $primer_1_mo = "";
        $primer_2_mo = ",";

        setlocale(LC_ALL, 'en_GB');
        $path = $request->file('select_file');

        try{

            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($path);
        
            $text = $pdf->getText();
            
            $array = explode("  Ingresado El", mb_convert_encoding($text, 'ISO-8859-15', 'UTF-8'));

            $array_2 = explode("#", $array[0]);

            $array_3 = implode("", $array_2);

            $array_4 = explode("Ingresado", $array_3);

            $array_5 = implode("", $array_4);

            $array_6 = explode("&34;", $array_5);

            $array_7 = explode(".", $array_6[2]);

            $array_8 = implode("", $array_7);

            $array_9 = explode("2/2", $array_8);
            
            $array_10 = explode("Cargado el", $array_9[0]);
            // $array_11 = explode("Cargado el", $array_9[1]);

            $array_12 = implode("", $array_10);
            //$array_13 = implode("", $array_11);
            

            $array_14 = explode("El pedido se ha validado ", $array_12);
            //$array_15 = explode("El pedido se ha validado ", $array_13);


            $array_16 = implode("", $array_14);
            //$array_17 = implode("", $array_15);

            $array_18 = explode(strtolower($fecha_recibida), $array_16);
            //$array_19 = explode("28 sep 2020", $array_17);


            $array_20 = implode("", $array_18);
            //$array_21 = implode("", $array_19);


            $array_22 = explode("Orden de compra", $array_20);
            //$array_23 = explode("Orden de compr a", $array_21);

            $array_24 = implode("", $array_22);
            //$array_25 = implode("", $array_23);

            $array_26 = explode("R", $array_24);
            //$array_27 = explode("o", $array_25);

            // return $array_26;

            /*for($i=0; $i<20; $i++){
                array_push($array_so_number_mo, $array_26[$i]);
                //array_push($array_so_number_mo_2, $array_27[$i]);
            }*/

            //return $array_so_number_mo;

            for ($x=0; $x <20 ; $x++) { 
                for($y=2; $y<14; $y++){
                    if($array_26[$x][$y] != " "){
                        $primer = $primer.$array_26[$x][$y];
                        //$primer_1 = $primer_1.$array_so_number_mo_2[$x][$y];
                    }elseif($y == 13){
                        $primer = $primer.$primer_2;
                        //$primer_1 = $primer_1.$primer_2;
                    }
                }

                for($z=21; $z<28; $z++){
                    if($z < 27){
                        $primer_mo = $primer_mo.$array_26[$x][$z];
                        //$primer_1_mo = $primer_1_mo.$array_so_number_mo_2[$x][$z];
                    }else{
                        
                        $primer_mo = $primer_mo.$array_26[$x][$z].$primer_2_mo;
                        //$primer_1_mo = $primer_1_mo.$array_so_number_mo_2[$x][$z].$primer_2_mo;
                    }
                }

            }

            //return $primer_mo;

            ltrim($primer);
            ltrim($primer_mo);

            $limpiar_array = explode(",", trim($primer, ' '));
            $limpiar_array_2 = explode(",", trim($primer_mo, ' '));

            //$limpiar_array_3 = explode(",", trim($primer_mo, ' '));
            //$limpiar_array_4 = explode(",", trim($primer_1_mo, ' '));

            array_pop($limpiar_array);
            array_pop($limpiar_array_2);

            //array_pop($limpiar_array_3);
            //array_pop($limpiar_array_4);

            $nuevo_array_so = [];
            $nuevo_array_mo = [];

            for($f=0; $f<20; $f++){
                array_push($nuevo_array_so, trim($limpiar_array[$f]));
                array_push($nuevo_array_mo, trim($limpiar_array_2[$f]));
            }

            for($f=0; $f<10; $f++){
                //array_push($nuevo_array_so, trim($limpiar_array_2[$f]));
                //array_push($nuevo_array_mo, trim($limpiar_array_4[$f]));
            }

            $fecha = "+2 days";
            if (date("l") == 'Friday') {
                $fecha = "+3 days";
            } elseif( date("l") == 'Saturday'){
                $fecha = "+2 days";
            }else{
                $fecha = "+1 days";
            }

            for($k=0; $k<20; $k++){
                $fechas_entregas_antiguas = Order::where('po', $nuevo_array_mo[$k])->get();
                Order::where('po', $nuevo_array_mo[$k])->where('status_id', '1')->update(['so_number' => $nuevo_array_so[$k], 'status_id'=> '2', 'fecha_eliminacion' => date("Y-m-d",strtotime($fechas_entregas_antiguas[0]->dia_entrega.$fecha ))]);
                // echo $nuevo_array_so[$k].' - '.$nuevo_array_mo[$k].'<br>';
            }

            return redirect()->route('pedidos.index')->with('status', __('SO NUMBERS asignados correctamente.'))->with('color', 2);

        }catch(Exception $e){
            return redirect()->route('pedidos.index')->with('status', __('PDF no Valido.'))->with('color', 4);
        }
    }

    public function exportar_excel(Request $request) 
    {
        
        return Excel::download(new OrdersExport, 'invoices.xls');
    }

    public function contar_pipas_disponibles(Request $request) 
    {
        $capacidad_completa = Pipe::distinct()->get(['capacidad']);
        $capacidad_1_unica = Pipe::distinct()->get(['capacidad_1']);
        $capacidad_2_unica = Pipe::distinct()->get(['capacidad_2']);

        $pipas_compleatas = [];
        $pipas_capacidad_1 = [];
        $pipas_capacidad_2 = [];

        for($i=0; $i<count($capacidad_completa); $i++){
            array_push($pipas_compleatas, ['type_container' => $capacidad_completa[$i]->capacidad, 'total_containers' => Pipe::where('capacidad', $capacidad_completa[$i]->capacidad)->count()]);
        }

        for($j=0; $j<count($capacidad_1_unica); $j++){
            array_push($pipas_capacidad_1, ['type_container' => $capacidad_1_unica[$j]->capacidad_1, 'total_containers' => Pipe::where('capacidad_1', $capacidad_1_unica[$j]->capacidad_1)->count()]);
        }

        for($k=0; $k<count($capacidad_2_unica); $k++){
            array_push($pipas_capacidad_2, ['type_container' => $capacidad_2_unica[$k]->capacidad_2, 'total_containers' => Pipe::where('capacidad_2', $capacidad_2_unica[$k]->capacidad_2)->count()]);
        }

        // ultimos arrays

        $pipas_compleatas_c = [];
        $pipas_capacidad_1_c = [];
        $pipas_capacidad_2_c = [];

        for($x=0; $x<count($pipas_compleatas); $x++){
            array_push($pipas_compleatas_c, ['type_container' => $capacidad_completa[$x]->capacidad, 'total_containers' =>Order::where([['cantidad_lts', $pipas_compleatas[$x]['type_container']], ['dia_entrega', $request->fecha], ['status_id', '<=', 4]])->count()]);
        }

        for($z=0; $z<count($pipas_capacidad_1); $z++){
            array_push($pipas_capacidad_1_c, ['type_container' => $capacidad_1_unica[$z]->capacidad_1, 'total_containers' =>Order::where([['cantidad_lts', $pipas_capacidad_1[$z]['type_container']], ['dia_entrega', $request->fecha], ['status_id', '<=', 4]])->count()]);
        }

        for($z=0; $z<count($pipas_capacidad_2); $z++){
            array_push($pipas_capacidad_2_c, ['type_container' => $capacidad_2_unica[$z]->capacidad_2, 'total_containers' =>Order::where([['cantidad_lts', $pipas_capacidad_2[$z]['type_container']], ['dia_entrega', '2020-10-19']])->count()]);
        }


        // ultimo arreglo

        $new_array = [];

        for($c=0; $c < count($pipas_capacidad_1_c); $c++){

            array_push($new_array, ['type_container' => $pipas_capacidad_1_c[$c]['type_container'], 'total_containers' => $pipas_capacidad_1[$c]['total_containers'] - $pipas_capacidad_1_c[$c]['total_containers'] ]);

        }

        for($c=0; $c < count($pipas_capacidad_2_c); $c++){
            if($new_array[$c]['type_container'] == $pipas_capacidad_2_c[$c]['type_container']){
                $new_array[$c]['total_containers'] = $new_array[$c]['total_containers']  + $pipas_capacidad_2[$c]['total_containers'] - $pipas_capacidad_2_c[$c]['total_containers'];
            }else{
                array_push($new_array, ['type_container' => $pipas_capacidad_2_c[$c]['type_container'],'total_containers' => $new_array[$c]['total_containers']  + $pipas_capacidad_2[$c]['total_containers'] - $pipas_capacidad_2_c[$c]['total_containers'] ]);
            }
        }

        for($c=0; $c < count($pipas_compleatas_c); $c++){
            array_push($new_array, ['type_container' => $pipas_compleatas_c[$c]['type_container'], 'total_containers' => $pipas_compleatas[$c]['total_containers'] - $pipas_compleatas_c[$c]['total_containers'] ]);
        }

        return $new_array;

    }

}
