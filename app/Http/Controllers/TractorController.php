<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TractorRequest;
use Illuminate\Support\Facades\Hash;
use App\Tractor;
use App\State;

class TractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tractor $model)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        
        //retornamos la informacion correspondiente a la vista
        return view('tractores.index', ['tractores' => $model::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, State $state)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        
        // cargamos los estatus para llenar el select
        $states = $state::all();
        return view('tractores.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TractorRequest $request, Tractor $model)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        
        // creamos el tractor correspondiente con la informacion proporcionada
        $model->create($request->all());
        
        return redirect()->route('tractores.index')->withStatus(__('Tractor creado exitosamente.'));
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
    public function edit(Request $request, Tractor $tractor, $id, State $state)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        
        //buscamos al tractor por id
        $tractor_edit = $tractor::findorfail($id);
        // cargamos los status para llenar el select
        $states = $state::all();
        return view('tractores.edit', compact('tractor_edit','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TractorRequest $request,Tractor $tractor, $id)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        
        // buscamos el tractor correspondiente por id
        $tractor_up = $tractor::findorfail($id);
        
        // actualizamos la informacion del tractor
        $tractor_up->update($request->all());

        return redirect()->route('tractores.index')->withStatus(__('Tractor editado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Tractor $tractor, $id)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        
        // buscamos el tractor correspondiente por id
        $tractor_de = $tractor::findorfail($id);
        
        // eliminamos el tractor
        $tractor_de->delete();

        return redirect()->route('tractores.index')->withStatus(__('Tractor eliminado exitosamente.'));
    }
}
