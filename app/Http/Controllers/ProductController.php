<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::all();
        return new ProductCollection( $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

/**
 * Store a newly created resource in storage.
 */
public function store(StoreProductRequest $request)
{
    $data = $request->validated();
    $product = Product::create($data);
    return new ProductResource($product);
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource( $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

/**
 * Update the specified resource in storage.
 *
 * @param  \App\Http\Requests\UpdateProductRequest  $request
 * @param  \App\Models\Product  $product
 * @return \App\Http\Resources\ProductResource
 */
public function update(UpdateProductRequest $request, Product $product)
{
    // Validate the request data
    $validated = $request->validated();
    
    // Update the product with the validated data
    $product->update($validated);
    
    // Return the updated product as a resource
    return new ProductResource($product);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }


    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'like', '%' . $search . '%')->get();
        return new ProductCollection( $products);
    }

    
}
