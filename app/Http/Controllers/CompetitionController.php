<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Terminal;
use App\Competition;
use App\Price;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Competition $model)
    {
        $request->user()->authorizeRoles(['Administrador']);
        /*$competicions = Competition::where('id', 1)->get()->last();
        $competicions = Price::where('competition_id', 1)->get()->last();*/
        $competicions = Competition::all();
        $terminals = Terminal::all();
        
        // echo $competicions;
        //echo $competi = Competition::get()->last()->find($competicions[0]->id);
        return view('competidores.index', compact('competicions', 'terminals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $competicions = Competition::all();
        return view('competidores.create', compact('competicions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Price $price)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $price->create($request->all());
        return redirect()->route('competencia.index')->withStatus(__('Precio agregado correctamente.'));
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
        $competicions = Competition::findOrFail($id);
        return view('competidores.edit', compact('competicions'));
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
        $request->user()->authorizeRoles(['Administrador']);
        $competition = Price::findorfail($id);
        $competition->update($request->all());
        return redirect()->route('competencia.index')->withStatus(__('Actualización correcta'));
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
