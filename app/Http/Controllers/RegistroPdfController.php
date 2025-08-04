<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Libraries\UTF8FPDF;

class RegistroPdfController extends Controller
{
    public function generarPdf($id)
    {
        // 1. Obtener datos del registro principal
        $registroPrincipal = DB::table('registroips')
                            ->where('id', $id)
                            ->first();

        if (!$registroPrincipal) {
            abort(404, 'Registro no encontrado');
        }

        // 2. Obtener TODOS los registros del mismo auxiliar (solo IDs primero)
        $registrosIps = DB::table('registroips')
                      ->where('Auxiliar', $registroPrincipal->Auxiliar)
                      ->pluck('id');

        // 3. Obtener datos de MP (todos los registros)
        $materiaPrima = DB::table('mp')
            ->where('ID_regis', $id)
            ->get();

        // 4. Obtener defectos ordenados
        $defectos = DB::table('defectos')
                    ->where('ID_regis', $id)
                    ->orderBy('Hora', 'asc')
                    ->get();

        // 5. Obtener datos de colorante sin duplicados
        $colorantes = DB::table('colorante')
                        ->where('ID_regis', $id)
                        ->get()
                        ->unique('ID_regis');

        // 6. Obtener datos de pesos sin duplicados
        $pesos = DB::table('pesoips')
                    ->where('ID_regis', $id)
                    ->get();

        // 7. Obtener datos básicos del registro principal (incluyendo gramaje)
        $registroBasico = DB::table('registroips')
                            ->where('id', $id)
                            ->first();

        // 6. Crear PDF (manteniendo EXACTAMENTE el mismo diseño)
        $pdf = new UTF8FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 6);

        // Encabezado (igual que antes)
        $imagenPath = storage_path('app/public/images/preforsa.jpeg');
        if (!file_exists($imagenPath)) {
            abort(404, 'La imagen no fue encontrada en storage');
        }

        $anchoCeldaImagen = 40;
        $anchoCeldaDatos = 120;
        $anchoCeldaCodigo = 35;
        $alturaFila = 5;

        $x_inicial = $pdf->GetX();
        $y_inicial = $pdf->GetY();

        $pdf->Cell($anchoCeldaImagen, $alturaFila * 3, '', 1, 0);
        $pdf->Image($imagenPath, $x_inicial, $y_inicial, $anchoCeldaImagen, $alturaFila * 3);
        $pdf->Cell($anchoCeldaDatos, $alturaFila, 'Nombre de Documento', 1, 0, 'C');
        $pdf->Cell($anchoCeldaCodigo, $alturaFila, 'Código: SIG RL 03', 1, 1, 'C');

        $pdf->SetXY($x_inicial + $anchoCeldaImagen, $y_inicial + $alturaFila);
        $pdf->Cell($anchoCeldaDatos, $alturaFila, 'CONTROL DE CALIDAD: REPORTE DIARIO...', 1, 0, 'C');
        $pdf->Cell($anchoCeldaCodigo, $alturaFila, 'Fecha: 30-01-24', 1, 1, 'C');

        $pdf->SetXY($x_inicial + $anchoCeldaImagen, $y_inicial + ($alturaFila * 2));
        $pdf->Cell($anchoCeldaDatos, $alturaFila, 'Tipo de Documento: REGISTRO', 1, 0, 'C');
        $pdf->Cell($anchoCeldaCodigo, $alturaFila, 'Version 00', 1, 1, 'C');

        // Información básica (igual que antes)
        $alturaFila = 6;
        $anchos = [55, 50, 50, 40];
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $pdf->Cell($anchos[0], $alturaFila * 2, 'Resp Laboratorio: Ruben Ordoñez', 0, 0, 'C');
        $pdf->Cell($anchos[1], $alturaFila, 'Fecha: ' . \Carbon\Carbon::parse($registroPrincipal->created_at)->format('Y-m-d'), 0, 0, 'C');
        $pdf->Cell($anchos[2], $alturaFila, 'Turno: '.($registroPrincipal->Turno ?? 'N/A'), 0, 0, 'C');
        $pdf->Cell($anchos[3], $alturaFila * 2, 'LOTE: '.($registroPrincipal->Lote ?? 'N/A'), 0, 1, 'C');

