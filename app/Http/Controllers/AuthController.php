<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $dados = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $dados['email'])->first();
        if (! $user || ! Hash::check($dados['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
    
        $token = $user->createToken('app-flutter')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function register(Request $request)
    {
        $dadosValidados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $dadosValidados['name'],
            'email' => $dadosValidados['email'],
            'password' => Hash::make($dadosValidados['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
