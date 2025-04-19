<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Tool;
use Illuminate\Http\Request;
use App\Http\Requests\StoretoolRequest;
use App\Http\Requests\UpdatetoolRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ToolCollection;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Desafio Back API",
 *     version="1.0.0",
 *     description="Documentação da API do Desafio Back"
 * )
 * @OA\Server(
 *     url="http://localhost:3000/api/v1",
 *     description="Servidor local"
 * )
 *  * @OA\Schema(
 *     schema="Tool",
 *     type="object",
 *     title="Tool",
 *     description="Modelo de uma ferramenta",
 *     @OA\Property(property="title", type="string", example="Nova ferramenta"),
 *     @OA\Property(property="link", type="string", example="http://example.com"),
 *     @OA\Property(property="description", type="string", example="Descrição da ferramenta"),
 *     @OA\Property(property="tags", type="array", @OA\Items(type="string"), example={"tag1", "tag2"})
 * )
 */
class ToolController extends Controller
{
    /**
     * @OA\Get(
     *     path="/tools",
     *     summary="Lista todas as ferramentas",
     *     description="Retorna todas as ferramentas ou filtra por tags.",
     *     @OA\Parameter(
     *         name="tag",
     *         in="query",
     *         description="Filtrar ferramentas por tags (separadas por vírgula, exemplo: 'tag1,tag2')",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de ferramentas retornada com sucesso",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Tool")
     *         )
     *     )
     * )
     */

     public function index(Request $request)
    {
        $tag = $request->query('tag');

        if ($tag) {
            $tags = explode(',', $tag);
            $query = Tool::query();

            foreach ($tags as $tag) {
                $query->whereJsonContains('tags', $tag);
            }
            $data = $query->get();

            return $data;
        } else {
            return Tool::paginate();
        }
    }

    /**
     * @OA\Post(
     *     path="/tools",
     *     summary="Cria uma nova ferramenta",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Tool")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ferramenta criada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Tool")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro ao criar ferramenta",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Erro ao criar ferramenta"),
     *             @OA\Property(property="error", type="string", example="Detalhes do erro")
     *         )
     *     )
     * )
     */
    public function store(UpdatetoolRequest $request)
    {
        // Validando os dados
        $data = $request->validated();

        try {
            $tool = Tool::create([
                'title' => $data['title'],
                'link' => $data['link'],
                'description' => $data['description'],
                'tags' => json_encode($data['tags'])
            ]);

            return response()->json([
                'message' => 'Ferramenta criada com sucesso',
                'data' => $tool
            ], 201);
        } catch (\Exception $error) {
            \Log::error('Erro ao criar ferramenta: ' . $error->getMessage());
            return response()->json([
                'message' => 'Erro ao criar ferramenta',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/tools/{id}",
     *     summary="Exclui uma ferramenta pelo ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da ferramenta a ser excluída",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ferramenta excluída com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Ferramenta excluída com sucesso.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ferramenta não encontrada"
     *     )
     * )
     */
    public function destroy($id)
    {
        $tool = Tool::findOrFail($id);
        $tool->delete();

        return response()->json(['message' => 'Ferramenta excluída com sucesso.']);
    }
}