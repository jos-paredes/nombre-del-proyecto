<?php

namespace App\Http\Controllers;

use App\pesos;
use Illuminate\Http\Request;

class pesosController extends Controller 
{
    // 📌 Método para obtener todos los registros
    public function Obtenerpesos() 
    {
        $pesoss = pesos::all();
        return response()->json($pesoss);
    }

    // 📌 Método para insertar un nuevo registro
    public function Mandarpesos(Request $request) 
    {
        $request->validate([
            'Hora' => 'string|required',
            'PA' => 'string|required',
            'PesoTara' => 'numeric|required',
            'PesoNeto' => 'numeric|required',
            'PesoTotal' => 'numeric|required',
        ]);
    
        $pesos = pesos::create([
            'Hora' => $request->Hora,
        'PA' => $request->PA,
        'PesoTara' => $request->PesoTara,
        'PesoNeto' => $request->PesoNeto,
        'PesoTotal' => $request->PesoTotal,        
        ]);
    
        return response()->json([
            'mensaje' => 'pesos se guardó correctamente',
            'data' => $pesos,
        ], 201);
    } 
}