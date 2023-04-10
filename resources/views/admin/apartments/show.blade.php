@extends('layouts.admin')
@section('content')
    <div class="container-fluid my-5">
        <div class="row bg-light-transparent flex-column flex-lg-row">
            <div class="col-12 col-lg-8 ">
                @if ($apartment->image == null)
                    <img class="w-100" src="https://www.finconsumo.com/wp-content/uploads/2022/07/placeholder-176.png"
                        alt="">
                @else
                    <img class="w-100" src="{{ asset('storage/' . $apartment->image) }}" alt="">
                @endif
            </div>
            <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                <h1>{{ $apartment->title }}</h1>
                <div><i class="fa-solid fa-location-dot primary-color me-1"></i><strong>Indirizzo:</strong> {{$address['street']}}, {{$address['postalCode']}}, {{$address['countrySubdivision']}}</div>
                <hr class=" border-top-3">
                <div class="d-flex flex-column gap-2">
                    <div>
                        <i class="fa-solid fa-person-shelter primary-color"></i>
                        <span><strong>Stanze: </strong>{{ $apartment->n_room }}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-bed primary-color"></i>
                        <span><strong>Letti: </strong>{{ $apartment->n_bed }}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-bath primary-color"></i>
                        <span><strong>Bagni: </strong>{{ $apartment->n_bathroom }}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-kaaba primary-color"></i>
                        <span><strong>m&#178;: </strong>{{ $apartment->mq }}</span>
                    </div>
                    <hr class="border-top-3">
                    <div>
                        <span><strong>Servizi:</strong></span>
                        @forelse ($apartment->services as $item)
                            {{ $loop->first ? '' : '' }}
                            <div> <i class="{{ $item->class_icon }} me-2 primary-color"></i>{{ $item->name }}</div>
                        @empty
                            <div>nessun servizio</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ $apartment->title }} --}}
@endsection
