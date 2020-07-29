<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    // obtenemos la relacion de usuarios con los roles
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    
    // obtenemos la relacion de usuarios con los estaciones
    public function estacions(){
        return $this->belongsToMany('App\Estacion');
    }
    
    // validamos si el usuario cuenta con un rol valido
    public function authorizeRoles($roles){
        if($this->hasAnyRole($roles)){
            return true;
        }
        // en caso de no contar
        abort(401,'This action is unauthorized');
    }
    
    // // validamos si el usuario cuenta con mas de un rol, si los tiene hacemos un recorido con el foreach
    public function hasAnyRole($roles){
        if(is_array($roles)){
            foreach ($roles as $role) {
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }
    
    // validamos un solo rol del usuario
    public function hasRole($role){
        if($this->roles()->where('name',$role)->first()){
            return true;
        }
        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'app_name', 'apm_name','username', 'direccion', 'sex','phone', 'active', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
