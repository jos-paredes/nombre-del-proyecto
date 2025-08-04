<?php

namespace App\Http\Controllers;

use App\Pesosips;
use Illuminate\Http\Request;

class PesosipsController extends Controller
{
    // Crear un nuevo registro
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'Hora' => 'string',
            'PA' => 'string',            
            'PesoTara' => 'numeric',
            'PesoNeto' => 'numeric',
            'PesoTotal' => 'numeric',
            'ID_regis' => 'int',
        ]);

        // Crear y guardar el registro
        $Pesoips = Pesosips::create([
            'Hora' => $request->Hora,
            'PA' => $request->PA,            
            'PesoTara' => $request->PesoTara,
            'PesoNeto' => $request->PesoNeto,
            'PesoTotal' => $request->PesoTotal,
            'ID_regis' => $request->ID_regis,
        ]);

        // Responder con éxito
        return response()->json([
            'message' => 'Pesosips saved successfully',
            'data' => $Pesoips,
        ], 201);
    }

    // Obtener todos los registros
    public function index()
    {
        $Pesoips = Pesosips::all();

        return response()->json([
            'data' => $Pesoips,
        ], 200);
    }

    public function show($id)
{
    $Pesoips = Pesosips::find($id);
    if (!$Pesoips) {
        return response()->json(['error' => 'Pesosips not found'], 404);
    }
    return response()->json(['data' => $Pesoips], 200);
}

    // Actualizar un registro
    public function update(Request $request, $id)
    {
        $Pesoips = Pesosips::find($id);

        if (!$Pesoips) {
            return response()->json(['error' => 'Pesosips not found'], 404);
        }

        // Validar los datos
        $request->validate([
            'ID_regis' => 'int|required',
            'Hora' => 'string|nullable',
            'PA' => 'string|nullable',            
            'PesoTara' => 'numeric|nullable',
            'PesoNeto' => 'numeric|nullable',
            'PesoTotal' => 'numeric|nullable',
        ]);

        // Actualizar el registro
        $Pesoips->update($request->only(['Hora', 'PA', 'PesoTara', 'PesoNeto', 'PesoTotal']));

        return response()->json([
            'message' => 'Pesosips updated successfully',
            'data' => $Pesoips,
        ], 200);
    }

    // Eliminar un registro
    public function destroy($id)
    {
        $Pesoips = Pesosips::find($id);

        if (!$Pesoips) {
            return response()->json(['error' => 'Pesosips not found'], 404);
        }

        $Pesoips->delete();

        return response()->json(['message' => 'Pesosips deleted successfully'], 200);
    }
}



