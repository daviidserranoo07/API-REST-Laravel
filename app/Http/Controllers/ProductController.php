<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Product::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();

        $product = Product::create($data);
        
        return response()->json([
            'status' => true,
            'product' => $product,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {   
        return response()->json([
            'status'=>true,
            'products'=>$product,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
