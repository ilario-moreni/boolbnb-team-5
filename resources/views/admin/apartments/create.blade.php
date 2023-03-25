@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <form class="form" action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group my-3">
                <div class="mb-3">
                    <label for="" class="form-label">Aggiungi title</label>
                    <input type="text" class="form-control" id="title" aria-describedby="" name="title">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Numero stanze</label>
                    <input type="number" id="rooms" class="form-control" name="n_room">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('n_room')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Numero letti</label>
                    <input type="number" id="beds" class="form-control" name="n_bed">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('n_bed')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Numero bagni</label>
                    <input type="number" id="bathrooms" class="form-control" name="n_bathroom">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('n_bathroom')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Grandezza appartamento in mq</label>
                    <input type="number" id="mq" class="form-control" name="mq">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('mq')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="control-label">Copertina</label>
                    <input type="file" name="image" id="image"
                        class="form-control @error('image')is-invalid @enderror">
                    @error('image')
                        <div class="text-danger">
                        @enderror
                    </div>
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Latitudine</label>
                    <input type="number" id="latitude" class="form-control" name="latitude">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('latitude')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Longitudine</label>
                    <input type="number" id="longitude" class="form-control" name="longitude">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('longitude')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
        </form>
    </div>

    <script src="{{ asset('js/aptValidation.js') }}"></script>
@endsection
