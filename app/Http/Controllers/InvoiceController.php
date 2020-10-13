<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Pipe;
use App\State;
use App\Order;
use App\Estacion;
use App\Terminal;
use App\Statu_order;
use App\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $order)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion', 'Abonos & Pagos']);
        $sucursal_usuario = $request->user()->estacions[0]->id;

        /*$fecha = "+1 days";
        if(date("l") == 'Friday' || date("l") == 'Saturday'){
            $fecha = "+3 days";
        }*/
        //dd(date("l"));

        if($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica" || $request->user()->roles[0]->name == "Abonos & Pagos") {

            //return view('facturas.index', ['orders' => $order::where('dia_entrega',date("Y-m-d"))->where('status_id',5)->orderBy('dia_entrega','asc')->get()]);
            return view('facturas.index', ['orders' => $order::where('status_id', 5)->orderBy('dia_entrega','asc')->get()]);

        }else{
            $estaciones = array();

            for($i=0; $i<count($request->user()->estacions); $i++){
                array_push($estaciones, $request->user()->estacions[$i]->id);
            }

            return view('facturas.index', ['orders' => $order::whereIn('estacion_id', $estaciones)->where('status_id',5)->get()]);
        }
        //return view('facturas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Abonos & Pagos']);

        $file_pdf = $request->file('pdf');
        $file_xml = $request->file('xml');

        $nombre_pdf = $request->order_id.'-'.date("dmY-His").'.'.$file_pdf->getClientOriginalExtension();
        $nombre_xml = $request->order_id.'-'.date("dmY-His").'.'.$file_xml->getClientOriginalExtension();

        Storage::disk('facturas_pdf')->put('/'.$request->estacion_id.'/'.$nombre_pdf, \File::get($file_pdf));
        Storage::disk('facturas_xml')->put('/'.$request->estacion_id.'/'.$nombre_xml, \File::get($file_xml));

        $litros_final = $request->post('litros_final');
        $costo_real = $request->post('costo_real');

        $orden_costo_pago = $order::select('costo_aprox', 'estacion_id')->where('id', $request->order_id)->get()[0];

        $costo_aprox = $orden_costo_pago->costo_aprox;
        $estacion_id = $orden_costo_pago->estacion_id;

        $costo_real = floatval($costo_real);
        $costo_aprox = floatval($costo_aprox);

        $diferencia = $costo_real - $costo_aprox;

        if($diferencia != 0)
        {
            $status_saldo_credito = Estacion::select('saldo','credito_usado')->where('id', $estacion_id)->get()[0];
            /* Aqui le agregamos al saldo lo que sobra */
            if($diferencia < 0)
            {
                $diferencia = abs($diferencia);
                $nuevo_credito_usado = floatval($status_saldo_credito->credito_usado);

                $nuevo_credito_usado = $nuevo_credito_usado - $diferencia;
                if($nuevo_credito_usado > 0)
                {
                    $diferencia = 0;
                }else{
                    $diferencia = abs($nuevo_credito_usado);
                    $nuevo_credito_usado = 0;
                }

                if($diferencia != 0)
                {
                    $nuevo_saldo = floatval($status_saldo_credito->saldo) + $diferencia;
                    Estacion::where('id', $estacion_id)->update(['saldo' => $nuevo_saldo]);
                }

                Estacion::where('id', $estacion_id)->update(['credito_usado' => $nuevo_credito_usado ]);

            }else{
                /* La estacion quedo a deber */

                /* No cuenta con saldo suficiente y se le agrega al credito usado */
                if(floatval($status_saldo_credito->saldo) < $diferencia)
                {
                    $nuevo_credito_usado = floatval($status_saldo_credito->credito_usado) + $diferencia;
                    Estacion::where('id', $estacion_id)->update(['credito_usado' => $nuevo_credito_usado]);
                }else{
                    $nuevo_saldo = floatval($status_saldo_credito->saldo) - $diferencia;
                    Estacion::where('id', $estacion_id)->update(['saldo' => $nuevo_saldo]);
                }
            }

        }

        $order::where('id', $request->order_id)->update(['pdf' => $nombre_pdf, 'xml' => $nombre_xml, 'costo_real' => $costo_real, 'cantidad_lts_final' => $litros_final, 'fecha_expiracion'=> $request->fecha_expiracion]);

        return redirect()->route('facturas.index')->withStatus(__('PDF y XML agregados correctamente.'));
        //dd($request->all());
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
