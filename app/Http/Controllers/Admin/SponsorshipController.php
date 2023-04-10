<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsorship;
use App\Models\Apartment;


class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sponsorships = Sponsorship::all();
        $apartmentSlug = $request->apartmentSlug;

        $apartment = Apartment::where('slug', $apartmentSlug)->first();
        // Check if the apartment is already sponsored
        $isSponsored = $apartment->sponsorships()->where('expired_at', '>', now())->exists();

        return view('admin.sponsorships.index', compact('sponsorships', 'apartmentSlug', 'isSponsored'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // dd($request->route()->parameters());
        // dd($request->id);
        $sponsorship = Sponsorship::findOrFail($request->id);
        $apartmentSlug = $request->apartmentSlug;
        // dd($apartmentSlug);
        // PAGAMENTO parte form
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $token = $gateway->ClientToken()->generate();
        return view('admin.sponsorships.show', compact('sponsorship', 'token', 'apartmentSlug'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function processPayment(Request $request)
    {

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $sponsorship = Sponsorship::findOrFail($request->id);
        $apartment = Apartment::where('slug', $request->apartmentSlug)->firstOrFail();
        $amount = $sponsorship->price;
        $nonce = $request->input('payment_method_nonce');
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Sophia',
                'lastName' => 'Mziou',
                'email' => 'sofiamziou@gmail.com'
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success || !is_null($result->transaction)) {
            $transaction = $result->transaction;
            $sponsorship->save();
            $createdAt = $transaction->createdAt->format('Y-m-d H:i:s');
            if ($request->id === '1') {
                $expired_at = date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($createdAt)));
            } elseif ($request->id === '2') {
                $expired_at = date('Y-m-d H:i:s', strtotime('+72 hours', strtotime($createdAt)));
            } else {
                $expired_at = date('Y-m-d H:i:s', strtotime('+1 hours', strtotime($createdAt)));
            }
            $apartment->sponsorships()->attach(
                $sponsorship->id,
                ['expired_at' => $expired_at]
            );

            return redirect()->route('admin.apartments.index')->with('success_message', 'Pagamento effettuato con successo');
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('An error occurred with the message:' . $result->message);
        }
    }
}
