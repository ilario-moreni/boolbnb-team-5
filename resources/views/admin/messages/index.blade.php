@extends('layouts.admin')
@section('content')
    <div>
        <div class="container">
            <div class="row">
                <div class="col">
                    {{ $messages_count }} nuovi messaggi.
                </div>
            </div>
        </div>
        <div class="container">
            @foreach ($messages as $message)
                <div class="row ">
                    <div class="col-8 my-3">
                        <div class="card border border-primary border-3">

                            <h5 class="card-title p-2 border-bottom border-primary">{{ $message->name }}
                                {{ $message->surname }}</h5>
                            <div class="d-flex justify-content-between px-2 border-bottom border-primary">
                                <h6 class="card-subtitle  text-muted">{{ $message->email }}</h6>
                                <p class="fs-6 card-subtitle  text-muted">{{ $message->created_at }}</p>
                            </div>
                            <p class="card-text p-2 mt-2">{{ $message->description }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
