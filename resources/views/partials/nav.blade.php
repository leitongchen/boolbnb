<nav class="navbar my_navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">

        {{-- LOGO BOOLBNB --}}
        <div class="logo_container">
            <a href="{{ route('index') }}">
                <img src="{{ asset('images/BoolBnb_logo.png') }}" alt="">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger_menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">

            {{-- lasciare questo ul separa il logo dai button --}}
            <ul class="navbar-nav mr-auto">
            </ul>

            <span class="navbar-text">
                <div class="buttons_container display_flex justify_content_sa">
                    @if (Route::has('login'))
                    @auth

                    <div>
                        
                        <div class="profile_pic_container nav-item dropdown">
                            <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset('images/undraw_male_avatar_323b.svg') }}" alt="">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('admin.home') }}">
                                    Dashboard
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                
                            </div>
                            
                        </div>
                        
                    </div>

                    
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

    </div>
</nav>