@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <form class="form" action="{{ route('admin.apartments.update', ['apartment' => $apartment['slug']]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mt-5 p-5 bg-light-transparent">
                <div class="mb-3">
                    <label for="" class="form-label">Aggiungi title</label>
                    <input value="{{ old('title') ?? $apartment['title'] }}" type="text" class="form-control"
                        id="title" aria-describedby="" name="title">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Numero stanze</label>
                    <input value="{{ old('n_room') ?? $apartment['n_room'] }}" type="number" id="rooms"
                        class="form-control" name="n_room">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('n_room')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Numero letti</label>
                    <input value="{{ old('n_bed') ?? $apartment['n_bed'] }}" type="number" id="beds"
                        class="form-control" name="n_bed">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('n_bed')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Numero bagni</label>
                    <input value="{{ old('n_bathroom') ?? $apartment['n_bathroom'] }}" type="number" id="bathrooms"
                        class="form-control" name="n_bathroom">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('n_bathroom')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Grandezza appartamento in mq</label>
                    <input value="{{ old('mq') ?? $apartment['mq'] }}" type="number" id="mq" class="form-control"
                        name="mq">
                    <div class="error d-none alert alert-danger mt-2"></div>
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
                <div class="mb-3">
                    <label for="" class="form-label">Seleziona servizi</label>
                    @foreach ($services as $item)
                        <div class="form-check @error('services') is-invalid @enderror">
                            @if ($errors->any())
                                <input class="form-check-input" type="checkbox" value="{{ $item['id'] }}"
                                    name="services[]" {{ in_array($item['id'], old('services', [])) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $item['name'] }}
                                </label>
                            @else
                                <input class="form-check-input" type="checkbox" value="{{ $item['id'] }}"
                                    name="services[]" {{ $apartment['services']->contains($item) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $item['name'] }}
                                </label>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Latitudine</label>
                    <input value="{{ old('latitude') ?? $apartment['latitude'] }}" type="number" id="latitude"
                        class="form-control" name="latitude">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('latitude')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Longitudine</label>
                    <input value="{{ old('longitude') ?? $apartment['longitude'] }}" type="number" id="longitude"
                        class="form-control" name="longitude">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('longitude')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn button-color text-white">Salva</button>
                </div>
        </form>
    </div>
    <script src="{{ asset('js/aptValidation.js') }}"></script>
@endsection
