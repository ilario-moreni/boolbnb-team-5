@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-12 d-flex justify-content-between">
                @foreach ($sponsorships as $item)
                    <article class="plan [ card ]">
                        <div class="inner">

                            <span class="pricing">
                                <span>
                                    €{{ $item->price }}
                                </span>
                            </span>
                            <h2 class="title">{{ $item->name }}</h2>
                            <p class="info">{{ $item->description }}</p>
                            <ul class="features">
                                <li>
                                    <span class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <span><strong>{{ $item->duration }}</strong> ore di visibilità</span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <span>presenza in <strong>Homepage</strong></span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <span>Più visualizzazioni</span>
                                </li>
                            </ul>
                            @if (!$isSponsored)
                                <a class="btn button-color text-white"
                                    href="{{ route('admin.sponsorships.show', ['apartmentSlug' => $apartmentSlug, 'id' => $item->id]) }}">Acquista</a>
                            @endif
                        </div>
                    </article>
                @endforeach
                {{-- @foreach ($sponsorships as $item)
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
                @endforeach --}}
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
