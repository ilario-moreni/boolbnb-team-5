<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;

class ApartmentController extends Controller
{

    public function index(Request $request)
    {
        $street = $request->street;

        $resultApartments = $this->getRadiusCenter($street);

        return response()->json([
            'success' => true,
            'filteredList' => $resultApartments

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

    public function filter(Request $filter)
    {

        $street = $filter->street;
        /* $range = $filter->range; */
        $rooms = strval($filter->n_rooms);
        $beds = strval($filter->n_beds);
        $bathrooms = strval($filter->n_bathrooms);
        $services = $filter->services;
        $idarray = [];
        $resultApartments = $this->getRadiusCenter($street);
        foreach ($resultApartments as $apartment) {
            array_push($idarray, $apartment->id);
        }
        $idapartment = Apartment::whereIn('id', $idarray)->whereHas('services', function ($q) use ($services) {
            $q->whereIn('services.id', $services);
        })
            ->withCount(['services' => function ($q) use ($services) {
                $q->whereIn('services.id', $services);
            }])
            ->having('services_count', '=', count($services))->where('n_room', '>=', $rooms)->where('n_bed', '>=', $beds)->where('n_bathroom', '>=', $bathrooms)->get();

        return response()->json([
            'success' => true,
            'prova' => $idapartment,
            'prova2' => $services,
            'prova3' => $street
        ]);
    }


    public function getRadiusCenter($a)
    {
        $apikey = 'sqAC6HGqUo0FuWA7iea7gmbV4KpA2wju';
        $searchUrlFirst = 'https://api.tomtom.com/search/2/geocode/';
        $searchUrlSecond = '.json?storeResult=false&countrySet=IT&language=it-IT&view=Unified&key=';
        $newUrl = $searchUrlFirst . $a . $searchUrlSecond . $apikey;
        $res = Http::withOptions(['verify' => false])->get($newUrl);
        $response = $res->json();
        $lat = $response['results'][0]['position']['lat'];
        $lon = $response['results'][0]['position']['lon'];
        $apartments = Apartment::all();
        $AptString = '';
        foreach ($apartments as $key => $apartment) {
            if ($key === (count($apartments) - 1)) {
                $AptPosition = "%7B%22position%22%3A%7B%22lat%22%3A" . $apartment->latitude . "%2C%22lon%22%3A" . $apartment->longitude . "%7D%7D";
                $AptString = $AptString . $AptPosition;
            } else {
                $AptPosition = "%7B%22position%22%3A%7B%22lat%22%3A" . $apartment->latitude . "%2C%22lon%22%3A" . $apartment->longitude . "%7D%7D%2C";

                $AptString = $AptString . $AptPosition;
            }
        }

        $radiusUrl = "https://api.tomtom.com/search/2/geometryFilter.json?geometryList=%5B%7B%22type%22%3A%22CIRCLE%22%2C%20%22position%22%3A%22" . $lat . "%2C" . $lon . "%22%2C%20%22radius%22%3A20000%7D%2C%20%7B%22type%22%3A%22POLYGON%22%2C%20%22vertices%22%3A%5B%2237.7524152343544%2C%20-122.43576049804686%22%2C%20%2237.70660472542312%2C%20-122.43301391601562%22%2C%20%2237.712059855877314%2C%20-122.36434936523438%22%2C%20%2237.75350561243041%2C%20-122.37396240234374%22%5D%7D%5D&poiList=%5B" . $AptString . "%5D&key=" . $apikey;
        $filter = Http::withOptions(['verify' => false])->get($radiusUrl);
        $positionFilter = $filter->json();
        $apartmentFilter = [];
        foreach ($positionFilter['results'] as  $position) {

            $pos_lon = $position['position']['lon'];
            $pos_lat = $position['position']['lat'];
            $singleFilter = Apartment::where('longitude', $pos_lon)->where('latitude', $pos_lat)->first();

            array_push($apartmentFilter, $singleFilter);
        }
        return $apartmentFilter;
    }
}
