<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = "Administrador";
        $role->description = "Usuarion con nivel de administracion total.";
        $role->save();

        $role = new Role();
        $role->name = "Admin-Estacion";
        $role->description = "Administrador total de la estacion seleccionada.";
        $role->save();

        $role = new Role();
        $role->name = "Logistica";
        $role->description = "";
        $role->save();

        $role = new Role();
        $role->name = "Abonos & Pagos";
        $role->description = "";
        $role->save();

        /*$role = new Role();
        $role->name = "Pagos";
        $role->description = "";
        $role->save();*/

    }
}
