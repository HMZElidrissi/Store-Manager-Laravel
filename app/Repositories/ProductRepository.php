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
}
