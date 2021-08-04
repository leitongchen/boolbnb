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