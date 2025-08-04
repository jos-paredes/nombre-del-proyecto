<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class procesos extends Model 
{
    protected $table = 'procesos';      
    protected $fillable = ["ID_regis", "Hora", "PAprod", "TempTolvaSec", "TempProd", "Tciclo", "Tenfri"]; 
    public $timestamps = true;
}