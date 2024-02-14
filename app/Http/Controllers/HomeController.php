<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SaleRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected ProductRepository $productRepository, protected CategoryRepository $categoryRepository, protected SaleRepository $saleRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->saleRepository = $saleRepository;
    }

    public function index(Request $request)
    {
        $products = $this->productRepository->query($request)
            ->paginate(3)
            ->withQueryString();
        $categories = $this->categoryRepository->getAll();
        return view('frontOffice.home',
            compact('products', 'categories'));
    }

    public function dashboard()
    {
        return view('backOffice.dashboard');
    }
}
