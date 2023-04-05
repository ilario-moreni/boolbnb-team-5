<?php

namespace App\Http\Controllers\Admin;

//Richiamo il Model
use App\Models\Apartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;
use Location\Distance\Vincenty;
use Illuminate\Support\Facades\DB;



class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $apartments = Apartment::where('user_id', $user->id)->get();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TEST
        $lat1 = 41.90232;
        $lon1 = 12.50028;
        $street = 'via%20aldo%20carratore';

        $idarray = [];
        $resultApartments = $this->getRadiusCenter($street, 20);
        foreach ($resultApartments as $apartment) {
            array_push($idarray, $apartment->id);
        }
        /* $idapartment = Apartment::whereIn('id', $idarray)->where('n_room', '>=', 1)->where('n_bed', '>=', 1)->where('n_bathroom', '>=', 1)->when($lon1 and $lat1, function ($query) use ($lat1, $lat2, $lon1, $lon2) {
            $query->addSelect(DB::raw("ST_Distance_Sphere(POINT('$lon1', '$lat1'), POINT('$lon2', '$lat2')) as distance"))->orderBy('distance');
        })->get(); */
        $cordinates = $this->getCordinates($street);

        $idapartment = Apartment::whereIn('id', $idarray)->where('n_room', '>=', 1)->where('n_bed', '>=', 1)->where('n_bathroom', '>=', 1)->select(['*'])->selectRaw("(6371 * acos(cos(radians($cordinates[0])) * cos(radians(latitude)) * cos(radians(longitude) - radians($cordinates[1])) + sin(radians($cordinates[0])) * sin(radians(latitude)))) AS distance")->havingRaw("distance < 10")->orderBy('distance')->get();
        dd($idapartment);




        //Prova 1
        $results =  Apartment::orderByDistanceFrom(41.90232, 12.50028, 'asc')->get();

        //Prova 2
        $lat1 = 41.90232;
        $lon1 = 12.50028;
        $lat2 = 41.89766;
        $lon2 = 12.42066;
        $dist = 20;
        $prova2 = Apartment::select(['id', 'title'])->when($lon1 and $lat1, function ($query) use ($lat1, $lat2, $lon1, $lon2) {
            $query->addSelect(DB::raw("ST_Distance_Sphere(POINT('$lon1', '$lat1'), POINT('$lon2', '$lat2')) as distance"))->orderBy('distance');
        })->get();
        dd($prova2);
        /* $prova3 = Apartment::select(['*'])->selectRaw("(6371 * acos(cos(radians($lat1)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lon1)) + sin(radians($lat1)) * sin(radians(latitude)))) AS distance")->orderBy('latitude')->orderBy('longitude')->havingRaw("distance < $dist")->get();
        dd($prova3); */








        //FINE TEST
        /* indirizzamento alla pagina di creazione di un nuovo apartment */
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {

        /* recupero dati validati */
        $form_data = $request->validated();
        $user = Auth::user();
        $address = str_replace(' ', ',', $request->address);
        $n_house = $request->n_house;
        $cap = $request->cap;
        /* controllo e salvataggio dell'immagine */
        $res = Http::withOptions(['verify' => false])->get("https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IT&streetNumber=" . $n_house . "&streetName=" . $address . "i&municipality=Italia&postalCode=" . $cap . "&language=it-IT&view=Unified&key=sqAC6HGqUo0FuWA7iea7gmbV4KpA2wju");
        $response = $res->json();
        $latitude = strval($response['results'][0]['position']['lat']);
        $longitude = strval($response['results'][0]['position']['lon']);

        if ($request->has('image')) {
            $path = Storage::disk('public')->put('apartment_images', $request->image);

            $form_data['image'] = $path;
        }
        /* generazione e assegnazione slug */
        $slug = Apartment::generateSlug($request->title);
        $form_data['slug'] = $slug;
        /* creazione riempimento e salvataggio istanza di apartment */
        $newApartment = new Apartment();
        $newApartment->user_id = $user->id;
        $newApartment->latitude = $latitude;
        $newApartment->longitude = $longitude;
        $newApartment->fill($form_data);
        $newApartment->save();
        if ($request->has('services')) {
            $newApartment->services()->attach($request->services);
        }
        /* reindirizzamento alla pagina index una volta completate le operazioni precedenti */
        return redirect()->route('admin.apartments.index')->with('message', 'Annuncio creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $user = Auth::user();

        if ($user->id != $apartment->user_id) {
            return redirect()->route('admin.apartments.index')->with('warning', 'Accesso Negato');
        }
        $latitude = $apartment->latitude;
        $longitude = $apartment->longitude;

        $res = Http::withOptions(['verify' => false])->get("https://api.tomtom.com/search/2/reverseGeocode/crossStreet/" . $latitude . "%2C" . $longitude . ".json?limit=1&spatialKeys=false&radius=1000&allowFreeformNewLine=false&view=Unified&key=sqAC6HGqUo0FuWA7iea7gmbV4KpA2wju");
        $response = $res->json();

        $address = $response['addresses'][0]['address'];

        return view('admin.apartments.show', compact('apartment', 'address'));
        /* indirizzamento alla pagina di visualizzazione del un nuovo apartment */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    function edit(Apartment $apartment)

    {
        $user = Auth::user();

        if ($user->id != $apartment->user_id) {
            return redirect()->route('admin.apartments.index')->with('warning', 'Accesso Negato');
        }
        $services = Service::all();
        return view('admin.apartments.edit', compact('apartment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentRequest  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {

        $user = Auth::user();
        if ($user->id != $apartment->user_id) {
            return redirect()->route('admin.apartments.index')->with('warning', 'Accesso Negato');
        }
        //VIENE VALIDATO IL FORM INVIATO DALL'UTENTE ATTRAVERSO LA CLASSE "UpdateApartmentRequest" CHE CONTROLLA CHE I DATI SIANO CORRETTI E COERENTI CON LE REGOLE DI VALIDAZIONE DEFINITE
        $form_data = $request->validated();
        //VIENE GENERATO UNO "slug" UNIVOCO PER L'APPARTAMENTO UTILIZZANDO IL METODO STATICO "generateSlug()" NEL MODELLO "Apartment".
        $slug = Apartment::generateSlug($request->title, '-');
        $form_data['slug'] = $slug;
        if ($request->hasFile('image')) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }
            $path = Storage::disk('public')->put('apartment_images', $request->image);
            $form_data['image'] = $path;
        }
        $address = str_replace(' ', ',', $request->address);
        $n_house = $request->n_house;
        $cap = $request->cap;
        $res = Http::withOptions(['verify' => false])->get("https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IT&streetNumber=" . $n_house . "&streetName=" . $address . "i&municipality=Italia&postalCode=" . $cap . "&language=it-IT&view=Unified&key=sqAC6HGqUo0FuWA7iea7gmbV4KpA2wju");
        $response = $res->json();
        $latitude = strval($response['results'][0]['position']['lat']);
        $longitude = strval($response['results'][0]['position']['lon']);
        $apartment->latitude = $latitude;
        $apartment->longitude = $longitude;
        $apartment->update($form_data);
        $apartment->services()->sync($request->services);
        return redirect()->route('admin.apartments.index')->with('message', 'Annuncio modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $user = Auth::user();
        if ($user->id != $apartment->user_id) {
            return redirect()->route('admin.apartments.index')->with('warning', 'Accesso Negato');
        }
        //Elimino il progetto specificato
        $apartment->delete();
        //Reindirizza alla pagina index.
        return redirect()->route('admin.apartments.index')->with('message', 'Annuncio cancellato correttamente');
    }
    public function getRadiusCenter($a, $b)
    {
        $cordinates = $this->getCordinates($a);

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
        $r_ange = '';
        if ($b != null) {
            $r_ange = $b * 1000;
        } else {
            $r_ange = 20000;
        }
        $apikey = 'sqAC6HGqUo0FuWA7iea7gmbV4KpA2wju';
        $radiusUrl = "https://api.tomtom.com/search/2/geometryFilter.json?geometryList=%5B%7B%22type%22%3A%22CIRCLE%22%2C%20%22position%22%3A%22" . $cordinates[0] . "%2C" . $cordinates[1] . "%22%2C%20%22radius%22%3A" . $r_ange . "%7D%2C%20%7B%22type%22%3A%22POLYGON%22%2C%20%22vertices%22%3A%5B%2237.7524152343544%2C%20-122.43576049804686%22%2C%20%2237.70660472542312%2C%20-122.43301391601562%22%2C%20%2237.712059855877314%2C%20-122.36434936523438%22%2C%20%2237.75350561243041%2C%20-122.37396240234374%22%5D%7D%5D&poiList=%5B" . $AptString . "%5D&key=" . $apikey;
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
    public function getCordinates($a)
    {
        $apikey = 'sqAC6HGqUo0FuWA7iea7gmbV4KpA2wju';
        $searchUrlFirst = 'https://api.tomtom.com/search/2/geocode/';
        $searchUrlSecond = '.json?storeResult=false&countrySet=IT&language=it-IT&view=Unified&key=';
        $newUrl = $searchUrlFirst . $a . $searchUrlSecond . $apikey;
        $res = Http::withOptions(['verify' => false])->get($newUrl);
        $response = $res->json();
        $lat = $response['results'][0]['position']['lat'];
        $lon = $response['results'][0]['position']['lon'];
        $cordinates = [];
        array_push($cordinates, $lat);
        array_push($cordinates, $lon);

        return $cordinates;
    }
}
