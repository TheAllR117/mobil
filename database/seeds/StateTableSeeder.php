<?php

use Illuminate\Database\Seeder;
use App\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = new State();
        $state->estado = "Disponible";
        $state->descripcion = "-";
        $state->created_at = now();
        $state->updated_at = now();
        $state->save();

        $state = new State();
        $state->estado = "Ocupado";
        $state->descripcion = "-";
        $state->created_at = now();
        $state->updated_at = now();
        $state->save();

        $state = new State();
        $state->estado = "Mantenimiento";
        $state->descripcion = "";
        $state->created_at = now();
        $state->updated_at = now();
        $state->save();

        $state = new State();
        $state->estado = "Fuera de servicio";
        $state->descripcion = "-";
        $state->created_at = now();
        $state->updated_at = now();
        $state->save();
    }
}
