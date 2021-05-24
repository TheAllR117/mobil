<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\Price;
use App\Terminal;
use App\Estacion;
use App\Valero;
use App\Pipe;
use App\Payment;
use App\Order;
use App\DifferentBill;
use DB;
use App\DifferentBillPayments;
use App\OrderPayments;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, Estacion $estacion, Pipe $pipe, Payment $payment, Order $order)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion','Abonos & Pagos']);
        $saldo_total = 0;
        $terminals = Terminal::all();

        //informacion de ventas
        $order_totales = Order::where('status_id','5')->count();
        //información de los pedidos
        $info_pedidos = Order::all();
        //información de las facturas diversas
        $info_facturas = DifferentBill::all();
        //información de las facturas diversas pagos
        $info_facturas_pagos = DifferentBillPayments::all();

        //informacion de las estaciones
        if($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica" || $request->user()->roles[0]->name == "Abonos & Pagos") {

            $estaciones_info = $estacion::where('razon_social','!=','*')->orderBy('nombre_sucursal')->get();

        } else {

            $estaciones = array();

            for($i=0; $i<count($request->user()->estacions); $i++){
                array_push($estaciones, $request->user()->estacions[$i]->nombre_sucursal);
            }

            $estaciones_info = $estacion::whereIn('nombre_sucursal', $estaciones)->orderBy('nombre_sucursal')->get();
            //return view('estaciones.index', ['estaciones' => $model::whereIn('nombre_sucursal', $estaciones)->get()]);
        }
        

        //consulta de informacion
        $estacion_total = $estacion::where('razon_social','!=','*')->count();

        $abonos_pendientes = strval(intval($payment::where('id_status','1')->count()) + intval(OrderPayments::where('id_status', 1)->count()) + intval(DifferentBillPayments::where('id_status', 1)->count()));

        $estacion_saldo = $estacion::select('saldo')->get();
        //dd($estacion_saldo[0]->saldo);
        foreach ($estacion_saldo as $saldos) {
            $saldo_total = $saldo_total + $saldos['saldo'];
        }
        
        $ordenes = Order::select( '*' ,
            DB::raw('DATEDIFF( STR_TO_DATE(orders.fecha_expiracion, "%d-%m-%Y") , CURDATE()) as dias'),
            DB::raw('DATE_FORMAT( STR_TO_DATE(orders.fecha_expiracion, "%d-%m-%Y") , "%d-%m-%Y") as expiracion_date')
        )
            ->where('orders.metodo_pago','credito')
            ->where('orders.pagado','FALSE')
            ->join('estacions', 'estacions.id','orders.estacion_id')
            ->get();

        $estaciones_deudoras = array();

        foreach($ordenes as $orden)
        {
            if($orden->dias < 0)
            {
                array_push($estaciones_deudoras, $orden);
            }
        }

        // dd($estaciones_deudoras);

        /* Obtener los precios actualizados de las estaciones */
        $precios_actuales_estaciones = DB::select('SELECT estacions.id as estacion_id, prices.id as precio_id, estacions.razon_social,
                            estacions.nombre_sucursal, DATE_FORMAT(prices.created_at, "%d-%m-%Y") as fecha,
                            extra, extra_u, supreme, supreme_u, diesel, diesel_u
                            FROM prices
                            INNER JOIN estacions
                            ON estacions.id = prices.id_estacion
                            WHERE prices.id IN ( SELECT MAX(prices.id) FROM prices WHERE DATEDIFF( prices.created_at , CURDATE()) < 1 GROUP BY prices.id_estacion )
                            AND DATEDIFF( prices.created_at , CURDATE()) < 1
                            ORDER BY prices.created_at DESC
                    ');

        // array para almacenar las estaciones con mas ventas
        $ventas_nombre_estaciones = [];
        $resultado_estaciones = [];
        $nombre_estacion = [];
        $ventas_estacion = [];
        $estaciones = Estacion::all();

        foreach($estaciones as $estacion){
            if($estacion->razon_social != '*'){
                array_push($ventas_nombre_estaciones, count($estacion->orders()->where('status_id','5')->get()));
                array_push($ventas_nombre_estaciones, $estacion->nombre_sucursal);
                array_push($resultado_estaciones, $ventas_nombre_estaciones);
                $ventas_nombre_estaciones = [];
            }
        }
        rsort($resultado_estaciones);
        //return $resultado_estaciones;

        for($s=0;$s<7; $s++){
            array_push($ventas_estacion, $resultado_estaciones[$s][0]); 
            array_push($nombre_estacion, $resultado_estaciones[$s][1]);  
        }

       // array para almacenar los ultimos 12 meses
       $meses_hasta_el_actual = [];
       $nombre_del_mes = [];

        // foreach para crear las fechas y almacenarlas en el array
        for($i=1; $i<=11; $i++){
            array_push($meses_hasta_el_actual, date("Y-m", mktime(0 ,0 ,0, date("m")-$i, date("d"), date("Y"))));
            array_push($nombre_del_mes, date("M", mktime(0 ,0 ,0, date("m")-$i, date("d"), date("Y"))));
        }
        array_unshift($meses_hasta_el_actual, date("Y-m", mktime(0 ,0 ,0, date("m"), date("d"), date("Y"))));
        array_unshift($nombre_del_mes, date("M", mktime(0 ,0 ,0, date("m"), date("d"), date("Y"))));

        // revertimos el orden del array
        $meses_hasta_el_actual = array_reverse($meses_hasta_el_actual);
        $nombre_del_mes = array_reverse($nombre_del_mes);

        // arrays para dividir los litros por mes
        $meses_extra = [];
        $meses_supreme = [];
        $meses_diesel = [];

        for($i=0; $i<12; $i++){
            array_push($meses_extra, Order::where('producto','Extra')->where('status_id','5')->whereDate('created_at','like', '%'.$meses_hasta_el_actual[$i].'%')->count());
            array_push($meses_supreme, Order::where('producto','Supreme')->where('status_id','5')->whereDate('created_at','like', '%'.$meses_hasta_el_actual[$i].'%')->count());
            array_push($meses_diesel, Order::where('producto','Diésel')->where('status_id','5')->whereDate('created_at','like', '%'.$meses_hasta_el_actual[$i].'%')->count());
        }

        //return geoip_continent_code_by_name($nombre_estacion[1]);
        return view('dashboard', compact('terminales','estacion_total', 'saldo_total', 'pipas_total','abonos_pendientes', 'estaciones_deudoras','precios_actuales_estaciones', 'estaciones_info', 'order_totales', 'nombre_estacion', 'ventas_estacion', 'nombre_del_mes','meses_extra', 'meses_supreme', 'meses_diesel', 'info_pedidos', 'info_facturas', 'info_facturas_pagos'));
    }

    public function search(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion','Abonos & Pagos']);

        //información de las estaciones
        if($request->id == "*"){
            $info_estaciones = Estacion::where('nombre_sucursal', '!=' ,$request->id)->orderBy('nombre_sucursal')->get();
            //$info_estaciones = Estacion::where('nombre_sucursal', '!=', '*')->orderBy('nombre_sucursal')->get();
        } else {
            $info_estaciones = Estacion::where('id', $request->id)->orderBy('nombre_sucursal')->get();
            //$info_estaciones = Estacion::where('id', 55)->orderBy('nombre_sucursal')->get();
        }
        $array_titulo = [];
        $array_ventas_estaciones = [];
        $array_facturas_estacione = [];
        $array_ventas_estaciones_final = [];

        // suma del total del importe
        $total_importe = 0;
        $total_abonado = 0;

        foreach($info_estaciones as $estacion){
            array_push($array_titulo, '<p class="title text-dark">'.$estacion->nombre_sucursal.'</p>');
            array_push($array_titulo, '');
            array_push($array_titulo, '');
            array_push($array_titulo, '');
            array_push($array_titulo, '');
            array_push($array_titulo, '');
            array_push($array_titulo, '');

            array_push($array_ventas_estaciones_final, $array_titulo);

            $array_titulo = [];

            array_push($array_titulo, '');
            array_push($array_titulo, '<p class="title text-dark">Fecha</p>');
            array_push($array_titulo, '<p class="title text-dark">Concepto</p>');
            array_push($array_titulo, '<p class="title text-dark">Descripción</p>');
            array_push($array_titulo, '<p class="title text-dark">Cargos</p>');
            array_push($array_titulo, '<p class="title text-dark">Depósitos</p>');
            array_push($array_titulo, '<p class="title text-dark">Costo Cubierto</p>');

            array_push($array_ventas_estaciones_final, $array_titulo);

            $array_titulo = [];

            foreach($estacion->orders->where('status_id', '<=',5)->whereBetween('created_at', [$request->ini, date("Y-m-d", strtotime($request->fin."+ 1 days"))]) as $ventas){
                array_push($array_ventas_estaciones, '');
                array_push($array_ventas_estaciones, Carbon::parse($ventas->fecha_expiracion)->format('d/m/Y'));
                array_push($array_ventas_estaciones, 'Venta');
                array_push($array_ventas_estaciones, $ventas->po.'-'.$ventas->producto.'-'.number_format($ventas->cantidad_lts, 0));
                
                if($ventas->costo_real == ''){
                    $total_importe = $total_importe + $ventas->costo_aprox;
                    array_push($array_ventas_estaciones, '$'. number_format($ventas->costo_aprox, 2));
                }
                else{
                    $total_importe = $total_importe + $ventas->costo_real;
                    array_push($array_ventas_estaciones, number_format($ventas->costo_real, 2));
                }
                array_push($array_ventas_estaciones, '');
                array_push($array_ventas_estaciones, number_format($ventas->total_abonado, 2));

                array_push($array_ventas_estaciones_final, $array_ventas_estaciones);
                $array_ventas_estaciones = [];

                foreach($ventas->orderpayment->where('id_status', 2) as $key => $orderBill){
                    array_push($array_ventas_estaciones, '');
                    array_push($array_ventas_estaciones, Carbon::parse($orderBill->deposit_date)->format('d/m/Y'));
                    array_push($array_ventas_estaciones, 'Depósito');
                    array_push($array_ventas_estaciones, '');
                    array_push($array_ventas_estaciones, '');
                    array_push($array_ventas_estaciones, '$'.number_format($orderBill->cantidad, 2));
                    array_push($array_ventas_estaciones, '');
                    array_push($array_ventas_estaciones_final, $array_ventas_estaciones);
                    $array_ventas_estaciones = [];
                }
                
                $total_abonado = $total_abonado + $ventas->total_abonado;
            }
            
            foreach($estacion->differentbill->whereBetween('created_at', [$request->ini, date("Y-m-d", strtotime($request->fin."+ 1 days"))]) as $factura){
                array_push($array_facturas_estacione, '');
                array_push($array_facturas_estacione, Carbon::parse($factura->expiration_date)->format('d/m/Y'));
                array_push($array_facturas_estacione, 'Diversa');
                array_push($array_facturas_estacione, $factura->description);
                array_push($array_facturas_estacione, '$'. number_format($factura->quantity, 2));
                array_push($array_facturas_estacione, '');
                array_push($array_facturas_estacione, '$'. number_format($factura->differentbills->where('id_status', 2)->sum('cantidad'), 2));
                array_push($array_ventas_estaciones_final, $array_facturas_estacione);

                $array_facturas_estacione = [];

                foreach($factura->differentbills->where('id_status', 2) as $key => $bill){
                    array_push($array_facturas_estacione, '');
                    array_push($array_facturas_estacione, Carbon::parse($bill->deposit_date)->format('d/m/Y'));
                    array_push($array_facturas_estacione, 'Depósito');
                    array_push($array_facturas_estacione, '');
                    array_push($array_facturas_estacione, '');
                    array_push($array_facturas_estacione, '$'.number_format($bill->cantidad, 2));
                    array_push($array_facturas_estacione, '');
                    array_push($array_ventas_estaciones_final, $array_facturas_estacione);
                    $array_facturas_estacione = [];
                }

                $total_importe = $total_importe + $factura->quantity;
                $total_abonado = $total_abonado + $factura->differentbills->where('id_status', 2)->sum('cantidad');
            }

        }

        return response()->json([
            'estado'     => $array_ventas_estaciones_final,
            'total_importe' => $total_importe,
            'total_abonado' => $total_abonado
        ]);

    }

}
