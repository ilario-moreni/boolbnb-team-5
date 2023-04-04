@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-12 d-flex justify-content-between">
                <div class="card rounded-4 p-2 bg-azure" style="width: 22rem;">
                    <div class="card-body">
                        <h5 class="card-title h1 text-center">{{ $sponsorship->name }}</h5>
                        <div class="d-flex mt-4">
                            <h3 class="m-0">h{{ $sponsorship->duration }}/</h3>
                            <h4 class="m-0">€{{ $sponsorship->price }}</h4>
                        </div>
                        <p class="card-text h5 lh-lg text-center my-4">{{ $sponsorship->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <form class="m-5" method="post" id="payment-form"
                        action="{{ route('admin.sponsorships.process_payment', ['apartmentSlug' => $apartmentSlug, 'id' => $sponsorship->id]) }}">
                        @csrf
                        <section>
                            <label for="amount">
                                <span class="input-label">Amount</span>
                                <div>{{ $sponsorship->price }}</div>
                            </label>
                            <div class="bt-drop-in-wrapper">
                                <div id="bt-dropin"></div>
                            </div>
                        </section>
                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button class="button" type="submit"><span>Test Transaction</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.min.js"></script>
    <script>
        var form = document.getElementById('payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
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
    </script>
@endsection
