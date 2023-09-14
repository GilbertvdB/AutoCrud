@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Create stuff</h1>

    <form method="POST" action="{{ route('stuffs.store') }}">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                
                    <div class="form-group mb-3">
                        <label for="name" class="@if ($errors->has('name')) text-danger @endif">{{ __('labels.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            placeholder="{{ __('labels.name') }}..." value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="job" class="@if ($errors->has('job')) text-danger @endif">{{ __('labels.job') }}</label>
                        <input type="file" id="job" name="job" class="form-control-file @if ($errors->has('job')) is-invalid @endif" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="active" class="@if ($errors->has('active')) text-danger @endif">{{ __('labels.active') }}</label>
                        <input type="number" id="active" name="active" class="form-control @if ($errors->has('active')) is-invalid @endif"
                            placeholder="{{ __('labels.active') }}..." value="{{ old('active') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="user_id" class="@if ($errors->has('user_id')) text-danger @endif">{{ __('labels.user_id') }}</label>
                        <select id="user_id" name="user_id" class="form-control @if ($errors->has('user_id')) is-invalid @endif" required>
                            <option value="">{{ __('labels.choice') }}</option>
                            {{-- @foreach ($options as $option)
                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection