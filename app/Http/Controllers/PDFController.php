<?php

namespace App\Http\Controllers;

use App\Models\Firma;
use App\Models\Tramite;
use App\Models\Expediente;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\App;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
namespace App\Http\Controllers;
use PDF;

class PDFController extends Controller
{

    // function to display preview
    public function albanco()
    {
        return view('notas.albanco');
    }

    public function generatePDF()
    {
        set_time_limit(600);

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf = PDF::loadView('notas.albanco');
            return $pdf->stream('pdfview.pdf');
    }
}
