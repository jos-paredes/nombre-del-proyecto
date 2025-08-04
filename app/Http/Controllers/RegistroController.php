<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function obtenerDatos()
{
    $sql = "
    SELECT 
    R.id,
    R.Auxiliar, 
    R.Turno, 
    R.Maquinista, 
    R.Modalidad, 
    R.Lote,
    MP.MateriaPrima,
    MP.INTF,
    MP.CantidadEmpaque,
    MP.Identif,
    MP.CantidadBolsones,
    MP.Dosificacion,
    MP.Humedad,
    C.Colorante,
    C.Codigo,
    C.KL,
    C.BP,
    C.Dosificacion,
    C.CantidadBolsones,
    R.Parte,
    R.Producto,
    R.Gramaje,
    R.Ciclo,
    R.Cavhabilitadas,
    R.PesoProm,
    R.Pesopromneto,
    R.CantidadtotalKg,
    R.Cantidadtotaldepiezas,
    R.Totalcajascont,
    R.Totalprodu,
    R.PAinicial,
    R.PAfinal,
    R.Empaque,
    R.Cantidad,
    R.updated_at,
    D.Hora,
    D.Defectos,
    D.Palet,
    D.Empaque,
    D.Embalado,
    D.Etiquetado,
    D.Inocuidad,
    D.CantidadProductoRetenido,
    D.CantidadProductoCorregido,
    D.Observaciones,
    P.Hora AS Peso_Hora,
    P.PA,
    P.PesoTara,
    P.PesoNeto
FROM 
    registroips R
LEFT JOIN 
    defectos D ON R.id = D.ID_regis
LEFT JOIN 
    mp MP ON R.id = MP.ID_regis
LEFT JOIN
    colorante C ON R.id = C.ID_regis
LEFT JOIN 
    pesoips P ON R.id = P.ID_regis

    ";

    // Ejecutar la consulta
    $results = DB::select(DB::raw($sql));

    // Verificar los resultados de la consulta

    // Retornar los resultados a la vista
    // Obtener registros únicos por Auxiliar y Turno
    $results = DB::table('registroips')
        ->select('id', 'Auxiliar', 'Turno', 'updated_at')
        //->groupBy('id', Auxiliar) // Agrupar por estos campos
        ->orderBy('updated_at', 'desc')
        ->get();

    return view('registro', compact('results'));

    
}

}