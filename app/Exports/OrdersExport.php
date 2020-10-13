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
        $ordenes = Order::where('status_id', 1)->limit(20)->get();
        foreach($ordenes as $estacion){
            $pedidos = [];
            foreach($estacion->estacions as $sh){
                array_push($pedidos, $sh->sh);
                array_push($pedidos, 'OTJC');
                array_push($pedidos, date("Ymd", strtotime($estacion->dia_entrega)));
                array_push($pedidos, $estacion->po);
                array_push($pedidos, $estacion->clave_producto);
                array_push($pedidos, $estacion->cantidad_lts);
                array_push($array_principal, $pedidos);
            }
        }
        return collect($array_principal);
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
