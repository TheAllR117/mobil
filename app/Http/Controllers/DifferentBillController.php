<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DifferentBillRequest;
use App\DifferentBill;
use App\Estacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\DifferentBillPayments;

class DifferentBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DifferentBill $model)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica', 'Admin-Estacion']);
        if($request->user()->roles[0]->name == "Administrador" ) {

            return view('facturas_diferentes.index', ['facturas' => $model::all()]);

        } else {

            $estaciones = array();

            for($i=0; $i<count($request->user()->estacions); $i++){
                array_push($estaciones, $request->user()->estacions[$i]->id);
            }

            return view('facturas_diferentes.index', ['facturas' => $model::whereIn('id_estacion', $estaciones)->get()]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        return view('facturas_diferentes.create', ['estaciones' => Estacion::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DifferentBillRequest $request, DifferentBill $model, Estacion $estacion)
    {
        $request->user()->authorizeRoles(['Administrador']);

        $fecha_actual = date($request->expiration_date);        
    
        $fecha_actual = date("Y-m-d", strtotime($fecha_actual."+ 10 days"));

        $cobro_devolucion = false;

        $file_pdf = $request->file('file_pdf');
        $file_xml = $request->file('file_xml');

        $nombre_pdf = $request->id_estacion.'-'.date("dmY-His").'.'.$file_pdf->getClientOriginalExtension();
        $nombre_xml = $request->id_estacion.'-'.date("dmY-His").'.'.$file_xml->getClientOriginalExtension();

        Storage::disk('facturas_pdf_2')->put('/'.$request->id_estacion.'/'.$nombre_pdf, \File::get($file_pdf));
        Storage::disk('facturas_xml_2')->put('/'.$request->id_estacion.'/'.$nombre_xml, \File::get($file_xml));
        if($request->add_or_subtract == 'on'){
            $cobro_devolucion = true;
        }
        $new = $model->create($request->merge(['add_or_subtract' => $cobro_devolucion, 'file_pdf' => $nombre_pdf, 'file_xml' => $nombre_xml, 'id_status' => 1, 'expiration_date' => $fecha_actual])->all());
        $new->update(['file_pdf' => $nombre_pdf, 'file_xml' => $nombre_xml]);

        $estacion_selecionada = $estacion::find($request->id_estacion);

        //if($request->add_or_subtract == true){
        $estacion_selecionada->update(['credito_usado' => ($estacion_selecionada->credito_usado + $request->quantity)]);
        //} else {
            //$estacion_selecionada->update(['credito_usado' => ($estacion_selecionada->credito_usado - $request->quantity)]);
        //}

        return redirect()->route('facturas.index')->withStatus(__('Factura cargada exitosamente.'));        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador', 'Admin-Estacion']);

        return view('facturas_diferentes.show', ['facturas' => DifferentBillPayments::where('id_different_bill', $id)->get(), 'estacion' => DifferentBill::find($id)]);
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
    public function update(Request $request, DifferentBill $model)
    {   
        $request->user()->authorizeRoles(['Administrador']);

        $billPayment = DifferentBillPayments::find($request->id);

        $billPayment->update(['id_status' => 2, 'cantidad' => $request->cantidad_f]);

        $differentBill = DifferentBill::find($billPayment->id_different_bill);

        //return $differentBill->differentbills->where('id_status', 2)->sum('cantidad');

        // if validación para cambiar el pedido a completado
        if( $differentBill->differentbills->where('id_status', 2)->sum('cantidad') ==  $differentBill->quantity){
            $differentBill->update(['id_status' => 2]);
        }
        

        $station = Estacion::find($differentBill->id_estacion);

        // credito de la estación
        $credito = $station->credito;
        // credito usado de la estación
        $credito_usado = $station->credito_usado;
        // credito disponible de la estación
        $disponible = $credito - $credito_usado;

        if(floatval($station->saldo) >= 0 && floatval($station->credito_usado) == 0){
            $station->update(['saldo' => floatval($station->saldo) + $request->cantidad_f]);
        } 
        elseif (floatval($station->credito_usado) > 0) {
            /*  
                verificamos si la estación tiene credito usado mayor a cero, 
                para agregar la cantidad abonada al credito_usado
            */
            $total = $request->cantidad_f + $disponible;

            if($total == $credito){
               $station->update(['credito_usado' => 0]);
            }
            elseif($total < $credito)
            {
                $station->update(['credito_usado' => $credito - $total]);
            }
            else
            {
                $station->update(['credito_usado' => 0 ,'saldo' => $station->saldo + abs($total) ]);
            }
        }

        return redirect()->route('abonos.index')->with('status', __('Abono Autorizado Correctamente.'))->with('color', 2);

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
        $factura = DifferentBill::findorfail($id);
        $estacion = Estacion::find($factura->id_estacion);

        $estacion->update(['credito_usado'=> $estacion->credito_usado - $factura->quantity]);
        
        $factura->delete();

        return redirect()->route('facturas.index')->with('status', __('Factura Eliminada.'))->with('color', 2);
    }

    public function payments(Request $request, DifferentBillPayments $model)
    {
        $request->user()->authorizeRoles(['Administrador', 'Admin-Estacion']);

        $deuda_suma = 0;
        $pagos_suma = 0;
        $suma_tem = 0;

        $array_facturas_diversas = explode(",", $request->ids_bills);

        $facturas_escogidas = DifferentBill::find($array_facturas_diversas);

        //$facturas_escogidas->groupBy('add_or_subtract');

        // return $facturas_escogidas;

        foreach($facturas_escogidas as $key => $factura){
            $deuda_suma = $factura->quantity + $deuda_suma;
            $pagos_suma = $factura->differentbills->where('id_status', 2)->sum('cantidad') + $pagos_suma;
            
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
            $deuda_suma = $factura_up->quantity;
            $pagos_suma = $factura_up->differentbills->where('id_status', 2)->sum('cantidad');
            $restante = $deuda_suma - $pagos_suma;
            $resta = $resta - $restante;

            $file_img = $request->file('url_multi');
            $nombre_img = $factura_up->id_estacion.'-'.date("dmY-His").'.'.$file_img->getClientOriginalExtension();

            if($key < (count($facturas_escogidas)-1) )
            {
                //echo $restante.' <br>';
                $new = $model->create($request->merge(['id_different_bill' => $factura_up->id , 'cantidad' => $restante, 'url'=> $nombre_img, 'id_status' => 1])->all());
            }
            elseif($resta >= $restante && $key == (count($facturas_escogidas)-1)){
                //echo $restante.'-- <br>';
                $new = $model->create($request->merge(['id_different_bill' => $factura_up->id , 'cantidad' => $restante, 'url'=> $nombre_img, 'id_status' => 1])->all());
            }
            else
            {
                //echo $restante - abs($resta).'--- <br>';
                $new = $model->create($request->merge(['id_different_bill' => $factura_up->id , 'cantidad' => $restante - abs($resta) ,'url'=> $nombre_img, 'id_status' => 1])->all());
            }

            $new->update(['url'=> $nombre_img]);
            
            Storage::disk('bill_payment')->put('/'.$factura_up->id_estacion.'/'.$nombre_img, \File::get($file_img));
        }

        return redirect()->route('facturas.index')->with('status', __('Abonos Solicitados Correctamente, Espere Hasta que sean Autorizados.'))->with('color', 2);
    }

    public function pay(Request $request, DifferentBillPayments $model)
    {
        $request->user()->authorizeRoles(['Administrador', 'Admin-Estacion']);

        //return $request->all();

        $file_img = $request->file('url');
        $nombre_img = $request->id_estacion.'-'.date("dmY-His").'.'.$file_img->getClientOriginalExtension();

        $new = $model->create($request->merge(['url'=> $nombre_img, 'id_status' => 1])->all());
        $new->update(['url'=> $nombre_img, 'deposit_date' => $request->deposit_date]);
        
        Storage::disk('bill_payment')->put('/'.$request->id_estacion.'/'.$nombre_img, \File::get($file_img));
        
        return redirect()->route('facturas.index')->with('status', __('Abono Solicitado Correctamente, Espere Hasta que sea Autorizado.'))->with('color', 2);       
       
    }

    public function destroy_payment(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador']);

        $DifferentBill = DifferentBillPayments::findorfail($id);
        $DifferentBill->delete();
        return redirect()->route('abonos.index')->with('status', __('Abono Eliminado Correctamente.'))->with('color', 2);

    }
}
