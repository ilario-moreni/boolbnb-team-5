@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-12 d-flex justify-content-between">
                @foreach ($sponsorships as $item)
                    <div class="card rounded-4 p-2 bg-azure" style="width: 22rem;">
                        <div class="card-body">
                            <h5 class="card-title h1 text-center">{{ $item->name }}</h5>
                            <div class="d-flex mt-4">
                                <h3 class="m-0">h{{ $item->duration }}/</h3>
                                <h4 class="m-0">€{{ $item->price }}</h4>
                            </div>
                            <p class="card-text h5 lh-lg text-center my-4">{{ $item->description }}</p>
                            @if (!$isSponsored)
                                <a class="btn button-color text-white"
                                    href="{{ route('admin.sponsorships.show', ['apartmentSlug' => $apartmentSlug, 'id' => $item->id]) }}">Acquista</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if ($isSponsored)
                    <h3>Questo appartamento è già sponsorizzato</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
