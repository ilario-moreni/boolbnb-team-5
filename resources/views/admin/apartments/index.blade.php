@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <h2>Apartments List</h2>
                </div>
                <div>

                    <a href="{{ route('admin.apartments.create') }}" class="btn button-color mt-4 text-white">Add
                        Apartment</a>

                    @if (session('message'))
                        <div class="alert alert-success mt-5">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-danger mt-5">
                            {{ session('warning') }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table bg-light-transparent ">
                    <thead class="table-dark">
                        <th>Image</th>
                        <th>Title</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                        <th>Inbox</th>
                    </thead>
                    <tbody>
                        @forelse ($apartments as $apartment)
                            <tr>
                                <td class="w-25">
                                    @if ($apartment->image == null)
                                        <img class="w-100"
                                            src="https://www.finconsumo.com/wp-content/uploads/2022/07/placeholder-176.png"
                                            alt="">
                                    @else
                                        <img class="w-100" src="{{ asset('storage/' . $apartment->image) }}"
                                            alt="">
                                    @endif
                                </td>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->created_at }}</td>
                                <td>{{ $apartment->updated_at }}</td>
                                <td class="">
                                    <div class="d-flex">
                                        <div>
                                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}"
                                                title="Visualizza Appartamento"
                                                class="button-action btn btn-sm btn-primary  my-2">
                                                <i class="fa-solid fa-eye elem-center"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.apartments.edit', $apartment->slug) }}"
                                                title="Modifica Appartamento"
                                                class="button-action btn btn-sm btn-warning text-white my-2 ms-2">
                                                <i class="fa-solid fa-pencil elem-center"></i>
                                            </a>
                                        </div>
                                        <form action="{{ route('admin.apartments.destroy', $apartment->slug) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="button-action btn btn-sm  btn-danger my-2 ms-2 confirm_delete_button"
                                                data-bs-toggle="modal" data-bs-target="#delete-modal-apartment"
                                                data-projectid="{{ $apartment->id }}">
                                                <i class="fa-solid fa-trash-can elem-center"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="">
                                    <a href="{{ route('admin.messages', $apartment->id) }}"
                                        class="button-action btn btn-sm btn-success mt-2">
                                        <i class="fa-regular fa-envelope elem-center"></i>
                                        @if ($apartment->messages)
                                            <div class='notification'>
                                                {{ count($apartment->messages) }}
                                            </div>
                                        @else
                                        @endif
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <div class="container">
                                <div class="row justify-content-center mt-5">
                                    <div class="col-lg-8 col-md-10 col-sm-12">
                                        <div class="alert alert-primary text-center" role="alert">
                                            <h4 class="alert-heading mb-4">Il database dei tuoi annunci è vuoto.</h4>
                                            <p class="lead">Clicca sul pulsante "Add Apartment" per crearne uno.</p>
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
