<?php

namespace App\Http\Controllers;

use App\Resistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ResistenciaController extends Controller
{
    public function store(Request $request) 
{
    try {
        // Validación de datos
        $validatedData = $request->validate([
            'id_registro' => 'nullable|integer|exists:tb_registro_produccion,id_registro',
            'bt1_max' => 'nullable|numeric',
            'bt1_min' => 'nullable|numeric',
            'bt2_max' => 'nullable|numeric',
            'bt2_min' => 'nullable|numeric',
            'bt3_max' => 'nullable|numeric',
            'bt3_min' => 'nullable|numeric',
            'bt4_max' => 'nullable|numeric',
            'bt4_min' => 'nullable|numeric',
            'bt5_max' => 'nullable|numeric',
            'bt5_min' => 'nullable|numeric',
            'bt9_max' => 'nullable|numeric',
            'bt9_min' => 'nullable|numeric',
            'bt11_max' => 'nullable|numeric',
            'bt11_min' => 'nullable|numeric',
            'bt12_max' => 'nullable|numeric',
            'bt12_min' => 'nullable|numeric',
            'bt13_max' => 'nullable|numeric',
            'bt13_min' => 'nullable|numeric',
            'bt14_max' => 'nullable|numeric',
            'bt14_min' => 'nullable|numeric',
            'bt15_max' => 'nullable|numeric',
            'bt15_min' => 'nullable|numeric',
            'bt16_max' => 'nullable|numeric',
            'bt16_min' => 'nullable|numeric',
            'bt17_max' => 'nullable|numeric',
            'bt17_min' => 'nullable|numeric',
            'bt19_max' => 'nullable|numeric',
            'bt19_min' => 'nullable|numeric',
            'cerrado' => 'nullable|boolean',
            'fecha_creacion' => 'nullable|date',
            'fecha_actualizacion' => 'nullable|date'
        ]);

        // Debug: Verificar datos recibidos
        Log::info('Datos recibidos en API:', $validatedData);

        DB::beginTransaction();

        // Usar updateOrCreate para insertar o actualizar
        $resistencia = Resistencia::updateOrCreate(
            ['id_registro' => $validatedData['id_registro']],
            [
                'bt1_max' => $validatedData['bt1_max'],
                'bt1_min' => $validatedData['bt1_min'],
                'bt2_max' => $validatedData['bt2_max'],
                'bt2_min' => $validatedData['bt2_min'],
                'bt3_max' => $validatedData['bt3_max'],
                'bt3_min' => $validatedData['bt3_min'],
                'bt4_max' => $validatedData['bt4_max'],
                'bt4_min' => $validatedData['bt4_min'],
                'bt5_max' => $validatedData['bt5_max'],
                'bt5_min' => $validatedData['bt5_min'],
                'bt9_max' => $validatedData['bt9_max'],
                'bt9_min' => $validatedData['bt9_min'],
                'bt11_max' => $validatedData['bt11_max'],
                'bt11_min' => $validatedData['bt11_min'],
                'bt12_max' => $validatedData['bt12_max'],
                'bt12_min' => $validatedData['bt12_min'],
                'bt13_max' => $validatedData['bt13_max'],
                'bt13_min' => $validatedData['bt13_min'],
                'bt14_max' => $validatedData['bt14_max'],
                'bt14_min' => $validatedData['bt14_min'],
                'bt15_max' => $validatedData['bt15_max'],
                'bt15_min' => $validatedData['bt15_min'],
                'bt16_max' => $validatedData['bt16_max'],
                'bt16_min' => $validatedData['bt16_min'],
                'bt17_max' => $validatedData['bt17_max'],
                'bt17_min' => $validatedData['bt17_min'],
                'bt19_max' => $validatedData['bt19_max'],
                'bt19_min' => $validatedData['bt19_min'],
                'cerrado' => $validatedData['cerrado'] ?? false,
                'fecha_creacion' => $validatedData['fecha_creacion'] ?? now(),
                'fecha_actualizacion' => $validatedData['fecha_actualizacion'] ?? now()
            ]
        );

        DB::commit();

        return response()->json([
            'success' => true,
            'id' => $resistencia->id,
            'data' => $resistencia,
            'message' => 'Datos de resistencias guardados correctamente'
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors(),
            'message' => 'Error de validación: ' . implode(' ', array_flatten($e->errors()))
        ], 422);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error al guardar resistencias: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error al guardar el registro: ' . $e->getMessage()
        ], 500);
    }
}
}