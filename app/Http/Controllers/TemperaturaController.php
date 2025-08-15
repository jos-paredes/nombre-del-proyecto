<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TemperaturaProd;
use Illuminate\Support\Facades\Validator;

class TemperaturaController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_registro' => 'required|integer|exists:tb_registro_produccion,id_registro',
            'enfriamiento_dato' => 'nullable|numeric',
            'dato_1' => 'nullable|numeric',
            'dato_2' => 'nullable|numeric',
            'dato_3' => 'nullable|numeric',
            'dato_4' => 'nullable|numeric',
            'dato_5' => 'nullable|numeric',
            'dato_6' => 'nullable|numeric',
            'dato_7' => 'nullable|numeric',
            'dato_8' => 'nullable|numeric',
            'dato_9' => 'nullable|numeric',
            'dato_10' => 'nullable|numeric',
            'dato_11' => 'nullable|numeric',
            'dato_12' => 'nullable|numeric',
            'dato_13' => 'nullable|numeric',
            'dato_14' => 'nullable|numeric',
            'dato_15' => 'nullable|numeric',
            'dato_16' => 'nullable|numeric',
            'dato_17' => 'nullable|numeric',
            'dato_18' => 'nullable|numeric',
            'dato_19' => 'nullable|numeric',
            'tipo_cuello' => 'nullable|string|max:50',
            'peso_preforma' => 'nullable|numeric',
            'espesor_1' => 'nullable|numeric',
            'espesor_2' => 'nullable|numeric',
            'espesor_3' => 'nullable|numeric',
            'espesor_4' => 'nullable|numeric',
            'cerrado' => 'sometimes|boolean',
            'fecha_creacion' => 'nullable|date',
            'fecha_actualizacion' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->all();
            $data['fecha_actualizacion'] = now();
            
            if ($request->has('cerrado') && $request->cerrado) {
                $data['cerrado'] = 1;
            }
            
            $temperatura = TemperaturaProd::create($data);
            
            return response()->json([
                'success' => true,
                'data' => $temperatura
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar: ' . $e->getMessage()
            ], 500);
        }
    }
}