<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\OrderPayments;
use App\Order;

class OrderPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, OrderPayments $model)
    {
        $request->user()->authorizeRoles(['Administrador', 'Admin-Estacion']);
        $station_orden = Order::find($request->id_order);

        $file_img = $request->file('url_order');
        $nombre_img = $station_orden->estacion_id.'-'.date("dmY-His").'.'.$file_img->getClientOriginalExtension();

        $new = $model->create($request->merge(['cantidad' => $request->cantidad_order, 'url'=> $nombre_img, 'id_status' => 1])->all());
        $new->update(['url'=> $nombre_img]);
        
        Storage::disk('order_payment')->put('/'.$station_orden->estacion_id.'/'.$nombre_img, \File::get($file_img));
        
        return redirect()->route('facturas.index')->with('status', __('Abono Solicitado Correctamente, Espere Hasta que sea Autorizado.'))->with('color',  2);
        
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
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $orderPayment = OrderPayments::findorfail($id);
        $orderPayment->delete();
        return redirect()->route('abonos.index')->with('status', __('Abono Eliminado Correctamente.'))->with('color', 2);
    }

    public function payments(Request $request, OrderPayments $model)
    {
        $request->user()->authorizeRoles(['Administrador', 'Admin-Estacion']);

        $deuda_suma = 0;
        $pagos_suma = 0;
        $suma_tem = 0;

        $array_facturas_diversas = explode(",", $request->ids_bills);

        $facturas_escogidas = Order::find($array_facturas_diversas);

        foreach($facturas_escogidas as $key => $factura){
            $deuda_suma = $factura->costo_real + $deuda_suma;
            $pagos_suma = $factura->orderpayment->where('id_status', 2)->sum('cantidad') + $pagos_suma;
            
            if($request->cantidad_multi >= ($deuda_suma - $pagos_suma) &&  $key < (count($facturas_escogidas)-1))
            {
                //echo 'Permitido';
                $suma_tem = $deuda_suma - $pagos_suma;
            }
            elseif($request->cantidad_multi >= ($deuda_suma - $pagos_suma) && $key == (count($facturas_escogidas)-1))
            {
                // abono igual a la deuda
                //return $deuda_suma - $pagos_suma;
            }
            elseif($request->cantidad_multi > $suma_tem && $key == (count($facturas_escogidas)-1))
            {
                //echo 'Permitido';
                //return $suma_tem;
            }
            else
            {
                return redirect()->route('facturas.index')->with('status', __('No se cumple con la cantidad minima de pago.'))->with('color', 4);
            }
        }

        $deuda_suma = 0;
        $pagos_suma = 0;
        $restante = 0;

        $resta = $request->cantidad_multi;

        foreach($facturas_escogidas as $key => $factura_up){
            $deuda_suma = $factura_up->costo_real;
            $pagos_suma = $factura_up->orderpayment->where('id_status', 2)->sum('cantidad');
            $restante = $deuda_suma - $pagos_suma;
            $resta = $resta - $restante;

            $file_img = $request->file('url_multi');
            $nombre_img = $factura_up->estacion_id.'-'.date("dmY-His").'.'.$file_img->getClientOriginalExtension();

            if($key < (count($facturas_escogidas)-1) )
            {
                $new = $model->create($request->merge(['id_order' => $factura_up->id , 'cantidad' => $restante, 'url'=> $nombre_img, 'id_status' => 1])->all());
            }
            elseif($resta >= $restante && $key == (count($facturas_escogidas)-1))
            {
                $new = $model->create($request->merge(['id_order' => $factura_up->id , 'cantidad' => $restante, 'url'=> $nombre_img, 'id_status' => 1])->all());
            }
            else
            {
                $new = $model->create($request->merge(['id_order' => $factura_up->id , 'cantidad' => $restante - abs($resta) ,'url'=> $nombre_img, 'id_status' => 1])->all());
            }

            $new->update(['url'=> $nombre_img]);
            
            Storage::disk('order_payment')->put('/'.$factura_up->estacion_id.'/'.$nombre_img, \File::get($file_img));
        }

        return redirect()->route('facturas.index')->with('status', __('Abonos Solicitados Correctamente, Espere Hasta que sean Autorizados.'))->with('color', 2);
    }

    
}
