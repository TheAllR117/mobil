<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FreightRequest;
use Illuminate\Support\Facades\Hash;
use App\Freight;
use App\NameFreight;
use App\Estacion;
use App\Pipe;
use App\Tractor;
use App\Driver;


class FreightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Freight $freight)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        return view('fleteras.index', ['freights' => $freight::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,NameFreight $freight,Estacion $estacion, Pipe $pipe, Tractor $tractor,Driver $driver)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        return view('fleteras.create',['freights' => $freight::all(), 'estacions'=>$estacion::where("id","!=",1)->get(),'pipes'=>$pipe::all(), 'tractors'=>$tractor::all(), 'drivers'=>$driver::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FreightRequest $request,Freight $freight)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);

        if(count($request->id_pipa) == 2){
            $request->merge(['id_pipa_1'=>$request->id_pipa[0],'id_pipa_2'=>$request->id_pipa[1]])->all();
            //dd($request->except('id_pipa'));
            $freight->create($request->except('id_pipa'));
        }else{
            $request->merge(['id_pipa_1'=>$request->id_pipa[0]])->all();
            $freight->create($request->except('id_pipa'));
        }
        
        //dd($request->all());
        return redirect()->route('fleteras.index')->withStatus(__('Relación establecida exitosamente.'));
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
