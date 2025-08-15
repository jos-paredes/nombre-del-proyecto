<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroProduccion extends Model
{
    protected $table = 'tb_registro_produccion';
    public $timestamps = false;

    protected $fillable = [
        'id_registro',
        'nombre_usuario',
        'turno',
        'fecha',
    ];
}
