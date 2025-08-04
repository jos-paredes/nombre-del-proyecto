<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function uploadPdf(Request $request)
    {
        // 1. Verificar si el archivo PDF está presente y es válido
        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            
            // 2. Obtener el archivo PDF
            $pdf = $request->file('pdf');

            // 3. Generar un nombre único para el archivo o usar el nombre original
            $filename = $pdf->getClientOriginalName(); // o cualquier otro método para crear un nombre único

            // 4. Guardar el archivo en el disco público
            // El archivo será almacenado en 'storage/app/public/pdfs'
            $path = $pdf->storeAs('pdfs', $filename, 'public');

            // 5. Devolver la respuesta con un mensaje de éxito y la ruta del archivo guardado
            return response()->json([
                'message' => 'Archivo PDF recibido y guardado correctamente.',
                'path' => $path
            ], 200);
        } else {
            // Si no se recibe un archivo válido
            return response()->json([
                'message' => 'No se recibió un archivo PDF válido.'
            ], 400);
        }
    }
}
