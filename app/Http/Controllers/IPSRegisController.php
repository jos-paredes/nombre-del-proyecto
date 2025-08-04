<?php

namespace App\Http\Controllers;

use App\IPSRegis;
use Illuminate\Http\Request;

class IPSRegisController extends Controller
{
    public function crearIPSRegis(Request $request)
    {
        $request->validate([
            "Auxiliar" => "nullable|string",            
            "Modalidad" => "nullable|string",
            "Ciclo" => "nullable|numeric",
            "PAinicial" => "nullable|numeric",
            "PAfinal" => "nullable|numeric",
        ]);

        $IPSRegistro = new IPSRegis();
        $IPSRegistro->Modalidad = $request->Modalidad ?? ' ';
        $IPSRegistro->Ciclo = $request->Ciclo ?? 0;
        $IPSRegistro->PAinicial = $request->PAinicial ?? 0;
        $IPSRegistro->PAfinal = $request->PAfinal ?? 0;
        $IPSRegistro->save();

        return response()->json(['id' => $IPSRegistro->id, 'mensaje' => 'IPSRegis creado exitosamente'], 201);
    }

    public function actualizarUltimoIPSRegis(Request $request)
    {
        $IPSRegistro = IPSRegis::latest()->first();

        if (!$IPSRegistro) {
            return response()->json(['error' => 'No hay registros disponibles para actualizar'], 404);
        }

        $request->validate([
            "Modalidad" => "nullable|string",
            "Ciclo" => "nullable|numeric",
            "PAinicial" => "nullable|numeric",
            "PAfinal" => "nullable|numeric",
        ]);

        $IPSRegistro->fill($request->only(["Modalidad", "Ciclo", "PAinicial", "PAfinal"]));
        $IPSRegistro->save();

        return response()->json([
            'mensaje' => 'IPSRegis actualizado correctamente',
            'data' => $IPSRegistro,
        ]);
    }

    public function obtenerUltimoIPSRegis()
    {
        $IPSRegistro = IPSRegis::latest()->first();

        if (!$IPSRegistro) {
            return response()->json(['error' => 'No hay registros disponibles'], 404);
        }

        return response()->json(['data' => $IPSRegistro], 200);
    }
}
