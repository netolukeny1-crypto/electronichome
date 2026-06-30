<?php

namespace App\Http\Controllers;

use App\Models\Divida;

class DividaController extends Controller
{
    public function index()
    {
        $dividas = \App\Models\Divida::with('venda.cliente')->get();
        return view('dividas.index', compact('dividas'));
    }
}