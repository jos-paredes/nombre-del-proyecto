<?php

namespace App\Http\Controllers;

use App\RegistroIPS;
use Illuminate\Http\Request;

class RegistroIPSController extends Controller 
{
    public function crearRegistroIPS(Request $request) 
    {
        $request->validate([
            "Auxiliar" => "nullable|String",
            "Turno" => "nullable|String",
            "Modalidad" => "nullable|String",
            "Lote" => "nullable|String",
            "Maquinista" => "nullable|String",
            "Parte" => "nullable|int",
            "Producto" => "nullable|String",
            "Gramaje" => "nullable|String",
            "Empaque" => "nullable|String",
            "Cavhabilitadas" => "nullable|String",
            "Ciclo" => "nullable|numeric",
            "PesoProm" => "nullable|numeric",
            "PAinicial" => "nullable|int",
            "PAfinal" => "nullable|int",
            "Cantidad" => "nullable|int",
            "Pesopromneto" => "nullable|numeric",
            "Totalcajascont" => "nullable|numeric",
            "Saldos" => "nullable|numeric",
            "Totalprodu" => "nullable|numeric",
            "Cantidadtotaldepiezas" => "nullable|int",
            "CantidadtotalKg" => "nullable|numeric",
            "Conformidad" => "nullable|bool",
        ]);
    
        $RegistroIPS = new RegistroIPS();
        $RegistroIPS->Auxiliar = $request->Auxiliar ?? ' ';
        $RegistroIPS->Turno = $request->Turno ?? ' ';
        $RegistroIPS->Modalidad = $request->Modalidad ?? ' ';
        $RegistroIPS->Lote = $request->Lote ?? ' ';
        $RegistroIPS->Maquinista = $request->Maquinista ?? ' ';
        $RegistroIPS->Parte = $request->Parte ?? 0;
        $RegistroIPS->Producto = $request->Producto ?? ' ';
        $RegistroIPS->Gramaje = $request->Gramaje ?? ' ';
        $RegistroIPS->Empaque = $request->Empaque ?? ' ';
        $RegistroIPS->Cavhabilitadas = $request->Cavhabilitadas ?? ' ';
        $RegistroIPS->Ciclo = $request->Ciclo ?? 0;
        $RegistroIPS->PesoProm = $request->PesoProm ?? 0;
        $RegistroIPS->PAinicial = $request->PAinicial ?? 0;
        $RegistroIPS->PAfinal = $request->PAfinal ?? 0;
        $RegistroIPS->Cantidad = $request->Cantidad ?? 0;
        $RegistroIPS->Pesopromneto = $request->Pesopromneto ?? 0;
        $RegistroIPS->Totalcajascont = $request->Totalcajascont ?? 0;
        $RegistroIPS->Saldos = $request->Saldos ?? 0;
        $RegistroIPS->Totalprodu = $request->Totalprodu ?? 0;
        $RegistroIPS->Cantidadtotaldepiezas = $request->Cantidadtotaldepiezas ?? 0;
        $RegistroIPS->CantidadtotalKg = $request->CantidadtotalKg ?? 0;
        $RegistroIPS->Conformidad = $request->Conformidad ?? 0;        
        $RegistroIPS->save();
    
        return response()->json(['id' => $RegistroIPS->id, 'mensaje' => 'RegistroIPS creado exitosamente'], 201);
    }
    
    public function actualizarUltimoRegistroIPS(Request $request, $id) 
    {
        $RegistroIPS = RegistroIPS::find($id);
    
        if (!$RegistroIPS) {
            return response()->json(['error' => 'No hay registros disponibles para actualizar'], 404);
        }
    
        $request->validate([
            "Auxiliar" => "nullable|String",
            "Turno" => "nullable|String",
            "Modalidad" => "nullable|String",
            "Lote" => "nullable|String",
            "Maquinista" => "nullable|String",
            "Parte" => "nullable|int",
            "Producto" => "nullable|String",
            "Gramaje" => "nullable|String",
            "Empaque" => "nullable|String",
            "Cavhabilitadas" => "nullable|String",
            "Ciclo" => "nullable|numeric",
            "PesoProm" => "nullable|numeric",
            "PAinicial" => "nullable|int",
            "PAfinal" => "nullable|int",
            "Cantidad" => "nullable|int",
            "Pesopromneto" => "nullable|numeric",
            "Totalcajascont" => "nullable|numeric",
            "Saldos" => "nullable|numeric",
            "Totalprodu" => "nullable|numeric",
            "Cantidadtotaldepiezas" => "nullable|int",
            "CantidadtotalKg" => "nullable|numeric",
            "Conformidad" => "nullable|bool",
        ]);
    
        $RegistroIPS->fill($request->only(["Auxiliar", "Turno", "Modalidad", "Lote", "Maquinista", "Parte", "Producto", "Gramaje", "Empaque", "Cavhabilitadas", "Ciclo", "PesoProm", "PAinicial", "PAfinal", "Cantidad", "Pesopromneto", "Totalcajascont", "Saldos", "Totalprodu", "Cantidadtotaldepiezas", "CantidadtotalKg", "Conformidad"]));
        $RegistroIPS->save();
    
        return response()->json([
            'mensaje' => 'RegistroIPS actualizado correctamente',
            'data' => $RegistroIPS,
        ]);
    }
    
    public function obtenerUltimoRegistroIPS($id) 
    {
$RegistroIPS = RegistroIPS::find($id);    
        if (!$RegistroIPS) {
            return response()->json(['error' => 'No hay registros disponibles'], 404);
        }
    
        return response()->json(['data' => $RegistroIPS], 200);
    }   
}