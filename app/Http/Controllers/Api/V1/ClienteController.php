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


/**
 *  @OA\Post(
 *      path="/login",
 *      summary="Autenticar Cliente",
 *      description="Faz login do cliente e retorna um token de autenticação",
 *      operationId="loginCliente",
 *      tags={"Cliente"},
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Dados de login",
 *          @OA\JsonContent(ref="#/components/schemas/Cliente")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Login bem-sucedido",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="token", type="string", example="1|abcdefg123456...")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Credenciais inválidas",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="Erro na autenticação")
 *          )
 *      )
 *  )
 */

    public function authenticate(LoginClienteRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::guard()->attempt($credentials)){
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
 *  @OA\Post(
 *      path="/clientes",
 *      summary="Registrar novo cliente",
 *      description="Cria um novo cliente com email e senha",
 *      operationId="storeCliente",
 *      tags={"Cliente"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Dados do cliente",
 *          @OA\JsonContent(ref="#/components/schemas/Cliente")
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Cliente criado com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="Cliente criado com sucesso"),
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="email", type="string", example="exemplo@email.com"),
 *                  @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-20T14:30:00Z"),
 *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-20T14:30:00Z")
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Erro de validação",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="The email field is required. (and 1 more error)"),
 *              @OA\Property(
 *                  property="errors",
 *                  type="object",
 *                  @OA\Property(
 *                      property="email",
 *                      type="array",
 *                      @OA\Items(type="string", example="Invalid domain, email must be Gmail.")
 *                  ),
 *                  @OA\Property(
 *                      property="password",
 *                      type="array",
 *                      @OA\Items(type="string", example="The password field must be at least 6 characters.")
 *                  )
 *              )
 *          )
 *      )
 * )
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
