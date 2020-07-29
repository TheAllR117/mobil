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
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion']);
        $sucursal_usuario = $request->user()->estacions[0]->id;

        /*$fecha = "+1 days";
        if(date("l") == 'Friday' || date("l") == 'Saturday'){
            $fecha = "+3 days";
        }*/      
        //dd(date("l"));

        if($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica") {

            //return view('facturas.index', ['orders' => $order::where('dia_entrega',date("Y-m-d"))->where('status_id',5)->orderBy('dia_entrega','asc')->get()]);
            return view('facturas.index', ['orders' => $order::where('status_id',5)->orderBy('dia_entrega','asc')->get()]);

        }else{

            return view('facturas.index', ['orders' => $order::where('estacion_id',$sucursal_usuario)->where('status_id',5)->get()]);
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

        $order::where('id', $request->order_id)->update(['pdf' => $nombre_pdf, 'xml' => $nombre_xml]);

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
