<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistroProduccion;

class RegistroProduccionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_registro' => 'required|string',
            'nombre_usuario' => 'required|string',
            'turno' => 'required|string',
            'fecha' => 'required|date',
        ]);

        $registro = new RegistroProduccion();
        $registro->id_registro = $request->id_registro;
        $registro->nombre_usuario = $request->nombre_usuario;
        $registro->turno = $request->turno;
        $registro->fecha = $request->fecha;
        $registro->save();

        return response()->json(['message' => 'Registro guardado correctamente'], 201);
    }
}
