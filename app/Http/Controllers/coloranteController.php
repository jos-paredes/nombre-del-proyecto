<?php

namespace App\Http\Controllers;

use App\colorante;
use Illuminate\Http\Request;

class coloranteController extends Controller 
{
    // 📌 Método para obtener todos los registros
    public function Obtenercolorante() 
    {
        $colorantes = colorante::all();
        return response()->json($colorantes);
    }

    // 📌 Método para insertar un nuevo registro
    public function Mandarcolorante(Request $request) 
    {
        $request->validate([
            'ID_regis' => 'int|required',
            'Colorante' => 'string|required',
            'Codigo' => 'string|required',
            'KL' => 'string|required',
            'BP' => 'string|required',
            'Dosificacion' => 'numeric|required',
            'CantidadBolsones' => 'int|required',
        ]);
    
        $colorante = colorante::create([
            'ID_regis' => $request->ID_regis,
            'Colorante' => $request->Colorante,
        'Codigo' => $request->Codigo,
        'KL' => $request->KL,
        'BP' => $request->BP,
        'Dosificacion' => $request->Dosificacion,
        'CantidadBolsones' => $request->CantidadBolsones,        
        ]);
    
        return response()->json([
            'mensaje' => 'colorante se guardó correctamente',
            'data' => $colorante,
        ], 201);
    } 
}