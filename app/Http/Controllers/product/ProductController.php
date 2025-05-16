<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Http\Requests\products\AddProductFormRequest;
use App\Http\Requests\products\UpdateProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductFormRequest $request)
    {
        $requestData = $request->validated();
        $category = Category::find($requestData['category_id']);
        if (!$category) {
            throw new HttpResponseException(
                response()->json(['message' => 'Catégorie non trouvée'], 404)
            );
        }

        $code = Product::where('code',$requestData['code'])->first();
        if ($code) {
            throw new HttpResponseException(
                response()->json(['message' => 'Code produit existant'], 400)
            );
        }
        $product = Product::create($requestData);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new HttpResponseException(
                response()->json(['message' => 'Produit non trouvé'], 404)
            );
        }
        return response()->json($product, 200);
    }

    public function get_by_category(int $category_id){
        $products = Product::where('category_id', $category_id)->get();
        return response()->json($products, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductFormRequest $request, int $id)
    {
        $requestData = $request->validated();
        $product = Product::find($id);
        if (!$product) {
            throw new HttpResponseException(
                response()->json(['message' => 'Produit non trouvé'], 404)
            );
        }
        $product->update($requestData);
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new HttpResponseException(
                response()->json(['message' => 'Produit non trouvé'], 404)
            );
        }   
        $product->delete();
        return response()->json(['message' => 'Produit supprimé'], 204);
    }
}
