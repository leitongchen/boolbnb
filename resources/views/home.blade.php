<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials.head')

<body>
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
</body>
</html>
