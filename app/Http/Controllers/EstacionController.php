<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EstacionRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Estacion;
use App\Terminal;
use DB;
use Mail;
use Excel;
use App\Imports\PriceImport;

class EstacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Estacion $model)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion']);
        // $sucursal_usuario = $request->user()->estacions[0]->nombre_sucursal;

        if($request->user()->roles[0]->name == "Administrador" || $request->user()->roles[0]->name == "Logistica") {

            return view('estaciones.index', ['estaciones' => $model::where("id","!=",1)->get()]);

        } else {

            $estaciones = array();

            for($i=0; $i<count($request->user()->estacions); $i++){
                array_push($estaciones, $request->user()->estacions[$i]->nombre_sucursal);
            }

            return view('estaciones.index', ['estaciones' => $model::whereIn('nombre_sucursal', $estaciones)->get()]);
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
        return view('estaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstacionRequest $request, Estacion $model)
    {
        $request->user()->authorizeRoles(['Administrador']);

        $status = '';
        $linea_credito = '';
        $datos_fiscales = '';

        if($request->status == 'on'){
            $status = '1';
        }else{
            $status = '0';
        }

        if($request->linea_credito == 'on'){
            $linea_credito = '1';
        }else{
            $linea_credito = '0';
        }

        if($request->datos_fiscales == 'on'){
            $datos_fiscales = '1';
        }else{
            $datos_fiscales = '0';
        }


        $model->create($request->merge(['status' => $status,'linea_credito' => $linea_credito,'datos_fiscales'=>$datos_fiscales])->all());
        return redirect()->route('estaciones.index')->withStatus(__('Estación creada exitosamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica','Admin-Estacion']);
        // array para almacenar los ultimos 12 meses
        $meses_hasta_el_actual = [];
        $nombre_del_mes = [];

        // varible para sumar los litros
        $litros_extra = 0;
        $litros_supreme = 0;
        $litros_diesel = 0;

        // arrays para dividir los litros por mes
        $meses_extra = [];
        $meses_supreme = [];
        $meses_diesel = [];


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


        $estacion_buscada = Estacion::findOrFail($id);

        for($i=0; $i<12; $i++){
            $ventas_extra = $estacion_buscada->orders()->where('producto','Extra')->where('status_id','5')->whereDate('created_at','like', '%'.$meses_hasta_el_actual[$i].'%')->get();
            $ventas_supreme = $estacion_buscada->orders()->where('producto','Supreme')->where('status_id','5')->whereDate('created_at','like', '%'.$meses_hasta_el_actual[$i].'%')->get();
            $ventas_diesel = $estacion_buscada->orders()->where('producto','Diesel')->where('status_id','5')->whereDate('created_at','like', '%'.$meses_hasta_el_actual[$i].'%')->get();
            
            for($j=0; $j<count($ventas_extra); $j++){
                $litros_extra = $ventas_extra[$j]->cantidad_lts + $litros_extra;
            }
            array_push($meses_extra, $litros_extra);
            $litros_extra = 0;

            for($j=0; $j<count($ventas_supreme); $j++){
                $litros_supreme = $ventas_supreme[$j]->cantidad_lts + $litros_supreme;
            }
            array_push($meses_supreme, $litros_supreme);
            $litros_supreme = 0;

            for($j=0; $j<count($ventas_diesel); $j++){
                $litros_diesel = $ventas_diesel[$j]->cantidad_lts + $litros_diesel;
            }
            array_push($meses_diesel, $litros_diesel);
            $litros_diesel = 0;
        }

        return view('estaciones.show', ['estacion' => Estacion::findOrFail($id), 'meses' => $nombre_del_mes, 'extra' => $meses_extra, 'supreme' => $meses_supreme, 'diesel' => $meses_diesel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Estacion $estacion, $id)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $estacion_edit = $estacion::findorfail($id);
        return view('estaciones.edit', compact('estacion_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstacionRequest $request,Estacion $estacion, $id)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $status = '0';
        $linea_credito = '0';
        $datos_fiscales = '0';

        if($request->status == 'on'){
            $status = '1';
        }

        if($request->linea_credito == 'on'){
            $linea_credito = '1';
        }

        if($request->datos_fiscales == 'on'){
            $datos_fiscales = '1';
        }

        $terminal_up = $estacion::findorfail($id);

        $terminal_up->update($request->merge(['status' => $status,'linea_credito' => $linea_credito,'datos_fiscales'=>$datos_fiscales])->all());

        return redirect()->route('estaciones.index')->withStatus(__('Estación editada correctamente.'));
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

        $estacion=Estacion::findorfail($id);
        $estacion->delete();

        return redirect()->route('estaciones.index')->withStatus(__('Estación eliminada exitosamente.'));

    }

    public function import_excel(Request $request) {

        $request->user()->authorizeRoles(['Administrador', 'Logistica']);

        $path = $request->file('select_file');
        $fecha = $request->post('fecha_precio_sugerido');
        $data = array($fecha);

        if(Excel::import(new PriceImport($data), $path)) {
            return redirect()->route('estaciones.index')->withStatus(__('Excel importado correctamente.'));
        } else {
            return redirect()->route('estaciones.index')->withStatus(__('Error al importar el archivo Excel.'));
        }


    }
}
