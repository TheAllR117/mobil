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
        $estaciones_info = $estacion::where('razon_social','!=','*')->orderBy('nombre_sucursal')->get();

        //consulta de informacion
        $estacion_total = $estacion::where('razon_social','!=','*')->count();
        $pipas_total = $pipe::all()->count();
        $abonos_pendientes = $payment::where('id_status','1')->count();

        $estacion_saldo = $estacion::select('saldo')->get();
        //dd($estacion_saldo[0]->saldo);
        foreach ($estacion_saldo as $saldos) {
            $saldo_total = $saldo_total + $saldos['saldo'];
        }
        $terminales = array();

        foreach ($terminals as $terminal) {
            $datos = array();
            array_push($datos, $terminal->razon_social);
            $fechas = array();
            $precios_valero_regular = array();
            $precios_valero_premium = array();
            $precios_valero_diesel = array();

            foreach ($terminal->valeros as $valero) {
                array_push($fechas, $valero->created_at->format('j - m'));
                array_push($precios_valero_regular, $valero->precio_regular);
                array_push($precios_valero_premium, $valero->precio_premium);
                array_push($precios_valero_diesel, $valero->precio_disel);
            }

            array_push($datos, $fechas, $precios_valero_regular, $precios_valero_premium, $precios_valero_diesel);
            array_push($terminales, $datos);
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

        return view('dashboard', compact('fechas', 'terminales','estacion_total', 'saldo_total', 'pipas_total','abonos_pendientes', 'estaciones_deudoras','precios_actuales_estaciones', 'estaciones_info', 'order_totales'));
    }

}
