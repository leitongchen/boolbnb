<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials.head')

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/admin') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">

            <h1>

                HOMEPAGE PROVA
            
            </h1>

            <div id="app">

                <search-input>
                </search-input>

            </div>
           

            <div class="links">
                <a href="{{ route('apartments.index') }}">INDEX APPARTAMENTI PUBBLICO</a>
            </div>


        </div>
    </div>
    
    @include('layouts.partials.footer')
    @include('partials.scripts')
</body>
</html>
