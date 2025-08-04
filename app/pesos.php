<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesos extends Model 
{
    protected $table = 'pesoips';      
    protected $fillable = ["Hora", "PA", "PesoTara", "PesoNeto", "PesoTotal"]; 
    public $timestamps = true;
}