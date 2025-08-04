<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroIPS extends Model 
{
    protected $table = 'registroips';      
    protected $fillable = ["Auxiliar", "Turno", "Modalidad", "Lote", "Maquinista", "Parte", "Producto", "Gramaje", "Empaque", "Cavhabilitadas", "Ciclo", "PesoProm", "PAinicial", "PAfinal", "Cantidad", "Pesopromneto", "Totalcajascont", "Saldos", "Totalprodu", "Cantidadtotaldepiezas", "CantidadtotalKg", "Conformidad"]; 
}