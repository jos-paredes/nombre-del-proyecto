<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPSRegis extends Model
{
    protected $table = 'ipsregistros';
    protected $fillable = ["Modalidad", "Ciclo", "PAinicial", "PAfinal"];
}