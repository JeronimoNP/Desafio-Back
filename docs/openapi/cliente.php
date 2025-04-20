<?php
use OpenApi\Annotations as OA; 

/**
 * @OA\Info(
 *     title="Desafio Back API",
 *     version="1.0.0",
 *     description="Documentação da API do Desafio Back"
 * )
 */

 /** 
 * @OA\Server(
 *     url="http://localhost:3000/api/v1",
 *     description="Servidor local"
 * )
 */

 /**  
  * @OA\Schema(
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
class FakeControllerForDocs{
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
}