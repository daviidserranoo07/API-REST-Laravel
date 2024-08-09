<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PutRequest;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Product::get(),200);
    }

    /**
     * Display a listing of the resource for name.
     */
    public function showTitle(Product $product)
    {
        $product = Product::where('title',$product->title)->get();
        return response()->json([
            'status'=>true,
            'product'=>$product,
        ],200);

    }

    /**
     * Display a listing of the resource for id.
     */
    public function showId(Product $product){

        $product = Product::where('id',$product->id)->get();
        return response()->json([
            'status'=>true,
            'product'=>$product,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {   
        $product = Product::create($request->validated());
        
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
    public function update(PutRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json([
            'status' => true,
            'product' => $product,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
