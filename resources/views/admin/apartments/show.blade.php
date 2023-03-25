@extends('layouts.admin')
@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-8">
                {{-- <img class="w-100" src="{{ asset('storage/'.$apartment->image) }}" alt="{{ $apartment->title }}"> --}}
                <img class="w-100" src="{{ asset('storage/'.$apartment->image) }}" alt="{{ $apartment->title }}">
            </div>
            <div class="col-4">
                <h1>{{ $apartment->title }}</h1>
                <hr class="w-25 border-top-3">
                <div class="d-flex flex-column gap-2">
                    <div>
                        <i class="fa-solid fa-person-shelter"></i>
                        <span><strong>Rooms: </strong>{{ $apartment->n_room}}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-bed"></i>
                        <span><strong>Beds: </strong>{{ $apartment->n_bed}}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-bath"></i>
                        <span><strong>Bathrooms: </strong>{{ $apartment->n_bathroom}}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-kaaba"></i>
                        <span><strong>m&#178;: </strong>{{ $apartment->mq}}</span>
                    </div>
                </div>
                <hr class="w-25 border-top-3">
                
                {{ $apartment->latitude}}
                {{ $apartment->longitude}}
            </div>
        </div>
    </div>
    {{-- {{ $apartment->title }} --}}
@endsection