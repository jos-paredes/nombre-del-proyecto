<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesosips extends Model
{
    protected $table = 'pesoips';
    protected $fillable = ['Hora', 'PA', 'PesoTara', 'PesoNeto', 'PesoTotal', 'ID_regis'];

}
