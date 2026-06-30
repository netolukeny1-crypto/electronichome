<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $produtos = Produto::when($request->pesquisa, function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->pesquisa . '%')
                      ->orWhere('categoria', 'like', '%' . $request->pesquisa . '%');
            })
            ->latest()
            ->paginate(10);

        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'required|string',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imagemPath = null;

        if ($request->hasFile('imagem')) {
            $file = $request->file('imagem');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $imagemPath = $file->storeAs('produtos', $filename, 'public');
        }

        Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'stock' => $request->stock,
            'categoria' => $request->categoria,
            'descricao' => $request->descricao,
            'imagem' => $imagemPath
        ]);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }
}