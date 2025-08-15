<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemperaturaProd extends Model
{
    // Nombre de la tabla
    protected $table = 'tb_temperaturas';

    // Si no quieres que Laravel maneje automáticamente created_at y updated_at
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id_registro',
        'enfriamiento_dato',
        'dato_1', 'dato_2', 'dato_3',
        'dato_4', 'dato_5', 'dato_6',
        'dato_7', 'dato_8', 'dato_9',
        'dato_10', 'dato_11', 'dato_12',
        'dato_13', 'dato_14', 'dato_15',
        'dato_16', 'dato_17', 'dato_18',
        'dato_19',
        'tipo_cuello',
        'peso_preforma',
        'espesor_1', 'espesor_2', 
        'espesor_3', 'espesor_4',
        'cerrado',
        'fecha_creacion', // <- agregado para evitar errores
        'fecha_actualizacion' // <- agregado para evitar errores
    ];

    // Tipos de datos para casting automático
    protected $casts = [
        'enfriamiento_dato' => 'float',
        'dato_1' => 'float',
        'dato_2' => 'float',
        'dato_3' => 'float',
        'dato_4' => 'float',
        'dato_5' => 'float',
        'dato_6' => 'float',
        'dato_7' => 'float',
        'dato_8' => 'float',
        'dato_9' => 'float',
        'dato_10' => 'float',
        'dato_11' => 'float',
        'dato_12' => 'float',
        'dato_13' => 'float',
        'dato_14' => 'float',
        'dato_15' => 'float',
        'dato_16' => 'float',
        'dato_17' => 'float',
        'dato_18' => 'float',
        'dato_19' => 'float',
        'peso_preforma' => 'float',
        'espesor_1' => 'float',
        'espesor_2' => 'float',
        'espesor_3' => 'float',
        'espesor_4' => 'float',
        'cerrado' => 'boolean',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime'
    ];
}
