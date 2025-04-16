<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Tool;
use Illuminate\Http\Request;
use App\Http\Requests\StoretoolRequest;
use App\Http\Requests\UpdatetoolRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ToolCollection;


class ToolController extends Controller
{

    public function index(Request $request)
    {
        //capture the tags in the query
        $tag = $request->query('tag'); 

        if ($tag) {

            $tags = explode(',', $tag);
            $query = Tool::query();
            
            // Applies a whereJsonContains to each tag (AND operation)
            foreach ($tags as $tag) {
                $query->whereJsonContains('tags', $tag);
            }
            $data = $query->get();

            return $data;
        } else {
            //return all data
            return Tool::paginate();
        }
    }
    

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdatetoolRequest $request)
    {
        // validating data
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
        } catch (Exception $error) {
            Log::error('Erro ao criar ferramenta: ' . $error->getMessage());
            return response()->json([
                'message' => 'Erro ao criar ferramenta',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(tool $tool)
    {

    }

    public function edit(tool $tool)
    {
        
    }

    public function update(UpdatetoolRequest $request, tool $tool)
    {
        //
    }

    public function destroy($id)
    {
        $tool = Tool::findOrFail($id);
        $tool->delete();

        return response()->json(['message' => 'Ferramenta excluída com sucesso.']);
    }
}
