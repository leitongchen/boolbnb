<div class="content">

    <h1>Sponsorizza il tuo appartamento</h1>

    <form method="post" id="payment-form" action="{{ url('/admin/sponsorship/checkout') }}">
        @csrf
        <input type="hidden" id="token" name="token" value="{{$token}}">
        <section>
            <label for="apartments">
                <span class="input-label">Quale appartamento vuoi sponsorizzare?</span>
                <br>
                <select name="apartment_id" id="apartments">

                    @foreach($apartments as $apartment)

                        <option value="{{$apartment->id}}"> 
                            {{ $apartment->title }} - {{ $apartment->completeAddress }}
                        </option>

                    @endforeach

                </select>
            </label>

            <br>
            <br>

            <label for="sponsorships">
                <span class="input-label">Per quanto tempo vuoi sponsorizzare il tuo appartamento?</span>
                <br>
                <select name="sponsorship_id" id="sponsorships">

                    @foreach($sponsorships as $type)

                        <option id="amount" name="amount" value="{{$type->id}}"> 
                            {{ $type->promo_hours }} ORE - €{{ $type->price }}
                        </option>

                    @endforeach

                </select>
            </label>

            <br>
            <br>


            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
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


<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script src="{{ asset('js/btpayment.js') }}"></script>

{{-- <script>

    var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";

    braintree.dropin.create({
    authorization: client_token,
    selector: '#bt-dropin',
    // paypal: {
        //flow: 'vault'
    //}
    }, function (createErr, instance) {
    if (createErr) {
        console.log('Create Error', createErr);
        return;
    }
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        instance.requestPaymentMethod(function (err, payload) {
        if (err) {
            console.log('Request Payment Method Error', err);
            return;
        }

        // Add the nonce to the form and submit
        document.querySelector('#nonce').value = payload.nonce;
        form.submit();
        });
    });
    });

</script> --}}