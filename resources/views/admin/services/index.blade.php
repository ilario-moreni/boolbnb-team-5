@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <h2>Services List</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @forelse ($services as $service)
                    <ul>
                        <li>
                            <i class="{{ $service->class_icon }} mx-3"></i>{{ $service->name }}
                        </li>
                    </ul>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
