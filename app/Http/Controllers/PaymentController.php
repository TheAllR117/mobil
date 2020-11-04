<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Payment;
use App\Estacion;
use App\Order;
use DB;
use App\OrderPayments;
use App\DifferentBillPayments;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Payment $payment)
    {
        $request->user()->authorizeRoles(['Administrador','Abonos & Pagos']);

        //validamos los roles
        if($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica" || $request->user()->roles[0]->name == "Abonos & Pagos") {

        return view('abonos.index', ['payments' => $payment::all(), 'order_payments' => OrderPayments::all(), 'different_bill_payments' => DifferentBillPayments::all()]);

        }else{
            // en caso de no tener el rol administrador, logistica o abonos & pagos se mostrara la informacion de los abonos de las estaciones que le corresponden al usuario
            $estaciones = array();

            for($i=0; $i<count($request->user()->estacions); $i++){
                array_push($estaciones, $request->user()->estacions[$i]->id);
            }

            return view('abonos.index', ['payments' => $payment::whereIn('id_estacion', $estaciones)->get(), 'order_payments' => OrderPayments::all(),'different_bill_payments' => DifferentBillPayments::all()]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador','Abonos & Pagos','Admin-Estacion']);

        // validamos los roles para determinar si el usuario en cuestion puede hacer abonos a cualquier estacion o solo la que le corresponde
        if($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica" || $request->user()->roles[0]->name == "Abonos & Pagos") {
            // seleccionamos id, razon_social y nombre de la sucursal para llenar el select
            $estaciones = $estacion::select('id','razon_social','nombre_sucursal')->get();

        }else{
            // en caso de no contar con el rol admin estacion solo le apareceran sus estaciones asignadas
            $estaciones = array();

            for($i=0; $i<count($request->user()->estacions); $i++){
                array_push($estaciones, $request->user()->estacions[$i]->id);
            }

            $estaciones = $estacion::select('id','razon_social','nombre_sucursal')->whereIn('id',$estaciones)->get();

        }
        return view('abonos.create', ['estaciones' => $estaciones ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request,Payment $payment)
    {
        $request->user()->authorizeRoles(['Administrador','Abonos & Pagos','Admin-Estacion']);

        // obtenmos la imagen selecciona por el usuario
        $file_fac = $request->file('url');

        // creamos el nombre del archivo
        $nombre_fac = $request->id_estacion.'-'.date("dmY-His").'.'.$file_fac->getClientOriginalExtension();

        // almacenamos la iamgen en el servidor
        Storage::disk('estaciones')->put('/'.$request->id_estacion.'/'.$nombre_fac, \File::get($file_fac));

        // almacenamos el abonos en la base de daos
        DB::table('payments')->insert(
            ['id_estacion' => $request->id_estacion, 'cantidad' => $request->cantidad, 'url' => $nombre_fac, 'id_status' => $request->id_status, 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")]
        );

        return redirect()->route('abonos.index')->with('status', __('Abono Creado Exitosamente.'))->with('color', 2);
    }

    // esta funcion se encarga de determinar si el abono se va tratar como saldo o credito para la estacion
    public function sal_o_cre(Request $request,Payment $payment, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador','Abonos & Pagos']);

        $saldo_can = $request->cantidad;
        $estacions = $estacion::findOrFail($request->id_estacion);
        $payments = $payment::findOrFail($request->id);

        $credito = $estacions->credito;
        $credito_usado = $estacions->credito_usado;
        $disponible = $credito - $credito_usado;
        $disponible_f = $credito - $saldo_can;

        /*
            Buscamos todas las ordenes que fueron pagadas con "credito"
            y verificamos cuales termina de pagar
        */
        $saldo_descontar = $request->cantidad;
        $ordenes = Order::where('estacion_id', $request->id_estacion)
            ->where('metodo_pago','credito')
            ->where('pagado','FALSE')
            ->get();

        foreach($ordenes as $orden)
        {
            if($saldo_descontar <= 0)
            {
                break;
            }else{
                $total_abono = floatval($orden->total_abonado) + $saldo_descontar;

                /* Se cubre el pago total de una orden  */
                if( $total_abono >= floatval($orden->costo_aprox) )
                {
                    $saldo_descontar =  $total_abono - floatval($orden->costo_aprox);
                    Order::where('id', $orden->id)
                        ->update(['pagado' => 'TRUE', 'total_abonado' => floatval($orden->costo_aprox) ]);
                }else{

                    Order::where('id', $orden->id)
                        ->update(['total_abonado' => $total_abono]);
                    $saldo_descontar = 0;
                }
            }
        }


        if(floatval($estacions->saldo) >= 0 && floatval($estacions->credito_usado) == 0){

            $estacions->update(['saldo' => $saldo_can + floatval($estacions->saldo)]);

            $payments->update(['id_status' => 2]);
            return json_encode('El abono, se agrego al saldo.');

        } elseif (floatval($estacions->credito_usado) > 0) {

            $total = $disponible_f - $disponible;

            if($total >= 0){
                $estacions->update(['credito_usado' => $total]);
                $payments->update(['id_status' => 2]);
                return json_encode('El abono se utilizo para cubrir el credito');

            }else{
                $estacions->update(['credito_usado' => 0 ,'saldo' => $estacions->saldo + abs($total) ]);
                $payments->update(['id_status' => 2]);
                return json_encode('El abono se utilizo para cubrir el credito y lo restante se abono al saldo');
            }


        }else{

            return json_encode($estacions->saldo);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request->user()->authorizeRoles(['Administrador','Abonos & Pagos']);
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
        $request->user()->authorizeRoles(['Administrador','Abonos & Pagos']);
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
        $request->user()->authorizeRoles(['Administrador','Abonos & Pagos']);
        $terminal_up = $estacion::findorfail($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id ,Payment $payment)
    {
        $request->user()->authorizeRoles(['Administrador','Abonos & Pagos']);

        $payments = $payment::find($id);
        // borramos la imagen del servidor
        Storage::disk('estaciones')->delete($payments->id_estacion.'/'.$payments->url);
        $payments->delete();
        return redirect()->route('abonos.index')->with('status', __('Abono Eliminado Exitosamente.'))->with('color', 2);

    }
}
