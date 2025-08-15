<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resistencia extends Model
{
    

    protected $table = 'tb_resistencias';

    public $timestamps = false;
    
    protected $fillable = [
        'id_registro',
        'bt1_max', 'bt1_min',
        'bt2_max', 'bt2_min',
        'bt3_max', 'bt3_min',
        'bt4_max', 'bt4_min',
        'bt5_max', 'bt5_min',
        'bt9_max', 'bt9_min',
        'bt11_max', 'bt11_min',
        'bt12_max', 'bt12_min',
        'bt13_max', 'bt13_min',
        'bt14_max', 'bt14_min',
        'bt15_max', 'bt15_min',
        'bt16_max', 'bt16_min',
        'bt17_max', 'bt17_min',
        'bt19_max', 'bt19_min',
        'cerrado',
        'fecha_creacion',
        'fecha_actualizacion'
    ];
    
}