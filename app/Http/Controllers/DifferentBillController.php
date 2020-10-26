<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DifferentBillRequest;
use App\DifferentBill;
use App\Estacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

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

        //$cobro_devolucion = false;

        $file_pdf = $request->file('file_pdf');
        $file_xml = $request->file('file_xml');

        $nombre_pdf = $request->id_estacion.'-'.date("dmY-His").'.'.$file_pdf->getClientOriginalExtension();
        $nombre_xml = $request->id_estacion.'-'.date("dmY-His").'.'.$file_xml->getClientOriginalExtension();

        Storage::disk('facturas_pdf_2')->put('/'.$request->id_estacion.'/'.$nombre_pdf, \File::get($file_pdf));
        Storage::disk('facturas_xml_2')->put('/'.$request->id_estacion.'/'.$nombre_xml, \File::get($file_xml));
        /*if($request->add_or_subtract == 'on'){
            $cobro_devolucion = true;
        }*/
        $new = $model->create($request->merge(['add_or_subtract' => 1, 'file_pdf' => $nombre_pdf, 'file_xml' => $nombre_xml, 'id_status' => 1])->all());
        $new->update(['file_pdf' => $nombre_pdf, 'file_xml' => $nombre_xml]);

        $estacion_selecionada = $estacion::find($request->id_estacion);

        /*if($request->add_or_subtract == true){*/
            $estacion_selecionada->update(['credito_usado' => ($estacion_selecionada->credito_usado + $request->quantity)]);
        /*} else {
            $estacion_selecionada->update(['credito_usado' => ($estacion_selecionada->credito_usado - $request->quantity)]);
        }*/

        return redirect()->route('facturas.index')->withStatus(__('Factura cargada exitosamente.'));        
       
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
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $factura = DifferentBill::findorfail($id);
        $estacion = Estacion::find($factura->id_estacion);

        $estacion->update(['credito_usado'=> $estacion->credito_usado - $factura->quantity]);
        
        $factura->delete();

        return redirect()->route('facturas.index')->withStatus(__('Factura eliminada.'));
    }
}
