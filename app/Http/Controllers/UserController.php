<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Estacion;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model, Request $request)
    {   // validamos el rol del usuario para determinar si tine acceso a la vista si el usuario no tine ninguno de esos roles no se muestra las vista
        $request->user()->authorizeRoles(['Administrador']);
        
        // retornamos las informacion de todos los usurios
        return view('users.index', ['users' => $model::all()]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request, Estacion $estacion, Role $roles)
    {
        $request->user()->authorizeRoles(['Administrador']);
        
        //cargamos la informacion de las estaciones para llenar el select con la informacion de la estacion en el registro de usurios
        $estacion = Estacion::all();
        
        //cargamos la informacion de los roles para llenar el select con la informacion de estos
        $roles = Role::all();
        
        //retornamos la informacion a la vista
        return view('users.create', compact('estacion','roles'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $request->user()->authorizeRoles(['Administrador']);
        
        // creamos al usuarios con los datos proporcinados
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        
        // conseguimos el ultimos registro de usuarios
        $ultimo_registro = $model::get()->last();
        
        //buscamos ultimo usuario registrado
        $user = $model::find($ultimo_registro->id);
        
        //asignamos las estaciones seleccionas al usuario registrado, en caso de que sean mas de una
        for($i=0; $i<count($request->razon_social); $i++){
            $user->estacions()->attach($request->razon_social[$i]);
        }
        
        // asignamos el rol del usuario
        $user->roles()->attach($request->rol);
        
        // retornamos a la vista user.index 
        return redirect()->route('user.index')->with('status', __('Usuario Creado Exitosamente.'))->with('color', 2);
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user, Request $request, Estacion $estacion, Role $roles)
    {
        $request->user()->authorizeRoles(['Administrador']);
        
        //cargamos la informacion para llenar los selects de la vista editar
        //return $user->estacions;

        $estaciones = array();

        for($i=0; $i<count($user->estacions); $i++){
            array_push($estaciones, $user->estacions[$i]->nombre_sucursal);
        }        
        
        $estacion = Estacion::whereNotIn('nombre_sucursal', $estaciones)->get();

        $estaciones_sele = Estacion::whereIn('nombre_sucursal', $estaciones)->get();

        $roles = Role::all();
        return view('users.edit', compact('user','estacion','estaciones_sele','roles'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $request->user()->authorizeRoles(['Administrador']);
        
        // declaramos las variables rol_actual y estacion_actual
        $rol_actual = "";
        $estacion_actual = "";
        
        // foreach para conseguir el rol actual
        foreach ($user->roles as $rol) {
            $rol_actual = $rol->id;
        }
    
        // foreach para conseguir la estacion actual
        foreach ($user->estacions as $estacion) {
            $estacion_actual = $estacion->id;
        }
        
        // procesamos la contraseña y guardamos los cambios en la informacion del usuario
        $hasPassword = $request->get('password');
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$hasPassword ? '' : 'password']
        ));
        
        // borramos los registros de relacion del usuario con la estacion 
        $user->estacions()->detach();
            
        // asignamos la nueva estacion o estaciones al usuario
        for($i=0; $i<count($request->razon_social); $i++){    
            $user->estacions()->attach($estacion_actual,['estacion_id'=>$request->razon_social[$i]]);
        }
        
        //actualizamos el rol del usuario
        $user->roles()->updateExistingPivot($rol_actual,['role_id'=>$request->rol]);
        

        return redirect()->route('user.index')->with('status', __('Usuario Actualizado con Éxito.'))->with('color', 2);
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user,Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);

        $user->delete();

        return redirect()->route('user.index')->with('status', __('Usuario Eliminada con Éxito.'))->with('color', 2);
    }
}
