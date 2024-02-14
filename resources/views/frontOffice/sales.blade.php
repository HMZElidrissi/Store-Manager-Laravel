@extends('frontOffice.layouts.app')

@section('title', 'adidas™')

@section('content')
<main class="max-w-6xl mx-auto mt-2 lg:mt-20 space-y-6">
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-0">
            <h1 class="text-3xl font-extrabold text-center tracking-tight text-gray-900 sm:text-4xl mb-5">My Sales</h1>
             <section aria-labelledby="cart-heading">
                    <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                    <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                        @foreach($sales as $sale)
                        <li class="flex py-6">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $sale->product->image) }}" alt="Product image" class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32">
                            </div>

                            <div class="ml-4 flex-1 flex flex-col sm:ml-6">
                                <div>
                                    <div class="flex justify-between">
                                        <h4 class="text-sm">
                                            <a href="#" class="font-medium text-gray-700 hover:text-gray-800">{{ $sale->product->title }}</a>
                                        </h4>
                                        <p class="ml-4 text-sm font-medium text-gray-900">{{ $sale->product->price }} MAD</p>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">{{ $sale->product->category->title }}</p>
                                </div>

                                <div class="mt-4 flex-1 flex items-end justify-between">
                                    <span class="py-1 px-2 rounded border text-center rounded-full text-xs {{ $sale->status == 'delivered' ? 'border-green-500 text-green-500' : ($sale->status == 'pending' ? 'border-amber-500 text-amber-500' : 'border-indigo-500 text-indigo-500') }}">
                                        {{ ucfirst($sale->status) }}
                                    </span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </section>
        </div>
    </div>
</main>
@endsection
