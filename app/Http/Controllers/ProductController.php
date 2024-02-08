<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
