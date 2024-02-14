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
