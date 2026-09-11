<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
    {
        return Contato::with('usuario')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'telefone' => 'required|string',
        ]);

        $contato = Contato::create([
            ...$request->only(['nome', 'sobrenome', 'telefone', 'empresa', 'descricao', 'imagem']),
            'user_id' => auth()->id(),
        ]);

        return response()->json($contato, 201);
    }

    public function show(Contato $contato)
    {
        return $contato->load('usuario');
    }

    public function update(Request $request, Contato $contato)
    {
        $contato->update($request->only(['nome', 'sobrenome', 'telefone', 'empresa', 'descricao', 'imagem']));

        return response()->json($contato);
    }

    public function destroy(Contato $contato)
    {
        $contato->delete();

        return response()->json(null, 204);
    }
}   