@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 my-5">
            <div class="d-flex justify-content-between">
                <h2>Apartments List</h2>
            </div>
            <div>
                <a href="{{route('admin.projects.create')}}" class="btn btn-sm btn-primary mt-4">Add Apartment</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead class="table-dark">
                    <th>Image</th>
                    <th>Title</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($apartments as $apartment)
                        <tr>
                            <td><img class="w-25" src="{{$apartment->image}}" alt=""></td>
                            <td>{{$apartment->title}}</td>
                            <td>{{$apartment->created_at}}</td>
                            <td>{{$apartment->updated_at}}</td>
                            <td class="d-flex justify-content-around">
                                <a href="{{route('admin.apartments.show', $apartment->slug)}}" title="Visualizza Appartamento" class="btn btn-sm btn-primary btn-square">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{route('admin.apartments.edit', $apartment->slug)}}" title="Modifica Appartamento" class="btn btn-sm btn-warning btn-square">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{route('admin.apartments.destroy', $apartment->slug)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-square btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-apartment" data-projectid="{{$apartment->id}}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection