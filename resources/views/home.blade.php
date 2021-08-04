<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials.head')

<body>
    <section id="section-1">
        <div class="container">
            
            @include('partials.nav')

            <div class="padding_t_400 padding_l_16">
                <h1 class="text_color_w">
                    <strong>
                        Stai pianificando un viaggio? <br>
                        parti da qui!
                    </strong>
                </h1>
            </div>
        </div>
        {{-- <div class="sfumatura_nera"></div> --}}
    </section>
    <section id="section-2">
        <div class="search-container col-6 display_flex justify_content_ce align_item_c">
            <div id="app" class="w-80x">
                <h5 class="text_color_two margin_t_20 text-center"><strong>Qual è la tua prossima destinazione?</strong></h5>
                <search-input>
                </search-input>
            </div>
        </div>
        <h2 class="text-center text_color_two">In evidenza</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 card-group">
            @foreach ($apartments as $apartment)
            <div class="col mb-3">
                <div class="card my-apartment-card overflow-hidden h-100">
                    <div class="my-card-img-container">
                        <img src="{{ asset('storage/' . $apartment->img_url) }}" class="card-img-top my-card-img-top img-fluid" alt="...">
                    </div>
                    <div class="card-body my-card-body d-flex align-content-around flex-column">
 
                        <h5 class="card-title my-card-title">{{ $apartment->title }}</h5>
                        <p>
                            @if ($apartment->rooms_number = 1) 
                                <span>{{ $apartment->rooms_number }} stanza - </span>
                            @else 
                                <span>{{ $apartment->rooms_number }} stanze - </span>
                            @endif

                            @if ($apartment->beds_number = 1) 
                                <span>{{ $apartment->beds_number }} letto - </span>
                            @else 
                                <span>{{ $apartment->beds_number }} letti - </span>
                            @endif

                            @if ($apartment->bathrooms_number = 1) 
                                <span>{{ $apartment->bathrooms_number }} bagno</span>
                            @else 
                                <span>{{ $apartment->bathrooms_number }} bagni</span>
                            @endif
                        </p>

                        @if ($apartment->extra_services->count() > 0)
                        <p class="card-text">
                            @foreach($apartment->extra_services as $extraService)
                            <span>{{ $extraService->name }}
                                @if(!$loop->last)
                                -
                                @endif
                            </span>
                            @endforeach
                        </p>
                        @endif

                        <div class="m-auto my-btn-container">
                            <a href="{{ URL::signedRoute('admin.apartments.show', $apartment->id) }}" class="white_button">Vedi i dettagli</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h2 class="text-center text_color_two">Più Recenti</h2>

        <div class="links">
            {{-- <a href="{{ route('apartments.index') }}">INDEX APPARTAMENTI PUBBLICO</a> --}}
        </div>
    </section>
    <section id="section-3">
        <div class="container text-center col-sm-">
            <h1 class="text_color_w "><strong>Registrati subito e diventa un host!</strong></h1>
            <div class="extra_button d-inline">
                <a href="{{ route('register') }}"><strong>Registrati ora!</strong></a>
            </div>
        </div>
    </section>
    @include('partials.scripts')
    @include('layouts.partials.footer')
</body>
</html>
