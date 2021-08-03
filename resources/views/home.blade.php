<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials.head')

<body>

    {{-- <div class="flex-center position-ref full-height">
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

            @include('alerts.payment')
           
            <h1>Sponsored apartments</h1>
            @dump($sponsored)

            <h1>Last apartments</h1>
            @dump($apartments)

            <div class="links">
                <a href="{{ route('apartments.index') }}">INDEX APPARTAMENTI PUBBLICO</a>
            </div>

            


        </div>
    </div> --}}
    

    <div class="container-fluid">
        <section id="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <div>logo</div>
                    </div>
                    <div class="off"></div>
                    <div class="col-2 offset-8">
                        <div class="buttons_container">
                            @if (Route::has('login'))
                            @auth
                            <a href="{{ url('/admin') }}">Home</a>
                            @else
                            <button type="button" class="orange-button">
                                <a href="{{ route('register') }}">Registrati</a>
                            </button>
                            @if (Route::has('register'))
                            <button type="button" class="">
                                <a href="{{ route('login') }}" class="">Accedi</a>
                            </button>
                            @endif
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="content col-8">
                <h1>
                    stai pianificando un viaggio? <br>
                    parti da qui!
                </h1>
            </div>
            <div class="search-container col-6">
                <div id="app">
                    <search-input>
                    </search-input>
                </div>
            </div>
        </section>
        <section id="section-2">
            <div class="links">
                <a href="{{ route('apartments.index') }}">INDEX APPARTAMENTI PUBBLICO</a>
            </div>
        </section>
    </div>

    @include('partials.scripts')
    @include('layouts.partials.footer')
</body>
</html>
