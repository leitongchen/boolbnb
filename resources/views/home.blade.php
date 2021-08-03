<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials.head')

<body>
    <div id="app">
        
        <section id="section-1">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="#">Logo</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">

                        {{-- lasciare questo ul separa il logo dai button --}}
                        <ul class="navbar-nav mr-auto">
                        </ul>

                        <span class="navbar-text">
                            <div class="buttons_container display_flex justify_content_sa">
                                @if (Route::has('login'))
                                @auth
                                <a href="{{ url('/admin') }}">Home</a>
                                @else
                                <div class="white_button margin_r_15">
                                    <a href="{{ route('register') }}"><strong>Registrati</strong></a>
                                </div>
                                @if (Route::has('register'))
                                <div class="orange_button">
                                    <a href="{{ route('login') }}" class=""><strong>Accedi</strong></a>
                                </div>
                                @endif
                                @endauth
                            </div>
                            @endif
                        </span>
                    </div>
                </nav>
                <div class="padding_t_400 padding_l_16">
                    <h1 class="text_color_w">
                        <strong>
                            Stai pianificando un viaggio? <br>
                            parti da qui!
                        </strong>
                    </h1>
                </div>
            </div>
        </div>
        <div class="sfumatura_nera"></div>
    </section>
    <section id="section-2">
        <div class="search-container col-6 display_flex justify_content_ce">
            <div id="app">
                <h5 class="text_color_two margin_t_20 text-center"><strong>Qual è la tua prossima destinazione?</strong></h5>
                <search-input>
                </search-input>
            </div>
            <h2 class="text-center text_color_two">In evidenza</h2>
            <h2 class="text-center text_color_two">Più Recenti</h2>

            <div class="links">
                <a href="{{ route('apartments.index') }}">INDEX APPARTAMENTI PUBBLICO</a>
            </div>
        </section>
        <section id="section-3">
            <div class="container text-center">
                <h1 class="text_color_w "><strong>Registrati subito e diventa un host!</strong></h1>
                <div class="extra_button d-inline">
                    <a href="{{ route('register') }}"><strong>Registrati ora!</strong></a>
                </div>
            </div>
        </section>

    </div> 
    @include('partials.scripts')
</body>
</html>
