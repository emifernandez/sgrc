<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    public function PDF() {
        $pdf = PDF::loadView('establecimiento.reportes.establecimiento');
        return $pdf->stream('prueba.pdf');
    }
}
