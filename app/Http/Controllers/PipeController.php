<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PipeRequest;
use Illuminate\Support\Facades\Hash;
use App\Pipe;
use App\State;
use App\Tractor;
use App\User;

class PipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pipe $model)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        return view('pipas.index', ['pipas' => $model::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, State $state)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $states = $state::all();
        $tractors = Tractor::all();
        return view('pipas.create', compact('states', 'tractors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PipeRequest $request, Pipe $model)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        // return $request->all();
        $model->create($request->all());

        return redirect()->route('pipas.index')->with('status', __('Pipa Creada Exitosamente.'))->with('color', 2);
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
    public function edit(Request $request, Pipe $pipe, $id, State $state)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $pipe_edit = $pipe::findorfail($id);
        $states = $state::all();
        $tractors = Tractor::all();
        return view('pipas.edit', compact('pipe_edit', 'states', 'tractors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PipeRequest $request, Pipe $pipe, $id)
    {   
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $pipe_up = $pipe::findorfail($id);

        $pipe_up->update($request->all());

        return redirect()->route('pipas.index')->with('status', __('Pipa Editada Correctamente.'))->with('color', 2);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);

        $pipa = Pipe::findorfail($id);
        $pipa->delete();

        return redirect()->route('pipas.index')->with('status', __('Pipa Eliminada Exitosamente.'))->with('color', 2);
    }
}
