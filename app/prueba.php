<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $table = 'Pruebas';
    protected $fillable = ["p1", "p2", "p3", "p4", "p5"];
}



namespace App\Http\Controllers;

use App\Prueba;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function crearPrueba(Request $request)
    {
        $request->validate([
            "p1" => "nullable|string",
            "p2" => "nullable|double",
            "p3" => "nullable|boolean",
            "p4" => "nullable|integer",
            "p5" => "nullable|array",
        ]);

        $Prueba = new Prueba();
        $Pruebas->p1 = $request->p1 ?? ' ';
        $Pruebas->p2 = $request->p2 ?? 0;
        $Pruebas->p3 = $request->p3 ?? false;
        $Pruebas->p4 = $request->p4 ?? 0;
        $Pruebas->p5 = $request->p5 ?? [];
        $Prueba->save();

        return response()->json(['id' => $Prueba->id, 'mensaje' => 'Prueba creado exitosamente'], 201);
    }

    public function actualizarUltimoPrueba(Request $request)
    {
        $Prueba = Prueba::latest()->first();

        if (!$Prueba) {
            return response()->json(['error' => 'No hay registros disponibles para actualizar'], 404);
        }

        $request->validate([
            "p1" => "nullable|string",
            "p2" => "nullable|double",
            "p3" => "nullable|boolean",
            "p4" => "nullable|integer",
            "p5" => "nullable|array",
        ]);

        $Prueba->fill($request->only(["p1", "p2", "p3", "p4", "p5"]));
        $Prueba->save();

        return response()->json([
            'mensaje' => 'Prueba actualizado correctamente',
            'data' => $Prueba,
        ]);
    }

    public function obtenerUltimoPrueba()
    {
        $Prueba = Prueba::latest()->first();

        if (!$Prueba) {
            return response()->json(['error' => 'No hay registros disponibles'], 404);
        }

        return response()->json(['data' => $Prueba], 200);
    }
}