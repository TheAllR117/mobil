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
        
        return redirect()->route('facturas.index')->withStatus(__('Abono solicitado correctamente, espere hasta que sea autorizado.')); 
        
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
        return redirect()->route('abonos.index')->withStatus(__('Abono eliminado correctamente.'));
    }
}
