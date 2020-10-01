<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {
        $array_principal = [];
        $pedidos = [];
        $ordenes = Order::where('status_id', 1)->get();
        foreach($ordenes as $estacion){
            $pedidos = [];
            foreach($estacion->estacions as $sh){
                array_push($pedidos, $sh->sh);
                array_push($pedidos, 'OTJC');
                array_push($pedidos, date("Ymd", strtotime($estacion->dia_entrega)));
                array_push($pedidos, $estacion->po);
                array_push($pedidos, '123499');
                array_push($pedidos, $estacion->cantidad_lts);
                array_push($array_principal, $pedidos);
            }
        }
        //dd($array_principal[0]);
        //return $array_principal[0];
        return collect($array_principal);
        //return Order::all();
    }

    public function headings(): array
    {
        return [
            'SH',
            'TERMINAL',
            'DATE',
            'PO',
            'MATERIAL',
            'QTY'
        ];
    }
}
