<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class HomeController extends Controller
{
    public function __construct(protected ProductRepository $productRepository, protected CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
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
}
