@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Create test2</h1>

    <form method="POST" action="{{ route('test2s.update'), test2 }}" >
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                
                    <div class="form-group mb-3">
                        <label for="fillings" class="@if ($errors->has('fillings')) text-danger @endif">{{ __('labels.fillings') }}</label>
                        <input type="text" id="fillings" name="fillings" class="form-control @if ($errors->has('fillings')) is-invalid @endif"
                            placeholder="{{ __('labels.fillings') }}..." value="{{ old('fillings', $test2->fillings) }}" required>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection