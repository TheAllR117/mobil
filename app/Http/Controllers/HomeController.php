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
use DB;

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
        $order_totales = $order::where('status_id','==','4')->count();

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

        $abonos_pendientes = $payment::where('id_status','1')->count();

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

        //return geoip_continent_code_by_name($nombre_estacion[1]);
        return view('dashboard', compact('fechas', 'terminales','estacion_total', 'saldo_total', 'pipas_total','abonos_pendientes', 'estaciones_deudoras','precios_actuales_estaciones', 'estaciones_info', 'order_totales', 'nombre_estacion', 'ventas_estacion'));
    }

}
