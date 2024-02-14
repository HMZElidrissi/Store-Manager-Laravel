<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository extends Repository
{
    public function __construct(Sale $model)
    {
        parent::__construct($model);
    }

    public function buy($product_id, $quantity)
    {
        $sale = new Sale();
        $sale->product_id = $product_id;
        $sale->client_id = auth()->user()->id;
        $sale->quantity = $quantity;
        $sale->save();
    }
}
