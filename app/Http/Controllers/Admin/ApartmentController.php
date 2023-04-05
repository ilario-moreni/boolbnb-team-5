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
}
