<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PdfMenuController extends Controller
{
    // Función para mostrar el listado de archivos PDF
    public function index()
    {
        // Obtener la lista de archivos PDF en 'storage/app/public/pdfs'
        $pdfFiles = Storage::disk('public')->files('pdfs');

        // Pasar los archivos a la vista
        return view('pdfmenu.index', compact('pdfFiles'));
    }
}



