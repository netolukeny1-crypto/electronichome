<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Barryvdh\DomPDF\Facade\Pdf;

class FaturaController extends Controller
{
    public function show($id)
    {
       $venda = Venda::with(['cliente', 'itens.produto'])->findOrFail($id);

        $pdf = Pdf::loadView('faturas.venda', compact('venda'));

        return $pdf->stream('fatura.pdf');
    }
}