<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {

        $apartments = Apartment::with('services', 'sponsorships')->paginate();
        $prova = $request->name;

        return response()->json([
            'success' => true,
            'apartments' => $apartments,
            'prova' => $prova

        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::with('services', 'sponsorships')->where('slug', $slug)->first();

        if ($apartment) {
            return response()->json([
                'success' => true,
                'apartment' => $apartment,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessun appartamento trovato',
            ]);
        }
    }
}
