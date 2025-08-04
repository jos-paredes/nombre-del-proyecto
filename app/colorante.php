<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class colorante extends Model 
{
    protected $table = 'colorante';      
    protected $fillable = [ "ID_regis", "Colorante", "Codigo", "KL", "BP", "Dosificacion", "CantidadBolsones"]; 
    public $timestamps = true;
}