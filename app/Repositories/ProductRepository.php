<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends Repository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function uploadImage($request, $attributes)
    {
        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('products', 'public');
        }
        return $attributes;
    }

    public function query($request)
    {
        $query = $this->model->query();
        if ($request->has('search') && $request->input('search') != '') {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        } elseif ($request->has('category') && $request->input('category') != '') {
            $query->where('category_id', $request->input('category'));
        } else {
            $query->latest();
        }
        return $query;
    }
}
