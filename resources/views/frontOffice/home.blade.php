@extends('frontOffice.layouts.app')

@section('title', 'adidas™')

@section('content')
<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        Quality <span class="text-amber-500">never goes out</span> fashion.
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
        <form action="{{ route('home') }}" method="GET">
            <!--  Category -->
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
                <select id="category" name="category" class="focus:ring-amber-500 focus:border-amber-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" onchange="this.form.submit()">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Search -->
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
                <input type="text" name="search" placeholder="Find your product" class="focus:ring-amber-500 focus:border-amber-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ request('search') }}">
            </div>
        </form>
    </div>
</header>

<main class="max-w-6xl mx-auto mt-2 lg:mt-20 space-y-6">
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-4 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Products</h2>
            <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:grid-cols-3 lg:gap-x-8">
                @foreach($products as $product)
                    <div class="group relative bg-white border border-gray-200 rounded-lg flex flex-col overflow-hidden">
                        <div class="aspect-w-3 aspect-h-4 bg-gray-200 group-hover:opacity-75 sm:aspect-none sm:h-96">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-center object-cover sm:w-full sm:h-full">
                        </div>
                        <div class="flex-1 p-4 space-y-2 flex flex-col">
                            <h3 class="text-sm font-medium text-gray-900">
                                {{ $product->title }}
                            </h3>
                            <p class="text-sm text-gray-500">{{ $product->description }}</p>
                            <div>
                                <span class="px-3 py-1 border border-red-300 rounded-full text-red-300 text-xs uppercase font-semibold">{{ $product->category->title }}</span>
                                <span class="px-3 py-1 border border-gray-200 rounded-full text-gray-900 text-xs uppercase font-semibold">{{ $product->price }} MAD</span>
                            </div>
                            <form action="{{ route('products.buy') }}" method="POST" class="mt-6" onsubmit="return confirmQuantity(this);">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="quantity">
                                <button type="submit" class="bg-amber-500 w-full rounded-md py-2 text-sm font-medium text-white hover:bg-gray-400 flex items-center justify-center">
                                    <svg class="w-6 h-6 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M4 4c0-.6.4-1 1-1h1.5c.5 0 .9.3 1 .8L7.9 6H19a1 1 0 0 1 1 1.2l-1.3 6a1 1 0 0 1-1 .8h-8l.2 1H17a3 3 0 1 1-2.8 2h-2.4a3 3 0 1 1-4-1.8L5.7 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                    </svg>

                                    <span class="font-semibold">Buy</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <nav class="border-t border-gray-200 px-4 flex items-center justify-between sm:px-0 pb-8">
            {{ $products->appends(request()->query())->links('frontOffice.pagination') }}
        </nav>
    </div>
</main>
@endsection
