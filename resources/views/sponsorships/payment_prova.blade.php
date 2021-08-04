@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="form-message form-apartment sponsorship_form">
        

            <form action="{{ url('/admin/sponsorship/checkout') }}" method="POST" id="payment-form">
                @csrf
                <input type="hidden" id="token" name="token" value="{{ $token ?? ''}}">

                <section>
                    <h3 class="text-center">Sponsorizza il tuo appartamento</h3>


                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                                <label for="apartments" class="form-label">
                                    Quale appartamento vuoi sponsorizzare?
                                    <br>
                                    <select class="form-control" name="apartment_id" id="apartments">

                                        @foreach($apartments as $apartment)

                                        <option value="{{$apartment->id}}">
                                            {{ $apartment->title }} - {{ $apartment->completeAddress }}
                                        </option>

                                        @endforeach

                                    </select>
                                </label>
                        </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sponsorships" class="form-label">
                                    Per quanto tempo vuoi sponsorizzare il tuo appartamento?
                                    <br>
                                    <select class="form-control" name="sponsorship_id" id="sponsorships">

                                        @foreach($sponsorships as $type)

                                        <option id="amount" name="amount" value="{{$type->id}}">
                                            {{ $type->promo_hours }} ORE - €{{ $type->price }}
                                        </option>

                                        @endforeach

                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>

                    <h6 class="text-center">Inserisci i tuoi dati di pagamento</h6>

                    <div class="row">

                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>

                    </div>

                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />

                <div class="cta_form">
                    <a class="my_link" href="{{ asset('admin.apartments.index') }}">
                        Torna ai tuoi appartamenti
                    </a>

                    <button class="btn_bool btn_primary" type="submit">
                        <span>Paga</span>
                    </button>
                </div>
            </form>

            @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



        </div>

    </div>

    
@endsection

@section('scripts')
    <script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
    {{-- <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script> --}}

    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script src="{{ asset('js/btpayment_dropin.js') }}"></script>
@endsection

