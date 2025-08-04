<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MP extends Model 
{
    protected $table = 'MP';      
    protected $fillable = ["MateriaPrima", "ID_regis", "INTF", "CantidadEmpaque", "Identif", "CantidadBolsones", "Dosificacion", "Humedad", "Conformidad"]; 
    public $timestamps = true;
}