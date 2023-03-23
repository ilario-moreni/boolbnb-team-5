@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.projects.update', ['project' => $project['slug']]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">modifica titolo</label>
                <input value="{{ old('title') ?? $apartment['title'] }}" type="text" class="form-control" id=""
                    aria-describedby="" name="title">
                @error('title')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <div>
                        <img src="{{ asset('storage/' . $project->cover_image) }}" class="w-50">
                    </div>
                    <input type="file" name="cover_image" id="cover_image"
                        class="form-control
                    @error('cover_image')is-invalid @enderror">
                    @error('cover_image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salva modifiche</button>
            </div>
        </form>
    </div>
@endsection
