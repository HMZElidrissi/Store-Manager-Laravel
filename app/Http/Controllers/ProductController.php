<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $productRepository, protected CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the product.
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('backOffice.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        return view('backOffice.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $attributes = $request->validated();
        $attributes = $this->productRepository->uploadImage($request, $attributes);
        $this->productRepository->create($attributes);
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->getAll();
        $product = $this->productRepository->getById($id);
        return view('backOffice.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $attributes = $request->validated();
        $attributes = $this->productRepository->uploadImage($request, $attributes);
        $this->productRepository->update($id, $attributes);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = $this->productRepository->getById($id);
        if($product->image) {
            Storage::delete($product->image);
        }
        $this->productRepository->delete($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
