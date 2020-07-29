<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{   
    // relacionamos los menus con los roles
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
}
