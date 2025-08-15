<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class FormularioGeneralProd extends Model
{
    protected $table = 'prod_formulario_general';
    
    // Deshabilitar completamente los timestamps automáticos
    public $timestamps = false;
    
    protected $fillable = [
        'id_registro',
        'tonalidad',
        'dosificacion_eco',
        'gramaje',
        'punto_ajuste',
        'temp_proceso',
        'dewpoint',
        'temp_cono',
        'presion_entrada_agua_molde',
        'presion_salida_agua_molde',
        'presion_entrada_agua_maquina',
        'presion_salida_agua_maquina',
        'punto_ajuste_chiller_2',
        'lectura_chiller_2',
        'temp_motor_m2',
        'temp_aire_torre_entrada',
        'velocidad_tornillo',
        'temp_aire_torre_salida',
        'temp_cilindro',
        'torre_cama1d',
        'caudal_aire',
        'temp_intercambiados',
        'cerrado',
        'fecha_creacion',
        'fecha_actualizacion'
    ];
}