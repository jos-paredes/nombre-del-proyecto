<?php

namespace App\Http\Controllers;

use App\defectos;
use Illuminate\Http\Request;

class defectosController extends Controller 
{
    // 📌 Método para obtener todos los registros
    public function Obtenerdefectos() 
    {
        $defectoss = defectos::all();
        return response()->json($defectoss);
    }

    // 📌 Método para insertar un nuevo registro
    public function Mandardefectos(Request $request) 
    {
        $request->validate([
            'Hora' => 'string|required',
            'Defectos' => 'array|required',
            //'Criticidad' => 'array|required',
            'CSeccionDefecto' => 'string|required',
            'DefectosEncontrados' => 'numeric|required',
            'Fase' => 'string|required',
            'Palet' => 'bool|required',
            'Empaque' => 'bool|required',
            'Embalado' => 'bool|required',
            'Etiquetado' => 'bool|required',
            'Inocuidad' => 'bool|required',
            'CantidadProductoRetenido' => 'numeric|required',
            'CantidadProductoCorregido' => 'numeric|required',
            'Observaciones' => 'string|nullable',
            'ID_regis' => 'int|required',
        ]);
    
        $defectos = defectos::create([
            'Hora' => $request->Hora,
        //'Defectos' => $request->Defectos,
        'Defectos' => json_encode($request->Defectos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        //'Criticidad' => json_encode($request->Criticidad, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        
        'CSeccionDefecto' => $request->CSeccionDefecto,
        'DefectosEncontrados' => $request->DefectosEncontrados,
        'Fase' => $request->Fase,
        'Palet' => $request->Palet,
        'Empaque' => $request->Empaque,
        'Embalado' => $request->Embalado,
        'Etiquetado' => $request->Etiquetado,
        'Inocuidad' => $request->Inocuidad,
        'CantidadProductoRetenido' => $request->CantidadProductoRetenido,
        'CantidadProductoCorregido' => $request->CantidadProductoCorregido,
        'Observaciones' => $request->Observaciones, 
        'ID_regis' => $request->ID_regis,       
        ]);
    
        return response()->json([
            'mensaje' => 'defectos se guardó correctamente',
            'data' => $defectos,
        ], 201);
    } 
}