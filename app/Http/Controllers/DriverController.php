<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DriverRequest;
use Illuminate\Support\Facades\Hash;
use App\Driver;
use App\State;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Driver $driver)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        return view('conductores.index', ['drivers' => $driver::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, State $state)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $states = $state::all();
        return view('conductores.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverRequest $request,Driver $driver)
    {
        $request->user()->authorizeRoles(['Administrador','Logistica']);
        $driver->create($request->all());
        return redirect()->route('conductores.index')->withStatus(__('Conductor agregado exitosamente.'));
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
    public function edit(Request $request, Driver $driver, $id,State $state)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $conductor_edit = $driver::findorfail($id);
        $states = $state::all();
        return view('conductores.edit', compact('conductor_edit','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, Driver $driver, $id)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $conductor_up = $driver::findorfail($id);

        $conductor_up->update($request->all());

        return redirect()->route('conductores.index')->withStatus(__('conductor editado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id,Driver $driver)
    {
        $request->user()->authorizeRoles(['Administrador']);

        $driver_up = $driver::findorfail($id);
        $driver_up->delete();

        return redirect()->route('conductores.index')->withStatus(__('Conductor eliminado exitosamente.'));
    }
}
