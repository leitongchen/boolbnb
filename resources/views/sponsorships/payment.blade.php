@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Sponsorizza il tuo appartamento</h1>

        <form action="{{ url('/admin/sponsorship/checkout') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" id="token" name="token" value="{{ $token ?? ''}}">
            <section>

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

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name_on_card" class="form-label">Name on Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card" placeholder="Mario Rossi">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cc_number" class="form-label">Credit Card Number</label>
                            <div class="form-control" id="card-number"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="expiry" class="form-label">Expiry</label>
                            <div class="form-control" id="expiration-date"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cvv" class="form-label">CVV</label>
                            <div class="form-control" id="cvv"></div>
                        </div>
                    </div>
                </div>

            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="btn btn-primary" type="submit"><span>Test Transaction</span></button>
        </form>

    </div>

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
@endsection

@section('scripts')
    <script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>

    {{-- <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script> --}}
    <script src="{{ asset('js/btpayment.js') }}"></script>
@endsection

