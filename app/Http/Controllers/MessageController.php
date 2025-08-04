<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Crear un nuevo mensaje
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'message' => 'required|string',
            'number' => 'required|integer',
            
        ]);

        // Crear y guardar el mensaje
        $message = Message::create([
            'message' => $request->message,
            'number' => $request->number,
        ]);

        // Responder con éxito
        return response()->json([
            'message' => 'Message saved successfully',
            'data' => $message,
        ], 201);
    }

    // Obtener todos los mensajes
    public function index()
    {
        $messages = Message::all();

        return response()->json([
            'data' => $messages,
        ], 200);
    }

    // Obtener un mensaje por ID
    public function show($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not foundki'], 404);
        }

        return response()->json(['data' => $message], 200);
    }

    // Actualizar un mensaje
   public function update(Request $request, $id)
    {
    $message = Message::find($id);

    if (!$message) {
        return response()->json(['error' => 'Message found'], 404);
    }

   //  Validar los datos
    $request->validate([
        'message' => 'string|nullable',
        'number' => 'integer|nullable',
    ]);

    // Actualizar el mensaje
    $message->update($request->only('message', 'number'));

    return response()->json([
       'message' => 'Message updated successfully',
        'data' => $message,
    ], 200);
    }


    // Eliminar un mensaje
    public function destroy($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted successfully'], 200);
    }


    public function crearMensaje(Request $request)
    {
        // Validar los datos, pero sin requerirlos obligatoriamente
        $request->validate([
            'message' => 'nullable|string', // Puede ser nulo
            'number' => 'nullable|integer',
            'tipos' => 'nullable|string',
            'te_gusta' => 'nullable|boolean',
        ]);
    
        // Crear un nuevo mensaje con valores predeterminados si no se envían
        $mensaje = new Message();
        $mensaje->message = $request->message ?? ' ';
        $mensaje->number = $request->number ?? 0;
        $mensaje->tipos = $request->tipos ?? ' ';
        $mensaje->te_gusta = $request->te_gusta ?? false;
        $mensaje->save();
    
        return response()->json(['id' => $mensaje->id, 'mensaje' => 'Mensaje creado exitosamente'], 201);
    }
    
    // Actualizar el último mensaje creado
    public function actualizarUltimoMensaje(Request $request)
    {
        // Obtener el último mensaje
        $mensaje = Message::latest()->first();

        if (!$mensaje) {
            return response()->json(['error' => 'No hay mensajes disponibles para actualizar'], 404);
        }

        // Validación de datos
        $request->validate([
            'message' => 'sometimes|required|string',
            'number' => 'sometimes|required|integer',
            'tipos' => 'sometimes|required|string',
            'te_gusta' => 'sometimes|required|boolean',
        ]);

        // Actualizar los datos si están presentes en la petición
        $mensaje->fill($request->only(['message', 'number', 'tipos', 'te_gusta']));
        $mensaje->save();

        return response()->json([
            'mensaje' => 'Mensaje actualizado correctamente',
            'data' => $mensaje,
        ]);
    }
    
    public function obtenerUltimoMensaje()
    {
        $mensaje = Message::latest()->first();
    
        if (!$mensaje) {
            return response()->json(['error' => 'No hay registros disponibles'], 404);
        }
    
        return response()->json(['data' => $mensaje], 200);
    }   
      
     
}
