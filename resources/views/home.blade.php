<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials.head')

<body>
    <section id="section-1">
        @include('partials.nav')
        <div class="container">
            

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

        @include('alerts.payment')

        <div class="container-fluid sponsored_section">
        
            <h2 class="text-center text_color_two">In evidenza</h2>
            <div class="row card-group">
                @foreach ($sponsored as $apartment)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
                    <div class="card my-apartment-card overflow-hidden">
                        <div class="my-card-img-container">
                            <img src="{{ asset('storage/' . $apartment->img_url) }}" class="card-img-top" alt="...">
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
                                <a href="{{ route('apartments.show', $apartment->id) }}" class="btn_bool btn_outline">Vedi i dettagli</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

        <div class="container-fluid recents_section">
        
            <h2 class="text-center text_color_two">Novità</h2>
            <div class="row card-group">
                @foreach ($apartments as $apartment)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
                    <div class="card my-apartment-card overflow-hidden">
                        <div class="my-card-img-container">
                            <img src="{{ asset('storage/' . $apartment->img_url) }}" class="card-img-top" alt="...">
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
                                <a href="{{ route('apartments.show', $apartment->id) }}" class="btn_bool btn_outline">Vedi i dettagli</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

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
