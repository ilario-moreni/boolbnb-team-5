@extends('layouts.admin')
@section('content')
    <div id="loader" class="container h-100 d-none">
        <div class="row h-100">
            <div class="col h-100 d-flex align-items-center justify-content-center flex-column">
                <h3>pagamento in corso, attendere...</h3>
                <lord-icon src="https://cdn.lordicon.com/slkvcfos.json" trigger="loop" delay="1000"
                    style="width:300px;height:300px">
                </lord-icon>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-lg-row d-block justify-content-center align-items-center">
        <div id="show" class="container">
            <div class="row my-5">
                <div class="col mx-3">
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
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <form class="m-5" method="post" id="payment-form"
                        action="{{ route('admin.sponsorships.process_payment', ['apartmentSlug' => $apartmentSlug, 'id' => $sponsorship->id]) }}">
                        @csrf
                        <section>
                            <label for="amount" class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h5 class="input-label m-0">Totale:</h5>
                                    <h5>{{ $sponsorship->price }} €</h5>
                                </div>
                            </label>
                            <div class="bt-drop-in-wrapper">
                                <div id="bt-dropin"></div>
                            </div>
                        </section>
                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button class="btn button-color text-white my-2" type="submit"><span>Test
                                Transaction</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.min.js"></script>
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
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
