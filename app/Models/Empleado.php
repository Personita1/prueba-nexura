<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Roles;

class Empleado extends Model
{
    protected $table = 'empleado';

    protected $fillable = ['nombre', 'email', 'sexo', 'area_id',  'boletin', 'descripcion'];

    public $timestamps = false;

    function area(){
        return $this->belongsTo(Area::class)->select();
    }

    function rol(){
        return $this->belongsToMany(Roles::class,'empleado_rol','empleado_id', 'rol_id')->select();
    }
}
