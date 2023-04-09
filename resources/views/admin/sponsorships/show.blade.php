@extends('layouts.admin')
@section('content')
    <div id="loader" class="container d-none">
        <div class="row">
            <div class="col">
                <div class="loader my-4"></div>
                <h5>pagamento in corso, attendere...</h5>
            </div>
        </div>
    </div>
    <div id="show" class="container d-block">
        <div class="row my-5">
            <div class="col-12 d-flex justify-content-between">
                <article class="plan [ card_ ]">
                    <div class="inner">

                        <span class="pricing">
                            <span>
                                €{{ $sponsorship->price }}
                            </span>
                        </span>
                        <h2 class="title">{{ $sponsorship->name }}</h2>
                        <p class="info">{{ $sponsorship->description }}</p>
                        <ul class="features">
                            <li>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24">
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <span><strong>{{ $sponsorship->duration }}</strong> ore di visibilità</span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24">
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <span>presenza in <strong>Homepage</strong></span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24">
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <span>Più visualizzazioni</span>
                            </li>
                        </ul>
                    </div>
                </article>

            </div>
            <div class="row mt-3 me-2">
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
    <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>
    <script>
        var form = document.getElementById('payment-form');
        var client_token = "{{ $token }}";
        let loading = document.getElementById('loader');
        let show = document.getElementById('show');

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
                loading.classList.remove('d-none');
                loading.classList.add('d-block');
                show.classList.toggle('d-none');
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
