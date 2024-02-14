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

<body>
<section class="px-6 py-8">
    @include('frontOffice.layouts._navbar')
    @yield('content')
    @include('frontOffice.layouts._footer')
</section>
@if (session()->has('success'))
    <div id="success-message" class="fixed bg-green-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        {{ session('success') }}
    </div>
@endif
@if (session()->has('error'))
    <div id="error-message" class="fixed bg-red-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        {{ session('error') }}
    </div>
@endif
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
