@extends('layouts.admin')
@section('content')
    <div class="container h-100">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center gap-md-5 gap-lg-0 my-4">
                    <div class="text-lg-center d-none d-md-block fs-3">Approfitta di una sponsorizzazione secondo le tue
                        esigenze
                    </div>
                    <a href="{{ route('admin.apartments.index') }}" class="btn button-color text-white d-none d-md-flex">Torna
                        indietro</a>
                    <a href="{{ route('admin.apartments.index') }}" class="btn button-color text-white d-md-none"><i
                            class="fa-solid fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-between align-content-center gap-4 gap-lg-0 my-4">
            @foreach ($sponsorships as $item)
                <div class="col-12 col-lg-4">
                    <article class="plan card_">
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
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col my-3">
                @if ($isSponsored)
                    <h3>Questo appartamento è già sponsorizzato</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
