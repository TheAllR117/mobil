<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\Role;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $menu->name_modulo = "dashboard";
        $menu->desplegable = "0";
        $menu->ruta = "home";
        $menu->id_role = "1";
        $menu->icono = "dashboard";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('2');
        $menu->roles()->attach('3');
        $menu->roles()->attach('4');

        $menu = new Menu();
        $menu->name_modulo = "Perfil";
        $menu->desplegable = "0";
        $menu->ruta = "profile";
        $menu->id_role = "1";
        $menu->icono = "account_circle";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('2');
        $menu->roles()->attach('3');
        $menu->roles()->attach('4');

        

        $menu = new Menu();
        $menu->name_modulo = "Estaciones";
        $menu->desplegable = "0";
        $menu->ruta = "estaciones";
        $menu->id_role = "1";
        $menu->icono = "local_gas_station";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('2');
        $menu->roles()->attach('3');

        $menu = new Menu();
        $menu->name_modulo = "Usuarios";
        $menu->desplegable = "0";
        $menu->ruta = "user";
        $menu->id_role = "1";
        $menu->icono = "perm_identity";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('3');


        $menu = new Menu();
        $menu->name_modulo = "Terminales";
        $menu->desplegable = "0";
        $menu->ruta = "terminales";
        $menu->id_role = "1";
        $menu->icono = "home_work";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('3');

        $menu = new Menu();
        $menu->name_modulo = "Pedidos";
        $menu->desplegable = "0";
        $menu->ruta = "pedidos";
        $menu->id_role = "1";
        $menu->icono = "add_shopping_cart";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('2');
        $menu->roles()->attach('3');

        $menu = new Menu();
        $menu->name_modulo = "Facturas";
        $menu->desplegable = "0";
        $menu->ruta = "facturas";
        $menu->id_role = "1";
        $menu->icono = "description";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('2');
        $menu->roles()->attach('3');
        $menu->roles()->attach('4');

        $menu = new Menu();
        $menu->name_modulo = "Control pedidos";
        $menu->desplegable = "0";
        $menu->ruta = "control";
        $menu->id_role = "1";
        $menu->icono = "control_camera";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('3');
        

        $menu = new Menu();
        $menu->name_modulo = "Fleteras";
        $menu->desplegable = "0";
        $menu->ruta = "fleteras";
        $menu->id_role = "1";
        $menu->icono = "account_tree";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('3');

        /*$menu = new Menu();
        $menu->name_modulo = "Pipas";
        $menu->desplegable = "0";
        $menu->ruta = "pipas";
        $menu->id_role = "1";
        $menu->icono = "rv_hookup";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('3');

        $menu = new Menu();
        $menu->name_modulo = "Tractores";
        $menu->desplegable = "0";
        $menu->ruta = "tractores";
        $menu->id_role = "1";
        $menu->icono = "local_shipping";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('3');

        $menu = new Menu();
        $menu->name_modulo = "Conductores";
        $menu->desplegable = "0";
        $menu->ruta = "conductores";
        $menu->id_role = "1";
        $menu->icono = "how_to_reg";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('3');*/

        $menu = new Menu();
        $menu->name_modulo = "Abonos";
        $menu->desplegable = "0";
        $menu->ruta = "abonos";
        $menu->id_role = "1";
        $menu->icono = "control_point";
        $menu->created_at = now();
        $menu->updated_at = now();
        $menu->save();
        $menu->roles()->attach('1');
        $menu->roles()->attach('2');
        $menu->roles()->attach('4');


    }
}
