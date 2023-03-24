@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.apartments.update', ['apartment' => $apartment['slug']]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group my-3">
                <div class="mb-3">
                    <label for="" class="form-label">Aggiungi title</label>
                    <input value="{{ old('title') ?? $apartment['title'] }}" type="text" class="form-control"
                        id="" aria-describedby="" name="title">
                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Numero stanze</label>
                    <input value="{{ old('n_room') ?? $apartment['n_room'] }}" type="number" id=""
                        class="form-control" name="n_room">
                    @error('n_room')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Numero letti</label>
                    <input value="{{ old('n_bed') ?? $apartment['n_bed'] }}" type="number" id=""
                        class="form-control" name="n_bed">
                    @error('n_bed')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Numero bagni</label>
                    <input value="{{ old('n_bathroom') ?? $apartment['n_bathroom'] }}" type="number" id=""
                        class="form-control" name="n_bathroom">
                    @error('n_bathroom')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Grandezza appartamento in mq</label>
                    <input value="{{ old('mq') ?? $apartment['mq'] }}" type="number" id="" class="form-control"
                        name="mq">
                    @error('mq')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <div>
                        <img src="{{ asset('storage/' . $apartment->image) }}" class="w-50">
                    </div>
                    <input type="file" name="image" id="image"
                        class="form-control
                    @error('image')is-invalid @enderror">
                    @error('image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Latitudine</label>
                    <input value="{{ old('latitude') ?? $apartment['latitude'] }}" type="number" id=""
                        class="form-control" name="latitude">
                    @error('latitude')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Longitudine</label>
                    <input value="{{ old('longitude') ?? $apartment['longitude'] }}" type="number" id=""
                        class="form-control" name="longitude">
                    @error('longitude')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
        </form>
    </div>
@endsection
