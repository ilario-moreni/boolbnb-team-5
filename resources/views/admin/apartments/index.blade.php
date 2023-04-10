@extends('layouts.admin')
@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12 my-3">
                <div class="d-flex justify-content-between align-items-center my-4">
                    <h2 class="text-dark m-0">I tuoi Appartamenti</h2>
                    <a href="{{ route('admin.apartments.create') }}" class="btn button-color text-white d-none d-md-flex">Aggiungi
                        Appartamenti</a>
                    <a href="{{ route('admin.apartments.create') }}" class="btn button-color text-white d-md-none"><i class="fa-solid fa-plus"></i></a>
                </div>
                <div class="row">
                    @if (session('message'))
                        <div class="col-6 alert alert-success mt-2 mb-0">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="col-6 alert alert-danger mt-2 mb-0">
                            {{ session('warning') }}
                        </div>
                    @endif
                    @if (session('success_message'))
                        <div class="col-6 alert alert-success mt-2 mb-0">
                            {{ session('success_message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <div class="col-md-4 d-flex flex-wrap">
                </div>

                {{-- tabella --}}
                <table class="table bg-light-transparent">
                    <thead class="table-dark">
                        <th>Immagine</th>
                        <th>Titolo</th>
                        <th>Informazioni</th>
                        <th>Creato il:</th>
                        <th>Azioni</th>
                    </thead>
                    <tbody>
                        @forelse ($apartments as $apartment)
                            <tr>
                                <td class="img_table">
                                    @if ($apartment->image == null)
                                        <img class="w-100 altezza_img_apt"
                                            src="https://www.finconsumo.com/wp-content/uploads/2022/07/placeholder-176.png"
                                            alt="">
                                    @else
                                        <img class="w-100 altezza_img_apt" src="{{ asset('storage/' . $apartment->image) }}"
                                            alt="">
                                    @endif
                                </td>
                                <td>
                                    {{ $apartment->title }}
                                    @if ($isSponsored[$loop->index])
                                        <i class="fa-solid fa-crown"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($isSponsored[$loop->index])
                                        <div>La tua sponsorizzazione scade il:
                                            {{ date('d/m/Y', strtotime($apartment->sponsorships->first()->pivot->expired_at)) }}
                                        </div>
                                    @elseif ($apartment->sponsorships->isNotEmpty())
                                        <p>la sponsorizzazione è scaduta</p>
                                    @else
                                        <p>Questo appartamento non è sponsorizzato</p>
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y', strtotime($apartment->created_at)) }}</td>
                                <td class="">
                                    <div class="d-flex">
                                        <div>
                                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}"
                                                title="Visualizza Appartamento">
                                                <lord-icon src="https://cdn.lordicon.com/tyounuzx.json" trigger="hover"
                                                    style="width:40px;height:40px">
                                                </lord-icon>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.apartments.edit', $apartment->slug) }}"
                                                title="Modifica Appartamento">
                                                <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover"
                                                    style="width:40px;height:40px">
                                                </lord-icon>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.sponsorships.index', ['apartmentSlug' => $apartment->slug]) }}"
                                                title="Sponsorizza Appartamento">
                                                <lord-icon src="https://cdn.lordicon.com/mdgrhyca.json" trigger="morph"
                                                    style="width:40px;height:40px">
                                                </lord-icon>
                                            </a>
                                        </div>
                                        <form action="{{ route('admin.apartments.destroy', $apartment->slug) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a type="submit" class="button-action m-0 confirm_delete_button"
                                                data-bs-toggle="modal" data-bs-target="#delete-modal-apartment"
                                                data-projectid="{{ $apartment->id }}">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="hover"
                                                    style="width:40px;height:40px">
                                                </lord-icon>
                                            </a>
                                        </form>
                                        <a href="{{ route('admin.messages', $apartment->id) }}" class="button-action">
                                            <lord-icon src="https://cdn.lordicon.com/zpxybbhl.json" trigger="hover"
                                                style="width:40px;height:40px">
                                            </lord-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="container">
                                <div class="row justify-content-center mt-5">
                                    <div class="col-lg-8 col-md-10 col-sm-12">
                                        <div class="alert alert-primary text-center" role="alert">
                                            <h4 class="alert-heading mb-4">Il database dei tuoi annunci è vuoto.</h4>
                                            <p class="lead">Clicca sul pulsante "Aggiungi Appartamento" per crearne uno.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </tbody>
                </table>
                @include ('admin.partials.modals')
            </div>
        </div>
    </div>
@endsection
