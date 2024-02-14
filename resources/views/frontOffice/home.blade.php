<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>adidas™</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" alt="Store Logo" width="165" height="16">
            </a>
        </div>

        <div class="mt-8 md:mt-0">
            @if(auth()->user())
                <span class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->name }}</span>
            @else
                <a href="{{ route('showRegisterForm') }}" class="text-xs font-bold uppercase">Create an account</a>
            @endif

            @if(auth()->user())
                <a href="{{ route('logout') }}" class="bg-amber-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Logout
                </a>
            @else
                <a href="{{ route('showLoginForm') }}" class="bg-amber-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Sign in
                </a>
            @endif
        </div>
    </nav>

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
                                <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full h-full object-center object-cover sm:w-full sm:h-full">
                            </div>
                            <div class="flex-1 p-4 space-y-2 flex flex-col">
                                <h3 class="text-sm font-medium text-gray-900">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500">{{ $product->description }}</p>
                                <div>
                                    <span class="px-3 py-1 border border-red-300 rounded-full text-red-300 text-xs uppercase font-semibold">{{ $product->category->title }}</span>
                                    <span class="px-3 py-1 border border-gray-200 rounded-full text-gray-900 text-xs uppercase font-semibold">{{ $product->price }} MAD</span>
                                </div>
                                <form action="#" method="POST" class="mt-6">
                                    <button type="submit" class="bg-amber-500 w-full rounded-md py-2 text-sm font-medium text-white hover:bg-gray-400 flex items-center justify-center">
                                        <svg class="w-6 h-6 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M4 4c0-.6.4-1 1-1h1.5c.5 0 .9.3 1 .8L7.9 6H19a1 1 0 0 1 1 1.2l-1.3 6a1 1 0 0 1-1 .8h-8l.2 1H17a3 3 0 1 1-2.8 2h-2.4a3 3 0 1 1-4-1.8L5.7 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                        </svg>

                                        <span class="font-semibold">Add to cart</span>
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

    <footer aria-labelledby="footer-heading" class="bg-gray-50">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="border-t border-gray-200 py-20">
                <div
                    class="grid grid-cols-1 md:grid-cols-12 md:grid-flow-col md:gap-x-8 md:gap-y-16 md:auto-rows-min">
                    <!-- Image section -->
                    <div class="col-span-1 md:col-span-2 lg:row-start-1 lg:col-start-1">
                        <img src="./images/logo1.png" alt=""
                             class="h-8 w-auto">
                    </div>

                    <!-- Sitemap sections -->
                    <div
                        class="mt-10 col-span-6 grid grid-cols-2 gap-8 sm:grid-cols-3 md:mt-0 md:row-start-1 md:col-start-3 md:col-span-8 lg:col-start-2 lg:col-span-6">
                        <div class="grid grid-cols-1 gap-y-12 sm:col-span-2 sm:grid-cols-2 sm:gap-x-8">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Products</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Bags </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Tees </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Objects </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Home Goods </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Accessories </a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Company</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Who we are </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Sustainability </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Press </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Careers </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Terms &amp;
                                            Conditions
                                        </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Privacy </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Customer Service</h3>
                            <ul role="list" class="mt-6 space-y-6">
                                <li class="text-sm">
                                    <a href="#" class="text-gray-500 hover:text-gray-600"> Contact </a>
                                </li>

                                <li class="text-sm">
                                    <a href="#" class="text-gray-500 hover:text-gray-600"> Shipping </a>
                                </li>

                                <li class="text-sm">
                                    <a href="#" class="text-gray-500 hover:text-gray-600"> Returns </a>
                                </li>

                                <li class="text-sm">
                                    <a href="#" class="text-gray-500 hover:text-gray-600"> Warranty </a>
                                </li>

                                <li class="text-sm">
                                    <a href="#" class="text-gray-500 hover:text-gray-600"> Secure Payments </a>
                                </li>

                                <li class="text-sm">
                                    <a href="#" class="text-gray-500 hover:text-gray-600"> FAQ </a>
                                </li>

                                <li class="text-sm">
                                    <a href="#" class="text-gray-500 hover:text-gray-600"> Find a store </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Newsletter section -->
                    <div
                        class="mt-12 md:mt-0 md:row-start-2 md:col-start-3 md:col-span-8 lg:row-start-1 lg:col-start-9 lg:col-span-4">
                        <h3 class="text-sm font-medium text-gray-900">Sign up for our newsletter</h3>
                        <p class="mt-6 text-sm text-gray-500">The latest deals and savings, sent to your inbox
                            weekly.
                        </p>
                        <form class="mt-2 flex sm:max-w-md">
                            <label for="email-address" class="sr-only">Email address</label>
                            <input id="email-address" type="text" autocomplete="email" required
                                   class="appearance-none min-w-0 w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                            <div class="ml-4 flex-shrink-0">
                                <button type="submit"
                                        class="w-full bg-amber-600 border border-transparent rounded-md shadow-sm py-2 px-4 flex items-center justify-center text-base font-medium text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">Sign
                                    up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 py-10 text-center">
                <p class="text-sm text-gray-500">&copy; 2024 adidas, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>
</section>
</body>

</html>
