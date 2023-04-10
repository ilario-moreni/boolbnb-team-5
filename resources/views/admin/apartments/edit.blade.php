@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <form class="form" action="{{ route('admin.apartments.update', ['apartment' => $apartment['slug']]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mt-5 p-5 bg-light-transparent">
                <div class="col-6 mb-3">
                    <label for="" class="form-label">Aggiungi titolo</label>
                    <input value="{{ old('title') ?? $apartment['title'] }}" type="text" class="form-control"
                        id="title" aria-describedby="" name="title">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2">
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
                        <label for="" class="form-label">Grandezza appartamento</label>
                        <input value="{{ old('mq') ?? $apartment['mq'] }}" type="number" id="mq"
                            class="form-control" name="mq">
                        <div class="error d-none alert alert-danger mt-2"></div>
                        @error('mq')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <div>
                        @if ($apartment->image != null)
                            <img src="{{ asset('storage/' . $apartment->image) }}" class="w-50 my-3">
                        @endif
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
                <div class="form-row d-flex gap-2">
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">Inserisci Via</label>
                        <input type="text" id="address" class="form-control" name="address" value="{{$address_complete}}">
                        <div class="error d-none alert alert-danger mt-2"></div>
                        @error('address')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="" class="form-label">N. Civico</label>
                        <input type="number" id="n_house" class="form-control" name="n_house" >
                        <div class="error d-none alert alert-danger mt-2"></div>
                        @error('address')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="" class="form-label">Cap</label>
                        <input type="number" id="cap" class="form-control" name="cap" >
                        <div class="error d-none alert alert-danger mt-2"></div>
                        @error('address')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- <div class="form-group my-3">
                    <label for="" class="form-label">Inserisci Via</label>
                    <input type="text" id="address" class="form-control" name="address">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('address')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">N. Civico</label>
                    <input type="number" id="n_house" class="form-control" name="n_house">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('address')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="" class="form-label">Cap</label>
                    <input type="number" id="cap" class="form-control" name="cap">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('address')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group"> --}}
                <button type="submit" class="btn button-color text-white">Salva</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/aptValidation.js') }}"></script>
@endsection
