<?php

namespace App\Http\Controllers;

use App\procesos;
use Illuminate\Http\Request;

class procesosController extends Controller 
{
    // 📌 Método para obtener todos los registros
    public function Obtenerprocesos() 
    {
        $procesoss = procesos::all();
        return response()->json($procesoss);
    }

    // 📌 Método para insertar un nuevo registro
    public function Mandarprocesos(Request $request) 
    {
        $request->validate([
            'ID_regis' => 'int|required',
            'Hora' => 'string|required',
            'PAprod' => 'string|required',
            'TempTolvaSec' => 'array|required',
            
            'TempProd' => 'numeric|required',
            'Tciclo' => 'numeric|required',
            'Tenfri' => 'numeric|required',
        ]);
    
        $procesos = procesos::create([
            'ID_regis' => $request->ID_regis,
            'Hora' => $request->Hora,
        'PAprod' => $request->PAprod,
        'TempTolvaSec' => json_encode($request->TempTolvaSec),
        'TempProd' => $request->TempProd,
        'Tciclo' => $request->Tciclo,
        'Tenfri' => $request->Tenfri,        
        ]);
    
        return response()->json([
            'mensaje' => 'procesos se guardó correctamente',
            'data' => $procesos,
        ], 201);
    } 
}