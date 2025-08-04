<?php

namespace App\Http\Controllers;

use App\Temperaturas;
use Illuminate\Http\Request;

class temperaturasController extends Controller 
{
    // 📌 Método para obtener todos los registros
    public function Obtenertemperaturas() 
    {
        $temperaturass = Temperaturas::all();
        return response()->json($temperaturass);
    }

    // 📌 Método para insertar un nuevo registro
    public function Mandartemperaturas(Request $request) 
    {
        $request->validate([
            'ID_regis' => 'int|required',
            'Hora' => 'string|required',
            'Fase' => 'string|required',
            'Cavidades' => 'array|required',
            'Tcuerpo' => 'array|required',
            'Tcuello' => 'array|required',
        ]);
    
        $temperaturas = Temperaturas::create([
            'ID_regis' => $request->ID_regis,
            'Hora' => $request->Hora,
        'Fase' => $request->Fase,
        'Cavidades' => json_encode($request->Cavidades),
        'Tcuerpo' => json_encode($request->Tcuerpo),
        'Tcuello' => json_encode($request->Tcuello),       
        ]);
    
        return response()->json([
            'mensaje' => 'temperaturas se guardó correctamente',
            'data' => $temperaturas,
        ], 201);
    } 
}