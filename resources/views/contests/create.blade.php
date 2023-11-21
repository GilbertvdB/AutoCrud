@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Create contest</h1>

    <form method="POST" action="{{ route('contests.store') }}" enctype='multipart/form-data'>
        @csrf
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                
                    <div class="form-group mb-3">
                        <label for="title" class="@if ($errors->has('title')) text-danger @endif">{{ __('labels.title') }}</label>
                        <input type="text" id="title" name="title" class="form-control @if ($errors->has('title')) is-invalid @endif"
                            placeholder="{{ __('labels.title') }}..." value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="date" class="@if ($errors->has('date')) text-danger @endif">{{ __('labels.date') }}</label>
                        <input type="text" id="date" name="date" class="form-control @if ($errors->has('date')) is-invalid @endif"
                            placeholder="{{ __('labels.date') }}..." value="{{ old('date') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="content" class="@if ($errors->has('content')) text-danger @endif">{{ __('labels.content') }}</label>
                        <textarea id="content" name="content" class="form-control @if ($errors->has('content')) is-invalid @endif"
                            placeholder="{{ __('labels.content') }}..." required>{{ old('content') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image" class="@if ($errors->has('image')) text-danger @endif">{{ __('labels.image') }}</label>
                        <input type="file" id="image" name="image" class="form-control @if ($errors->has('image')) is-invalid @endif" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="blok1-title" class="@if ($errors->has('blok1-title')) text-danger @endif">{{ __('labels.blok1-title') }}</label>
                        <input type="text" id="blok1-title" name="blok1-title" class="form-control @if ($errors->has('blok1-title')) is-invalid @endif"
                            placeholder="{{ __('labels.blok1-title') }}..." value="{{ old('blok1-title') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="blok1-content" class="@if ($errors->has('blok1-content')) text-danger @endif">{{ __('labels.blok1-content') }}</label>
                        <textarea id="blok1-content" name="blok1-content" class="form-control @if ($errors->has('blok1-content')) is-invalid @endif"
                            placeholder="{{ __('labels.blok1-content') }}..." required>{{ old('blok1-content') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="blok1-image" class="@if ($errors->has('blok1-image')) text-danger @endif">{{ __('labels.blok1-image') }}</label>
                        <input type="file" id="blok1-image" name="blok1-image" class="form-control @if ($errors->has('blok1-image')) is-invalid @endif" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="blok2-title" class="@if ($errors->has('blok2-title')) text-danger @endif">{{ __('labels.blok2-title') }}</label>
                        <input type="text" id="blok2-title" name="blok2-title" class="form-control @if ($errors->has('blok2-title')) is-invalid @endif"
                            placeholder="{{ __('labels.blok2-title') }}..." value="{{ old('blok2-title') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="blok2-content" class="@if ($errors->has('blok2-content')) text-danger @endif">{{ __('labels.blok2-content') }}</label>
                        <textarea id="blok2-content" name="blok2-content" class="form-control @if ($errors->has('blok2-content')) is-invalid @endif"
                            placeholder="{{ __('labels.blok2-content') }}..." required>{{ old('blok2-content') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="blok2-image" class="@if ($errors->has('blok2-image')) text-danger @endif">{{ __('labels.blok2-image') }}</label>
                        <input type="file" id="blok2-image" name="blok2-image" class="form-control @if ($errors->has('blok2-image')) is-invalid @endif" required>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>
</div>
@endsection