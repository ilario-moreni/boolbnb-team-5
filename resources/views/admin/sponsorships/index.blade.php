@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row my-5">
            <div class="col-12 d-flex justify-content-between">

                <div class="card rounded-4 p-2 bg-azure" style="width: 22rem;">
                    <div class="card-body">
                        <h5 class="card-title h1 text-center">{{ $sponsorships[0]->name }}</h5>

                        <div class="d-flex mt-4">
                            <h3 class="m-0">h{{ $sponsorships[0]->duration }}/</h3>
                            <h4 class="m-0">€{{ $sponsorships[0]->price }}</h4>
                        </div>

                        <p class="card-text h5 lh-lg text-center my-4">{{ $sponsorships[0]->description }}</p>
                        <a href="#" class="btn button-color text-white">Acquista</a>
                    </div>
                </div>

                <div class="card rounded-4 p-2 bg-blue" style="width: 22rem;">
                    <div class="card-body">
                        <h5 class="card-title h1 text-center">{{ $sponsorships[1]->name }}</h5>

                        <div class="d-flex mt-4">
                            <h3 class="m-0">h{{ $sponsorships[1]->duration }}/</h3>
                            <h4 class="m-0">€{{ $sponsorships[1]->price }}</h4>
                        </div>

                        <p class="card-text h5 lh-lg text-center my-4">{{ $sponsorships[1]->description }}</p>
                        <a href="#" class="btn button-color text-white">Acquista</a>
                    </div>
                </div>

                <div class="card rounded-4 p-2 bg-pink" style="width: 22rem;">
                    <div class="card-body">
                        <h5 class="card-title h1 text-center">{{ $sponsorships[2]->name }}</h5>

                        <div class="d-flex mt-4">
                            <h3 class="m-0">h{{ $sponsorships[2]->duration }}/</h3>
                            <h4 class="m-0">€{{ $sponsorships[2]->price }}</h4>
                        </div>

                        <p class="card-text h5 lh-lg text-center my-4">{{ $sponsorships[2]->description }}</p>
                        <a href="#" class="btn button-color text-white">Acquista</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection