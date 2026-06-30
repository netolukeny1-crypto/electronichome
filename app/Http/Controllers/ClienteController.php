<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
{
    $query = \App\Models\Cliente::query();

    if ($request->pesquisa) {
        $query->where(function ($q) use ($request) {
            $q->where('nome', 'like', '%' . $request->pesquisa . '%')
              ->orWhere('telefone', 'like', '%' . $request->pesquisa . '%')
              ->orWhere('bi', 'like', '%' . $request->pesquisa . '%');
        });
    }

    $clientes = $query->latest()->paginate(10);

    return view('clientes.index', compact('clientes'));
}

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        Cliente::create($request->all());
        return redirect()->route('clientes.index');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $cliente->update($request->all());
        return redirect()->route('clientes.index');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}