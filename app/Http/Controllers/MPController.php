<?php

namespace App\Http\Controllers;

use App\MP;
use Illuminate\Http\Request;

class MPController extends Controller 
{
    public function ObtenerMP() 
    {
        $mps = MP::all();
        return response()->json($mps);
    }
    public function MandarMP(Request $request) 
    {
        $request->validate([
            'ID_regis' => 'int|required',
            'MateriaPrima' => 'string|required',
            'INTF' => 'string|required',
            'CantidadEmpaque' => 'string|required',
            'Identif' => 'string|required',
            'CantidadBolsones' => 'int|required',
            'Dosificacion' => 'numeric|required',
            'Humedad' => 'numeric|required',
            'Conformidad' => 'bool|required',
        ]);
    
        $MP = MP::create([
            
        'MateriaPrima' => $request->MateriaPrima,
        'ID_regis' => $request->ID_regis,
        'INTF' => $request->INTF,
        'CantidadEmpaque' => $request->CantidadEmpaque,
        'Identif' => $request->Identif,
        'CantidadBolsones' => $request->CantidadBolsones,
        'Dosificacion' => $request->Dosificacion,
        'Humedad' => $request->Humedad,
        'Conformidad' => $request->Conformidad,        
        ]);
    
        return response()->json([
            'mensaje' => 'MP se guardó correctamente',
            'data' => $MP,
        ], 201);
    } 
}