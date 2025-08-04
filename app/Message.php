<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    protected $table = 'mensaje'; // Cambia por el nombre real de la tabla en SQL

    // Permitir asignación masiva para estos campos
    protected $fillable = ['message', 'number','tipos','te_gusta'];
}
