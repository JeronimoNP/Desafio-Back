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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tag = $request->query('tag'); 

        if($tag){
            return Tool::whereJsonContains('tags', $tag)->get();
        }else{
            return Tool::paginate();
        }
    }

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretoolRequest $request)
    {
        //Validando a requisição
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'description' => 'required|string',
            'tags' => 'required|array'
        ]);

        $tool = tool::create([
            'title' => $data['title'],
            'link' => $data['link'],
            'description' => $data['description'],
            'tags' => json_encode($data['tags']) // Se o campo é JSON no banco
        ]);

        //retornando data e status http ok
        return response()->json($tool, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(tool $tool)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tool $tool)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetoolRequest $request, tool $tool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tool = Tool::findOrFail($id);
        $tool->delete();

        return response()->json(['message' => 'Ferramenta excluída com sucesso.']);
    }
}
