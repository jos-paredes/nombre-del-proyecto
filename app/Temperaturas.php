<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temperaturas extends Model 
{
    protected $table = 'temperaturas';      
    protected $fillable = ["ID_regis", "Hora", "Fase", "Cavidades", "Tcuerpo", "Tcuello"]; 
    public $timestamps = true;
}