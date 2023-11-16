@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Create img</h1>

    <form method="POST" action="{{ route('imgs.update'), img }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                
                    <div class="form-group mb-3">
                        <label for="name" class="@if ($errors->has('name')) text-danger @endif">{{ __('labels.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            placeholder="{{ __('labels.name') }}..." value="{{ old('name', $img->name) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ asset('images/'.$img->path) }}" alt="Current Image" class="img-thumbnail" width="200">
                            </div>
                            <div class="col-9">
                                <label for="path" class="@if ($errors->has('path')) text-danger @endif">{{ __('labels.path') }}</label>
                                <input type="file" id="path" name="path" class="form-control-file @if ($errors->has('path')) is-invalid @endif">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="user_id" class="@if ($errors->has('user_id')) text-danger @endif">{{ __('labels.user_id') }}</label>
                        <select id="user_id" name="user_id" class="form-control @if ($errors->has('user_id')) is-invalid @endif" required>
                            <option value="">{{ __('labels.choice') }}</option>
                            {{-- @foreach ($options as $option)
                            <option value="{{ $option->id }}" @if ($img->user_id == $option->id) selected @endif>{{ $option->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection