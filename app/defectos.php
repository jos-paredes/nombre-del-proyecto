<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class defectos extends Model 
{
    
    protected $table = 'defectos';      
    protected $fillable = ["Hora", "Defectos", "CSeccionDefecto", "DefectosEncontrados", "Fase", "Palet", "Empaque", "Embalado", "Etiquetado", "Inocuidad", "CantidadProductoRetenido", "CantidadProductoCorregido", "Observaciones", "ID_regis"]; 
    public $timestamps = true;
}