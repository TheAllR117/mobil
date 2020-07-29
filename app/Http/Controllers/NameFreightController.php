<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NameFreightRequest;
use Illuminate\Support\Facades\Hash;
use App\NameFreight;

class NameFreightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,NameFreight $freight)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        return view('registro_fleteras.index', ['freights' => $freight::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        return view('registro_fleteras.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NameFreightRequest $request,NameFreight $freight)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $freight->create($request->all());
        return redirect()->route('registro_fleteras.index')->withStatus(__('Fletera agregada exitosamente.'));
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
    public function edit(Request $request, $id,NameFreight $namefreight)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $namefreight_edit = $namefreight::findorfail($id);
        return view('registro_fleteras.edit',compact('namefreight_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NameFreightRequest $request, $id,NameFreight $freight)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);

        $freight_up = $freight::findorfail($id);

        $freight_up->update($request->all());

        return redirect()->route('registro_fleteras.index')->withStatus(__('Fletera editada correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id,NameFreight $freight)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);

        $freight_de = $freight::findorfail($id);
        $freight_de->delete();

        return redirect()->route('registro_fleteras.index')->withStatus(__('Fletera eliminada exitosamente.'));
    }
}
