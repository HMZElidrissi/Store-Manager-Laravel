<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the category.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified category in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
