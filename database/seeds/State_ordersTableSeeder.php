<?php

use Illuminate\Database\Seeder;
use App\Statu_order;

class State_ordersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statu_order = new Statu_order();
        $statu_order->name = "Pendiente";
        $statu_order->descripcion = "-";
        $statu_order->save();

        $statu_order = new Statu_order();
        $statu_order->name = "Autorizado";
        $statu_order->descripcion = "-";
        $statu_order->save();

        $statu_order = new Statu_order();
        $statu_order->name = "En camino";
        $statu_order->descripcion = "-";
        $statu_order->save();

        $statu_order = new Statu_order();
        $statu_order->name = "Entregado";
        $statu_order->descripcion = "-";
        $statu_order->save();

        $statu_order = new Statu_order();
        $statu_order->name = "Para Factura";
        $statu_order->descripcion = "-";
        $statu_order->save();

        $statu_order = new Statu_order();
        $statu_order->name = "Cancelado";
        $statu_order->descripcion = "-";
        $statu_order->save();
    }
}
