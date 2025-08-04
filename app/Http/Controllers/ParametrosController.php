<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ParametrosController extends Controller
{
    // Mostrar vista de gestión
    public function index()
    {
        $config = DB::table('config_data')->first();

        // Validación estricta
        if (!$config) {
            return response()->json(['error' => 'No hay datos en la tabla'], 404);
        }

        $jsonData = json_decode($config->data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Muestra el error y los primeros 100 caracteres del JSON para diagnóstico
            return response()->json([
                'error' => 'JSON inválido: ' . json_last_error_msg(),
                'json_sample' => substr($config->data, 0, 100)
            ], 400);
        }

        return view('parametros.index', compact('jsonData'));
    }

    // Guardar cambios (universal)
    public function save(Request $request)
    {
        $validated = $request->validate([
            'section' => 'required|string',
            'key' => 'required|string',
            'action' => 'required|in:add,update,delete',
            'value' => 'nullable',
            'old_value' => 'nullable',
        ]);

        $currentConfig = json_decode(DB::table('config_data')->first()->data, true);

        // Lógica para modificar el JSON
        switch ($validated['action']) {
            case 'add':
                $currentConfig[$validated['section']][$validated['key']][] = $validated['value'];
                break;
            case 'update':
                $index = array_search($validated['old_value'], $currentConfig[$validated['section']][$validated['key']]);
                if ($index !== false) {
                    $currentConfig[$validated['section']][$validated['key']][$index] = $validated['value'];
                }
                break;
            case 'delete':
                $currentConfig[$validated['section']][$validated['key']] = array_diff(
                    $currentConfig[$validated['section']][$validated['key']],
                    [$validated['old_value']]
                );
                break;
        }

        DB::table('config_data')->update(['data' => json_encode($currentConfig)]);

        return back()->with('success', '¡Parámetro actualizado!');
    }
}