        $pdf->SetXY($x + $anchos[0], $y + $alturaFila);
        $pdf->Cell($anchos[1], $alturaFila, 'Aux Laboratorio: ' . ($registroPrincipal->Auxiliar ?? 'N/A'), 0, 0, 'C');
        $pdf->Cell($anchos[2], $alturaFila, 'Maquinista: '.($registroPrincipal->Maquinista ?? 'N/A'), 0, 0, 'C');

        // Sección de Materia Prima (modificada para mostrar todas las filas)
        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 6);
        $alturaFila = 5;
        $anchoTotal = 195;
        
        // Encabezado de sección
        $pdf->Cell($anchoTotal, $alturaFila, 'I6 IPS 400 (Modalidad Produccion: '.($registroPrincipal->Modalidad ?? 'N/A').')', 1, 1, 'C');
        
        // Definir anchos de columnas (7 columnas para materia prima, 6 para colorante)
        $anchosMP = [35, 30, 30, 25, 30, 25, 20]; // Suma = 195
        $anchosColorante = [35, 30, 30, 30, 35, 35]; // Suma = 195 (ajustado para 6 columnas)
        
        // Mostrar materia prima (7 columnas) - todas las filas
        if ($materiaPrima->isEmpty()) {
            // Mostrar una fila vacía si no hay registros
            $pdf->Cell($anchosMP[0], $alturaFila, 'Materia Prima: N/A', 1, 0, 'L');
            $pdf->Cell($anchosMP[1], $alturaFila, 'INT F: N/A', 1, 0, 'C');
            $pdf->Cell($anchosMP[2], $alturaFila, 'Cant. Emp.: 0', 1, 0, 'C');
            $pdf->Cell($anchosMP[3], $alturaFila, 'Identif: N/A', 1, 0, 'C');
            $pdf->Cell($anchosMP[4], $alturaFila, 'Cant/Bolsones: 0', 1, 0, 'C');
            $pdf->Cell($anchosMP[5], $alturaFila, 'Dosif: 0%', 1, 0, 'C');
            $pdf->Cell($anchosMP[6], $alturaFila, '%H: 0%', 1, 1, 'C');
        } else {
            foreach ($materiaPrima as $mp) {
                $pdf->Cell($anchosMP[0], $alturaFila, 'Materia Prima: '.($mp->MateriaPrima ?? 'N/A'), 1, 0, 'L');
                $pdf->Cell($anchosMP[1], $alturaFila, 'INT F: '.($mp->INTF ?? 'N/A'), 1, 0, 'C');
                $pdf->Cell($anchosMP[2], $alturaFila, 'Cant. Emp.: '.($mp->CantidadEmpaque ?? '0'), 1, 0, 'C');
                $pdf->Cell($anchosMP[3], $alturaFila, 'Identif: '.($mp->Identif ?? 'N/A'), 1, 0, 'C');
                $pdf->Cell($anchosMP[4], $alturaFila, 'Cant/Bolsones: '.($mp->CantidadBolsones ?? '0'), 1, 0, 'C');
                $pdf->Cell($anchosMP[5], $alturaFila, 'Dosif: '.($mp->Dosificacion ?? '0%'), 1, 0, 'C');
                $pdf->Cell($anchosMP[6], $alturaFila, '%H: '.($mp->Humedad ?? '0%'), 1, 1, 'C');
            }
        }
        
        // Mostrar colorantes (6 columnas)
        foreach ($colorantes as $colorante) {
            $pdf->Cell($anchosColorante[0], $alturaFila, 'Colorante: '.($colorante->Colorante ?? 'N/A'), 1, 0, 'L');
            $pdf->Cell($anchosColorante[1], $alturaFila, 'Codigo: '.($colorante->Codigo ?? 'N/A'), 1, 0, 'C');
            $pdf->Cell($anchosColorante[2], $alturaFila, 'KL: '.($colorante->KL ?? 'N/A'), 1, 0, 'C');
            $pdf->Cell($anchosColorante[3], $alturaFila, 'BP: '.($colorante->BP ?? 'N/A'), 1, 0, 'C');
            $pdf->Cell($anchosColorante[4], $alturaFila, 'Dosif: '.($colorante->Dosificacion ?? '0%'), 1, 0, 'C');
            $pdf->Cell($anchosColorante[5], $alturaFila, 'Cant: '.($colorante->Cantidad ?? '0'), 1, 1, 'C');
        }
        
        // Configuración inicial
        $pdf->SetFont('Arial', '', 6);
        $alturaFila = 5;
        $numFilas = 3;

        // Anchuras de columnas (sin usar array)
        $anchoCol1 = 25;
        $anchoCol2 = 25;
        $anchoCol3 = 20;
        $anchoCol4 = 20;
        $anchoCol5 = 25;
        $anchoCol6 = 40;
        $anchoCol7 = 40;

        // Posición inicial
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        // Columna 1 (Parte)
        $this->cellWithLineBreak($pdf, $x, $y, $anchoCol1, $alturaFila * $numFilas, 'Parte', $registroBasico->Parte ?? 'N/A');

        // Columna 2 (Id Producto con gramaje)
        $productoConGramaje = $this->formatearProductoConGramaje($registroBasico->Producto ?? 'N/A', $registroBasico->Gramaje ?? 'N/A');
        $this->cellWithLineBreak($pdf, $x + $anchoCol1, $y, $anchoCol2, $alturaFila * $numFilas, 'Id Producto', $productoConGramaje);

        // Columna 3 (Ciclo)
        $this->cellWithLineBreak($pdf, $x + $anchoCol1 + $anchoCol2, $y, $anchoCol3, $alturaFila * $numFilas, 'Ciclo', $registroBasico->Ciclo ?? 'N/A');

        // Columna 4 (Cav. Habilitadas)
        $this->cellWithLineBreak($pdf, $x + $anchoCol1 + $anchoCol2 + $anchoCol3, $y, $anchoCol4, $alturaFila * $numFilas, 'Cav. Habilitadas', $registroBasico->Cavhabilitadas ?? 'N/A');

        // Columna 5 (Peso Promedio)
        $this->cellWithLineBreak($pdf, $x + $anchoCol1 + $anchoCol2 + $anchoCol3 + $anchoCol4, $y, $anchoCol5, $alturaFila * $numFilas, 'Peso Promedio', $registroBasico->PesoProm ?? 'N/A');

        // Dibujar columnas 6 y 7 (3 filas individuales cada una)
        // Primera fila de columnas 6 y 7
        $pdf->SetXY($x + $anchoCol1 + $anchoCol2 + $anchoCol3 + $anchoCol4 + $anchoCol5, $y);
        $pdf->Cell($anchoCol6, $alturaFila, 'Peso Prom Pref en contenido NETO: '.($registroBasico->Pesopromneto ?? 'N/A'), 1, 0, 'C');
        $pdf->Cell($anchoCol7, $alturaFila, 'Tot. Caja Contr. '.($registroBasico->Totalcajascont ?? 'N/A'), 1, 0, 'C');

        // Segunda fila de columnas 6 y 7
        $pdf->SetXY($x + $anchoCol1 + $anchoCol2 + $anchoCol3 + $anchoCol4 + $anchoCol5, $y + $alturaFila);
        $pdf->Cell($anchoCol6, $alturaFila, '1', 1, 0, 'C');
        $pdf->Cell($anchoCol7, $alturaFila, 'Total Caja Prod: '.($registroBasico->Totalprodu ?? 'N/A'), 1, 0, 'C');

        // Tercera fila de columnas 6 y 7 (con salto de línea)
        $pdf->SetXY($x + $anchoCol1 + $anchoCol2 + $anchoCol3 + $anchoCol4 + $anchoCol5, $y + ($alturaFila * 2));
        $pdf->Cell($anchoCol6, $alturaFila, 'Cajas sin declarar: '.('N/A'), 1, 0, 'C');
        $pdf->Cell($anchoCol7, $alturaFila, 'Cant Total Kg: '.($registroBasico->CantidadtotalKg ?? 'N/A'), 1, 1, 'C');

        // Ajustar posición para siguiente elemento
        $y_nueva = $y + ($alturaFila * $numFilas);

        // Dibujar fila con 6 columnas justo debajo
        $pdf->SetXY($x, $y_nueva);
        $pdf->Cell(25, $alturaFila, 'PA Inicial: '.($registroBasico->PAinicial ?? 'N/A'), 1, 0, 'L');
        $pdf->Cell(25, $alturaFila, 'PA Final: '.($registroBasico->PAfinal ?? 'N/A'), 1, 0, 'L');
        $pdf->Cell(25, $alturaFila, 'Empaque 1:'.($registroBasico->Empaque ?? 'N/A'), 1, 0, 'L');
        $pdf->Cell(30, $alturaFila, 'Cantidad 1: '.($registroBasico->Cantidad ?? 'N/A'), 1, 0, 'L');
        $pdf->Cell(55, $alturaFila, 'Tiempo de enfriamento prod. Term: 8 Hrs.', 1, 0, 'L');
        $pdf->Cell(35, $alturaFila, 'Cant. Total Piezas:'.($registroBasico->Cantidadtotaldepiezas ?? 'N/A'), 1, 1, 'L');

        // Configuración
        $pdf->SetFont('Arial', '', 5); // Fuente más pequeña para encabezados
        $alturaEncabezado = 8;
        $anchos = [12, 13, 40, 10, 10, 10, 10, 10, 20, 20, 40]; // Ajustados para 11 columnas (suma = 195)

        // Dibujar encabezados en dos filas para mejor legibilidad
        $x_inicial = $pdf->GetX();
        $y_inicial = $pdf->GetY();
        // Fila 1 de encabezados (columnas 1-7)
        $pdf->SetXY($x_inicial, $y_inicial);    
        $pdf->Cell($anchos[0], $alturaEncabezado, 'NUM.', 1, 0, 'C');
        $pdf->Cell($anchos[1], $alturaEncabezado, 'HORA', 1, 0, 'C');
        $pdf->Cell($anchos[2], $alturaEncabezado, 'DEFECTOS', 1, 0, 'C');
        $pdf->Cell($anchos[3], $alturaEncabezado, 'PALET', 1, 0, 'C');
        $pdf->Cell($anchos[4], $alturaEncabezado, 'EMPAQ', 1, 0, 'C');
        $pdf->Cell($anchos[5], $alturaEncabezado, 'ETIQ', 1, 0, 'C');
        $pdf->Cell($anchos[6], $alturaEncabezado, 'ENBAL', 1, 0, 'C');
        $pdf->Cell($anchos[7], $alturaEncabezado, 'INOC', 1, 0, 'C');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $this->cellWithLineBreak($pdf, $x, $y, $anchos[8], $alturaEncabezado, 'CANT. PROD.', 'RETENIDO');
        // Luego restauramos la posición en X, y mantenemos el Y original
        $pdf->SetXY($x + $anchos[8], $y);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $this->cellWithLineBreak($pdf, $x, $y, $anchos[9], $alturaEncabezado, 'CANT. PROD.', 'CORREGIDO');
        // Luego restauramos la posición en X, y mantenemos el Y original
        $pdf->SetXY($x + $anchos[9], $y);
        $pdf->Cell($anchos[10], $alturaEncabezado, 'OBSERVACIONES', 1, 1, 'C');

        // Restaurar fuente normal para datos
        $pdf->SetFont('Arial', '', 6);
        $alturaFila = 5;
        $contador = 1;
        $defectos = $defectos->sortBy('updated_at');
        foreach ($defectos as $defecto) {
            
            $pdf->Cell($anchos[0], $alturaFila,  $contador++, 1, 0, 'C');
            $pdf->Cell($anchos[1], $alturaFila, \Carbon\Carbon::parse($defecto->Hora)->format('H:i') ?? 'N/A', 1, 0, 'C');
            $pdf->Cell($anchos[2], $alturaFila, $this->formatField($defecto->Defectos) ?? 'N/A', 1, 0, 'C');
            $pdf->Cell($anchos[3], $alturaFila, ($defecto->Palet == 1) ? 'X' : '', 1, 0, 'C');
            $pdf->Cell($anchos[4], $alturaFila, ($defecto->Empaque == 1) ? 'X' : '', 1, 0, 'C');
            $pdf->Cell($anchos[5], $alturaFila, ($defecto->Etiquetado== 1) ? 'X' : '', 1, 0, 'C');
            $pdf->Cell($anchos[6], $alturaFila, ($defecto->Embalado == 1) ? 'X' : '', 1, 0, 'C');
            $pdf->Cell($anchos[7], $alturaFila, ($defecto->Inocuidad == 1) ? 'X' : '', 1, 0, 'C');
            $pdf->Cell($anchos[8], $alturaFila, $defecto->CantidadProductoRetenido ?? 'N/A', 1, 0, 'C');
            $pdf->Cell($anchos[9], $alturaFila, $defecto->CantidadProductoCorregido ?? 'N/A', 1, 0, 'C');
            $pdf->Cell($anchos[10], $alturaFila, $defecto->Observaciones ?? 'N/A', 1, 1, 'C');
        }

        // Configuración
        $pdf->SetFont('Arial', '', 5);
        $alturaEncabezado = 8;
        $anchos = [12, 13, 20, 20, 20, 20, 25, 25, 40]; // 9 columnas
        $alturaFila = 5;
        $totalFilas = 4; // Siempre 4 filas

        // Encabezados
        $x_inicial = $pdf->GetX();
        $y_inicial = $pdf->GetY();

        $pdf->SetXY($x_inicial, $y_inicial);    
        $pdf->Cell($anchos[0], $alturaEncabezado, 'NUM.', 1, 0, 'C');
        $pdf->Cell($anchos[1], $alturaEncabezado, 'HORA', 1, 0, 'C');
        $pdf->Cell($anchos[2], $alturaEncabezado, 'PA', 1, 0, 'C');
        $pdf->Cell($anchos[3], $alturaEncabezado, 'PESO P + E', 1, 0, 'C');
        $pdf->Cell($anchos[4], $alturaEncabezado, 'PESO NETO', 1, 0, 'C');
        $pdf->Cell($anchos[5], $alturaEncabezado, 'PESO TOTAL', 1, 0, 'C');
        $pdf->Cell($anchos[6], $alturaEncabezado, 'CANT.', 1, 0, 'C');
        $pdf->Cell($anchos[7], $alturaEncabezado, 'EMPAQUE', 1, 0, 'C');
        $pdf->Cell($anchos[8], $alturaEncabezado, '', 'LTR', 1, 'C');

        // Datos - asegurar siempre 4 filas
        $pdf->SetFont('Arial', '', 6);
        $datosMostrados = count($pesos);
        $x_firma = $pdf->GetX() + array_sum(array_slice($anchos, 0, 8));
        $y_firma = $pdf->GetY();

        for ($i = 0; $i < $totalFilas; $i++) {
            $peso = $pesos[$i] ?? null;

            $pdf->Cell($anchos[0], $alturaFila, $i + 1, 1, 0, 'C');
    $pdf->Cell($anchos[1], $alturaFila, $peso ? \Carbon\Carbon::parse($peso->Hora)->format('H:i') : '', 1, 0, 'C');
            $pdf->Cell($anchos[2], $alturaFila, $peso->PA ?? '', 1, 0, 'C');
            $pdf->Cell($anchos[3], $alturaFila, $peso->PesoTara ?? '', 1, 0, 'C');
            $pdf->Cell($anchos[4], $alturaFila, $peso->PesoNeto ?? '', 1, 0, 'C');
            $pdf->Cell($anchos[5], $alturaFila, $peso->PesoTotal ?? '', 1, 0, 'C');
            $pdf->Cell($anchos[6], $alturaFila, $peso ? ($registroBasico->Cantidad ?? 'N/A') : '', 1, 0, 'C');
            $pdf->Cell($anchos[7], $alturaFila, $peso ? ($registroBasico->Empaque ?? 'N/A') : '', 1, 0, 'C');

            $pdf->Ln(); // Avanza sin dibujar firma
        }
        // Dibuja la celda combinada vacía primero (sin texto)
        $pdf->SetXY($x_firma, $y_firma);
        $pdf->Cell($anchos[8], $alturaFila * $totalFilas, '', 'LRB', 0);

        // Ahora escribe el texto manualmente más abajo dentro de esa celda
        $alturaTexto = 5; // puedes ajustar este valor para mover el texto más abajo
        $pdf->SetXY($x_firma, $y_firma + ($alturaFila * $totalFilas) - $alturaTexto);
        $pdf->Cell($anchos[8], 4, 'Firma Auxiliar', 0, 0, 'C');

        // Generar salida
        $pdfContent = $pdf->Output('S');
        
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="reporte_'.str_replace(' ', '_', $registroPrincipal->Auxiliar).'_'.($registroPrincipal->Turno).'_'. date('d-m-Y').'.pdf"');
    }

    private function formatField($data)
    {
        if (empty($data)) {
            return 'N/A';
        }
        
        if (is_string($data) && preg_match('/^\[.*\]$/', $data)) {
            try {
                $array = json_decode($data, true);
                return is_array($array) ? implode(', ', $array) : $data;
            } catch (\Exception $e) {
                return str_replace(['"', '[', ']'], '', $data);
            }
        }
        
        return $data;
    }

    private function cellWithLineBreak($pdf, $x, $y, $width, $height, $text1, $text2, $border = 1) 
    {
        // Dibujar borde
        $pdf->SetXY($x, $y);
        $pdf->Cell($width, $height, '', $border, 0);
        
        // Calcular posición centrada verticalmente
        $textHeight = 4; // Altura aproximada del texto
        $space = ($height - ($textHeight * 2)) / 3;
        
        // Primera línea
        $pdf->SetXY($x, $y + $space);
        $pdf->Cell($width, $textHeight, $text1, 0, 0, 'C');
        
        // Segunda línea
        $pdf->SetXY($x, $y + $space + $textHeight + $space);
        $pdf->Cell($width, $textHeight, $text2, 0, 0, 'C');
        
        // Restaurar posición para continuar
        $pdf->SetXY($x + $width, $y);
    }

    private function formatearProductoConGramaje($producto, $gramaje)
    {
        if ($producto === 'N/A' || empty($gramaje)) {
            return $producto;
        }

        // Extraer la primera palabra (Botella)
        $palabras = explode(' ', $producto);
        $primeraPalabra = $palabras[0] ?? '';
        $resto = implode(' ', array_slice($palabras, 1));
        
        // Formato: "Botella 25g PET 500ml"
        return trim("$primeraPalabra $gramaje $resto");
    }
}