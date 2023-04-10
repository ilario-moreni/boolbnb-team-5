@extends('layouts.admin')
@section('content')
    <div class="container-fluid my-5">
        <form class="form" action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group my-3 d-flex flex-wrap justify-content-between">
                <div class="my-3 my-lg-0 col-12">
                    <label for="" class="form-label">Aggiungi titolo</label>
                    <input type="text" class="form-control" id="title" aria-describedby="" name="title">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3 v-14">
                    <label for="" class="form-label">Numero stanze</label>
                    <input type="number" id="rooms" class="form-control" name="n_room">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('n_room')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3 v-14">
                    <label for="" class="form-label">Numero letti</label>
                    <input type="number" id="beds" class="form-control" name="n_bed">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('n_bed')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3 v-14">
                    <label for="" class="form-label">Numero bagni</label>
                    <input type="number" id="bathrooms" class="form-control" name="n_bathroom">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('n_bathroom')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3 v-14">
                    <label for="" class="form-label">Grandezza appartamento in mq</label>
                    <input type="number" id="mq" class="form-control" name="mq">
                    <div class="error d-none alert alert-danger mt-2"></div>
                    @error('mq')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12">
                    <label class="control-label">Copertina</label>
                    <input  type="file" name="image" id="image"
                        class="form-control @error('image')is-invalid @enderror">
                    @error('image')
                        <div class="text-danger">
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Seleziona i servizi</label>
                    @foreach ($services as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $item['id'] }}" name="services[]">
                            <label class="form-check-label">
                                {{ $item['name'] }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group mb-3 d-flex flex-wrap justify-content-between">
                    <div class="my-3  v-13">
                        <label for="" class="form-label">Inserisci Via</label>
                        <input type="text" id="address" class="form-control" name="address">
                        <div class="error d-none alert alert-danger mt-2"></div>
                        @error('address')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-3  v-13">
                        <label for="" class="form-label">N. Civico</label>
                        <input type="number" id="n_house" class="form-control" name="n_house">
                        <div class="error d-none alert alert-danger mt-2"></div>
                        @error('address')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-3  v-13">
                        <label for="" class="form-label">Cap</label>
                        <input type="number" id="cap" class="form-control" name="cap">
                        <div class="error d-none alert alert-danger mt-2"></div>
                        @error('address')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary button-color">Salva</button>
                </div>
        </form>
    </div>

    <script src="{{ asset('js/aptValidation.js') }}"></script>
@endsection
