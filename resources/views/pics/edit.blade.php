@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Create pic</h1>

    <form method="POST" action="{{ route('pics.update', $pic) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                
                    <div class="form-group mb-3">
                        <label for="name" class="@if ($errors->has('name')) text-danger @endif">{{ __('labels.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            placeholder="{{ __('labels.name') }}..." value="{{ old('name', $pic->name) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ asset('images/'.$pic->image) }}" alt="Current Image" class="img-thumbnail" width="200">
                            </div>
                            <div class="col-9">
                                <label for="image" class="@if ($errors->has('image')) text-danger @endif">{{ __('labels.image') }}</label>
                                <input type="file" id="image" name="image" class="form-control-file @if ($errors->has('image')) is-invalid @endif">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="active" class="@if ($errors->has('active')) text-danger @endif">{{ __('labels.active') }}</label>
                        <select id="active" name="active" class="form-control @if ($errors->has('active')) is-invalid @endif" required>
                            <option value="">{{ __('labels.choice') }}</option>
                            <option value="1" @if ($pic->active == 1) selected @endif>{{ __('labels.yes') }}</option>
                            <option value="0" @if ($pic->active == 0) selected @endif>{{ __('labels.no') }}</option>
                            {{-- @foreach ($options as $option)
                            <option value="{{ $option->id }}" @if ($pic->active == $option->id) selected @endif>{{ $option->name }}</option>
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