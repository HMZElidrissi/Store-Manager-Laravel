<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the category.
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = $this->categoryRepository->getAll();
        return view('backOffice.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('backOffice.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('create', Category::class);
        $attributes = $request->validated();
        $this->categoryRepository->create($attributes);
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
    {
        $this->authorize('update', Category::class);
        $category = $this->categoryRepository->getById($id);
        return view('backOffice.categories.edit', compact('category'));
    }
    /**
     * Update the specified category in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $this->authorize('update', Category::class);
        $attributes = $request->validated();
        $this->categoryRepository->update($id, $attributes);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', Category::class);
        $this->categoryRepository->delete($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
