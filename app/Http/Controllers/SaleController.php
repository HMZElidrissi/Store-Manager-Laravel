<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(protected ProductRepository $productRepository, protected SaleRepository $saleRepository)
    {
        $this->productRepository = $productRepository;
        $this->saleRepository = $saleRepository;
    }

    public function buy(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $this->saleRepository->buy($product_id, $quantity);
        return redirect()->route('home')->with('success', 'Product bought successfully!');
    }
}
