<nav class="md:flex md:justify-between md:items-center">
    <div>
        <a href="/">
            <img src="{{ asset('img/logo.png') }}" alt="Store Logo" width="165" height="16">
        </a>
    </div>

    <div class="mt-8 md:mt-0">
        @if(auth()->user())
            <span class="text-xs font-bold uppercase pr-1.5">Welcome, {{ auth()->user()->name }}</span>
        @else
            <a href="{{ route('showRegisterForm') }}" class="text-xs font-bold uppercase">Create an account</a>
        @endif

        @if(auth()->user())
            <a href="{{ route('mysales') }}">
                <svg class="w-8 h-8 text-amber-500 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 1 12c0 .5-.5 1-1 1H6a1 1 0 0 1-1-1L6 8h12Z"/>
                </svg>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-amber-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('showLoginForm') }}" class="bg-amber-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                Sign in
            </a>
        @endif
    </div>
</nav>
