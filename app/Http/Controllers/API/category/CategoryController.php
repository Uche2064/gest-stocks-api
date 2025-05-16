<?php

namespace App\Http\Controllers\API\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\category\AddOrUpdateCategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddOrUpdateCategoryFormRequest $request)
    {
        
        $validatedData = $request->validated();
        $dbCategory = Category::where('name', $validatedData['name'])->first();
        if ($dbCategory) {
            throw new HttpResponseException(
                response()->json(['message' => 'Catégorie déjà existante'], 400)
            );
        }
        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            throw new HttpResponseException(response()->json(['message' => 'Catégorie non trouvée'], 404));
        }
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddOrUpdateCategoryFormRequest $request, int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            throw new HttpResponseException(response()->json(['message' => 'Catégorie non trouvée'], 404));
        }
        $validatedData = $request->validated();
        $category->update($validatedData);
        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            throw new HttpResponseException(response()->json(['message' => 'Catégorie non trouvée'], 404));
        }
        $category->delete();
        return response()->json(['message' => 'Catégorie supprimée'], 204);
    }
}
