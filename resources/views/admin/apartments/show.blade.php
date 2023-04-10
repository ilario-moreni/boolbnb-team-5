@extends('layouts.admin')
@section('content')
    <div class="container-fluid my-5">
        <div class="row bg-light-transparent">
            <div class="col-8 p-0">
                @if ($apartment->image == null)
                    <img class="w-100" src="https://www.finconsumo.com/wp-content/uploads/2022/07/placeholder-176.png"
                        alt="">
                @else
                    <img class="w-100" src="{{ asset('storage/' . $apartment->image) }}" alt="">
                @endif
            </div>
            <div class="col-4">
                <h1>{{ $apartment->title }}</h1>
                <div><strong>Indirizzo:</strong> {{$address_complete}}</div>
                <hr class="w-25 border-top-3">
                <div class="d-flex flex-column gap-2">
                    <div>
                        <i class="fa-solid fa-person-shelter"></i>
                        <span><strong>Stanze: </strong>{{ $apartment->n_room }}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-bed"></i>
                        <span><strong>Letti: </strong>{{ $apartment->n_bed }}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-bath"></i>
                        <span><strong>Bagni: </strong>{{ $apartment->n_bathroom }}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-kaaba"></i>
                        <span><strong>m&#178;: </strong>{{ $apartment->mq }}</span>
                    </div>
                    <hr class="w-25 border-top-3">
                    <div>
                        <span><strong>Servizi:</strong></span>
                        @forelse ($apartment->services as $item)
                            {{ $loop->first ? '' : '' }}
                            <div> <i class="{{ $item->class_icon }} me-2"></i>{{ $item->name }}</div>
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
