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
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-danger">
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
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($apartments as $apartment)
                            <tr>
                                <td><img class="w-25" src="{{ asset('storage/' . $apartment->image) }}" alt="">
                                </td>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->created_at }}</td>
                                <td>{{ $apartment->updated_at }}</td>
                                <td class="">
                                    <a href="{{ route('admin.apartments.show', $apartment->slug) }}"
                                        title="Visualizza Appartamento" class="btn btn-sm btn-primary btn-square m-3">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.apartments.edit', $apartment->slug) }}"
                                        title="Modifica Appartamento" class="btn btn-sm btn-warning btn-square mx-3">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.apartments.destroy', $apartment->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-square btn-danger m-3 confirm_delete_button"
                                            data-bs-toggle="modal" data-bs-target="#delete-modal-apartment"
                                            data-projectid="{{ $apartment->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.messages', $apartment->id) }}"
                                        class="btn btn-sm btn-success btn-square">
                                        <i class="fa-regular fa-envelope"></i>
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
