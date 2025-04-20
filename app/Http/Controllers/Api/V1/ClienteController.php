<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginClienteRequest;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

/**
 * 
 * 
 * @OA\Schema(
 *     schema="Cliente",
 *     type="object",
 *     title="Cliente",
 *     description="Modelo de Cliente",
 *     @OA\Property(property="email", type="string", example="xxxxx@gmail.com"),
 *     @OA\Property(property="password", type="string", example="123Abc"),
 * )
 */



class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    public function authenticate(LoginClienteRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::guard->attempt($credentials)){
            $cliente = Auth::user();
            $token = $cliente->createToken('cliente-token')->plainTextToken;

            return response()->json(['token' => $token], 200);
        }else{
            return response()->json([
            'message'=> 'Erro na autenticação'
            ], 401);
        }

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        $data = $request->validated();

        try{
            $cliente = Cliente::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return response()->json([
                'message' => 'Cliente criado com sucesso',
                'data' => $cliente
            ], 201);
        }catch(Exception $error){
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
