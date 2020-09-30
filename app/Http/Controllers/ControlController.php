<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Estacion;
use App\Terminal;
use App\Pipe;
use App\Tractor;
use App\Driver;
use App\Control;
use App\Freight;
use App\NameFreight;
use Exception;

class ControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $order)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        return view('control.index', ['orders' => $order::where('status_id', 3)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Order $order, Estacion $estacion, $id = 0)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $terminal = Terminal::all();
        $pipe = Pipe::all();
        $tractor = Tractor::all();
        $driver = Driver::all();
        $namefreight = NameFreight::all();

        $idFreight = -1;
        $idTractor = -1;
        $idPipeOne = -1;
        $idPipeTwo = -1;
        $idPipeThree = -1;
        $idDrive = -1;
        $idTerminal = -1;
        $orderControler = [];
        $idOrderControler = -1;
        $pipes = array();
        try {
            $control = Control::find($id);
            $idFreight = $control->freights[0]->id_freights;
            $idTerminal = $control->terminal_id;
            $idDrive = $control->id_chofer;
            $idTractor = $control->tractor_id;
            $orderControler = $order::where('control_id', $id)->get();
            $pipes = $this->getPipes($orderControler);
            $idPipeOne = $pipes[0];
            $idPipeTwo = $pipes[1];
            if (count($pipes) > 2) {
                $idPipeThree = $pipes[2];
            }
            $idOrderControler = $id;
        } catch (Exception $e) {
        }
        if ($idOrderControler != -1 && $control->dia_entrega != null) {
            $fecha = date("Y-m-d", strtotime($control->dia_entrega));
        } else {
            $fecha = "+1 days";

            if (date("l") == 'Saturday') {
                $fecha = "+2 days";
            }
            $fecha = date("d/m/Y", strtotime($fecha));
        }
        $estaciones = $estacion::select('id', 'razon_social', 'nombre_sucursal')->get();
        $orders = $order::where('status_id', 2)->orderByDesc('id')->get();
        $data = [
            'orders' => $orders,
            'estaciones' => $estaciones,
            'terminals' => $terminal,
            'pipes' => $pipe,
            'tractores' => $tractor,
            'drivers' => $driver,
            'fecha' => $fecha,
            'namefreights' => $namefreight,
            'idFreight' => $idFreight,
            'idTractor' => $idTractor,
            'idPipaUno' => $idPipeOne,
            'idPipaDos' => $idPipeTwo,
            'idPipaTres' => $idPipeThree,
            'idConductor' => $idDrive,
            'orderControler' => $orderControler,
            'idOrderControler' => $idOrderControler,
            'idTerminal' => $idTerminal,
            'control' => $control
        ];

        return view('control.create', $data);
    }


    public function seleccionar_tractor(Freight $freight, Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $tractores_total = array();
        $tractores = $freight::where('id_freights', $request->id_freights)->get();

        for ($i = 0; $i < count($tractores); $i++) {
            array_push($tractores_total, $tractores[$i]->Tractors);
        }
        $selecion = array('tractores' => $tractores_total, 'id' => $tractores[0]->id);
        return json_encode($selecion);
    }


    public function seleccionar_pipa(Freight $freight, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        try {
            $tractor = Tractor::find($request->id_tractor);
            return response()->json([
                'pipas' => $tractor->pipes
            ]);
        } catch (Exception $e) {
            return response()->json([
                'pipas' => []
            ]);
        }
    }

    public function pipa_escogida(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);

        $resulta_busqueda = [];

        for ($i = 0; $i < count($request->pipas_ids); $i++) {
            array_push($resulta_busqueda, Pipe::find($request->pipas_ids[$i]));
        }

        return response()->json([
            'pipas' => $resulta_busqueda
        ]);
    }

    public function fletes_contador(Request $request)
    {
        $dia_entrega = $request->dia_entrega;
        $fletes = Control::where('dia_entrega', $dia_entrega)->get();
        $count_fletes = count($fletes);

        return $count_fletes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Control $control, Order $order, Pipe $pipe, Tractor $tractor, Driver $driver)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        $tractor::where('id', $request->tractor_id)->update(['id_status' => 2]);
        $driver::where('id', $request->chofer_id)->update(['id_status' => 2]);
        $lastControl = $control->create($request->except('_token', '_method', 'pipa_id', 'conductor_id', '0', '1', '2', '4', '5', '6', 'idOrderControler'));
        $pipas_selec = explode(',', $request->pipa_id);
        $pedidos = $request->except('_token', '_method', 'pipa_id', 'tractor_id', 'terminal_id', 'chofer_id', 'fletera', 'id_freights', 'dia_entrega', 'idOrderControler', 'id_chofer', 'tractor_id');
        if (count($pipas_selec) == count($pedidos)) {
            for ($i = 0; $i < count($pedidos); $i++) {
                $order::where('id', $pedidos[$i])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
            }
        } elseif ((count($pipas_selec) * 2) == count($pedidos)) {
            for ($i = 0; $i < count($pipas_selec); $i++) {
                $order::where('id', $pedidos[$i * 2])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
                $order::where('id', $pedidos[$i * 2 + 1])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
            }
        } else {
            switch (count($pipas_selec)) {
                case 2:
                    for ($i = 0; $i < 3; $i++) {
                        if ($i == 2) {
                            $order::where('id', $pedidos[$i])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[1]]);
                        } else {
                            $order::where('id', $pedidos[$i])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[0]]);
                        }
                    }
                    break;
                case 3:
                    switch (count($pedidos)) {
                        case 4:
                            for ($i = 0; $i < 4; $i++) {
                                if ($i == 3) {
                                    $order::where('id', $pedidos[$i])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[2]]);
                                } else {
                                    $order::where('id', $pedidos[$i])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
                                }
                            }
                            break;
                        case 5:
                            for ($i = 0; $i < 2; $i++) {
                                $order::where('id', $pedidos[$i * 2])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
                                $order::where('id', $pedidos[$i * 2 + 1])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
                            }
                            $order::where('id', $pedidos[4])->update(['control_id' => $lastControl->id, 'status_id' => 3, 'pipe_id' => $pipas_selec[2]]);
                            break;
                    }
                    break;
            }
        }
        return redirect()->route('pedidos.index')->withStatus(__('Armado de pedido exitoso.'));
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
    public function update(Request $request, Control $control, Order $order, Tractor $tractor, Driver $driver)
    {
        $request->user()->authorizeRoles(['Administrador', 'Logistica']);
        
        $tractor::where('id', $request->tractor_id)->update(['id_status' => 2]);
        $driver::where('id', $request->chofer_id)->update(['id_status' => 2]);
        $id_control = $control::find($request->idOrderControler);
        $id_control->update($request->except('_token', '_method', 'pipa_id', 'conductor_id', '0', '1', '2', '4', '5', '6', 'idOrderControler'));
        $pedidosOriginales = $id_control->orders;
        for ($i = 0; $i < count($pedidosOriginales); $i++) {
            $order::find($pedidosOriginales[$i]->id)->update(['control_id' => null, 'pipe_id' => null, 'status_id' => 2]);
        }
        $pipas_selec = explode(',', $request->pipa_id);
        $p = $request->except('_token', '_method', 'pipa_id', 'tractor_id', 'terminal_id', 'chofer_id', 'fletera', 'id_freights', 'dia_entrega', 'idOrderControler', 'id_chofer', 'tractor_id');
        $pedidos = array();
        foreach ($p as $pedido) {
            array_push($pedidos, $pedido);
        }
        if (count($pipas_selec) == count($pedidos)) {
            for ($i = 0; $i < count($pedidos); $i++) {
                $order::where('id', $pedidos[$i])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
            }
        } elseif ((count($pipas_selec) * 2) == count($pedidos)) {
            for ($i = 0; $i < count($pipas_selec); $i++) {
                $order::where('id', $pedidos[$i * 2])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
                $order::where('id', $pedidos[$i * 2 + 1])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
            }
        } else {
            switch (count($pipas_selec)) {
                case 2:

                    for ($i = 0; $i < 3; $i++) {
                        if ($i == 2) {
                            $order::where('id', $pedidos[$i])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[1]]);
                        } else {
                            $order::where('id', $pedidos[$i])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[0]]);
                        }
                    }
                    break;
                case 3:
                    switch (count($pedidos)) {
                        case 4:
                            for ($i = 0; $i < 4; $i++) {
                                if ($i == 3) {
                                    $order::where('id', $pedidos[$i])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[2]]);
                                } else {
                                    $order::where('id', $pedidos[$i])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
                                }
                            }
                            break;
                        case 5:
                            for ($i = 0; $i < 2; $i++) {
                                $order::where('id', $pedidos[$i * 2])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
                                $order::where('id', $pedidos[$i * 2 + 1])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[$i]]);
                            }
                            $order::where('id', $pedidos[4])->update(['control_id' => $request->idOrderControler, 'status_id' => 3, 'pipe_id' => $pipas_selec[2]]);
                            break;
                    }
                    break;
            }
        }
        return redirect()->route('pedidos.index')->withStatus(__('Armado de pedido exitoso.'));
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
    // Funcion para calcular la pocision dentro de un arreglo
    private function getPipes($array)
    {
        $pipes = array();
        foreach ($array as $pipe) {
            array_push($pipes, $pipe->pipe_id);
        }
        $pipes = array_unique($pipes);
        $p = array();
        foreach ($pipes as $pipe) {
            array_push($p, $pipe);
        }
        return $p;
    }
}
