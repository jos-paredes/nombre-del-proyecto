<?php

    namespace App\Http\Controllers;

    use App\FormularioGeneralProd;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\DB;

    class FormularioGeneralProdController extends Controller
    {
        public function store(Request $request) 
        {
            try {
                // Validación de datos
                $validatedData = $request->validate([
                    'id_registro' => 'nullable|integer|exists:tb_registro_produccion,id_registro',
                    'tonalidad' => 'nullable|string|max:255',
                    'dosificacion_eco' => 'nullable|string|max:255',
                    'gramaje' => 'nullable|string|max:255',
                    'punto_ajuste' => 'nullable|string|max:255',
                    'temp_proceso' => 'nullable|string|max:255',
                    'dewpoint' => 'nullable|string|max:255',
                    'temp_cono' => 'nullable|string|max:255',
                    'presion_entrada_agua_molde' => 'nullable|string|max:255',
                    'presion_salida_agua_molde' => 'nullable|string|max:255',
                    'presion_entrada_agua_maquina' => 'nullable|string|max:255',
                    'presion_salida_agua_maquina' => 'nullable|string|max:255',
                    'punto_ajuste_chiller_2' => 'nullable|string|max:255',
                    'lectura_chiller_2' => 'nullable|string|max:255',
                    'temp_motor_m2' => 'nullable|string|max:255',
                    'temp_aire_torre_entrada' => 'nullable|string|max:255',
                    'velocidad_tornillo' => 'nullable|string|max:255',
                    'temp_aire_torre_salida' => 'nullable|string|max:255',
                    'temp_cilindro' => 'nullable|string|max:255',
                    'torre_cama1d' => 'nullable|string|max:255',
                    'caudal_aire' => 'nullable|string|max:255',
                    'temp_intercambiados' => 'nullable|string|max:255',
                    'cerrado' => 'nullable|boolean',
                    'fecha_creacion' => 'nullable|date',
                    'fecha_actualizacion' => 'nullable|date'
                ]);

                // Iniciar transacción para seguridad de datos
                DB::beginTransaction();

                // Crear el registro
                $formulario = FormularioGeneralProd::create([
                    'id_registro' => $validatedData['id_registro'],
                    'tonalidad' => $validatedData['tonalidad'],
                    'dosificacion_eco' => $validatedData['dosificacion_eco'] ?? null,
                    'gramaje' => $validatedData['gramaje'] ?? null,
                    'punto_ajuste' => $validatedData['punto_ajuste'] ?? null,
                    'temp_proceso' => $validatedData['temp_proceso'] ?? null,
                    'dewpoint' => $validatedData['dewpoint'] ?? null,
                    'temp_cono' => $validatedData['temp_cono'] ?? null,
                    'presion_entrada_agua_molde' => $validatedData['presion_entrada_agua_molde'] ?? null,
                    'presion_salida_agua_molde' => $validatedData['presion_salida_agua_molde'] ?? null,
                    'presion_entrada_agua_maquina' => $validatedData['presion_entrada_agua_maquina'] ?? null,
                    'presion_salida_agua_maquina' => $validatedData['presion_salida_agua_maquina'] ?? null,
                    'punto_ajuste_chiller_2' => $validatedData['punto_ajuste_chiller_2'] ?? null,
                    'lectura_chiller_2' => $validatedData['lectura_chiller_2'] ?? null,
                    'temp_motor_m2' => $validatedData['temp_motor_m2'] ?? null,
                    'temp_aire_torre_entrada' => $validatedData['temp_aire_torre_entrada'] ?? null,
                    'velocidad_tornillo' => $validatedData['velocidad_tornillo'] ?? null,
                    'temp_aire_torre_salida' => $validatedData['temp_aire_torre_salida'] ?? null,
                    'temp_cilindro' => $validatedData['temp_cilindro'] ?? null,
                    'torre_cama1d' => $validatedData['torre_cama1d'] ?? null,
                    'caudal_aire' => $validatedData['caudal_aire'] ?? null,
                    'temp_intercambiados' => $validatedData['temp_intercambiados'] ?? null,
                    'cerrado' => $validatedData['cerrado'] ?? false,
                    'fecha_creacion' => $validatedData['fecha_creacion'] ?? now(),
                    'fecha_actualizacion' => $validatedData['fecha_actualizacion'] ?? now()
                ]);

                // Confirmar transacción
                DB::commit();

                return response()->json([
                    'success' => true,
                    'id' => $formulario->id,
                    'data' => $formulario,
                    'message' => 'Formulario general de producción creado exitosamente'
                ], 201);

            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                    'message' => 'Error de validación'
                ], 422);

            } catch (\Exception $e) {
                // Revertir transacción en caso de error
                DB::rollBack();
                
                Log::error('Error al crear formulario general: ' . $e->getMessage());
                
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear el registro: ' . $e->getMessage()
                ], 500);
            }
        }
    }