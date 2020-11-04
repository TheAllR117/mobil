<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FreightRequest;
use App\Freight;
use App\NameFreight;
use App\Estacion;
use App\Pipe;
use App\Tractor;


class FreightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Freight $freight)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        return view('fleteras.index', ['freights' => $freight::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, NameFreight $freight, Estacion $estacion, Tractor $tractor)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        return view('fleteras.create', ['freights' => $freight::all(), 'estacions' => $estacion::where("id", "!=", 1)->get(), 'tractors' => $tractor::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FreightRequest $request, Freight $freight)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $freight->create($request->all());

        return redirect()->route('fleteras.index')->with('status', __('Relación Establecida Exitosamente.'))->with('color', 2);
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
    public function edit(Request $request, NameFreight $freight, Estacion $estacion, Tractor $tractor, Freight $freig, $id)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        return view('fleteras.edit', ['freights' => $freight::all(), 'estacions' => $estacion::where("id", "!=", 1)->get(), 'tractors' => $tractor::all(), 'fletera' => $freig::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Freight $freig, $id)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $fletera = $freig::findorfail($id);
        $fletera->update($request->all());
        return redirect()->route('fleteras.index')->with('status', __('Edición Exitosamente.'))->with('color', 2);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Freight $freig, $id)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);

        $fletera = $freig::findorfail($id);
        $fletera->delete();

        return redirect()->route('fleteras.index')->with('status', __('Relación Eliminada Correctamente.'))->with('color', 2);
    }
}
